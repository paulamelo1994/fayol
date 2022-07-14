<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: agregar.php
	Objetivo: Este archivo es el encargado de agregar una existencia al catalogo e incrementarla de una vez en el
				inventario.
	Autor: Angela Benavides
	Modificado Por: Deisy Chaves
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
	
	//Se agrega el material al sistema
	if(isset($_POST['aceptar']))
	{	
		//validaciones
		if(empty($_POST['codMaterial'])||empty($_POST['tipoCodMaterial'])|| empty($_POST['titulo']) || empty($_POST['autores'])||  empty($_POST['precio']))
			$_GET['vacios'] = true;
		else if(!is_numeric($_POST['precio']) || !is_numeric($_POST['costo']))
			$_GET['numero'] = false;
		else if ($_POST['costo'] > $_POST['precio'])
			$_GET['error_costo'] = false;
		//Finalmente se agrega el material al sistema
		else
		{
			$conexion = @DBConnect('inventario');

			if(empty($conexion)) //Si no hay conexion
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible agregar la existencia del libro, por favor intentelo m&aacute;s tarde.</p>";
			}
			else
			{
				/*VER LUEGO UNA MEJOR FORMA DE VALIDAR EL INGRESO DE LIBROS PARA QUE NO QUEDEN REPETIDOS*/
				$rs = @db_query("select * from catalogo where codMaterial = '$_POST[codMaterial]' and tipoCodMaterial = '$_POST[tipoCodMaterial]'");
				
				if(pg_num_rows($rs) != 0)
					$_GET['yaExiste'] =true;					
				else
				{
					$fallo = false;
					
					db_query('begin');
					$fecha = date('Y')."-".date('m')."-".date('d');
					
					//se crea registro en el catalogo con la información general del material
					$rs = db_query("insert into catalogo (titulo, autores, edicion, tipoCodMaterial,codMaterial,costo,precio, fecha_ingreso) values ('$_POST[titulo]', '$_POST[autores]', '$_POST[edicion]', '$_POST[tipoCodMaterial]','$_POST[codMaterial]', '$_POST[costo]', '$_POST[precio]', '$fecha')
					");
					if(!$rs) $fallo = true;
					
					
					//Se crea un registro en el inventario para cada ubicación existente, para el manejo de existencias
					$rs = db_query("select last_value from catalogo_seq");
					$obj = pg_fetch_object($rs);
					$codCatalogo = $obj->last_value;
					
					$rs = db_query("insert into inventario (tipoCodMaterial,codMaterial, codUbicacion, existencia) values ('$_POST[tipoCodMaterial]','$_POST[codMaterial]', '$idUbicacion', 1)");
					
					
					$rs = db_query("select codubicacion, nombre as ubicacion from ubicacion where codUbicacion <> '$idUbicacion'");
					while($obj = pg_fetch_object($rs))
					{
						$rs1 =  db_query("insert into inventario (tipoCodMaterial,codMaterial, codUbicacion, existencia) values ('$_POST[tipoCodMaterial]','$_POST[codMaterial]', '$obj->codubicacion', 0)");
					}
					
					//manejo de errores
					if(!$rs) $fallo = true;					
					
					if($fallo)
					{
						db_query('rollback');
						$_GET['fallo'] = true;
					}
					//se agrego sin problemas
					else
					{
						db_query('commit');
						unset($_GET['existencia']);
						$_GET['agrego'] = true;
					}
										
					unset($_POST);
				}
			}
		}
	}
	
	if(isset($_POST['cancelar']))
	{
		?>
		<script language="javascript">
		location.href="index.php";
		</script>
		<?
	}
	
	PageInit("Agregar Existencia", "../menu.php");

// Formulario para ingresar un libro
?>
<h1 class="shiny">Agregar Existencia al Catalogo</h1>
<form name="ingresos" enctype="multipart/form-data" method="post" action="">
<table width="70%" border="0" align="center">
<tr>
	<td class="titulosContenidoInterno"><input type="radio" name="tipoCodMaterial" value="ISBN" <? if($_POST['tipoCodMaterial'] == 'ISBN') echo "checked"; ?>>ISBN
	<br><input type="radio" name="tipoCodMaterial" value="ISSN" <? if($_POST['tipoCodMaterial'] == 'ISSN') echo "checked"; ?>>ISSN
	</td>
	<td><input type="text" name="codMaterial" value="<?=$_POST['codMaterial']?>" size="20"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td class="titulosContenidoInterno">Titulo</td>
	<td><input type="text" name="titulo" value="<?=$_POST['titulo']?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td class="titulosContenidoInterno">Autor(es)</td>
	<td><input type="text" name="autores" value="<?=$_POST['autores']?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td class="titulosContenidoInterno">Edici&oacute;n</td>
	<td><input type="text" name="edicion" value="<?=$_POST['edicion']?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td class="titulosContenidoInterno">Costo</td>
	<td><input type="text" name="costo" value="<?=$_POST['costo']?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td class="titulosContenidoInterno">Precio Venta</td>
	<td><input type="text" name="precio" value="<?=$_POST['precio']?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td class="titulosContenidoInterno">Ubicaci&oacute;n</td>
	<td><input type="text" name="ubicacion" readonly value=<?=$ubicacion?> size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td colspan="2" align="center">
	<input type="submit" name="aceptar" value="Aceptar">&nbsp;&nbsp;&nbsp;
	<input type="submit" name="cancelar" value="Cancelar">
	</td>
</tr>
</table>
</form>
<?

//Mensajes de error
	if(isset($_GET['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se requieren llenos todos los campos!");
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
	
	if(isset($_GET['agrego']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se agrego la existencia al catalogo exitosamente.");
		location.href="agregar.php";
		</script>
		<?
	}
	
	if(isset($_GET['numero']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Los campos de costo y precio deben ser valores numericos!");
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
	
	PageEnd();
?>