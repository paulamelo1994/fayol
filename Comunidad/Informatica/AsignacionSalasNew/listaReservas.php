<?
	session_start();
	
	if(!isset($_SESSION['adminSalas']))
	{
		header("Location: /Comunidad/Informatica/AsignacionSalasNew/Formularios/ingresar.php");
		die();
	}
	$root_path = "../../..";
	require '../../../functions.php';
	PageInit("Listado Reservas", "menu.php");
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
		if($_GET['op']==1){
			$rs = db_query("select * from head_reserva  order by id_head desc");
			?>
			
				<h1 class="Estilo1">Lista reservas</h1>
				<br>
				<br>
						
				<table border="0" class="paginar display" cellpadding="2" cellspacing="5" style="width:700px; "> 
				<thead>
					<tr>
						<th>Fecha Petición</th>
						<th width="70px">Hora Petición</th>
						<th width="70px">Docente</th>
						<th>Sala</th>
						<th>Tipo Reserva</th>
						<th>Tipo Programa</th>
						<th>Asignatura</th>
						<th>Ver Fechas</th>
					</tr>
				</thead>
				<tbody>
				<?PHP
				while($obj = pg_fetch_object($rs)){
					DBConnect('profesores');
					$rsprof = db_query("select nombre from profesores  where cedula='$obj->docente'");
					$objp = pg_fetch_object($rsprof);
				?>
					<tr>
						<td><? echo $obj->fecha;?></td>
						<td><? echo $obj->hora;?></td>
						<td><? echo $objp->nombre;?></td>
						<td><? echo $obj->sala;?></td>
						<td><? echo $obj->tipo_reserva;?></td>
						<td><? echo $obj->tipo_programa;?></td>
						<td><? echo $obj->asignatura;?></td>
						<td><a href="listaReservas.php?id=<? echo $obj->id_head?>&op=2">Ver +</a></td>
						
					</tr>
				 <?PHP
				 }
				 ?>
				</tbody>
			  </table> 
			
			<?
		}
		///////
		if($_GET['op']==2){
			$id_head=@$_GET['id'];
			$rs = db_query("select * from body_reserva where id_head='$id_head' order by id_head desc");
			?>
			
				<h1 class="Estilo1">Lista fechas reservadas</h1>
				<br>
				<br>
						
				<table border="0" class="paginar display" cellpadding="2" cellspacing="5"> 
				<thead>
					<tr>
						<th>Id reserva</th>
						<th width="70px">Fecha reserva</th>
						<th width="70px">Hora inicio</th>
						<th>Hora final</th>
						<th>Estado</th>
						<th>Ver reserva completa</th>
					</tr>
				</thead>
				<tbody>
				<?PHP
				while($obj = pg_fetch_object($rs)){
				?>
					<tr>
						<td><? echo $obj->id_body;?></td>
						<td><? echo $obj->fecha_reserva;?></td>
						<td><? echo $obj->hora_inicio;?></td>
						<td><? echo $obj->hora_final;?></td>
						<td><? echo $obj->estado;?></td>
						<td><a href="vistaReserva.php?id2=<? echo $obj->id_body?>&idh=<? echo $id_head;?>">Ver +</a></td>
						
					</tr>
				 <?PHP
				 }
				 ?>
				</tbody>
				 <a href="listaReservas.php?op=1">Regresar</a><br><br><br><br>
			  </table> 
			 
			
			<?
		}
    }
?>


