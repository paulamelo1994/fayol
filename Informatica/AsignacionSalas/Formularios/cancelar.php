<? 
/*
 * Formulario de cancelacion de reservas de auditorios
 */
 
 	session_start();
	if(!isset($_SESSION['adminSalas']))
	{
		header("Location: /Comunidad/Informatica/AsignacionSalas/Formularios/ingresar.php");
		die();
	}
	$root_path = "../../../..";
	require '../../../../functions.php';
	PageInit("Formulario Cancelacion Reserva", "../menu.php");
	include '../../../../php-scripts/validadorFormularios/formReserva.php';
	 
	 if($_POST['aceptar']){
	 
	 $fecha= date('Y-m-d');
	 $id_body = pg_escape_string($_POST['reserva']);
	 $id_head = pg_escape_string($_POST['head']);
	 $cancelar=pg_escape_string(@$_POST['cancelarTodas']);
	 $observaciones=pg_escape_string($_POST['observaciones']);
	 $respuesta='';

	 DBConnect('controlsalas');
	 	$queryp=db_query("select count(*) as cantidad from cancelaciones_salas where id_body='$id_body'");
	 	$objp = pg_fetch_object($queryp);
		if($objp->cantidad >0){
			?><script language="javascript" type="text/javascript">
			alert("La reserva ya esta cancelada");
			location.href="/Comunidad/Informatica/AsignacionSalas/calendarioMensual.php";
			</script> <?
		}else{
		
	 	db_query('begin');
		
			$query2 = db_query("update body_reserva set estado='cancelado' where id_body='$id_body'");
			$query3= db_query("insert into cancelaciones_salas (fecha, id_body, observaciones) 
								values ('$fecha', '$id_body' , '$observaciones')");
			$hora1=pg_escape_string($_POST['hora1']);
			$hora2=pg_escape_string($_POST['hora2']);
			$idsala=pg_escape_string($_POST['sala']);
			$query4 = db_query("update horario_salas set 
														estado = 'Disponible',
														color = '#FFFFFF'
							 	where fecha = '$_POST[fechaReserva]' and 
									  hora >='$hora1' and 
									  hora <'$hora2' and 
									  id_sala='$idsala'");
									  	
			$respuesta=$respuesta.' --  '.$_POST['fechaReserva'].' de '.$_POST['hora1'].'  a   '.$_POST['hora2'].' <br> ';
			
		if($cancelar == 1){
			$query1=db_query("select * from body_reserva where id_head='$id_head' and id_body != '$id_body' and estado='activo'");
			while($obj1 = pg_fetch_object($query1)){
				$query5 = db_query("update body_reserva set estado='cancelado' where id_body='$obj1->id_body'");
				$query6= db_query("insert into cancelaciones_salas (fecha, id_body, observaciones) 
									values ('$fecha', '$obj1->id_body' , '$observaciones')");
				$query7 = db_query("update horario_salas set estado = 'Disponible', color = '#FFFFFF'
									 where fecha = '$obj1->fecha_reserva' and hora >='$obj1->hora_inicio' and hora <'$obj1->hora_final' and id_sala='$idsala'");	
				$respuesta=$respuesta.' --  '.$obj1->fecha_reserva.' de '.$obj1->hora_inicio.'  a   '.$obj1->hora_final.' <br> ';
			}
			
		}else{
			if(isset($_POST['otras_fechas'])){
				foreach($_POST['otras_fechas'] as $fechas){
					if($fechas != ''){
						$query1=db_query("select * from body_reserva where id_body = '$fechas'");
						$obj1 = pg_fetch_object($query1);
						$query5 = db_query("update body_reserva set estado='cancelado' where id_body='$fechas'");
						$query6= db_query("insert into cancelaciones_salas (fecha, id_body, observaciones) 
											values ('$fecha', '$fechas' , '$observaciones')");
						$query7 = db_query("update horario_salas set estado = 'Disponible', color = '#FFFFFF'
											 where fecha = '$obj1->fecha_reserva' and hora >='$obj1->hora_inicio' and hora <'$obj1->hora_final' and id_sala='$idsala' ");	
						$respuesta=$respuesta.' --  '.$obj1->fecha_reserva.' de '.$obj1->hora_inicio.'  a   '.$obj1->hora_final.' <br> ';
					}
				}
			}
			
		}
		
		if(!$query2 && !$query3 && !$query4 && !$query5 && !$query6 && !$query7){ 
			db_query('rollback');
			?>
			<script language="javascript" type="text/javascript">
			alert("La reserva no se pudo cancelar");
			location.href="/Comunidad/Informatica/AsignacionSalas/calendarioMensual.php";
			</script>
			<?
		}else{
			db_query('commit');
			?>
			<style type="text/css">
			<!--
			.Estilo1 {
				font-size: 16px;
				font-weight: bold;
			}
			-->
            </style>
			
				<table align="center">
					<tr>
						<td style="padding-top:25px; color:#777777;">
							<span class="Estilo1">RESULTADO CANCELACIONES</span><BR>
							<BR>
							Se cancel&oacute; la(s) siguiente(s) reserva(s):<br> <BR>
							<? echo $respuesta; ?>
					  </td>
					</tr>
				</table>
			<?
		}
	 
	  }
	 }else{
	 
		  
 	DBConnect('controlsalas');
	$id_reserva = pg_escape_string($_GET['id']);
	$rs = db_query("select * from head_reserva natural join body_reserva where id_body = $id_reserva");
	$obj = pg_fetch_object($rs);
	$query2=db_query("select count(*)as cant from body_reserva where id_head='$obj->id_head' and estado='activo'");
	$obj2 = pg_fetch_object($query2);
	$query3=db_query("select * from body_reserva where id_head='$obj->id_head' and estado='activo' and id_body != '$id_reserva'");
	DBConnect('profesores');
					$rsprof = db_query("select nombre from profesores  where cedula='$obj->docente'");
					$objp = pg_fetch_object($rsprof);
?>

<h2>Datos de la reserva a cancelar:</h2>
<br>
<form name="reserva3" id ="reserva3" method="post" enctype="multipart/form-data" action="">
<input type="hidden" name="reserva" value=<?=$obj->id_body?>>
<input type="hidden" name="head" value=<?=$obj->id_head?>>
<input type="hidden" name="fechaReserva" value=<?=$obj->fecha_reserva?>>
<input type="hidden" name="hora1" value=<?=$obj->hora_inicio?>>
<input type="hidden" name="hora2" value=<?=$obj->hora_final?>>
<input type="hidden" name="sala" value=<?=$obj->sala?>>

	<table border="0" align="center" width="60%">
		<tr>
			<td class="titulosContenidoInterno" width="40%">Sala:</td>
			<td width="60%"><?=$obj->sala?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno" width="40%">Profesor:</td>
			<td width="60%"><?=$objp->nombre?></td>
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
			<td><?=$obj->hora_final?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Tema</td>
			<td><?=$obj->asignatura?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Contenido</td>
			<td><?=$obj->contenido?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Observaciones:</td>
			<td><textarea  id="observaciones" name="observaciones" rows="5" cols="25"></textarea></td>
		</tr>
        <? if($obj2->cant > 1){?>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Otras fechas de la reserva:</td>
			<td>Seleccione las que desee cancelar.<br><br>
				<?	$i=0;
					while($obj3 = pg_fetch_object($query3)){
						?><input name="otras_fechas[<? echo $i; ?>]" type="checkbox"  value="<? echo $obj3->id_body; ?>">
						<? echo $obj3->fecha_reserva."  de ".substr($obj3->hora_inicio,0,5)." a ".substr($obj3->hora_final,0,5); ?> <br> <?
						$i++;
					}
				?>
				<input name="cancelarTodas" type="checkbox"  value="1"> Cancelarlas todas
			</td>
		</tr>
        <? } ?>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td align="center"><input type="submit" name="aceptar" value="Cancelar Reserva"></td>
			<td align="center"><input type="button" name="regresar" value="Regresar" onClick="location.href='/Comunidad/Informatica/AsignacionSalas/calendReserva.php?opcion=3&fecha=<?=$obj->fecha_reserva?>'"/></td>
		</tr>
	</table>
</form>

<?
	}
		PageEnd();
?>

