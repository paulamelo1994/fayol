<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: ingresos.php
	Objetivo: Este archivo permite ingresar existencias al catalogo de un material a la ubicación especificada.
			  Actulizando el numero de existencias en el catalogo.
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
	
	$fecha = date('Y')."-".date('m')."-".date('d');
	
	$_GET['submenu_inventario'] = true;
	$idUbicacion= $_SESSION['idUbicacion'];
	$ubicacion= $_SESSION['ubicacion'];
	

	//Se busca la información del material del que se vana ingrsar existencias
	if($_POST['buscar'])
	{			
		if(!empty($_POST['codMaterial']) && !empty($_POST['tipoCodMaterial']))
		{
			$conexion = DBConnect('inventario');
			
			if(!conexion)
					echo("<td>No se pudo lograr la conexi&oacute;n con la BD.</td>");
			else
			{
				$rs = db_query("select * from catalogo where codMaterial = '$_POST[codMaterial]' and tipoCodMaterial = '$_POST[tipoCodMaterial]' and estado ='0'");
				
				if($obj = pg_fetch_object($rs))
				{
					$codCatalogo = $obj->codcatalogo;
					$titulo = $obj->titulo;
					$autor  = $obj->autores;						
					$tipoCodMaterial = $obj->tipocodmaterial;
					$codMaterial= $obj->codmaterial;
				}
				else
				{
					?>
					<script language="javascript">
					location.href="ingresos.php?noEncontro=true";
					</script>
					<?
				}
			}
		}
	}	
	
	//Se ingresan las nuevas existencias 
	if(isset($_POST['aceptar']))
	{
		//validaciones
		if(empty($_POST['codMaterial']) || empty($_POST['tipoCodMaterial'])|| empty($_POST['cantidad']) || empty($_POST['documento']) || empty($_POST['concepto']))
			$_GET['vacios'] = true;
		else if(!is_numeric($_POST['cantidad']))
			$_GET['numero'] = false;
		else
		{
			$conexion = @DBConnect('inventario');
			
			if(empty($conexion)) // Si no hay conexion
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible agregar existencias del libro, por favor intentelo m&aacute;s tarde.</p>";
			}
			else
			{		
				//Se realiza el registro del ingreso de las existencias y se actualiza el inventario
				$fallo = false;
				db_query('begin');

				$rs1 = db_query("insert into ingresos (codCatalogo, codUbicacion, cantidad, documento, concepto, fecha, ingresado_por) values('$codCatalogo', '$idUbicacion', $_POST[cantidad], '$_POST[documento]', '$_POST[concepto]', '$fecha', '{$_SESSION[inventario][login]}')");
					
				if(!$rs1) $fallo = true;
					
				$rs2 = db_query("select * from inventario where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion = '$idUbicacion'");
				$obj2 = pg_fetch_object($rs2);
					
				$existencias = $obj2->existencia + $_POST['cantidad'];					
					
				$rs3 = db_query("update inventario set existencia = '$existencias' where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion ='$idUbicacion'");
				if(!$rs3) $fallo = true;
				
				if($fallo)
				{
					db_query('rollback');
					$_GET['fallo'] = true;
				}
				else
				{
					db_query('commit');
					$_GET['agrego'] = true;
					
					$codCatalogo = "";
					$titulo = "";
					$autor  = "";					
					$tipoCodMaterial = "";
					$codMaterial = "";	
				}
			}
		}
	}
	
	//Si se cancela el ingreso de existencias
	if($_POST['cancelar'])
	{
		?>
		<script language="javascript">
		location.href="index.php";
		</script>
		<?
	}
	

//Formulario para ingregar las existencias

	PageInit("Ingresos", "../menu.php");
?>

<h1 class="shiny">Ingresar a la <?=$ubicacion?></h1>
<h2>Formulario de ingreso:</h2>

<form name="ingresar" enctype="multipart/form-data" method="post" action="ingresos.php">

<table width="70%" border="0" align="center">
<tr>
	<td width="20%" class="titulosContenidoInterno">Fecha</td>
	<td><?=MakeDate($fecha)?></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td class="titulosContenidoInterno">
	<input type="radio" name="tipoCodMaterial" value="ISBN" <? if($tipoCodMaterial == 'ISBN') echo "checked"; ?>>ISBN
	<br>
	<input type="radio" name="tipoCodMaterial" value="ISSN" <? if($tipoCodMaterial == 'ISSN') echo "checked"; ?>>ISSN
	</td>
	<td><input type="text" name="codMaterial" value="<?=$codMaterial?>" size="20">
	&nbsp;	
	<input name="buscar" type="submit" value="..." title="Consultar Material!">
	</td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Titulo</td>
	<td><input type="text" name="titulo" readonly value="<?=$titulo?>" size="30"></td>
</tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Autores</td>
	<td><input type="text" name="autor" readonly value="<?=$autor?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Cantidad</td>
	<td><input type="text" name="cantidad" value="<?=$_POST['cantidad']?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Documento</td>
	<td >
			<select name="documento">
			<option>&nbsp;</option>
			<option<? if($_POST['documento'] == 'Oficio') echo " selected "; ?> >Oficio</option>
			<option<? if($_POST['documento'] == 'Reporte de Venta') echo " selected "; ?> >Reporte de Venta</option>
			</select>
	</td>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Concepto</td>
	<td><input type="text" name="concepto" value="<?=$_POST['concepto']?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td colspan="2" align="center">
	<input type="submit" name="aceptar" value="Aceptar">&nbsp;&nbsp;&nbsp;
	<input type="submit" name="cancelar" value="Cancelar">
	<input type="hidden" name="codCatalogo" value="<?=$codCatalogo?>">
	</td>
</tr>
</table>
</form>
<?

//Manejo mensajes de error
	if(isset($_GET['noEncontro']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El material no existe en el catalogo.");
		</script>
		<?
	}
	
	if(isset($_GET['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe ingresar todos los campos. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['numero']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El campo de cantidad debe ser un valor numerico. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['fallo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Ocurrio un error al tratar de ingresar la información. Intente nuevamente.");
		</script>
		<?
	} 
	
	if(isset($_GET['agrego']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se agrego la existencia al catalogo exitosamente.");
		location.href="catalogo.php";
		</script>
		<?
	}
	
	PageEnd();
?>