<?
/*
 * Formulario de registro de reservas de auditorios
 */
 
 session_start();
	
	$root_path = "../../..";
	require '../../../functions.php';
	PageInit("Formulario Reserva", "../../menu.php");
	include '../../../php-scripts/validadorFormularios/formReserva.php';	

 
 $fecha= date('Y-m-d');
 $hora = date('H:i:s');
 $fecha_reserva = $_GET['fecha_sel'];
 $hora_reserva = $_GET['hora'];
 $id_sala ='auditorio';
 $conexion = DBConnect('controlsalas');
 if(!$conexion)
	echo("No se pudo lograr la conexi&oacute;n con la BD.");
 //Registro reserva
	if($_POST['aceptar']){
		
		$docente=$_POST['profesor'];
		$tipo_reserva=$_POST['tipo_reserva'];
		$fecha_reserva=$_POST['fecha_reserva'];
		$hora_inicio=$_POST['hora_ini'];
		$hora_termino=$_POST['hora_fin'];
		$tema=$_POST['tema'];
		$protocolos=$_POST['protocolo'];
		
		$quer = db_query("select indice from horario_auditorio
						 where id_sala='auditorio' and  fecha_reserva='$fecha_reserva' and hora>='$hora_inicio' and hora <=$hora_termino 
						 and estado='No Disponible'");
						
		if(pg_num_rows($quer) == 0)
		{
				$rs = db_query("insert into reserva 
				(fecha, hora, docente, id_sala, tipo_reserva, fecha_reserva, hora_inicio, hora_termino, tema, protocolo, estado)
				values
				('$fecha', '$hora', '$docente', 'auditorio', '$tipo_reserva', '$fecha_reserva', '$hora_inicio','$hora_termino',
				'$tema', '$protocolos', 'activo')");
				if(!$rs){ ?>
					<script language="javascript" type="text/javascript">
						alert("No se logro realizar la reserva. Intente de nuevo.");
					</script>
					<script language="javascript">
						location.href="reservar.php";
					</script>
				<? //Si se pudo ingresar la reserva, se pasa a actualizar la tabla de horario
				}else{
				
					switch($tipo_reserva)
											{
											//Conferencia
												case 'conferencia':
													$color = "#3399CC";
													break;
											//video conferencia
												case 'video_conferencia':
													$color = "#FF6666";
													break;
											//charla		
												case 'charla':
													$color = "#FFCC66";
													break;
											//Foro
												case 'foro':
													$color = "#006699";
													break;
											//cineforo		
												case 'cine_foro':
													$color = "#99CC00";
													break;
											//pelicula
												case 'pelicula':
													$color = "#FF8000";
													break;
											}
											
						$rs2 = db_query("update horario_auditorio set estado = 'No Disponible', color = '$color' where id_sala = 'auditorio'
										 and fecha = '$fecha_reserva' and hora >= '$hora_inicio' and  hora <= hora_termino");
						if(!$rs2){
							db_query('rollback');
							?>
							<script language="javascript" type="text/javascript">
								alert("No se logro realizar la reserva. Intente de nuevo.");
							</script>
							<script language="javascript">
								location.href="reservar.php";
							</script>
							<?
						}else{ 
							$rs = db_query("select last_value from reserva_seq");
							$obj = pg_fetch_object($rs);
							$no_reserva = $obj->last_value;						
						
						?>
							<div id="ventanaReserva">
								<table border="0" width="80%" align="center">
								<tr>
									<td colspan="2"><h2>Se ha registrado su reserva exitosamente!</h2></td>
								</tr>
								<tr>
								 	<th colspan="2" scope="col">Datos Reserva</th></tr>
										<tr>
											<td class="titulosContenidoInterno">N&uacute;mero:</td>
											<td><?=$no_reserva?></td>
										</tr>
										<tr>
											<td class="titulosContenidoInterno">Fecha:</td>
											<td><?=$fecha_reserva?></td>
										</tr>
										<tr>
											<td class="titulosContenidoInterno">Hora:</td>
											<td><?=$hora_inicio?></td>
										</tr>
										<tr>
											<td class="titulosContenidoInterno">Hasta:</td>
											<td><?=$hora_termino?></td>
										</tr>
										<tr>
											<td class="titulosContenidoInterno">Auditorio:</td>
											<td><?='auditorio'?></td>
										</tr>
										<tr>
											<td class="titulosContenidoInterno">Tipo Reserva:</td>
											<td><?=$tipo_reserva?></td>
										</tr>
										<tr>
											<td class="titulosContenidoInterno">Docente:</td>
											<td><?=$docente?></td>
										</tr>
										<tr>
											<td class="titulosContenidoInterno">Tema:</td>
											<td><?=$tema?></td>
										</tr>
										<tr>
											<td class="titulosContenidoInterno">Protocolos:</td>
											<td><?=$protocolo?></td>
										</tr>
										<tr>
											<td align="center" colspan="2">
											<input type="button" name="Aceptar" value="Aceptar" onClick="location.href='../calendarioMensual.php?opcion=reserva'"/>
											</td>
										</tr>
								</table>
							</div>
							<?
						}
					
					}
		}else{ ?>
				<script language="javascript" type="text/javascript">
					alert("La reserva no se puede realizar, esta se cruza con una reserva previa");
				</script>
				<script language="javascript">
					location.href="../calendarioMensual.php?opcion=reservar";
				</script>
			
			<?
		}
	
	}
 
 
 $queryHoraFin= db_query("SELECT * FROM horario_auditorio WHERE fecha='$fecha_reserva' AND hora > '$hora_reserva' AND estado='No Disponible' ORDER BY hora ASC ");
 $result=pg_fetch_object($queryHoraFin);
 if($result==0){
 	$horaFin=21;
 }else{
 	$horaFin=$result->hora;
 }
 
  
 ?>
<form name="reserva2" method="post" enctype="multipart/form-data" action="reservar.php" id="reserva2">
	<input type="hidden" name="fecha" value="<?=$fecha?>">
	<input type="hidden" name="hora" value="<?=$hora?>">
	<br>
	<br>
	<table width="80%" align="center" border="0">
	<tr>
		<td colspan="2"><b>Fecha Actual:</b> <?=makeDate($fecha)?></td>
	</tr>
	<tr>
		<td colspan="2"><b>Hora Actual:</b> <?=$hora?></td>
	</tr>
		<td width="44%" height="36" class="titulosContenidoInterno">Profesor: </td>
		<td width="56%"><p>
		  <input type="text" size="76" name="profesor" id="profesor"></td>
	</tr>
	<tr>
		<td height="36" class="titulosContenidoInterno">Sala:</td>
		<td> <input readonly name="sala" type="text" size="10" value="Auditorio" id="sala"></td>
	</tr>
	<tr>
		<td width="44%" height="42" class="titulosContenidoInterno">Tipo reserva:</td>
		<td><select name="tipo_reserva" id="tipo_reserva">
			      <option value=""></option>
			      <option value="conferencia" selected="selected"> Conferencia</option>
			      <option value="video_conferencia"> Video Conferencia</option>
			      <option value="charla"> Charla</option>
			      <option value="foro">Foro</option>
			      <option value="cine_foro">Cine Foro</option>
			      <option value="pelicula"> Pel&iacute;cula</option>
		      </select>
	    </td>
	<tr>
		<td height="38" class="titulosContenidoInterno">Fecha para reservar:</td>
		<td><input readonly name="fecha_reserva" size="30" value="<? echo $fecha_reserva;?>"  id="fecha_reserva">
        &nbsp;(aa:mm:dd)</td>
	</tr>
	<tr>
		<td height="33" class="titulosContenidoInterno">Hora de inicio: </td>
		<td><p>
		  <input readonly name="hora_ini" size="30" value="<? echo $hora_reserva.":00";	?>" id="hora_ini"></td>
	</tr>
	<tr>
		<td class="titulosContenidoInterno">Hora de finalizaci&oacute;n:</td>
	  <td><select name="hora_fin" id="hora_fin">
       		 <option value=""></option>
				<? 
						for($a= $hora_reserva+1 ; $a <= $horaFin ; $a++){
							?>
				<option value=" <? echo $a; ?> "><? echo $a.":00"; ?></option>
				<?
						} 
					?>
      		</select></td>
	</tr>
	<tr>
		<td height="42" class="titulosContenidoInterno">Tema: </td>
		<td><p>
		  <input name="tema" type="text" size="76" value="" id="tema"></td>
	</tr>
	<tr>
		<td height="169" class="titulosContenidoInterno">Protocolos: </td>
		<td><textarea cols="58" rows="8" name="protocolo" id="protocolo"></textarea></td>
	<tr>
		<td height="26" colspan="2" align="center">
			&nbsp;&nbsp;&nbsp;
			<input name="aceptar" type="submit" value="Aceptar">
			&nbsp;&nbsp;&nbsp;
			<input name="cancelar" type="submit" value="Cancelar" >
		</td>
	</tr>
</table>
</form>
<!-- http://administracion.univalle.edu.co/Comunidad/Informatica/AsignacionAuditorio/formularioReserva.php?fecha_sel=2011-02-07&hora=10 -->

