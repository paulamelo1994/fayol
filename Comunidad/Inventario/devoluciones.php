<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: consignaciones.php
	Objetivo: Este archivo es el encargado de recibir material en devolución, el cual ingresa al inventario de la ubicación
		 	  especificada, esta pensado para recibir nuevamente en bodega los materiales que no fueron vendidos o simplemente
			  son devueltos de las ubucaciones en la que se habia consignado.
			  La cantidad a devolver se resta del inventario de la ubicación que devuelve el material  y se adiciona a la 
			  ubicación que recibe el material en devolucion, adicionalmente se guarda un registro de la operación.			  
	Autor: Deisy Chaves
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
	

	//Se recupera la información del material a consignar
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
					location.href="devoluciones.php?noEncontro=true";
					</script>
					<?
				}
			}
		}
	}	
	
	//Se devuelve el material
	if(isset($_POST['aceptar']))
	{
		//Validacion
		if(empty($_POST['codMaterial']) || empty($_POST['tipoCodMaterial'])|| empty($_POST['cantidad']) || empty($_POST['documento']) || empty($_POST['concepto']) || empty($_POST['ubicacionDevuelve'])|| empty($_POST['ubicacionRecibe']))
			$_GET['vacios'] = true;
		else if(!is_numeric($_POST['cantidad']))
			$_GET['numero'] = false;
		//Operacion de Devolucion
		else
		{
			$conexion = @DBConnect('inventario');
			
			if(empty($conexion)) // Si no hay conexion
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible agregar existencias del libro, por favor intentelo m&aacute;s tarde.</p>";
			}
			else
			{		
				$fallo = false;
				$falloMayor = false;
				db_query('begin');
				
				//se recupera la información de la ubicación que devuelve
				$rs=null;
				$rs = db_query("select codUbicacion  from ubicacion where nombre='$ubicacionDevuelve'");	
				$obj = pg_fetch_object($rs);
				
				$idUbicacionDevuelve= $obj->codubicacion;
				
				//Se actualiza la ubicacion que devuelve material
				$rs2 = db_query("select * from inventario where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion = '$idUbicacionDevuelve'");
				$obj2 = pg_fetch_object($rs2);
					
				$existencias = $obj2->existencia - $_POST['cantidad'];	
				
				//Si hay existencias suficientes para realizar la devolucion
				if($existencias>0)
				{				
					
					$rs3 = db_query("update inventario set existencia = '$existencias' where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion ='$idUbicacionDevuelve'");
					if(!$rs3) $fallo = true;
					
					//Se actualiza la ubicacion que recibe los materiales devueltos
					$rs2=null;
					$rs2 = db_query("select * from inventario where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion = '$idUbicacion'");
					$obj2 = pg_fetch_object($rs2);
					
					$existencias=0;
					$existencias = $obj2->existencia + $_POST['cantidad'];					
						
					$rs3 = db_query("update inventario set existencia = '$existencias' where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion ='$idUbicacion'");
					if(!$rs3) $fallo = true;
					
					//Se realiza el registro de la consignacion
					$rs1 = db_query("insert into devolucion (codCatalogo, ubicacionRecibe, ubicacionDevuelve, cantidad, documento, concepto, fecha, recibido_por) values('$codCatalogo', '$idUbicacion','$idUbicacionDevuelve', $_POST[cantidad], '$_POST[documento]', '$_POST[concepto]', '$fecha', '{$_SESSION[inventario][login]}')");
						
					if(!$rs1) $fallo = true;
				}
				//Manejo de posibles errores
				else				
				{					
					$falloMayor = true;
				}
				
				if($fallo)
				{
					db_query('rollback');
					$_GET['fallo'] = true;
				}
				else if ($falloMayor)
				{
					$_GET['mayor'] = true;
				}
				//Se realizo la devolución sin problemas
				else
				{
					db_query('commit');
					$_GET['agrego'] = true;
					
					$codCatalogo = "";
					$titulo = "";
					$autor  = "";					
					$tipoCodMaterial = "";
					$codMaterial = "";	
					$ubicacionRecibe="";
				}
			}
		}
	}
	
	if($_POST['cancelar'])
	{
		?>
		<script language="javascript">
		location.href="index.php";
		</script>
		<?
	}
	
	//Formulario de devolución de material	
	PageInit("Consignar Existencias", "../menu.php");
?>

<h1 class="shiny">Recepci&oacute;n de Devoluciones</h1>
<h2>Formulario de recepci&oacute;n:</h2>

<form name="devoluciones" enctype="multipart/form-data" method="post" action="devoluciones.php">

<table width="70%" border="0" align="center">
<tr>
	<td width="40%" class="titulosContenidoInterno">Fecha</td>
	<td><?=MakeDate($fecha)?></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td class="titulosContenidoInterno"><input type="radio" name="tipoCodMaterial" value="ISBN" <? if($tipoCodMaterial == 'ISBN') echo "checked"; ?>>ISBN
	&nbsp;	<input type="radio" name="tipoCodMaterial" value="ISSN" <? if($tipoCodMaterial == 'ISSN') echo "checked"; ?>>ISSN
	</td>
	<td><input type="text" name="codMaterial" value="<?=$codMaterial?>" size="20">
	&nbsp;	
	<input name="buscar" type="submit" value="..." title="Consultar Material!">
	</td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="40%" class="titulosContenidoInterno">Titulo</td>
	<td><input type="text" name="titulo" readonly value="<?=$titulo?>" size="30"></td>
</tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Autores</td>
	<td><input type="text" name="autor" readonly value="<?=$autor?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="40%" class="titulosContenidoInterno">Devuelve Existencias</td>
	<td>
		<select name="ubicacionDevuelve">
		<option>&nbsp;</option>
		<?
		$conexion = DBConnect('inventario');		
		$rs4 = db_query("select codUbicacion, nombre as ubicacion from ubicacion where codUbicacion<>'$idUbicacion'");						
		while($obj4 = pg_fetch_object($rs4))
		{
		?>
		  <option<? if($_POST['ubicacionDevuelve'] == $obj4->ubicacion) echo " selected "; ?> ><?=$obj4->ubicacion?></option>			
		<?	
		}
		?>
		</select>
	</td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="40%" class="titulosContenidoInterno">Recibe Existencias</td>
	<td><input type="text" name="ubicacionRecibe" readonly value="<?=$ubicacion?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="40%" class="titulosContenidoInterno">Cantidad</td>
	<td><input type="text" name="cantidad" value="<?=$_POST['cantidad']?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="40%" class="titulosContenidoInterno">Documento</td>
	<td >
			<select name="documento">
			<option>&nbsp;</option>
			<option<? if($_POST['documento'] == 'Oficio') echo " selected "; ?> >Oficio</option>
			<option<? if($_POST['documento'] == 'Reporte de Venta') echo " selected "; ?> >Reporte de Venta</option>
			</select>
	</td>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="40%" class="titulosContenidoInterno">Concepto</td>
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

//Mensajes de error
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
		alert("Se regreso la existencia exitosamente.");
		location.href="inventario.php";
		</script>
		<?
	}
		if(isset($_GET['mayor']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("La cantidad que desea ingresar es mayor que la disponible en el catalogo . Intente nuevamente.");
		</script>
		<?
	}
	
	PageEnd();
?>