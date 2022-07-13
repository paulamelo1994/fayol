<? 
/*
 * Formulario de cancelacion de reservas de auditorios
 */
 
 	session_start();
	if(!isset($_SESSION['profesor']))
	{
		header("Location: /Comunidad/Informatica/AsignacionSalas/index.php");
		die();
	}
	$root_path = "../../../..";
	require '../../../../functions.php';
	PageInit("Formulario Cancelacion Reserva", "../menu.php");
	include '../../../../php-scripts/validadorFormularios/formReserva.php';
	 
	 if($_POST['aceptar']){
	 
	 $fecha= date('Y-m-d');
	 $id_reserva = $_POST['reserva'];

	 DBConnect('controlsalas');
	 
	 	db_query('begin');
		
	 	$rs1 = db_query("insert into cancelaciones (fecha, reserva, observaciones) values ('$fecha', $id_reserva, '$_POST[observaciones]')");
		
		$rs2 = db_query("update reserva set estado='cancelado' where indice='$id_reserva'");		
		
		$rs3 = db_query("select * from reserva where indice = $id_reserva");
		$obj = pg_fetch_object($rs3);
				
		$rs4 = db_query("update horario_auditorio set estado = 'Disponible', color = '#FFFFFF'
						 where fecha = '$obj->fecha_reserva' and hora >='$obj->hora_inicio' and hora <'$obj->hora_termino' ");		 
		
	 
	 	if(!$rs1 && !$rs2 && !$rs3 && !$rs4){ 
			db_query('rollback');
			?>
			<script language="javascript" type="text/javascript">
			alert("La reserva no se pudo cancelar");
			location.href="/Comunidad/Informatica/AsignacionAuditorio/calendarioMensual.php";
			</script>
			<?
		}else{
			db_query('commit');
			?>
			<script language="javascript" type="text/javascript">
			alert("La reserva ha sido cancelada exitosamente");
			location.href="/Comunidad/Informatica/AsignacionAuditorio/calendarioMensual.php";
			</script>
			<?
		}
	 
	 
	 }
	 
	  
 	DBConnect('controlsalas');
	$id_reserva = $_GET['id'];
	$rs = db_query("select * from reserva where indice = $id_reserva");
	$obj = pg_fetch_object($rs);
?>

<h2>Datos de la reserva a cancelar:</h2>
<br>
<form name="reserva3" id ="reserva3" method="post" enctype="multipart/form-data" action="">
<input type="hidden" name="reserva" value=<?=$obj->indice?>>
<input type="hidden" name="fechaReserva" value=<?=$obj->fecha_reserva?>>

	<table border="0" align="center" width="60%">
		<tr>
			<td class="titulosContenidoInterno" width="40%">Profesor:</td>
			<td width="60%"><?=$obj->docente?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Tipo reserva:</td>
			<td><?=$obj->tipo_reserva?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Fecha reserva:</td>
			<td><?=$obj->fecha_reserva?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Hora Inicio:</td>
			<td><?=$obj->hora_inicio?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Hasta:</td>
			<td><?=$obj->hora_termino?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Tema</td>
			<td><?=$obj->asignatura?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Protocolos</td>
			<td><?=$obj->protocolo?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Observaciones:</td>
			<td><textarea  id="observaciones" name="observaciones" rows="5" cols="25"></textarea></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td align="center"><input type="submit" name="aceptar" value="Cancelar Reserva"></td>
			<td align="center"><input type="button" name="regresar" value="Regresar" onClick="location.href='/Comunidad/Informatica/AsignacionAuditorio/calendReserva.php?opcion=3&fecha=<?=$obj->fecha_reserva?>'"/></td>
		</tr>
	</table>
</form>
<?
		PageEnd();
?>

