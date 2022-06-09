<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: editar.php
	Objetivo: Este archivo es el encargado de modificar la  información de un material registrado en el catalogo.
	Autor: Angela Benavides
	Modificado por: Deisy Chaves
	Año: 2008
	*********************************************************/
	
	session_start();
	
	if(!isset($_SESSION['inventario']))
	{
		header ("Location: /Comunidad/Inventario/index.php");
		die();
	}
	
	require '../../functions.php';
	$root_path = "../..";
	
	$_GET['submenu_inventario'] = true;
	
	$idUbicacion = $_SESSION['idUbicacion'];
	$ubicacion = $_SESSION['ubicacion'];
	
	
	//Se obtiene la información del material a eliminar
	if($_POST['buscar'])
	{			
		if(!empty($_POST['codMaterial']) && !empty($_POST['tipoCodMaterial']))
		{
			?>
			<script language="javascript">
			location.href="eliminar.php?tipoCod=<?=$_POST['tipoCodMaterial']?>&cod=<?=$_POST['codMaterial']?>";
			</script>
			<?
		}
		else
		{
			$_GET['error_codigo'] = true;
		}
	}	

	//Se elimina la informacion del material
	if($_POST['eliminar'])
	{
		if(empty($_POST['observaciones']))
			$_GET['vacios'] = true;
		else
		{
			$fecha = date('Y-m-d');
			
			$conexion = @DBConnect('inventario');
			
			if(empty($conexion)) // Si no hay conexion
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible eliminar la informaci&oacute;n del libro, por favor intentelo m&aacute;s tarde.</p>";
			}
			else
			{
				//Se crea el registro del material eliminado  y se desabilita del catalogo
				$fallo = false;
				
				db_query('begin');
				
				$codMaterial = $_POST['codMaterial'];
				$tipoCodMaterial = $_POST['tipoCodMaterial'];
								
				$rs = db_query("select codCatalogo,titulo,codUbicacion, existencia from catalogo,inventario where inventario.tipoCodMaterial = catalogo.tipoCodMaterial and inventario.codMaterial = catalogo.codMaterial and catalogo.tipoCodMaterial='$tipoCodMaterial' and catalogo.codMaterial='$codMaterial' and estado = '0'");
				
				while($obj = pg_fetch_object($rs))
				{
				
					$rs1 = db_query("insert into inventario_cancelado (codCatalogo,codUbicacion, existencias, observaciones,fecha,cancelado_por) values('$obj->codcatalogo', '$obj->codubicacion', '$obj->existencia', '$_POST[observaciones]', '$fecha','{$_SESSION[inventario][login]}')");
					
					$rs2 = db_query("delete from inventario where tipoCodMaterial='$tipoCodMaterial' and codMaterial='$codMaterial' and codUbicacion = '$obj->codubicacion'");
					
					if(!$rs1 || !$rs2) $fallo = true;
				}

				
				$rs3 = db_query("update catalogo set estado='3' where tipoCodMaterial='$tipoCodMaterial' and codMaterial='$codMaterial'");
				
				if(!$rs3) $fallo = true;
				
				if($fallo)
				{
					db_query('rollback');
					$_GET['fallo'] = true;
				}
				else
				{
					db_query('commit');
					unset($_GET['material']);
					$_GET['elimino'] = true;
				}
			}
		}
	}
	
	//Se cancela la eliminacion del material
	if($_POST['cancelar'])
	{
		?>
		<script language="javascript" type="text/javascript">
		location.href="index.php";
		</script>
		<?
	}
	
	
	//Formulario para obtener la información del matrial a eliminar
	PageInit("Eliminar Existencia", "../menu.php");
	
	$conexion = @DBConnect('inventario');
	
	if(!isset($_GET['tipoCod']) && !isset($_GET['tipoCod']))
	{	

		?>
			<h1 class="shiny">Eliminar Existencias <?=$ubicacion?></h1>
			<br />
			<h3>Ingrese el c&oacute;digo de la existencia que desea eliminar:</h3>
			<br>
			<form name="eliminar" method="post" enctype="multipart/form-data" action="">
			<table width="60%" border="0" align="center">
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">
				<input type="radio" name="tipoCodMaterial" value="ISBN" <? if($tipoCodMaterial == 'ISBN') echo "checked"; ?>>ISBN
				&nbsp;
				<input type="radio" name="tipoCodMaterial" value="ISSN" <? if($tipoCodMaterial == 'ISSN') echo "checked"; ?>>ISSN
				</td>
				<td><input type="text" name="codMaterial" value="<?=$codMaterial?>" size="20">
				&nbsp;	
				<input name="buscar" type="submit" value="..." title="Consultar Material!">
				</td>
			</tr>
			</table>		
			</form>
		<?
	}
	else
	{
		if(empty($conexion)) // Si no hay conexion
		{
			echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible editar la informaci&oacute;n del libro, por favor intentelo m&aacute;s tarde.</p>";
		}
		else
		{
			$tipoCodMaterial = $_GET['tipoCod']; //Esta variable contiene el codigo del libro seleccionado para editar
			$codMaterial = $_GET['cod'];
			
			if(empty($conexion)) // Si no hay conexion
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible editar la informaci&oacute;n del libro, por favor intentelo m&aacute;s tarde.</p>";
			}
			else
			{	
				$rs1 = @db_query("select * from catalogo where tipoCodMaterial='$tipoCodMaterial' and codMaterial='$codMaterial' and estado = '0'");
			
				$obj = pg_fetch_object($rs1);
				
				if(pg_num_rows($rs1) == 0)
					$_GET['noEncontro'] = true;
				else
				{
					//Formulario con información del material a eliminar					
					?>					
					<h1 class="shiny">Eliminar Existencias</h1>
					
					<form name="editar" method="post" enctype="multipart/form-data" action="">
					<table width="70%" border="0" align="center">
					<table width="70%" border="0" align="center">
						<td class="titulosContenidoInterno">
						<input type="radio" name="tipoCodMaterial" readonly value="ISBN" <? if($obj->tipocodmaterial == 'ISBN') echo "checked"; ?>>ISBN
						<br>
						<input type="radio" name="tipoCodMaterial" readonly value="ISSN" <? if($obj->tipocodmaterial == 'ISSN') echo "checked"; ?>>ISSN
						</td>
						<td><input type="text" name="codMaterial"  readonly value="<?=$obj->codmaterial?>" size="20">
						</td>
					<tr><td colspan="2"><br></td></tr>
					<tr>
						<td class="titulosContenidoInterno">Titulo</td>
						<td><input readonly type="text" name="titulo" value="<?=$obj->titulo?>" size="30"></td>
					</tr>
					<tr><td colspan="2"><br></td></tr>
					<tr>
						<td class="titulosContenidoInterno">Autor(es)</td>
						<td><input readonly type="text" name="autores" value="<?=$obj->autores?>" size="30"></td>
					</tr>
					<tr><td colspan="2"><br></td></tr>
					<tr>
						<td class="titulosContenidoInterno">Edici&oacute;n</td>
						<td><input readonly type="text" name="edicion" value="<?=$obj->edicion?>" size="30"></td>
					</tr>
					<tr><td colspan="2"><br></td></tr>
					<tr>
					<td class="titulosContenidoInterno">Costo</td>
					<td><input readonly type="text" name="costo" value="<?=$obj->costo?>" size="30"></td>
					</tr>
					<tr><td colspan="2"><br></td></tr>
					<tr>
						<td class="titulosContenidoInterno">Precio </td>
						<td><input readonly type="text" name="precio" value="<?=$obj->precio?>" size="30"></td>
					</tr>
					<tr><td colspan="2"><br></td></tr>
					<tr>
						<td class="titulosContenidoInterno">Observaciones</td>
						<td><textarea name="observaciones" rows="4" cols="23"><?=$_POST['observaciones']?></textarea></td>
					</tr>
					<tr><td colspan="2"><br></td></tr>
					<tr>
						<td colspan="2" align="center">
						<input type="submit" name="eliminar" value="Eliminar">&nbsp;&nbsp;&nbsp;
						<input type="submit" name="cancelar" value="Cancelar">
						</td>
					</tr>
					</table>
					</form>
				
				<?
				}
		   }
	    }
	}
	
	//Manejo mensajes error
	if(isset($_GET['error_codigo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Ingrese el código del material a eliminar, recuerde que este es un número. Intente nuevamente");
		</script>
		<?
	}
	
	if(isset($_GET['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe ingresar todos los campos.");
		</script>
		<?
	}
	
	if(isset($_GET['elimino']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se elimino la existencia del catalogo exitosamente.");
		location.href="eliminar.php";
		</script>
		<?
	}
	
	if(isset($_GET['noEncontro']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El material no existe en el catalogo.");
		location.href="eliminar.php";
		</script>
		<?
	}
	
	PageEnd();
?>