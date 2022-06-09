<?
	session_start();
	
	if(!isset($_SESSION['adminSalas']))
	{
		header("Location: /Comunidad/Informatica/AsignacionSalasNew/Formularios/ingresar.php");
		die();
	}
	$root_path = "../../..";
	require '../../../functions.php';
	PageInit("Listado Cancelaciones Salas", "menu.php");
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
		$rs = db_query("select * from body_reserva natural join head_reserva inner join cancelaciones_salas on body_reserva.id_body = cancelaciones_salas.id_body order by cancelaciones_salas.fecha desc");
		?>
		
			<h1 class="Estilo1">Cancelaciones Realizadas</h1>
			<br>
			<br>
					
			<table border="0" class="paginar display" cellpadding="2" cellspacing="5"> 
			<thead>
				<tr>
					<th>Indice</th>
					<th>Sala</th>
					<th width="70px">Fecha Cancelación</th>
					<th>No Reserva</th>
					<th>Observaciones</th>
				</tr>
			</thead>
			<tbody>
			<?PHP
			while($obj = pg_fetch_object($rs)){
			?>
				<tr>
					<td><? echo $obj->id;?></td>
					<td><? echo $obj->sala;?></td>
					<td><? echo $obj->fecha;?></td>
					<td><? echo $obj->id_body;?><a href="vistaReserva.php?id2=<? echo $obj->id_body;?>&op=1"> ver</a></td>
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


