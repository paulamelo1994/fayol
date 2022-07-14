<?
/********************************************************
	Aplicacion: Asignacion Auditorio
	Archivo: calendReserva.php
	Objetivo: Este archivo muestra el horario semanal de el auditorio, las horas libres y las reservadas.
			  Permite solo visualizacion del calendario
	Autor: Andrea Cordoba
	Año: 2011
	*********************************************************/
	
	session_start();
	
	/*
	 * opcion= 1 (reserva), opcion=2 (reservar), opcion=3 (cancelar)
     */
		
	
	if(!isset($_GET['opcion'])){
			$opcion=1;
	}else{
			$opcion=$_GET['opcion'];
	}
	
	if($opcion!=1){
		if(!isset($_SESSION['profesor']))
		{
			header("Location: /Comunidad/Informatica/AsignacionSalas/index.php");
			die();
		}
	}	
	
	
	$root_path = "../../..";
	require '../../../functions.php';
	if(isset($_SESSION['profesor'])){
		PageInit("Horario : Auditorio", "menu.php");
	}else{
		PageInit("Horario : Auditorio", "../../menu.php");
	}
	
	
	/*
	 * Script para tooltip
	 */
	?>
		
	<script src="<?= $rootPath?>/php-scripts/scripts/jquery.bgiframe.js" type="text/javascript"></script>
	<script src="<?= $rootPath?>/php-scripts/scripts/jquery.dimensions.js" type="text/javascript"></script>
	<script src="<?= $rootPath?>/php-scripts/scripts/jquery.tooltip.js" type="text/javascript"></script>
	<script src="<?= $rootPath?>/php-scripts/scripts/chili-1.7.pack.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function() {
			$('.pretty').tooltip({ 
				track: true, 
				delay: 0, 
				showURL: false, 
				showBody: " - ", 
				extraClass: "pretty", 
				fixPNG: true, 
				opacity: 0.95, 
				left: -100 
			});
			$('.fancy').tooltip({
				track: true,
				delay: 0,
				showURL: false,
				fixPNG: true,
				showBody: " - ",
				extraClass: "pretty fancy",
				top: -15,
				left: 5
			});
		});
	</script>
	<?
	
	
	
	$_GET['submenu_asignacion'] = true;
	
	//Variables usadas en todos los casos
	$num_dias = 7;
	
		if(!isset($_GET['opcion'])){
			$opcion=1;
		}else{
			$opcion=$_GET['opcion'];
		}
		
		if(!isset($_GET['fecha'])){
			$fecha = date('Y')."-".date('m')."-".date('d');
		}else {
			$fecha = $_GET['fecha'];
		}
		
		$dia_tmp = date("l", mktime(0, 0, 0, splitDate($fecha, 'month'), splitDate($fecha, 'day'), splitDate($fecha, 'year')));
		if($dia_tmp != 'Sunday')
			$inicio_semana = date("Y-m-d", strtotime("last Sunday", strtotime($fecha)));
		else
			$inicio_semana = $fecha;
		$fin_semana = dateplus($inicio_semana, 6);
		$nombre_dia = date("l", mktime(0, 0, 0, splitDate($fecha, 'month'), splitDate($fecha, 'day'), splitDate($fecha, 'year')));
		$semana_anterior = date("Y-m-d", strtotime("last $nombre_dia", strtotime($fecha)));
		$semana_siguiente = date("Y-m-d", strtotime("next $nombre_dia", strtotime($fecha)));
		
		
		
		
		
		?>
		
		<form name="horario" method="post" enctype="multipart/form-data" action="">
		 <table align="center" border="0" cellspacing="2" width="100%"> 
			<tr>
				<td>
				<div class="tipReserva">
				<table align="center" border="0" cellspacing="2">
				<tr>
					<td colspan="8" valign="middle" align="left"><a href="calendarioMensual.php?opcion=<? echo $opcion; ?>">
					<img border="1" src="<?=$root_path?>/Images/iconoMes.png" name="volver_mes" title="Volver a modo mes!" width="30" height="30" alt=""></a><h1 class="shiny">Horario Auditorio</h1><br>
					</td>
				</tr>
				<tr>
					<td colspan="8" bgcolor="#FFFFFF" height="10px" style="padding-bottom:5px; ">
                                            <div align="left" style="float:left; padding-left:10px; padding-top:5px; " width="">
                                                <a href="calendReserva.php?opcion=<? echo $opcion; ?>&fecha=<?=$semana_anterior?>">
                                                    <img src="<?=$root_path?>/Images/iconosSalas/boton_atras_sin_sombra.png" name="semana_atras" title="Semana Anterior"  alt="">
                                                </a>
                                            </div>
					    <div align="center" style="float:left; color:#770000; width:300px; margin-left: 45px; margin-top: 5px">
                                                Semana del:<br><?=makeDate($inicio_semana);?><b> - </b><?=makeDate($fin_semana);?>
                                            </div>
                                            <div style="float:right; padding-right:10px; padding-top:5px; ">
                                                <a href="calendReserva.php?opcion=<? echo $opcion; ?>&fecha=<?=$semana_siguiente?>">
                                                    <img src="<?=$root_path?>/Images/iconosSalas/boton_siguiente_sin_sombra.png" name="semana_siguiente" title="Semana Siguiente" alt="">
                                                </a>
                                            </div>
																		
					</td>
				</tr>
				<tr > <td colspan="8"> </td></tr>
				<tr>
					<th width="55" STYLE="background-color:#ffffff;"></th>
					<th width="55" scope="col">DOM</th>
					<th width="55" scope="col">LUN</th>
					<th width="55" scope="col">MAR</th>
					<th width="55" scope="col">MIE</th>
					<th width="55" scope="col">JUE</th>
					<th width="55" scope="col">VIE</th>
					<th width="55" scope="col">SAB</th>
				</tr>
				
				<?
				
				DBConnect('controlsalas');
				$consulta = "SELECT * from horario_auditorio where fecha between '".$inicio_semana."' and '".$fin_semana."' order by hora, fecha ";
				
                                $rs = db_query($consulta);
	
				$aux=0;
				while($obj = pg_fetch_object($rs)){
					if($aux==0){
						$horaI=substr($obj->hora, 0, -6);
						$horaF=(int)$horaI;
						$horas1=$horaF+1;
						if($horas1<10){
							$horas="0".$horas1;
						}else{
							$horas="".$horas1;
						}
						?> <tr>
								<td align="center" height="20" bgcolor="#F0F0F0"> <? echo $horaI."-".$horas; ?></td><?
					}
					
						if($obj->estado == 'No Disponible'){					
							//busco reserva 
							$rs1 = db_query("SELECT * from reserva where id_sala = 'auditorio' and fecha_reserva = '$obj->fecha' and hora_inicio<='$obj->hora'and hora_termino > '$obj->hora' and estado = 'activo'");
							$obj1 = pg_fetch_object($rs1);
									 
							if($obj->hora == $obj1->hora_inicio){ ?>
								<td class="pretty" id="pretty" width="80" bgcolor="<?=$obj->color?>" align="center" valign="middle" title="<? echo makeDate($obj->fecha)." <br> Responsable: ".$obj1->docente." <br><br>".$obj1->asignatura."<br> <br> Hora Inicio: ".substr($obj1->hora_inicio,0,-3)." <br> Hora Finalizacion: ".substr($obj1->hora_termino,0,-3); ?>">
									<? if($opcion==3){?><a href="/Comunidad/Informatica/AsignacionAuditorio/Formularios/cancelar.php?id=<? echo $obj1->indice; ?>">
															<font color="#FFFFFF"><?=$obj1->asignatura?></font>
														</a> <? }else{
														?> <font color="#FFFFFF"><?=$obj1->asignatura?></font><?
														}?>
								</td>
								
								<?
								
							}else{?>							
								<td  height="20" bgcolor="<? echo $obj->color; ?>" valign="middle" title="No Disponible"  align="center"></td> <?
							}
						}else{?>
							<td height="20" bgcolor="<?=$obj->color?>" align="center" valign="middle" title="<?=makeDate($obj->fecha)?>. <?=$obj->estado?>">
							<? if($opcion==2){?><a href="/Comunidad/Informatica/AsignacionAuditorio/Formularios/reservar.php?fecha_sel=<? echo $obj->fecha; ?>&hora=<? echo substr($obj->hora,0,-3); ?>">.</a> <? }?></td><?
						}
					
					$aux=$aux+1;
					if($aux==7){
						?> </tr> <?
						$aux=0;
					}
				}
				
				?>
				<td></td>
				</tr>
				<tr><td colspan="8"><br></td></tr>
				<tr>
				<td align="center" colspan="8">
						<table border="0" width="70%" align="center">
						<tr>
							<td align="center" colspan="5" class="titulosContenidoInterno">Convenciones:</td>
						</tr>
						<tr>
							<td width="18%"></td>
							<td width="9%" bgcolor="#3399CC"></td>
							<td width="5%" align="center"><b>:</b></td>
							<td width="50%">Conferencia</td>
							<td width="18%"></td>
						</tr>
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
					</table>
				</td>
			</tr>
		</table>
		</div>
	  </td>
	  </tr>
	 </table>
	</form>
	
