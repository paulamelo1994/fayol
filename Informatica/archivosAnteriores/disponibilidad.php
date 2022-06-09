<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: disponibilidad.php
	Objetivo: Aqui se presenta la disponibilidad de una sala tanto por mes como por semana. Y a partir desde aqui 
				empieza el proceso de reserva de una sala.
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
	$_GET['submenu_asignacion'] = true;
	
	//Variables usadas en todos los casos
	$num_dias = 7;
	
	//Disponibilidad por mes
	if(!isset($_GET['semana']) && !isset($_GET['dia']))
	{	
		if(isset($_POST['atras']))
			$fecha = $_POST['atras'];
		else if(isset($_POST['siguiente']))
			$fecha = $_POST['siguiente'];
		else
			$fecha = date('Y')."-".date('m')."-".date('d');
		
		if(isset($_POST['sala']))
			$id_sala = $_POST['sala'];
		else if($_GET['sala'])
			$id_sala = $_GET['sala'];
		else
			$id_sala = 'auditorio';
	
		$mes_anterior = monthTransform($fecha, 'before');
		$mes_siguiente = monthTransform($fecha, 'next');
	
		$dias_mes = cal_days_in_month ( CAL_GREGORIAN, intval(splitDate($fecha, 'month')), intval(splitDate($fecha, 'year')));
		$dia_inicio = date("l", mktime(0, 0, 0, splitDate($fecha, 'month'), 1, splitDate($fecha, 'year')));
	
		DBConnect('controlsalas');
		$consulta = "SELECT distinct on (id_sala, fecha) * from horario where id_sala = '$id_sala' and fecha like '".splitDate($fecha, 'year')."-".splitDate($fecha, 'month')."%' ;";
	//echo "SELECT distinct on (id_sala, fecha) * from horario where id_sala = $id_sala and fecha like '".splitDate($fecha, 'year')."-".splitDate($fecha, 'month')."%'";
	
		$rs = db_query($consulta);
		
		//Si no hay registro de este mes, lo inserto en la BD
		if(pg_num_rows($rs) == 0)
		{
			for($i = 1; $i <= $dias_mes; $i++)
			{
				db_query('begin');
				
				if($i < 10) $i = "0".$i;
				$tmp = splitDate($fecha, 'year')."-".splitDate($fecha, 'month')."-".$i;
				
				for($j = 7; $j < 22; $j++)
				{
					$k = $j + 1;
					if($j < 10) $j = "0".$j;
					if($k < 10) $k = "0".$k;
					
					$consulta1 = "insert into horario (id_sala, fecha, hora, estado, color) values('$id_sala', '$tmp', '$j - $k', 'Disponible', '#FFFFFF')";
					$rs1 = db_query($consulta1);
				}
				
				if(!$rs1) $fallo = true;
			}
			
			if($fallo) db_query('rollback');
			else
			{ 
				db_query('commit');
				$rs = db_query($consulta);
			}
		}
	
		switch($dia_inicio)
		{
			case 'Sunday':
				$dia_semana = 1;
				break;
			case 'Monday':
				$dia_semana = 2;
				break;
			case 'Tuesday':
				$dia_semana = 3;
				break;
			case 'Wednesday':
				$dia_semana = 4;
				break;
			case 'Thursday':
				$dia_semana = 5;
				break;
			case 'Friday':
				$dia_semana = 6;
				break;
			case 'Saturday':
				$dia_semana = 7;
				break;
		}
		if($_GET['sala'] != 'auditorio')
			PageInit("Disponibilidad del Mes : Sala $id_sala", "menu.php");
		else
			PageInit("Disponibilidad del Mes : Auditorio $id_sala", "../../menu.php");
		?>
		<h1 class="shiny">Disponibilidad</h1>
		<form name="disponibilidad_mes" method="post" enctype="multipart/form-data" action="">
		<table width="100%" border="0">
		<tr>
			<td valign="top" width="20%" align="center">
			<table width="90%" border="0"><tr><td>
			<tr><td class="titulosContenidoInterno">A continuaci&oacute;n puede escojer la sala deseada:</td>
			</tr>
			<?
			if($_SESSION['profesor']['permisos'] == 'total')
			{
			
				$rs4 = db_query("SELECT distinct on (codigosala) codigosala from computador where nombresalas='auditorio';");
				
				while($obj4 = pg_fetch_object($rs4))
				{
					?>
					<tr><td><br></td></tr> 
					<?
					
					$i = $obj4->codigosala;
					
					if($i != $id_sala)
					{
						?>
						<tr>
							<td align="center">
							<input type="radio" name="sala" value="<?=$i?>" title="Sala No. <?=$i?>" onClick="document.location.href='disponibilidad.php?sala=<?=$i?>'"><br>Sala <?=$i?></td>
						</tr>
						<?
					}
					else
					{
						?>
						<tr>
							<td align="center">
							<input type="radio" name="sala" value="$i" title="Sala No. <?=$i?>" checked disabled>
							<br>Sala <?=$i?></td>
						</tr>
						<?
					}
				}
			}
			else if($_SESSION['profesor']['login'] == 'admseacd')
			{
				?>
				<tr><td><br></td></tr> 
				<?
				
				$i = 'auditorio';
				?>
				 
				<tr>
					<td align="center">
					<input type="radio" name="sala" value="<?=$i?>" title="Auditorio" checked onClick="document.location.href='disponibilidad.php?sala=<?=$i?>'">
					<br>Auditorio</td>
				</tr>	
				<?
			}
			?>
			
						
			</table>
			</td>
			<td width="80%">
			<table width="70%" align="center" border="1" cellspacing="1">
			<tr><td align="center" colspan="7"><h2><? 
			if($_GET['sala'] != 'auditorio') 
				echo 'Sala No. '.$id_sala;
			else
				echo 'Auditorio'; 	
				?><br><?=makeMonth($fecha);?></h2></td></tr>
			<tr>
				<td colspan="1" align="center" valign="middle">
				<input type="image" src="../../../Images/atras.jpg" name="atras" title="Mes Anterior" value="<?=$mes_anterior?>">
				</td>
				<td colspan="5"></td>
				<td colspan="1" align="center" valign="middle">
				<input type="image" src="../../../Images/adelante.png" name="siguiente" title="Mes Siguiente" value="<?=$mes_siguiente?>">
				
				</td>
			</tr>
			<tr>
				<th width="50" scope="col">DOM</th>
				<th width="50" scope="col">LUN</th>
				<th width="50" scope="col">MAR</th>
				<th width="50" scope="col">MIE</th>
				<th width="50" scope="col">JUE</th>
				<th width="50" scope="col">VIE</th>
				<th width="50" scope="col">SAB</th>
				
			</tr>
			<tr bgcolor="#FFFFFF">
			<?
			$tmp = 0;
			for($i = 1; $i < $dia_semana; $i++)
			{
				?>
				<td height="50" align="center" valign="middle" bgcolor="#f2f2f2"></td>
				<?
				$tmp ++;
			}
			while($obj = pg_fetch_object($rs))
			{
				$rs1 = db_query("select distinct(estado) from horario where id_sala = '$id_sala' and fecha = '$obj->fecha' and hora != '13 - 14' and hora != '17 - 18' and hora != '21 - 22'");
				$obj1 = pg_fetch_object($rs1);
				
				if(pg_num_rows($rs1) == 1 && $obj1->estado == 'Disponible')
				{
					?>
					<td bgcolor="#FFFFFF" height="50" align="center" valign="middle" title="Disponible">
					<a href="disponibilidad.php?semana=true&amp;seleccion=<?=$obj->fecha?>&amp;sala=<?=$id_sala?>" class="dayOn">
					<font color="#000000"><?=splitDate($obj->fecha, 'day')?></font>
					</a>
					</td>
					<?
				}
				else if(pg_num_rows($rs1) == 1 && $obj1->estado == 'No Disponible')
				{
					?>
					<td bgcolor="#FFFFFF" height="50" align="center" valign="middle" class="dayOff" title="No Disponible"><?=splitDate($obj->fecha, 'day')?></td>
					<?
				}
				else
				{
					?>
					<td bgcolor="#FFFFFF" height="50" align="center" valign="middle" title="Parcialmente Disponible">
					<a href="disponibilidad.php?semana=true&amp;seleccion=<?=$obj->fecha?>&amp;sala=<?=$id_sala?>" class="dayOn">
					<font color="#0099CC"><?=splitDate($obj->fecha, 'day')?></font></a>
					</td>
					<?
				}
						
				$tmp++;
				
				if($tmp % $num_dias == 0) echo "</tr><tr>";
				
			}
			?>
			<td colspan="7"></td>
			</tr>
			</table>
			</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td></td>
			<td align="center">
			<table border="0" width="70%" align="center">
			<tr><td align="center" colspan="5" class="titulosContenidoInterno">Convenciones:</td></tr>
			<tr>
				<td width="18%"></td>
				<td width="9%" bgcolor="#000000"></td>
				<td width="5%" align="center"><b>:</b></td>
				<td width="50%">Disponible</td>
				<td width="18%"></td>
			</tr>
			<tr>
				<td></td>
				<td bgcolor="#0099CC"></td>
				<td align="center"><b>:</b></td>
				<td>Parcialmente Disponible</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td bgcolor="#e04e4f"></td>
				<td align="center"><b>:</b></td>
				<td>No Disponible</td>
				<td></td>
			</tr>
			</table>
			</td>
		</tr>
		</table>
		</form>
		<?
	}
	
	//Disponibilidad por semana
	if(isset($_GET['semana']))
	{
		if(isset($_GET['sala'])) $id_sala = $_GET['sala'];
		
		if($_GET['seleccion']) $fecha = $_GET['seleccion'];
	
		$dia_tmp = date("l", mktime(0, 0, 0, splitDate($fecha, 'month'), splitDate($fecha, 'day'), splitDate($fecha, 'year')));
		if($dia_tmp != 'Sunday')
			$inicio_semana = date("Y-m-d", strtotime("last Sunday", strtotime($fecha)));
		else
			$inicio_semana = $fecha;
		$fin_semana = date("Y-m-d", strtotime("this Saturday", strtotime($fecha)));
		$nombre_dia = date("l", mktime(0, 0, 0, splitDate($fecha, 'month'), splitDate($fecha, 'day'), splitDate($fecha, 'year')));
		$semana_anterior = date("Y-m-d", strtotime("last $nombre_dia", strtotime($fecha)));
		$semana_siguiente = date("Y-m-d", strtotime("next $nombre_dia", strtotime($fecha)));
		
		if($_GET['sala'] != 'auditorio')
			PageInit("Disponibilidad de la Semana : Sala $id_sala", "../../menu.php");
		else
			PageInit("Disponibilidad de la Semana : Auditorio $id_sala", "../../menu.php");
		?>
		<h1 class="shiny">Disponibilidad</h1>
		<form name="disponibilidad_semana" method="post" enctype="multipart/form-data" action="">
		<table width="80%" align="center" border="0" cellspacing="2">
			<tr>
				<td colspan="1" valign="middle" align="center"><a href="disponibilidad.php?sala=<?=$id_sala?>">
				<img border="1" src="<?=$root_path?>/Images/iconoMes.png" name="volver_mes" title="Volver a modo mes!" width="30" height="30" alt=""></a>
				</td>
				<td align="center" colspan="7" valign="top"><h2>Sala No. <?=$id_sala?></h2><h3><?=makeDate($fecha)?></h3><br>Semana del:<br><?=makeDate($inicio_semana);?><b> - </b><?=makeDate($fin_semana);?><br></td></tr>
			<tr>
				<td colspan="1" align="center" valign="middle"><a href="disponibilidad.php?semana=true&amp;seleccion=<?=$semana_anterior?>&amp;sala=<?=$id_sala?>">
				<img src="../../../Images/atras.jpg" name="semana_atras" title="Semana Anterior" width="15" height="15" alt=""></a>
				</td>
				<td colspan="6"></td>
				<td colspan="1" align="center" valign="middle"><a href="disponibilidad.php?semana=true&amp;seleccion=<?=$semana_siguiente?>&amp;sala=<?=$id_sala?>">
				<img src="../../../Images/adelante.png" name="semana_siguiente" title="Semana Siguiente" width="15" height="15" alt=""></a>
				</td>
			</tr>
			<tr><td colspan="8" width="5">&nbsp;</td></tr>
			<tr>
				<th width="55" STYLE="background-color: inherit;"></th>
				<th width="55" scope="col" <? if($dia_tmp == 'Sunday') echo "STYLE=\"background-color: #993300;\"";?>>DOM</th>
				<th width="55" scope="col" <? if($dia_tmp == 'Monday') echo "STYLE=\"background-color: #993300;\"";?>>LUN</th>
				<th width="55" scope="col" <? if($dia_tmp == 'Tuesday') echo "STYLE=\"background-color: #993300;\"";?>>MAR</th>
				<th width="55" scope="col" <? if($dia_tmp == 'Wednesday') echo "STYLE=\"background-color: #993300;\"";?>>MIE</th>
				<th width="55" scope="col" <? if($dia_tmp == 'Thursday') echo "STYLE=\"background-color: #993300;\"";?>>JUE</th>
				<th width="55" scope="col" <? if($dia_tmp == 'Friday') echo "STYLE=\"background-color: #993300;\"";?>>VIE</th>
				<th width="55" scope="col" <? if($dia_tmp == 'Saturday') echo "STYLE=\"background-color: #993300;\"";?>>SAB</th>
			</tr>
			<tr bgcolor="#000000">
			<?
			DBConnect('controlsalas');
			$consulta = "SELECT * from horario where id_sala = '$id_sala' and fecha >= '".$inicio_semana."' and fecha <= '".$fin_semana."' order by hora, fecha";
			$rs = db_query($consulta);

			$tmp = 0;
			while($obj = pg_fetch_object($rs))
			{
				if($tmp % $num_dias == 0)
				{
					?>
					<td align="center" height="20" bgcolor="#F0F0F0"><?=$obj->hora?></td>
					<?
				}
				
				if($id_sala == 'CUSE')
				{
					if($obj->estado == 'Disponible')
					{
							?>
							<td height="20" bgcolor="<?=$obj->color?>" align="center" valign="middle" title="<?=makeDate($obj->fecha)?>. <?=$obj->estado?>">
							<a href="<?=makeURL("reserva.php?fecha_sel=$obj->fecha&amp;id_sala=$id_sala&amp;hora=$obj->hora")?>">.</a>
							</td>
							<?
					}
					else
					{
						
							$rs1 = db_query("select * from reserva where id_sala = '$obj->id_sala' and fecha_reserva = '$obj->fecha' and hora_inicio like '".substr($obj->hora, 0, 2)."%' and estado = 'activo' ");
							$obj1 = pg_fetch_object($rs1);
							?>
							<td height="20" bgcolor="<?=$obj->color?>" align="center" valign="middle" title="<?=makeDate($obj->fecha)?>.<?= substr($obj->hora, 0, 2)?>. <?=$obj->estado?>">
							<font color="#FFFFFF"><b><?=$obj1->docente?></b></font>
							</td>
							<?
					}
				}
				else
				{
				
					if($obj->estado == 'Disponible')
					{
						if($obj->hora == '07 - 08' || $obj->hora == '10 - 11' || $obj->hora == '14 - 15' || $obj->hora == '18 - 19')
						{
							?>
							<td height="20" bgcolor="<?=$obj->color?>" align="center" valign="middle" title="<?=makeDate($obj->fecha)?>. <?=$obj->estado?>">
							<a href="<?=makeURL("reserva.php?fecha_sel=$obj->fecha&amp;id_sala=$id_sala&amp;hora=$obj->hora")?>">*</a>
							</td>
							<?
						}
						else
						{
							?>
							<td height="20" bgcolor="<?=$obj->color?>" align="center" valign="middle" title = "<?=makeDate($obj->fecha)?>. <?=$obj->estado?>"></td>
							<?
						}
					}
					else
					{
						if($obj->hora == '07 - 08' || $obj->hora == '10 - 11' || $obj->hora == '14 - 15' || $obj->hora == '18 - 19')
						{
							$rs1 = db_query("select * from reserva where id_sala = '$obj->id_sala' and fecha_reserva = '$obj->fecha' and hora_inicio like '".substr($obj->hora, 0, 2)."%' and estado = 'activo' ");
							$obj1 = pg_fetch_object($rs1);
							?>
							<td height="20" bgcolor="<?=$obj->color?>" align="center" valign="middle" title="<?=makeDate($obj->fecha)?>. <?=$obj->estado?>">
							<? if ($id_sala != 'auditorio') {?>
								<a href="<?=makeURL("editar.php?indice=$obj1->indice")?>">
							<? } ?>
							<font color="#FFFFFF"><b><?=$obj1->asignatura?></b></font></a>
							</td>
							<?
						}
						else
						{
							$rs1 = db_query("select * from reserva where id_sala = '$obj->id_sala' and fecha_reserva = '$obj->fecha' and hora_inicio <= '".substr($obj->hora, 0, 2).":00:00' and hora_termino >= '".substr($obj->hora, 0, 2).":00:00' and estado = 'activo'");
							$obj1 = pg_fetch_object($rs1);
							if($obj->hora == '08 - 09' || $obj->hora == '11 - 12' || $obj->hora == '15 - 16' || $obj->hora == '19 - 20')
							{
								?>
								<td height="20" bgcolor="<?=$obj->color?>" align="center" valign="middle" title="<?=makeDate($obj->fecha)?>. <?=$obj->estado?>">
								<font color="#FFFFFF"><?=$obj1->plan?></font>
								</td>
								<?
							}
							if($obj->hora == '09 - 10' || $obj->hora == '12 - 13' || $obj->hora == '16 - 17' || $obj->hora == '20 - 21')
							{
								
									?>
									<td height="20" bgcolor="<?=$obj->color?>" align="center" valign="middle" title="<?=makeDate($obj->fecha)?>. <?=$obj->estado?>">
									<font color="#FFFFFF"><?=$obj1->docente?></font>
									</td>
									<?
								
							}
						}
					
					}	
				}	
				$tmp++;
				if($tmp % $num_dias == 0) echo "</tr><tr>";
				
			}
			?>
			<td></td>
			</tr>
			<tr><td colspan="8"><br></td></tr>
			<tr>
				<td align="center" colspan="8">
				<table border="0" width="70%" align="center">
				<tr><td align="center" colspan="5" class="titulosContenidoInterno">Convenciones:</td></tr>
				<? if($_GET['sala'] != 'auditorio')
				{
				?>
				<tr>
					<td width="18%"></td>
					<td width="9%" bgcolor="#FF6666"></td>
					<td width="5%" align="center"><b>:</b></td>
					<td width="50%">Clase Inform&aacute;tica</td>
					<td width="18%"></td>
				</tr>
				<tr>
					<td></td>
					<td bgcolor="#FFCC66"></td>
					<td align="center"><b>:</b></td>
					<td>Clase &Uacute;nica</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td bgcolor="#006699"></td>
					<td align="center"><b>:</b></td>
					<td>Taller</td>
					<td></td>
				</tr>
				<?
				if($_SESSION['profesor']['permisos'] == 'total')
				{
				?>
					<tr>
						<td></td>
						<td bgcolor="#99CC00"></td>
						<td align="center"><b>:</b></td>
						<td>Clase Posgrado</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td bgcolor="#FF8000"></td>
						<td align="center"><b>:</b></td>
						<td>Clase Diplomado</td>
						<td></td>
					</tr>
				<?
				}
				?>
				<tr>
						<td></td>
						<td  bgcolor="#b97bc4"></td>
						<td align="center"><b>:</b></td>
						<td>Practica dirigida</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td bgcolor="#3399CC"></td>
						<td align="center"><b>:</b></td>
						<td>Capacitaci&oacute;n</td>
						<td></td>
					</tr>
					<? 
					}
					else
					{
					?>
					<tr>
					<td width="18%"></td>
						<td width="9%" bgcolor="#FF6666"></td>
						<td width="5%" align="center"><b>:</b></td>
						<td width="50%">Video Conferencia</td>
					<td width="18%"></td>
					</tr>
					<tr>
						<td></td>
						<td bgcolor="#FFCC66"></td>
						<td align="center"><b>:</b></td>
						<td>Charla</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td bgcolor="#006699"></td>
						<td align="center"><b>:</b></td>
						<td>Foro</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td bgcolor="#99CC00"></td>
						<td align="center"><b>:</b></td>
						<td>Cine Foro</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td bgcolor="#FF8000"></td>
						<td align="center"><b>:</b></td>
						<td>Pelicula</td>
						<td></td>
					</tr>
								
					<?
					}
					?>
				</table>
				</td>
			</tr>
			</table>
		</form>
		<?
	}	
	PageEnd();
?>