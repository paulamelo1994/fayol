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
	
	//Se obtiene la información actual del material
	if($_POST['buscar'])
	{			
		if(!empty($_POST['codMaterial']) && !empty($_POST['tipoCodMaterial']))
		{
			?>
			<script language="javascript">
			location.href="editar.php?tipoCod=<?=$_POST['tipoCodMaterial']?>&cod=<?=$_POST['codMaterial']?>";
			</script>
			<?
		}
		else
		{
			$_GET['error_codigo'] = true;
		}
	}	

	//Se actualiza la información del material
	if($_POST['editar'])
	{	
		//Validaciones
		if( empty($_POST['titulo']) || empty($_POST['autores']) || empty($_POST['tipoCodMaterial'])|| empty($_POST['codMaterial']))
			$_GET['vacios'] = true;
		else if(!is_numeric($_POST['precio']) || !is_numeric($_POST['costo'])|| !is_numeric($_POST['existencias']))
			$_GET['numero'] = false;
		else if ($_POST['costo'] > $_POST['precio'])
			$_GET['error_costo'] = false;
		else
		{
			
			$conexion = @DBConnect('inventario');
			
			if(empty($conexion)) // Si no hay conexion
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible editar la informaci&oacute;n del libro, por favor intentelo m&aacute;s tarde.</p>";
			}
			else
			{
				//Se actualiza la información del catalogo
				$fallo = false;
				db_query('begin');
				
				$rs = db_query("Update catalogo set titulo = '$_POST[titulo]', autores = '$_POST[autores]', edicion = '$_POST[edicion]' where tipoCodMaterial = '$_POST[tipoCodMaterial]' and codMaterial = '$_POST[codMaterial]'");
				
				if(!$rs) $fallo = true;
				
				
				$rs = db_query("select costo, precio from catalogo where codCatalogo = '$_POST[codCatalogo]'");
				
				$obj = pg_fetch_object($rs);
				
				if($obj->costo == 0 && $obj->precio == 0)
				{
					$rs = db_query("Update catalogo set costo = '$_POST[costo]', precio = '$_POST[precio]' where tipoCodMaterial = '$_POST[tipoCodMaterial]' and codMaterial = '$_POST[codMaterial]'");
				
					if(!$rs) $fallo = true;
				}
				
				//Se crea registro historico
				else if($obj->costo != $_POST[costo] || $obj->precio != $_POST[precio])
				{
					$fecha = date('Y')."-".date('m')."-".date('d');					
					$rs = db_query("Update catalogo set estado = '1' where codCatalogo = '$_POST[codCatalogo]'");
					if(!$rs) $fallo = true;
					
					$rs = db_query("insert into catalogo (titulo, autores, edicion, tipoCodMaterial,codMaterial,costo,precio, fecha_ingreso) values ('$_POST[titulo]', '$_POST[autores]', '$_POST[edicion]', '$_POST[tipoCodMaterial]','$_POST[codMaterial]', '$_POST[costo]', '$_POST[precio]', '$fecha')");
					if(!$rs) $fallo = true;					
				}

				$rs1 = db_query("Update inventario set existencia = '$_POST[existencias]' where tipoCodMaterial = '$_POST[tipoCodMaterial]' and codMaterial = '$_POST[codMaterial]' and codUbicacion = '$idUbicacion'");
				
				if(!$rs1) $fallo = true;
				
				if($fallo)
				{
					db_query('rollback');
					$_GET['fallo'] = true;
				}
				else
				{
					db_query('commit');
					unset($_GET['cod']);
					unset($_GET['tipoCod']);
					$_GET['edito'] = true;
					
					$tipoCodMaterial="";
					$codMaterial="";
				}
			}
		}
	}
	
	//Cancelar modificacion
	if($_POST['cancelar'])
	{
		?>
		<script language="javascript">
		location.href="index.php";
		</script>
		<?
	}
	
	//Formulario para buscar el material a modificar
	PageInit("Editar Existencia", "../menu.php");
	
	$conexion = @DBConnect('inventario');

	if(!isset($_GET['tipoCod']) && !isset($_GET['tipoCod']))
	{	
		?>
			<h1 class="shiny">Editar Existencias <?=$ubicacion?></h1>
			<br />
			<h3>Ingrese el c&oacute;digo de la existencia que desea editar:</h3>
			<br>
			<form name="editar" method="post" enctype="multipart/form-data" action="">
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
		$tipoCodMaterial = $_GET['tipoCod']; //Esta variable contiene el codigo del libro seleccionado para editar
		$codMaterial = $_GET['cod'];
		
		if(empty($conexion)) // Si no hay conexion
		{
			echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible editar la informaci&oacute;n del libro, por favor intentelo m&aacute;s tarde.</p>";
		}
		else
		{	
			$rs1 = @db_query("select catalogo.codCatalogo as codigo,titulo,autores,edicion,catalogo.tipoCodMaterial as tipocodmaterial,catalogo.codMaterial as codmaterial,costo,precio, existencia from catalogo,inventario where inventario.tipoCodMaterial = catalogo.tipoCodMaterial and inventario.codMaterial = catalogo.codMaterial and codUbicacion = '$idUbicacion' and catalogo.tipoCodMaterial='$tipoCodMaterial' and catalogo.codMaterial='$codMaterial' and estado = '0'");

			$obj = pg_fetch_object($rs1);
			
			if(pg_num_rows($rs1) == 0)
				$_GET['noEncontro'] = true;
			else
			{
			//Formulario con información del material			
			?>
				<h1 class="shiny">Editar Existencias <?=$ubicacion?></h1>
				
				<form name="editar" method="post" enctype="multipart/form-data" action="">
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
					<td><input type="text" name="titulo" value="<?=$obj->titulo?>" size="30"></td>
				</tr>
				<tr><td colspan="2"><br></td></tr>
				<tr>
					<td class="titulosContenidoInterno">Autor(es)</td>
					<td><input type="text" name="autores" value="<?=$obj->autores?>" size="30"></td>
				</tr>
				<tr><td colspan="2"><br></td></tr>
				<tr>
					<td class="titulosContenidoInterno">Edicion</td>
					<td><input type="text" name="edicion" value="<?=$obj->edicion?>" size="30"></td>
				</tr>
				<tr><td colspan="2"><br></td></tr>
				<tr><td class="titulosContenidoInterno">Costo</td>
				<td><input type="text" name="costo" value="<?=$obj->costo?>" size="30"></td>
				</tr>
				<tr><td colspan="2"><br></td></tr>
				<tr>
					<td class="titulosContenidoInterno">Precio </td>
					<td><input type="text" name="precio" value="<?=$obj->precio?>" size="30"></td>
				</tr>
				<tr><td colspan="2"><br></td></tr>
				<tr>
					<td class="titulosContenidoInterno">Existencias</td>
					<td><input type="text" name="existencias" value="<?=$obj->existencia?>" size="30"></td>
				</tr>
				<tr><td colspan="2"><br></td></tr>
				<tr>
					<td class="titulosContenidoInterno">Ubicaci&oacute;n</td>
					<td><input readonly type="text" name="ubicacion" value="<?=$ubicacion?>" size="30"></td>
				</tr>		
				<tr><td colspan="2"><br></td></tr>
				<tr>
					<td colspan="2" align="center">
					<input type="submit" name="editar" value="Aceptar">&nbsp;&nbsp;&nbsp;
					<input type="submit" name="cancelar" value="Cancelar">
					<input type="hidden" name="codCatalogo" value="<?=$obj->codigo?>">
					</td>
				</tr>
				</table>
				</form>
		<?
		}
	  }
	}
	
	//Manejo mensajes de error
	if(isset($_GET['error_codigo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Ingrese el código del material a eliminar, recuerde que este es un número. Intente nuevamente");
		</script>
		<?
	}

	if(isset($_GET['noEncontro']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El material no existe en el catalogo.");
		location.href="editar.php";
		</script>
		<?
	}
	
	if(isset($_GET['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se requieren llenos todos los campos!");
		</script>
		<?
	}
	
	if(isset($_GET['numero']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Los campos de costo, precio y existencia deben ser valores numericos!");
		</script>
		<?
	}
	
	if(isset($_GET['fallo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Ocurrio un error al tratar de actualizar la información.");
		</script>
		<?
	}
	
	if(isset($_GET['error_costo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El precio de venta debe ser como minimo igual al costo el libro!");
		</script>
		<?
	}
	
	if(isset($_GET['edito']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se edito la existencia del catalogo exitosamente.");
		location.href="editar.php";
		</script>
		<?
	}
	
	if(isset($_GET['yaExiste']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Ya hay un registro en el catalogo con el mismo titulo!");
		</script>
		<?
	}

	PageEnd();
?>