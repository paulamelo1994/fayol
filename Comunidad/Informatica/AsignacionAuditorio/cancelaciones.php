<?
	session_start();
	
	if(!isset($_SESSION['profesor']))
	{
		header("Location: /Comunidad/Informatica/AsignacionSalas/index.php");
		die();
	}
	$root_path = "../../..";
	require '../../../functions.php';
	PageInit("Listado Cancelaciones : Auditorio", "menu.php");
	?>	<style type="text/css" title="currentStyle">
					@import "/php-scripts/datatables/media/css/demo_page.css";
					@import "/php-scripts/datatables/media/css/demo_table.css";
		.Estilo1 {color: #999999}
</style>
		<script type="text/javascript" language="javascript" src='<?= $rootPath?>/php-scripts/datatables/media/js/jquery.dataTables.js'></script>
		<script type="text/javascript" src="<?= $rootPath?>/php-scripts/datatables/javascripts.js"></script>
	<?

$conexion = DBConnect('controlsalas');
	if(!$conexion)
	{
		echo "No se logro la conexi&oacute;n con la BD.";
	}
	else
	{
		$rs = db_query("select * from cancelaciones where fecha >'2007-12-31' order by indice");
		?>
		
			<h1 class="Estilo1">Cancelaciones Realizadas</h1>
			<br>
			<br>
					
			<table border="0" class="paginar display" cellpadding="2" cellspacing="5"> 
			<thead>
				<tr>
					<th>Indice</th>
					<th width="70px">Fecha</th>
					<th>No Reserva</th>
					<th>Observaciones</th>
				</tr>
			</thead>
			<tbody>
			<?PHP
			while($obj = pg_fetch_object($rs)){
			?>
				<tr>
					<td><? echo $obj->indice;?></td>
					<td><? echo $obj->fecha;?></td>
					<td><? echo $obj->reserva;?></td>
					<td><? echo $obj->observaciones;?></td>
				</tr>
			 <?PHP
			 }
			 ?>
			</tbody>
		  </table> 
		
		<?
    }
?>


