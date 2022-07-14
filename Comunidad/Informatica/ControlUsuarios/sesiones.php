<?
	/********************************************************
	Aplicacion: Control Salas
	Archivo: sesiones.php
	Objetivo: Modulo en el cual se listan las sesiones actuales de una sala.
				- Codigo Estudiante
				- Usuario
				- Numero de Equipo
				- Hora de Inicio de Sesi&oacute;n
				- La hora en que debe salir: Esta la determina el monitor.
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
	
	$sala = pg_escape_string($_SESSION['idsala']);
	if( $sala == 'auditorio')
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/salir.php");
	}
	
	$fechaGuardada =pg_escape_string( $_SESSION['ultimoAcceso']);
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
	
	 if($tiempo_transcurrido >= 900 and getIP() != '192.168.221.63')
	 {
		session_destroy();
		header("Location: control.php");
	}
	
	else
	{

		PageInit("Sesiones Sala $sala", "menu.php");
		?>
		<h1 class="shiny">Sesiones</h1>
		<table width="700" align="center" border="1" cellspacing="0" cellpadding="2">
		<tr>
			<th width="10%">No. Equipo</th>
			<th width="15%">Codigo Estudiante</th>
			<th width="55%">Usuario</th>
			<th width="10%">Hora Inicio</th>
			<th width="10%">Hora Salida</th>
		</tr>
		<?
		$conexion = DBConnect('controlsalas');
		
		if(!$conexion)
			echo("<td colspan=\"2\">ha ocurrido un error al cargar desde la BD.</td>");
		else
		{
			$rs = db_query("select * from registro where sala = '$sala' and sesion = 'En proceso' order by equipo, horasal");
			while($obj = pg_fetch_object($rs))
			{
				$codigoestudiante = pg_escape_string($obj->codigoestudiante);
				$rs1 = db_query("select * from estudiantes where codigo = '$codigoestudiante'");
				$obj1 = pg_fetch_object($rs1);
				$usuario = $obj1->nombres." ".$obj1->apellidos;
				$equipo = $obj->equipo;
				$horaing = $obj->horaing;
				$horasal = $obj->horasal;
				
				?>
					<tr>
						<td class="normal" align="center" valign="middle"><?=$equipo?></td>
						<td class="normal" align="center" valign="middle"><?=$codigoestudiante?></td>
						<td class="normal" align="center" valign="middle"><?=$usuario?></td>
						<td class="normal" align="center" valign="middle"><?=$horaing?></td>
						<td class="normal" align="center" valign="middle"><?=$horasal?></td>
					</tr>
				<?
			}
		}
		?>
		</table>
		<?
	}

	PageEnd();
?>