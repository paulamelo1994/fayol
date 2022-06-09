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
	
	$sala = $_SESSION['idsala'];
	if( $sala == 'auditorio')
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/salir.php");
	}
	
	$fecha = date(Y)."-".date(m)."-".date(d);
	
	if($_GET['atras'])
	{
		$ant = $_GET['atras'];
		$fecha = monthTransForm($ant, 'before');
	}
	
	if($_GET['adelante'])
	{
		$ant = $_GET['adelante'];
		$fecha = monthTransform($ant, 'next');
	}
	
	if($_GET['txt'])
	{
		$sala = $_SESSION['idsala'];
		$fechareporte =  $_GET['txt'];
		$nombre_archivo = "reportes/reporteSala".$sala."_$fecha.txt";
		$file = fopen($nombre_archivo, "a");
		
		$conexion = DBConnect('controlsalas');
		
		if(!$conexion)
			echo("<td colspan=\"2\">ha ocurrido un error al cargar desde la BD.</td>");
		else
		{
			$iniciomes = startMonth($fechareporte);
			$finmes = endMonth($fechareporte);
			$rs = db_query("select * from registro where sala = '$sala' and fecha >= '$iniciomes' and fecha <= '$finmes' order by sala, fecha, equipo");
			
			fwrite($file, "Elaborado el... ".$fecha."\n");
			fwrite($file, "Mes: ".makeDate($iniciomes)." al ".makeDate($finmes)."\n");
			fwrite($file, "CODIGO | USUARIO | PLAN | FECHA REGISTRO | HORA INGRESO | HORA SALIDA | SALA | No. EQUIPO | TIPO USO\n\n");
			
			
			while($obj = pg_fetch_object($rs))
			{
				$codigoestudiante = pg_escape_string($obj->codigoestudiante);
				$rs1 = db_query("select * from estudiantes where codigo = '$codigoestudiante'");
				$obj1 = pg_fetch_object($rs1);
				$usuario = $obj1->nombres." ".$obj1->apellidos;
				$plan = $obj->plan;
				$fechar = $obj->fecha;
				$horaingr = $obj->horaing;
				$horasalr = $obj->horasal;
				$salar = $obj->sala;
				$equipo = $obj->equipo;
				$tipouso = $obj->tipouso;
				
				fwrite($file, "$codigoestudiante | $usuario | $plan | $fechar | $horaingr | $horasalr | $salar | $equipo | $tipouso\n");
				
				
			}
			fwrite($file, "\n\n");
			fclose($file);
			
			?>
			<script language="javascript">
			window.open("reportes/reporteSala<?=$sala?>_<?=$fecha?>.txt");
			</script>
			<?
		}
	}
	
	$fechaGuardada = $_SESSION['ultimoAcceso'];
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
	
	 if($tiempo_transcurrido >= 900 and getIP() != IP_ANGELA)
	 {
		session_destroy();
		header("Location: control.php");
	}
	else
	{

		PageInit("Reportes Sala $sala", "../../menu.php");
		?>
		<h1 class="shiny">Reportes</h1>
		<form method="get" name="Reportes" action="reportes.php">
		<table width="800" align="center" border="1" cellspacing="0" cellpadding="2">
		<tr>
			<td colspan="9" width="100%">
			<table width="84%">
			<tr>
				<td width="25%" align="left">
				<button type="submit" name="atras" title="Mes Anterior" value="<?=$fecha?>">
				<img src="../../../Images/atras.jpg" width="15" height="15" title="Mes Anterior" alt=""></button>
				</td>
				<td width="50%" align="center"><?=makeMonth($fecha);?></td>
				<td width="25%" align="right">
				<button type="submit" name="adelante" title="Mes Siguiente" value="<?=$fecha?>">
				<img src="../../../Images/adelante.png" width="15" height="15" title="Mes Siguiente" alt=""></button>
				</td>
			</tr>
			<td colspan="9" width="100%">

			<tr>
				<td width="24%" align="right" >
				<button type="submit" name="atrasDia" title="Mes Anterior" value="<?=$fecha?>">
				<div align="right"><img src="../../../Images/atras.jpg" width="15" height="15" title="Mes Anterior" alt=""></div>
				</button>
				</td>
				<td width="51%" align="center"><?=makeDate($fecha);?></td>
				<td width="25%" align="left">
				<button type="submit" name="adelanteDia" title="Mes Siguiente" value="<?=$fecha?>">
				<div align="left"><img src="../../../Images/adelante.png" width="15" height="15" title="Mes Siguiente" alt=""></div>
				</button>
				</td>
			</tr>
			</table>
			</td>
		</tr>
		<tr><td colspan="9"><br></td></tr>
		<tr>
			<th width="7%">Codigo Estudiante</th>
			<!--<th width="40%">Usuario</th>-->
			<th width="5%">Plan</th>
			<th width="11%">Fecha</th>
			<th width="9%">Hora Ingreso</th>
			<th width="9%">Hora Salida</th>
			<th width="4%">Sala</th>
			<th width="7%">Equipo</th>
			<th width="18%">Tipo Uso</th>
		</tr>
		<?
		$conexion = DBConnect('controlsalas');
		
		if(!$conexion)
			echo("<td colspan=\"2\">ha ocurrido un error al cargar desde la BD.</td>");
		else
		{
			$iniciomes = pg_escape_string(startMonth($fecha));
			$finmes = pg_escape_string(endMonth($fecha));
			$rs = db_query("select * from registro where sala = '$sala' and fecha >= '$iniciomes' and fecha <= '$finmes' order by sala, fecha DESC, equipo ");
			while($obj = pg_fetch_object($rs))
			{
				$codigoestudiante = pg_escape_string($obj->codigoestudiante);
				$rs1 = db_query("select * from estudiantes where codigo = '$codigoestudiante'");
				$obj1 = pg_fetch_object($rs1);
				$usuario = $obj1->nombres." ".$obj1->apellidos;
				$plan = $obj->plan;
				$fecha = $obj->fecha;
				$hora_ing = $obj->horaing;
				$hora_sal = $obj->horarealsal;
				$salar = $obj->sala;
				$equipo = $obj->equipo;
				$tipouso = $obj->tipouso;
				?>
				<tr>
					<td class="normal" align="center" valign="middle"><?=$codigoestudiante?></td>
					<!--<td class="normal" align="left" valign="middle">< ?=$usuario?></td>-->
					<td class="normal" align="center" valign="middle"><?=$plan?></td>
					<td class="normal" align="center" valign="middle"><?=$fecha?></td>
					<td class="normal" align="center" valign="middle"><?=$hora_ing?></td>
					<td class="normal" align="center" valign="middle"><?= $hora_sal ?></td>
					<td class="normal" align="center" valign="middle"><?=$salar?></td>
					<td class="normal" align="center" valign="middle"><?=$equipo?></td>
					<td class="normal" align="center" valign="middle"><?=$tipouso?></td>
				</tr>
				<?
			}
		}
		?>
		</table>
		<br><br><br>
		<div align="right">
			<button type="submit" name="txt" title="Escribir archivo" value="<?=$fecha?>">
			<img src="../../../Images/escribir.jpg" width="15" height="15" title="Escribir archivo" alt=""></button>
		</div>
	</form>
	<?
}

	PageEnd();
?>
