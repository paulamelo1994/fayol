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
	A&ntilde;o: 2006
	*********************************************************/
	
	session_start();

	if(!isset($_SESSION['monitor']))
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/control.php");
		die();
	}

	$rootPath = '../../..';
	require '../../../functions.php';	
	
	date_default_timezone_set('GMT-4'); //Establece zona horaria, evita desfaces
	
	$_GET['submenu_control'] = true;
	PageInit("Reportes Detalles Sesi&oacute;n ", "menu.php");

	$sala = $_SESSION['idsala'];
	if( $sala == 'auditorio')
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/salir.php");
	}


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
		location.href="estadisticas.php";
		</script>
		<?
		die();
	}
	

	
	//para cerrar sesion despues de cierto tiempo
	$fechaGuardada = $_SESSION['ultimoAcceso'];
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
	
	if($tiempo_transcurrido >= 900 and getIP() != IP_ANGELA)
	{
		session_destroy();
		//header("Location: control.php");
	}
	else
	{
		//Formulario dnd se selccionana el semestre para ve la estadistica		
		if(!isset($_POST['estadistica']))
		{
			?>
			<h1 class="shiny">Estadistica de Uso</h1>
			<h3>Seleccione el semestre y a&ntilde;o para ve la estadistica de uso:</h3>	
	
			<form name="reportes" enctype="multipart/form-data" method="post" action="estadisticas.php">
			<table width="80%" border="0" align="center">
			<tr>
				<td width="30%" class="titulosContenidoInterno">Fecha</td>
				<td><?=MakeDate($fecha)?></td>
			</tr>
			<tr><td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td  width="30%" class="titulosContenidoInterno">Semestre</td>
				<td>
				<select name="semestre" title="Semestre">
				<option>&nbsp;</option>
				<option selected <? if($_POST['semestre'] == '1') echo "selected"; ?>>Primer Semestre</option>
				<option <? if($_POST['semestre'] == '2') echo "selected"; ?>>Segundo Semestre</option>
				</select>
			    </td>
			</tr>	
			<tr><td colspan="2"><br></td></tr>	
			<tr>
				<td width="30%" class="titulosContenidoInterno">A&ntilde;o</td>		
				<td><input type="text" name="agno" value="<?=date('Y')?>" size="15">			     
				   </td>
			</tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td colspan="2">
				<input type="submit" name="estadistica" value="Estadistica">&nbsp;&nbsp;&nbsp;
				<input type="submit" name="cancelar" value="Cancelar">
				</td>
			</tr>
			</table>
			</form>
			<?
		}
		//Para generar reporte	
		else
		{
			
			if($_POST['semestre'] == "Primer Semestre")
			{
				$fechadesde = $_POST['agno'].'-01-01';
				$fechahasta = $_POST['agno'].'-06-30';
				$selectSemestre = 'Enero - Junio '.$_POST['agno'];
				
			}
			else if($_POST['semestre'] == "Segundo Semestre")
			{
				$fechadesde = $_POST['agno'].'-07-01';
				$fechahasta = $_POST['agno'].'-12-31';
				$selectSemestre = 'Julio - Diciembre del '.$_POST['agno'];
			}
			else
			{
				$_GET['vacios'] = true;
			}

			if(!$_GET['vacios'])
			{
			
				$conexion = DBConnect('controlsalas');
				if(!$conexion)
					echo "<h2>No se logr&oacute; la conexi&oacute;n con la base de datos.</h2>";
				else
				{
					?>
					<h1 class="shiny">Estadisticas de uso</h1>
					<br><br>
					<h2 class="shuny">Periodo <?=$selectSemestre?> </h2><br><br>
					<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" class="titulosContenidoInterno" width="35%">Total sesiones registradas:</td>
						<td width="25%">
						<?
						$rs = db_query("select count(*) from registro where sala = '$sala' and fecha >= '$fechadesde' and fecha <= '$fechahasta'");
						$obj = pg_fetch_object($rs);
						echo $obj->count;
						?>
						</td>
					</tr>
					<tr><td colspan="2"><br><br></td></tr>
					<tr>
						<td valign="top" class="titulosContenidoInterno">Total usuarios:</td>
						<td>
						<?
						$rs = db_query("select count(distinct codigoestudiante) from registro where sala = '$sala' and fecha >= '$fechadesde' and fecha <= '$fechahasta'");
						$obj = pg_fetch_object($rs);
						echo $obj->count;
						?>
						</td>
					</tr>
					<tr><td colspan="2"><br><br></td></tr>
					<tr>
						<td valign="top" class="titulosContenidoInterno">Total planes:</td>
						<td>
						<?
						$rs = db_query("select count(distinct plan) from registro where sala = '$sala' and fecha >= '$fechadesde' and fecha <= '$fechahasta'");
						$obj = pg_fetch_object($rs);
						echo $obj->count;
						?>
					  </td>
					<tr>
						<td>
						<?
						echo "<br><br><b>Estudiantes por plan:</b><br><br>";
						$rs = db_query(" SELECT plan, count(distinct codigoestudiante) as total from registro where sala = '$sala' and fecha >= '$fechadesde' and fecha <= '$fechahasta' group by plan order by plan");
						?>	
						</td>
								  
					</tr>
					</table>
					
								<table width="36%" align="center" border="1" cellpadding="0" cellspacing="0">
					  <tr>
						<th>Plan</th>
						<th>Total estudiantes</th>
					  </tr>
					  <?
						while($obj = pg_fetch_object($rs))
						{
							?>
					  <tr>
						<td class="titulosContenidoInternoCentrado"><?=$obj->plan?></td>
						<td align="center"><?=$obj->total?></td>
					  </tr>
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
				<form  name="estadistica" method="post"  action="estadisticas.php">
				<input type="submit" name="volver" value="Volver">
				</form>
			</div>
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
