<?
	/********************************************************
	Aplicacion: Control Salas
	Archivo: estadisticas.php
	Objetivo: Modulo mediante el cual se listan las estadisticas de una sala. 
	Autor: Angela Benavides
	Año: 2007
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
	$fecha = date(Y)."-".date(m)."-".date(d);
	
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
			$rs = db_query("select * from registro where sala = $sala and fecha >= '$iniciomes' and fecha <= '$finmes' order by sala, fecha, equipo");
			
			fwrite($file, "Elaborado el... ".$fecha."\n");
			fwrite($file, "Mes: ".makeDate($iniciomes)." al ".makeDate($finmes)."\n");
			fwrite($file, "CODIGO | USUARIO | PLAN | FECHA REGISTRO | HORA INGRESO | HORA SALIDA | SALA | No. EQUIPO | TIPO USO\n\n");
			
			while($obj = pg_fetch_object($rs))
			{
				$codigoestudiante = $obj->codigoestudiante;
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
	
	$fechadesde = "2008-01-01";
	$fechahasta = "2008-07-31" ;
	
	if($tiempo_transcurrido >= 900 )
	{
		session_destroy();
		header("Location: control.php");
	}
	
	else
	{
	
		PageInit("Estadisticas Sala $sala", "../../menu.php");
		
		$conexion = DBConnect('controlsalas');
		if(!$conexion)
			echo "<h2>No se logró la conexión con la base de datos.</h2>";
		else
		{
			?>
			<h1 class="shiny">Estadisticas de uso</h1>
			<br><br>
			<h2 class="shuny">Periodo Enero - Julio del 2008 </h2><br><br>
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

	PageEnd();
?>

			