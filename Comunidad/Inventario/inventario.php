<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: inventario.php
	Objetivo: Este archivo permite listar un inventario del material en catalogo.
	Autor: Angela Benavides
	Modificado por: Deisy Chaves
	A&ntilde;o: 2008
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
	
	if(isset($_POST['volver']))
	{
		?>
		<script language="javascript">
		location.href="inventario.php";
		</script>
		<?
		die();
	}
	
	PageInit("Inventario", "../menu.php");
	
	$conexion = @DBConnect('inventario');				
	
	if(empty($conexion)) // Si no hay conexion
	{
		echo" </h1> <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.
		En el momento no es posible acceder al inventario, por favor intentelo m&aacute;s tarde.</p> <h1>";
	}	
	else if(!isset($_GET['ubicacionInv']))
	{
		//Se selecciona la ubicaci&oacute;n de la cual se muestra el inventario
		
		$idUbicacion = $_GET['ubicacionInv'];
		$_SESSION['idUbicacion'] =$idUbicacion;	
		
		/*
		if($idUbicacion == '1')
		{
			$ubicacion ="Bodega";
		}
		else if($idUbicacion == '2')
		{
			$ubicacion ="Libreria";
		}
		else if($idUbicacion == '3')
		{
			$ubicacion ="Oficina";
		}
		
		$_SESSION['ubicacion'] =$ubicacion;	
		$_SESSION['idUbicacion'] =$idUbicacion;	
		*/
		
		$rs = db_query("select codUbicacion, nombre as ubicacion from ubicacion");
		
		?>
		<h1 class="shiny">Inventario</h1>
		<h3>Seleccione el sitio que desea ver:</h3>
		<br>
		<form name="seleccionar" enctype="multipart/form-data" method="get" action="">
		<div align="center">
		<select name="ubicacionInventario">
		<option>Seleccione...</option>
		<?
		while($obj = pg_fetch_object($rs))
		{
		?>
			<option onClick="document.location.href='inventario.php?ubicacionInv=<?=$obj->codubicacion?>'"><?=$obj->ubicacion?></option>
		<?	
		}
		
		?>
		</select>
		</div>
		</form>
		<?

	}
	else
	{		
		//Se lista la informaci&oacute;n del inventario, si es adminitrador se lista adicionalmente el costo del material
		$ubicacionInv = $_GET['ubicacionInv'];
		
		$rs2 = @db_query("select nombre as ubicacion from ubicacion where codUbicacion = '$ubicacionInv'");
		$obj2 = pg_fetch_object($rs2);
		
		?>
		<h1 class="shiny">Inventario  <?=$obj2->ubicacion?></h1>
		<?
		
		
		$rs1 = @db_query("select catalogo.codCatalogo as codigo,titulo,autores,edicion,catalogo.tipoCodMaterial as tipocodmaterial,catalogo.codMaterial as codmaterial,costo,precio, existencia from catalogo,inventario where inventario.tipoCodMaterial = catalogo.tipoCodMaterial and inventario.codMaterial = catalogo.codMaterial and codUbicacion = '$ubicacionInv' and estado = '0' order by codCatalogo, titulo");

		
		if(pg_num_rows($rs1) == 0) //No hay registros en el catalogo
		{
			echo "<h2>No hay registros en el catalogo!</h2>";
		}
		
		else
		{
		?>			
			
			<form name="inventario" enctype="multipart/form-data" method="post" action="">		
			<table width="700" border="1" align="center">
			<tr>
				<th colspan="2" width="10%">C&oacute;digo Material</th>
				<th width="32%">Titulo</th>
				<th width="22%">Autor(es)</th>
			<?
			if ($_SESSION['inventario']['permisos'] == 'administrador' ||$_SESSION['inventario']['permisos'] == 'responsable')
			{
				?> 
				<th width="8%">Costo</th>
				<?
			}
			?>
				<th width="8%">Precio</th>
				<th width="10%">Existencias</th>				
			</tr>
			<?
			while($obj1 = pg_fetch_object($rs1))
			{
			?>				
				<tr>
					<td align="center"><?=$obj1->tipocodmaterial?> </td>
					<td align="center"><?=$obj1->codmaterial?> </td>
					<td><?=makeHtml($obj1->titulo)?></td>
					<td><?=makeHtml($obj1->autores)?></td>
					<?
					if($_SESSION['inventario']['permisos'] == 'administrador'||$_SESSION['inventario']['permisos'] == 'responsable')
					{
						?> 
						<td align="center"><?=$obj1->costo?></td>
						<?
					}
					?>	
					<td align="center"><?=$obj1->precio?></td>					
					<td align="center"><?=$obj1->existencia?></td>
				</tr>
			<?
			}
		}
		?>
		</table>
		<div align="center">
			<input type="submit" name="volver" value="Volver">
		</div>
		</form>
		<?
	}
?>
<?
	PageEnd();
?>