<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: catalogo.php
	Objetivo: Lista el catalogo de libros registrados en el sistema
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
	
	PageInit("Catalogo", "../menu.php");

	$conexion = @DBConnect('inventario');
	
	if(empty($conexion)) // Si no hay conexion
	{
		echo'  <h1 class="shiny">Catalogo '.$ubicacion.'</h1>
          <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible mostrar el catalogo de libros, por favor intentelo m&aacute;s tarde.</p>';
	}
	else
	{
	 ?>
	  <h1 class="shiny">Catalogo <?=$ubicacion?></h1>
	 <?
	
		$rs = @db_query("select catalogo.codCatalogo as codigo,titulo,autores,edicion,catalogo.tipoCodMaterial as tipocodmaterial,catalogo.codMaterial as codmaterial,costo,precio, existencia from catalogo,inventario where inventario.tipoCodMaterial = catalogo.tipoCodMaterial and inventario.codMaterial = catalogo.codMaterial and codUbicacion = '$idUbicacion' and estado = '0' order by codCatalogo, titulo");

		
		if(pg_num_rows($rs) == 0) //No hay registros en el catalogo
		{
			echo "<h2>No hay registros en el catalogo!</h2>";
		}
		
		else
		{
		?>
			<table width="800" border="1" align="center">
			<tr>
				<th colspan="2" width="10%">C&oacute;digo Material</th>
				<th width="32%">Titulo</th>
				<th width="15%">Autor(es)</th>
				<th width="10%">Edici&oacute;n</th>				
		<?
				//Si es el administrador se muestra información del costo de los libros
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
			while($obj = pg_fetch_object($rs))
			{
			?>				
				<tr>
					<td align="center"><?=$obj->tipocodmaterial?> </td>
					<td align="center"><?=$obj->codmaterial?> </td>
					<td><?=makeHtml($obj->titulo)?></td>
					<td><?=makeHtml($obj->autores)?></td>
					<td align="center"><?=$obj->edicion?></td>
					
					<?
					if($_SESSION['inventario']['permisos'] == 'administrador'||$_SESSION['inventario']['permisos'] == 'responsable')
					{
						?> 
						<td align="center"><?=$obj->costo?></td>
						<?
					}
					?>	
					<td align="center"><?=$obj->precio?></td>					
					<td align="center"><?=$obj->existencia?></td>
				</tr>
			<?
			}
		}
		?>
		</table>
		<?
	}
	PageEnd();
?>