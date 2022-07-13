<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: consignaciones.php
	Objetivo: Este archivo es el encargado de dar material en consignaci�n a la ubicaci�n respectiva, inicialmente 
	          los materiales ingresan a la bodega y de alli se distribuyen a la ubicaci�n que corresponda. 
			  La cantidad en consignaci�n se resta del inventario de la ubicaci�n que consigna y se adiciona a la 
			  ubicaci�n que recibe el material, adicionalmente se guarda un registro de la operaci�n.			  
	Autor: Deisy Chaves
	A�o: 2008
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
	

	//Se recupera la informaci�n del material a consignar
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
					location.href="consignaciones.php?noEncontro=true";
					</script>
					<?
				}
			}
		}
	}	
	
	//Se consigna el material
	if(isset($_POST['aceptar']))
	{
		//Validaciones
		if(empty($_POST['codMaterial']) || empty($_POST['tipoCodMaterial'])|| empty($_POST['cantidad']) || empty($_POST['documento']) || empty($_POST['concepto']) || empty($_POST['ubicacionRecibe'])|| empty($_POST['ubicacionConsigna']))
			$_GET['vacios'] = true;
		else if(!is_numeric($_POST['cantidad']))
			$_GET['numero'] = false;
		//Operacion de cosnignacion
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
				
				$rs=null;
				//se recupera la informaci�n de la ubicaci�n que recibe
				$rs = db_query("select codUbicacion  from ubicacion where nombre='$ubicacionRecibe'");	
				$obj = pg_fetch_object($rs);
				
				$idUbicacionRecibe = $obj->codubicacion;
				
				//Se actualiza la ubicacion que consigna
				$rs2 = db_query("select * from inventario where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion = '$idUbicacion'");
				$obj2 = pg_fetch_object($rs2);
					
				$existencias = $obj2->existencia - $_POST['cantidad'];	
				
				//Si hay existencias suficientes para realizar la consignaci�n
				if($existencias>0)
				{				
					
					$rs3 = db_query("update inventario set existencia = '$existencias' where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion ='$idUbicacion'");
					if(!$rs3) $fallo = true;
					
					//Se actualiza la ubicacion que recibe en consignacion
					$rs2=null;
					$rs2 = db_query("select * from inventario where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion = '$idUbicacionRecibe'");
					$obj2 = pg_fetch_object($rs2);
					
					$existencias=0;
					$existencias = $obj2->existencia + $_POST['cantidad'];					
						
					$rs3 = db_query("update inventario set existencia = '$existencias' where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion ='$idUbicacionRecibe'");
					if(!$rs3) $fallo = true;
					
					//Se realiza el registro de la consignacion
					$rs1 = db_query("insert into consignacion (codCatalogo, ubicacionRecibe, ubicacionConsigna, cantidad, documento, concepto, fecha, consignado_por) values('$codCatalogo', '$idUbicacionRecibe','$idUbicacion', $_POST[cantidad], '$_POST[documento]', '$_POST[concepto]', '$fecha', '{$_SESSION[inventario][login]}')");
						
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
				//Se agrego sin problemas
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
	
	//Formulario para consignar material
	PageInit("Consignar Existencias", "../menu.php");
?>

<h1 class="shiny">Consignaci&oacute;n de Existencias</h1>
<h2>Formulario de consignaci&oacute;n:</h2>

<form name="consignaciones" enctype="multipart/form-data" method="post" action="consignaciones.php">

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
	<td width="40%" class="titulosContenidoInterno">Consigna Existencias</td>
	<td><input type="text" name="ubicacionConsigna" readonly value="<?=$ubicacion?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="40%" class="titulosContenidoInterno">Recibe Existencias</td>
	<td>
		<select name="ubicacionRecibe">
		<option>&nbsp;</option>
		<?
		$conexion = DBConnect('inventario');		
		$rs4 = db_query("select codUbicacion, nombre as ubicacion from ubicacion where codUbicacion<>'$idUbicacion'");						
		while($obj4 = pg_fetch_object($rs4))
		{
		?>
		  <option<? if($_POST['ubicacionRecibe'] == $obj4->ubicacion) echo " selected "; ?> ><?=$obj4->ubicacion?></option>			
		<?	
		}
		?>
		</select>
	</td>
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
		alert("Ocurrio un error al tratar de ingresar la informaci�n. Intente nuevamente.");
		</script>
		<?
	} 
	
	if(isset($_GET['agrego']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se consigno la existencia exitosamente.");
		location.href="inventario.php";
		</script>
		<?
	}
		if(isset($_GET['mayor']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("La cantidad que desea consignar es mayor que la disponible en el catalogo . Intente nuevamente.");
		</script>
		<?
	}
	
	PageEnd();
?>