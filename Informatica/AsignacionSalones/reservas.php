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
.Estilo2 {color: #666666}
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
		$rs = db_query("select * from reserva where fecha >'2009-01-01' and id_sala='auditorio' order by  indice desc");
		?>
		
			<h1 class="Estilo1">Reservas Realizadas: Auditorio</h1>
			<br>
			<br>
					
			<table border="0" class="paginar display" cellpadding="2" cellspacing="5"> 
			<thead>
				<tr>
					<th>Indice</th>
					<th >Fecha Realización</th>
					<th>Hora</th>
					<th>Tipo Reserva</th>
					<th>Fecha Reservación</th>
					<th>Horario</th>
					<th>Tema Reserva</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
			<?PHP
			while($obj = pg_fetch_object($rs)){
			$horario= substr($obj->hora_inicio, 0, -6)."-".substr($obj->hora_termino, 0, -6);
			?>
				<tr>
					<td><? echo $obj->indice;?></td>
					<td><? echo $obj->fecha;?></td>
					<td><? echo $obj->hora;?></td>
					<td><? echo $obj->tipo_reserva;?></td>
					<td><? echo $obj->fecha_reserva;?></td>
					<td><? echo $horario;?></td>
					<td><? echo $obj->asignatura;?></td>
					<td><? echo $obj->estado;?></td>
				</tr>
			 <?PHP
			 }
			 ?>
			</tbody>
		  </table> 
		
		<?
    }
?>

