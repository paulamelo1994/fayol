<?
	/********************************************************
	Aplicacion: Control Salas
	Archivo: reportes.php
	Objetivo: Modulo mediante el cual se listan todos los registros del mes de una sala. Se lista:
				- Codigo Estudiante
				- Usuario
				- Plan
				- Fecha
				- Sala
				- Equipo
				- Tipo de uso
				
				Permite que se vean los registros de los meses anteriores y sucesores.
	Autor: Angela Benavides
	Año: 2006
	*********************************************************/
	
	session_start();

	if(!isset($_SESSION['monitor']))
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/control.php");
		die();
	}

	$rootPath = '../../..';
	require '../../../functions.php';
	
	$_GET['submenu_control'] = true;
	PageInit("Reportes Detalles Sesi&oacute;n ", "../../menu.php");

	$sala = $_SESSION['idsala'];

	$fecha = date('Y')."-".date('m')."-".date('d');
	
	$fechaInicio = $_POST['fechaInicio'];
	if(empty ($fechaInicio))
	{
		$fechaInicio = date('Y')."-".date('m')."-".date('d');
	}
	
	$fechaFin = $_POST['fechaFin'];	
	if(empty ($fechaFin))
	{
		$fechaFin = date('Y')."-".date('m')."-".date('d');
	}

	if(isset($_POST['volver']))
	{
		?>
		<script language="javascript">
		location.href="reportesPorUsuario.php";
		</script>
		<?
		die();
	}
	
	//Para generar reporte	
	if(isset($_POST['generarReporte']))
	{
		if($_POST['tipoReporte']=='Todos')
		{
			$conexion = DBConnect('controlsalas');
			
			if(!$conexion)
				echo("<td colspan=\"2\">ha ocurrido un error al cargar desde la BD.</td>");
			else
			{			
			?>
			    <h2>Reporte Sobre el Tiempo de Uso de Todos los Usuarios para la Sala <?=$sala?> </h2>			
			<?
				$rs = db_query("select sum(horarealsal-horaing) as horasUso,codigoestudiante from registro where fecha>='$fechaInicio' and fecha<='$fechaFin' and sala='$sala' group by codigoestudiante order by codigoestudiante");
				
				
				if(pg_num_rows($rs) == 0) //No hay registros en el catalogo
				{
					echo "<h3>Del ".MakeDate($fechaInicio)." al ".MakeDate($fechaFin)." no se realizo ninguna practica en la sala.</h3>";
				}
				else
				{								
					if (isset($_POST['txt']))
					{
						$nombre_archivo = "reportes/reporteTiempoUso_Sala".$sala."_$fecha.txt";
						$file = fopen($nombre_archivo, "a") or die("Can't open file"); 			

						fwrite($file, "Elaborado el... ".MakeDate($fecha)."\n");
						fwrite($file, "Mes: ".makeDate($iniciomes)." al ".makeDate($finmes)."\n");
						fwrite($file, "CODIGO | USUARIO | PLAN |  TIEMPO DE USO\n\n");
					}
					?>
						<P>
							<b>Elaborado el... <?=MakeDate($fecha)?> </b><br>
							Del <?=makeDate($fechaInicio)?> al <?=makeDate($fechaFin)?>
						</p>
						
						<div align="right">
							<form  name="reporte1" method="post"  action="reportesPorUsuario.php">
								<input type="hidden" name="tipoReporte" value="Todos">
									<input type="hidden" name="fechaInicio" value="<?=$fechaInicio?>">
								<input type="hidden" name="fechaFin" value="<?=$fechaFin?>">
								<input type="hidden" name="generarReporte" value="generarReporte">
								<button type="submit" name="txt" title="Escribir archivo" value="<?=$fecha?>">
								<img src="../../../Images/escribir.jpg" width="15" height="15" title="Escribir archivo" alt=""></button>
							</form>
						</div>
						<br>
						<table width="100%" align="center" border="1" cellspacing="0" cellpadding="2">
						<tr>
							<th width="7%">Codigo Estudiante</th>
							<th width="40%">Usuario</th>
							<th width="5%">Plan</th>
							<th width="18%">Horas de Trabajo</th>
						</tr>				
					<?										
					while($obj = pg_fetch_object($rs))
					{
						$codigoestudiante = pg_escape_string($obj->codigoestudiante);
						$rs1 = db_query("select nombres, apellidos, codigo, codplan from estudiantes where codigo = '$codigoestudiante'");						
						$obj1 = pg_fetch_object($rs1);
						$usuario = pg_escape_string($obj1->nombres." ".$obj1->apellidos);
						$usuario = ucwords(strtolower($usuario));
						$plan = pg_escape_string($obj1->codplan);
						$horasUso = pg_escape_string($obj->horasuso);
						
						
						
						$rs1 = db_query("select count(codigo) from estudiantes where codigo = '$codigoestudiante'");						
						$obj1 = pg_fetch_object($rs1);
						
						
						$rs3 = db_query("select count(codigo) from estudiantes where codigo = '$codigoestudiante'");						
						$obj3 = pg_fetch_object($rs3);
						
						if($horasUso<0)
						{
							$rs2 = db_query("select sum(horasal-horaing) as horasUso from registro where fecha>='$fechaInicio' and fecha<='$fechaFin' and sala='$sala' and codigoestudiante = '$codigoestudiante'");
							$obj2 = pg_fetch_object($rs2);
							$horasUso = pg_escape_string($obj2->horasuso);
						}
						if(empty($horasUso))
						{
							$horasUso="----";
						}
						
						if (isset($_POST['txt']))
						{			
							fwrite($file, "$codigoestudiante | $usuario | $plan | $horasUso\n");
						}

						?>
						<tr>
							<td class="normal" align="center" valign="middle"><?=$codigoestudiante?></td>
							<td class="normal" align="left" valign="middle"><?=$usuario?></td>
							<td class="normal" align="center" valign="middle"><?=$plan?></td>
							<td class="normal" align="center" valign="middle"><?=$horasUso?></td>
						</tr>
						<?					
					}
					$rs7 = db_query("select count(distinct codigoestudiante)as cant from registro where sala = '$sala' and fecha >= '$fechaInicio' and fecha <= '$fechaFin'");
					
					$obj7 = pg_fetch_object($rs7);
					$totalEstu = pg_escape_string($obj7->cant);
					?>
					<tr>
						<td colspan="3" align="right">Total de Estudiantes: </td><td align="center"><?=$totalEstu?></td>
						
					</tr>
					<?
					if (isset($_POST['txt']))
					{	
						fwrite($file, "\n\n");
						fclose($file);
						
						?>
						<script language="javascript">
						window.open("<?=$nombre_archivo?>");
						</script>
						<?
					}
					?>					
						</table>					
					<?						
				}
			}
		?>
			<br />
			<div align="center">
				<form  name="reporte2" method="post"  action="reportesPorUsuario.php">
				<input type="submit" name="volver" value="Volver">
				</form>
			</div>
		<?	
		}
		
		else if($_POST['tipoReporte']=='Codigo')
		{
			$codigo =  pg_escape_string($_POST['codEstudiante']);
			if(empty($codigo) || strlen($codigo)!=7)
			{
				$_GET['vacios'] = true;
			}				
			else
			{
				$conexion = DBConnect('controlsalas');
				
				if(!$conexion)
					echo("<td colspan=\"2\">ha ocurrido un error al cargar desde la BD.</td>");
				else
				{			
				?>
					<h2>Reporte Sobre el Tiempo de Uso de por Usuario para la Sala <?=$sala?> </h2>
					<p>
						Elaborado el... <?=MakeDate($fecha)?>.<br>
						Reporte del <?=MakeDate($fechaInicio)?> al <?=MakeDate($fechaFin)?>.<br><br>		
					<?
						$rs = db_query("select nombres, apellidos, codigo, codplan from estudiantes where codigo = '$codigo'");
						$obj = pg_fetch_object($rs);
						
						$usuario = $obj->nombres." ".$obj->apellidos;
						$usuario = ucwords(strtolower($usuario));
						$plan = $obj->codplan;					
					?>				
						<b>C&oacute;digo Estudiante:</b> <?=$codigo?> <br>
						<b>Estudiante:</b>  <?=$usuario?> <br>
						<b>Plan:</b>  <?=$plan?> <br>					
					</p>					
				<?					
					$rs1 = db_query("select indice,fecha, tipoUso, (horarealsal-horaing) as horasUso from registro where codigoestudiante='$codigo' and fecha>='$fechaInicio' and fecha<='$fechaFin' and sala='$sala' order by fecha");
					
					if(pg_num_rows($rs1) == 0) //No hay registros en el catalogo
					{
						echo "<h3> Del ".MakeDate($fechaInicio)." al ".MakeDate($fechaFin)." el estudiante no realizo ninguna practica en la sala.</h3>";
					}
					else
					{				
						?>		
						<table width="70%" align="center" border="1" cellspacing="0" cellpadding="2">
							<tr>
								<th width="11%">Fecha</th>
								<th width="20%">Actividad</th>
								<th width="18%">Horas de Uso</th>
							</tr>		
						<?
						
						$totalHorasUso;
						$primeraFila=true;
						
						while($obj1 = pg_fetch_object($rs1))
						{	
							$horasUso = $obj1->horasuso;
							
							if($horasUso<0)
							{
								$indice = pg_escape_string($obj1->indice);
								$rs2 = db_query("select indice,fecha, tipoUso, (horasal-horaing) as horasUso from registro where indice ='$indice'");
								$obj2 = pg_fetch_object($rs2);
								$horasUso = $obj2->horasuso;
							}
							
							if($primeraFila)
							{
								$totalHorasUso = $horasUso;
								$primeraFila= false;
							}
							else
							{
								$totalHorasUso = timeadd($totalHorasUso,$horasUso);	
							}
							
									
							?>
							<tr>
								<td ><?=$obj1->fecha?></td>
								<td ><?=$obj1->tipouso?></td>
								<td ><?=$horasUso?></td>
							</tr>
							<?
						}
						?>
							<tr>
								<td >&nbsp;</td>
								<td align="right"><b>Total Horas</b></td>
								<td ><?=$totalHorasUso?></td>
							</tr>
						
						</table>
						<?
					}
				}
			}
		?>
			<br />
			<div align="center">
			<form  name="reporte3" method="post"  action="reportesPorUsuario.php">
			<input type="submit" name="volver" value="Volver">
			</form>
			</div>
		<?
		}
	}
	
	//para cerrar sesion despues de cierto tiempo
	$fechaGuardada = $_SESSION['ultimoAcceso'];
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
	
	 if($tiempo_transcurrido >= 900)
	 {
		session_destroy();
		//header("Location: control.php");
	}
	else
	{
		//Formulario dnd se selccionana el tipo de reporte y se dan los valores de entrada		
		if(!isset($_POST['tipoReporte']))
		{
			?>
			<h1 class="shiny">Reportes Por Sesi&oacute;n de Usuario</h1>
			<h3>Seleccione que tipo de reporte desea ver:</h3>	
	
			<form name="reportes" enctype="multipart/form-data" method="post" action="reportesPorUsuario.php">
			<table width="80%" border="0" align="center">
			<tr>
				<td width="30%" class="titulosContenidoInterno">Fecha</td>
				<td><?=MakeDate($fecha)?></td>
			</tr>		
			<tr><td colspan="2"><br></td></tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td  width="30%" class="titulosContenidoInterno">Fecha Inicio</td>
				<td><input type="text" name="fechaInicio" value="<?=$fecha?>" size="15"> (Año-Mes-Dia)</td>
			</tr>	
			<tr><td colspan="2"><br></td></tr>	
			<tr>
				<td width="30%" class="titulosContenidoInterno">Fecha Fin</td>		
				<td><input type="text" name="fechaFin" value="<?=$fecha?>" size="15"> (Año-Mes-Dia)</td>
			</tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">
				<input type="radio" name="tipoReporte" value="Todos" <? if($tipoReporte == 'Todos') echo "checked"; ?>>Todos 
				<br>
				<input type="radio" name="tipoReporte" value="Codigo" <? if($tipoReporte == 'Codigo') echo "checked"; ?>>Codigo
				</td>
				<td><input type="text" name="codEstudiante" value="<?=$codigo?>" size="20">
			</tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td colspan="2">
				<input type="submit" name="generarReporte" value="Generar Reporte">&nbsp;&nbsp;&nbsp;
				<input type="submit" name="cancelar" value="Cancelar">
				</td>
			</tr>
			</table>
			</form>
			<?
		}
	}

	if(isset($_GET['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe ingresar todos los campos antes de generar el reporte. Intente nuevamente.");
		</script>
		<?
	}
	
	PageEnd();
?>
