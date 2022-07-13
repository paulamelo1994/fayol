<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: calendarioMensual.php
	Objetivo: Este archivo muestra el horario de las salas, las horas libres y las reservadas. Segun la opcion 
			  indicada en la variable $_GET['opcion'], se redirecciona a el calendario semanal: reserva, reservar o cancelar.
	Autor: Oliver Felipe Idarraga
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
	
	if((!isset($_SESSION['adminSalas'])) && ($opcion != 1)){
		header("Location: /Comunidad/Informatica/AsignacionSalasNew/Formularios/ingresar.php");
		die();
	}
	
	$root_path = "../../..";
	require '../../../functions.php';
		
	
	//Variables usadas en todos los casos
	$num_dias = 7;
	
	//Disponibilidad por mes
		if(isset($_GET['atras']))
			$fecha = pg_escape_string($_GET['fecham']);
		else if(isset($_GET['siguiente']))
			$fecha = pg_escape_string($_GET['fecham']);
		else
			$fecha = date('Y')."-".date('m')."-".date('d');
			
		if(isset($_POST['sala']))
			$id_sala = pg_escape_string($_POST['sala']);
		else if($_GET['sala'])
			$id_sala = pg_escape_string($_GET['sala']);
		else
			$id_sala = '1';
		
	if((!isset($_SESSION['adminSalas'])) && ($opcion == 1)){
		PageInit("Horario : Sala $id_sala", "../../menu.php");
	}else{
		PageInit("Horario : Sala $id_sala", "menu.php");
	}
	
		$mes_anterior = pg_escape_string(monthTransform($fecha, 'before'));
		$mes_siguiente = pg_escape_string(monthTransform($fecha, 'next'));
	
		$dias_mes = cal_days_in_month ( CAL_GREGORIAN, intval(splitDate($fecha, 'month')), intval(splitDate($fecha, 'year')));
		$dia_inicio = date("l", mktime(0, 0, 0, splitDate($fecha, 'month'), 1, splitDate($fecha, 'year')));
	
		DBConnect('controlsalas');
                $consulta="delete from horario_salas where estado='Disponible'";
                db_query($consulta);
		$consulta = "SELECT distinct on (fecha) * from horario_salas where id_sala = '$id_sala' and fecha between '".splitDate($fecha, 'year')."-".splitDate($fecha, 'month')."-01'and '".splitDate($fecha, 'year')."-".splitDate($fecha, 'month')."-".$dias_mes."';";
                //echo $consulta;
	
		$rs = db_query($consulta);
			
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
		
		$titulo=tituloHorario($opcion);
		
		
			
		?>
		<!-- Horario -->
		<style type="text/css">
			<!--
			.Estilo1 {
				font-size: 18px;
				color: #CC0000;
				font-weight: bold;
				font-family: Georgia, "Times New Roman", Times, serif;
			}
			-->
        </style>
        <table width="70%" border="0" align="center" cellpadding="1">
			<tr>
				<td align="center" colspan="7">
					<BR>
						<h1 class="shiny"><? echo $titulo.' Sala: '; ?>
						<SELECT ONCHANGE="location = this.options[this.selectedIndex].value;">
                        <OPTION VALUE="calendarioMensual.php?opcion=<? echo $opcion;?>&sala=1" <? if($id_sala=='1'){echo "selected";}?> >1
                        <OPTION VALUE="calendarioMensual.php?opcion=<? echo $opcion;?>&sala=2" <? if($id_sala=='2'){echo "selected";}?>>2
                        <OPTION VALUE="calendarioMensual.php?opcion=<? echo $opcion;?>&sala=3" <? if($id_sala=='3'){echo "selected";}?>>3
                        <OPTION VALUE="calendarioMensual.php?opcion=<? echo $opcion;?>&sala=4" <? if($id_sala=='4'){echo "selected";}?>>4
                        <OPTION VALUE="calendarioMensual.php?opcion=<? echo $opcion;?>&sala=Idiomas" <? if($id_sala=='Idiomas'){echo "selected";}?>>Idiomas
                        <OPTION VALUE="calendarioMensual.php?opcion=<? echo $opcion;?>&sala=CUSE" <? if($id_sala=='CUSE'){echo "selected";}?>>CUSE
                   		</SELECT></h1>
						<BR>
				</td>
			</tr>
			<tr><td colspan="8"><br></td></tr>
			<tr>
				<td colspan="7" bgcolor="#FFFFFF" height="10px"><div align="left" style="float:left; padding-left:10px; padding-top:5px; "><a href="calendarioMensual.php?atras=1&fecham=<? echo $mes_anterior; ?>&opcion=<? echo $opcion; ?>&sala=<? echo $id_sala;?>" ><img src="../../../Images/iconosSalas/boton_atras_sin_sombra.png" ></a></div>
																<div align="center" style="float:left; padding-left:95px; "><h2><?=makeMonth($fecha);?></h2></div>
																<div align="right" style="float:right; padding-right:10px; padding-top:5px; "><a href="calendarioMensual.php?siguiente=1&fecham=<? echo $mes_siguiente; ?>&opcion=<? echo $opcion; ?>&sala=<? echo $id_sala;?>"><img src="../../../Images/iconosSalas/boton_siguiente_sin_sombra.png" ></a></div>
																	
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
                                
                                $consulta = "select count(id_sala) as cantidad, fecha from horario_salas where id_sala='$id_sala' and estado!='disponible' and fecha between '".  substr($fecha, 0, 7)."-01'and '".  substr($fecha, 0, 7)."-".$dias_mes."' group by fecha order by fecha asc";
                                
                                $rs=db_Query($consulta);
                                $obj = pg_fetch_object($rs);
                                
				for($diap=1; $diap<=$dias_mes; $diap++)
				{
                                    if($diap<10)
                                        $dia='0'.$diap;
                                    else
                                        $dia=$diap;
                                    
                                    if(pg_num_rows($rs)!=0)
                                    {
                                        if(($obj->fecha) == substr($fecha, 0, 8).$dia)
                                        {
                                            $cantidad=15-$obj->cantidad;
                                            $fecha = substr($fecha, 0, 7)."-".$dia;
                                            $obj=pg_fetch_object($rs);
                                        }
                                        else
                                        {
                                            $cantidad=15;
                                            $fecha = substr($fecha, 0, 7)."-".$dia;
                                        }
                                    }
                                    else
                                    {
                                        $cantidad=15;
                                        $fecha = substr($fecha, 0, 7)."-".$dia;
                                    }
					if($cantidad==15)
					{
						?>
						<td bgcolor="#FFFFFF" height="50" align="center" valign="middle" title="Disponible" style="border:1px; border-color:#AAAAAA; ">
						  
									<a href="calendReserva.php?sala=<? echo $id_sala;?>&opcion=<? echo $opcion; ?>&fecha=<?=$fecha?>" class="dayOn">
									<font color="#000000"><?=splitDate($fecha, 'day')?></font>
									</a> 						
						</td>
						<?
					}
					if($cantidad==0)
					{
						?>
						<td bgcolor="#FFFFFF" height="50" align="center" valign="middle" class="dayOff" title="No Disponible"  style="border:1px; border-color:#AAAAAA; ">
						 
									<a href="calendReserva.php?sala=<? echo $id_sala;?>&opcion=<? echo $opcion;?>&fecha=<?=$fecha?>" class="dayOn">
									<font color="#e04e4f"><?=splitDate($fecha, 'day')?></font>
									</a>
						</td>
						<?
					}
					if(($cantidad > 0)&&($cantidad < 15))
					{
						?>
						<td bgcolor="#FFFFFF" height="50" align="center" valign="middle" title="Parcialmente Disponible"  style=" border:1px; border-color:#AAAAAA; ">
						
							<a href="calendReserva.php?sala=<? echo $id_sala;?>&opcion=<? echo $opcion;?>&fecha=<?=$fecha?>" class="dayOn">
							<font color="#0099CC"><? echo $dia ?></font>
							</a>
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
		
		<!-- Convenciones -->
		<br>
		<table width="70%" align="center" border="0" cellspacing="1">
			<tr>
				<td align="center">
					<table border="0" width="70%" align="center">
						<tr>
							<td align="center" colspan="5" class="titulosContenidoInterno">Convenciones:</td>
						</tr>
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
		

