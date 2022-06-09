<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: reserva.php
	Objetivo: Formulario en el cual se ingresan los datos necesarios para realizar una reserva.
	Autor: Angela Benavides
	Año: 2006
	*********************************************************/
	
	session_start();
	
	if(!isset($_SESSION['profesor']))
	{
		header("Location: /Comunidad/Informatica/AsignacionSalas/index.php");
		die();
	}
	
	$root_path = "../../..";
	require '../../../functions.php';
	
	$_GET['submenu_informatica'] = null;
	$_GET['submenu_asignacion'] = null;
	$_GET['submenu_solicitud_reserva'] = true;
	
	if($_POST['aceptar'])
	{
		if(empty($_POST['profesor']) || empty($_POST['software']) || empty($_POST['tipo_reserva']) ||
		empty($_POST['plan']) || empty($_POST['asignatura']) || empty($_POST['grupo']) || empty($_POST['estudiantes']))
		{
			$_POST['vacios'] = true;
		}
		else if(!is_numeric($_POST['estudiantes']))
		{
			$_POST['numero'] = true;
		}
		else
		{
			$fecha = $_POST['fecha'];
			$hora = $_POST['hora'];
			$docente = $_POST['profesor'];
			$sala = $_POST['sala'];
			$software = $_POST['software'];
			$tipo_reserva = $_POST['tipo_reserva'];
			$fecha_reserva = $_POST['fr'];
			$hora_inicio = $_POST['hi'];
			$hora_final = $_POST['hf'];
			$plan = $_POST['plan'];
			$asignatura = $_POST['asignatura'];
			$grupo = $_POST['grupo'];
			$estudiantes = $_POST['estudiantes'];
			$login = $_SESSION['profesor']['login'];

			$conexion = DBConnect('controlsalas');
			
			if(!$conexion)
				echo("<td>No se pudo lograr la conexi&oacute;n con la BD.</td>");
			else
			{
				$dia_tmp = date("l", mktime(0, 0, 0, splitDate($fecha_reserva, 'month'), splitDate($fecha_reserva, 'day'), splitDate($fecha_reserva, 'year')));
				if($_SESSION['profesor']['permisos'] == 'limitado' && $tipo_reserva == 'ci' && (($dia_tmp == 'Friday' && $hora_inicio >= '13:00') || $dia_tmp == 'Saturday'))
				{
					$_POST['reserva_invalida'] = true;
				}
				else
				{
					$fallo = false;
					db_query('begin');
					
					$rs = db_query("insert into solicitud 
					(fecha, hora, docente, id_sala, software, tipo_reserva, fecha_reserva, hora_inicio, hora_termino, plan, asignatura, grupo, estudiantes, estado)
					values('$fecha', '$hora', '$docente', '$sala', '$software', '$tipo_reserva', '$fecha_reserva', '$hora_inicio', '$hora_final', '$plan', '$asignatura', '$grupo', $estudiantes, 'activo')");
					if(!$rs) $fallo = true;
					
					switch($tipo_reserva)
					{
						case 'ci':
							$color = "#FF6666";
							break;
						case 'cu':
							$color = "#FFCC66";
							break;
						case 't':
							$color = "#006699";
							break;
						case 'cp':
							$color = "#99CC00";
							break;
						case 'cd':
							$color = "#FF8000";
							break;
						case 'c':
							$color = "#3399CC";
						case 'pd':
							$color = "#B97BC4";//#9966FF";
					}
					
				}
			}

		/*
		mail('luispena@univalle.edu.co, webwoman@univalle.edu.co', 'Solicitud de Reserva de Sala', "
El doncente $_POST[profesor] ha enviado la siguiente solicitud de reserva de sala.

	Fecha: $_POST[fecha], $_POST[hora]
	Asignatura: $_POST[asignatura]
	Grupo: $_POST[grupo]
	No. de Estudiantes: $_POST[estudiantes]
	Plan: $_POST[plan]
			
	Tipo de reserva: $_POST[tipo_reserva]
	Sala: $_POST[sala]
	Software: $_POST[software]
			
	Fecha para reservar:$_POST[fr]
	Hora de inicio: $_POST[hi]
	Hora de culminación:$_POST[hf]
	
	Comentarios: $_POST[comentarios]
			", "From: $login") ;
			?>
			<script language="javascript" type="text/javascript">
			alert("Su solicitud a sido enviada correctamente.");
			</script>
			<?
			?>
			<script language="javascript">
			location.href="disponibilidad.php";
			</script>
		<?*/
		}
	}
	
	if($_POST['cancelar'])
	{
		?>
			<script language="javascript">
			location.href="disponibilidad.php";
			</script>
		<?
	}
	
	$fecha = date('Y-m-d');
	$hora = date('G:i:s');
	$fecha_reserva = $_GET['fecha_sel'];
	$hora_reserva = $_GET['hora'];
	$id_sala = $_GET['id_sala'];
	
	PageInit("Reservaci&oacute;n de Sala", "../../menu.php");
	?>
	<form name="reserva" method="post" enctype="multipart/form-data" action="">
	<input type="hidden" name="fecha" value="<?=$fecha?>">
	<input type="hidden" name="hora" value="<?=$hora?>">
	<table width="90%" align="center" border="0">
	<tr>
		<td colspan="2" align="left" valign="middle">
		<a href="disponibilidad.php?semana=true&amp;seleccion=<?=$fecha_reserva?>&amp;sala=<?=$id_sala?>">
		<img src="../../../Images/atras.jpg" name="volver" title="Volver!" width="15" height="15" alt=""></a>
		</td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr><td colspan="2"><b>Fecha Actual:</b> <?=makeDate($fecha)?></td></tr>
	<tr><td colspan="2"><br></td></tr>
	<tr><td colspan="2"><b>Hora Actual:</b> <?=$hora?></td></tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td width="30%" class="titulosContenidoInterno"><b>Profesor:</b></td>
		<?
		if($_SESSION['profesor']['permisos'] == 'total')
	//		echo "<td><input type=\"text\" name=\"profesor\" value=\"".$_POST['profesor']."\" size=\"50\"></td>";
	//	else
			echo "<td><input readonly type=\"text\" name=\"profesor\" value=\"".$_SESSION['profesor']['nombre']."\" size=\"50\"></td>";
		?>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td class="titulosContenidoInterno">Sala:</td>
		<td><input readonly name="sala" type="text" size="10" value="<?=$id_sala?>"></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td class="titulosContenidoInterno">Tipo de Software: </td>
		<td>
		<select name="software">
		<option>&nbsp;</option>
		
				<option<? if($_POST['software'] == 'SPSS') echo " selected ";?>>SPSS</option>
				<option<? if($_POST['software'] == 'Excel') echo " selected ";?>>Excel</option>
		<?
		switch($id_sala)
		{
			case 1:
				?>
				<option<? if($_POST['software'] == 'Project') echo " selected ";?>>Project</option>
				<option<? if($_POST['software'] == 'Java Creator') echo " selected ";?>>Java Creator</option>
				<?
				break;
			case 2:
				?>
				<option<? if($_POST['software'] == 'Project') echo " selected ";?>>Project</option>
				<?
				break;
			case 3:
				?>
				<option<? if($_POST['software'] == 'CGUno') echo " selected ";?>>CGUno</option>
				<option<? if($_POST['software'] == 'Siigo') echo " selected ";?>>Siigo</option>
				<option<? if($_POST['software'] == 'Software Libre') echo " selected ";?>>Software Libre</option>
				<?
				break;
			case 4:
				?>
				<option<? if($_POST['software'] == 'Software Libre') echo " selected ";?>>Software Libre</option>
				
				<?
				break;
		}
		if ($id_sala == 'idiomas')
		{
		?>
			<option<? if($_POST['software'] == 'TellMe') echo " selected ";?>>Tell Me More</option>
		<?
		}
		?>
			<option<? if($_POST['software'] == 'WinQSB') echo " selected ";?>>WinQSB</option>
			<option<? if($_POST['software'] == 'Composer') echo " selected ";?>>Composer</option>
			<option<? if($_POST['software'] == 'Simulacion') echo " selected ";?>>Simulación</option>
			<option<? if($_POST['software'] == 'Navegador') echo " selected ";?>>Navegador</option>
			<option<? if($_POST['software'] == 'Open Office') echo " selected ";?>>Open Office</option>
			<option<? if($_POST['software'] == 'Varios') echo " selected ";?>>Varios</option>
		</select>
		</td>
	</tr>
	<tr><td colspan="2"><br><br></td></tr>
	<tr>
		<td width="30%" class="titulosContenidoInterno">Tipo Reserva:</td>
		<td>
		<select name="tipo_reserva">
		<option selected value="">&nbsp;</option>
		<option value="Clase de Informatica"<? if($_POST['tipo_reserva'] == 'Clase de Informatica') echo " selected ";?>>Clase de Inform&aacute;tica</option>
		<option value="Clase Unica"<? if($_POST['tipo_reserva'] == 'Clase Unica') echo " selected ";?>>Clase &Uacute;nica</option>
		<option value="Taller"<? if($_POST['tipo_reserva'] == 'Taller') echo " selected ";?>>Taller</option>
		<option value="Capacitacion"<? if($_POST['tipo_reserva'] == 'Capacitacion') echo " selected ";?>>Capacitaci&oacute;n</option>
		<?
		if($_SESSION['profesor']['permisos'] == 'total')
		{
			?>
			<option value="Clase de Postgrado"<? if($_POST['tipo_reserva'] == 'Clase de Postgrado') echo " selected ";?>>Clase Posgrado</option>
			<option value="Clase de Diplomado"<? if($_POST['tipo_reserva'] == 'Clase de Diplomado') echo " selected ";?>>Clase Diplomado</option>
			<?
		}
		?>
		</select>
		</td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td class="titulosContenidoInterno">Fecha para reservar:</td>
		<td>
		<input readonly name="fr" size="30" value="<?=$fecha_reserva;?>" title="<?=makeDate($fecha_reserva);?>">&nbsp;(aa:mm:dd)
		</td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td class="titulosContenidoInterno">Hora de Inicio:</td>
		<td>
		<?
		if(isset($hora_reserva)) $hi_hora = substr($hora_reserva, 0, 2);
		else $hi_hora = 07;
		
		if($hi_hora < 10) $hi_hora = "0".($hi_hora + 0)."";
		?>
		<input readonly name="hi" size="30" value="<?=$hi_hora;?>:00">&nbsp;&nbsp;&nbsp;(hh:mm)
		</td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td class="titulosContenidoInterno">Hora Finalizaci&oacute;n:</td>
		<td>
		<?
		$hf_hora = $hi_hora + 3;
		if($hf_hora < 10) $hf_hora = "0".($hf_hora + 0)."";
		?>
		<input readonly name="hf" size="30" value="<?=$hf_hora;?>:00">&nbsp;&nbsp;&nbsp;(hh:mm)
		</td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td class="titulosContenidoInterno">Plan de estudios:</td>
		<td><input name="plan" type="text" size="50" title="Digite el codigo del plan de estudios!" value="<?=$_POST['plan']?>"></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td class="titulosContenidoInterno">Asignatura:</td>
		<td><input name="asignatura" type="text" size="50" title="Digite el codigo de la asignatura!" value="<?=$_POST['asignatura']?>"></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td class="titulosContenidoInterno">Grupo:</td>
		<td><input name="grupo" type="text" size="50" title="Digite el grupo al cual esta dirigida la asignatura!" value="<?=$_POST['grupo']?>"></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td class="titulosContenidoInterno">No. Estudiantes</td>
		<td><input name="estudiantes" type="text" size="50" title="Diguite el numero de estudiantes para los cuales esta diriguida la clase" value="<?=$_POST['estudiantes']?>"></td>
	</tr>
	<tr><td><br></td></tr>
	<TR>
		<TD COLSPAN="2" class="titulosContenidoInterno">Comentarios<br><br>
		<CENTER><TEXTAREA COLS="60" ROWS="8" NAME="comentarios"><?= $_POST['comentarios'] ?></TEXTAREA></CENTER>
		</TD>
	</TR>
	<tr>
		<td colspan="2" width="50%" align="center">
		<input name="aceptar" type="submit" value="Aceptar">
		&nbsp;&nbsp;&nbsp;
		<input name="cancelar" type="submit" value="Cancelar">
		</td>
		</tr>
	</table>
	</form>
<?
	
	if(isset($_POST['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se requieren llenos todos los campos!");
		</script>
		<?
	}
	
	if(isset($_POST['numero']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Los valores correspondientes al Plan y Estudiantes deben ser números.");
		</script>
		<?
	}
	
	if(isset($_POST['reserva_invalida']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("No hay sala disponible para talleres los viernes en la tarde ni los sabados.");
		</script>
		<?
	}
	
	if(isset($_POST['fallo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("No se logro realizar la reserva. Intente de nuevo.");
		</script>
		<?
	}
	
	PageEnd();
?>