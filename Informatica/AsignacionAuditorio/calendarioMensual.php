<?
	/********************************************************
	Aplicacion: Asignacion Auditorio
	Archivo: calendarioMensual.php
	Objetivo: Este archivo muestra el horario de el auditorio, las horas libres y las reservadas. Segun la opcion 
			  indicada en la variable $_GET['opcion'], se redirecciona a el calendario semanal: reserva, reservar o cancelar.
	Autor: Andrea Cordoba
	Año: 2011
         * 
         * Modificado: enero 2012
         * Oliver Felipe Idarraga
         * 
         * optimizaciones en el esquema de guardado en la BD, adaptación de la aplicaciíón para funcionamiento con el nuevo esquema
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
	
	$_GET['submenu_asignacion'] = true;
	
	//Variables usadas en todos los casos
	$num_dias = 7;
	
	//Disponibilidad por mes
		if(isset($_GET['atras']))
			$fecha = $_GET['fecham'];
		else if(isset($_GET['siguiente']))
			$fecha = $_GET['fecham'];
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
		    $consulta = "SELECT distinct on (id_sala, fecha) * from horario_auditorio where fecha between '".splitDate($fecha, 'year')."-".splitDate($fecha, 'month')."-01' and  '".splitDate($fecha, 'year')."-".splitDate($fecha, 'month')."-".$dias_mes."';";
	
	
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
					if($j < 10){
						$h="0".$j.":00";
					}else{
						$h=$j.":00";
					}
					$consulta1 = "insert into horario_auditorio (id_sala, fecha, hora, estado, color) values('$id_sala', '$tmp', '$h', 'Disponible', '#FFFFFF')";
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
		
	if(isset($_SESSION['profesor'])){
		PageInit("Disponibilidad del Mes : Auditorio", "menu.php");
	}else{
		PageInit("Disponibilidad del Mes : Auditorio", "../../menu.php");
	}
			
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
						<span class="Estilo1">Disponibilidad Auditorio 
						</span><br>
						<BR><BR>
			  </td>
			</tr>
			<tr>
				
				<td colspan="7" bgcolor="#FFFFFF" height="10px"><div align="left" style="float:left; padding-left:10px; padding-top:5px; "><a href="calendarioMensual.php?atras=1&fecham=<? echo $mes_anterior; ?>&opcion=<? echo $opcion; ?>" ><img src="../../../Images/iconosSalas/boton_atras_sin_sombra.png" ></a></div>
																<div align="center" style="float:left; padding-left:95px; "><h2><?=makeMonth($fecha);?></h2></div>
																<div align="right" style="float:right; padding-right:10px; padding-top:5px; "><a href="calendarioMensual.php?siguiente=1&fecham=<? echo $mes_siguiente; ?>&opcion=<? echo $opcion; ?>" ><img src="../../../Images/iconosSalas/boton_siguiente_sin_sombra.png" ></a></div>
																	
				</td>
			</tr>
			<tr>
				<td colspan="3" height="1px"></td>
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
                                $query="select count(*) as cantidad, fecha from horario_auditorio where fecha between 
                                    '".splitDate($fecha, 'year')."-".splitDate($fecha, 'month')."-01' and '".splitDate($fecha, 'year').
                                        "-".splitDate($fecha, 'month')."-".$dias_mes."' and estado='Disponible' 
                                            group by fecha order by fecha asc";
                                $rs1 = db_query($query);
                                $tmp = 0;
				for($i = 1; $i < $dia_semana; $i++)
				{
					?>
					<td height="50" align="center" valign="middle" bgcolor="#f2f2f2"></td>
					<?
					$tmp ++;
				}
				for($i=1; $i<=$dias_mes; $i++)
				{
					
					$obj1 = pg_fetch_object($rs1);
					if($obj1->cantidad==15)
					{
						?>
						<td bgcolor="#FFFFFF" height="50" align="center" valign="middle" title="Disponible">
						  
									<a href="calendReserva.php?opcion=<? echo $opcion; ?>&fecha=<?=$obj1->fecha?>" class="dayOn">
									<font color="#000000"><?=splitDate($obj1->fecha, 'day')?></font>
									</a> 						
						</td>
						<?
					}
					if($obj1->cantidad==0)
					{
						?>
						<td bgcolor="#FFFFFF" height="50" align="center" valign="middle" class="dayOff" title="No Disponible">
						 
									<a href="calendReserva.php?opcion=<? echo $opcion;?>&fecha=<?=$obj1->fecha?>" class="dayOn">
									<font color="#e04e4f"><?=splitDate($obj1->fecha, 'day')?></font>
									</a>
						</td>
						<?
					}
					if(($obj1->cantidad > 0)&&($obj1->cantidad < 15))
					{
						?>
						<td bgcolor="#FFFFFF" height="50" align="center" valign="middle" title="Parcialmente Disponible">
						
							<a href="calendReserva.php?opcion=<? echo $opcion;?>&fecha=<?=$obj1->fecha?>" class="dayOn">
							<font color="#0099CC"><?=splitDate($obj1->fecha, 'day')?></font>
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
		

