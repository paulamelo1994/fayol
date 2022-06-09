<?
	/********************************************************
	Aplicacion: Control Salas
	Archivo: estadoEquipos.php
	Objetivo: Modulo que lista los equipos de una sala y su estado:
				- Disponible
				- No Disponible
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
	
	$sala = $_SESSION['idsala'];
	if( $sala == 'auditorio')
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/salir.php");
	}
	
	$fechaGuardada = $_SESSION['ultimoAcceso'];
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
	
	 if($tiempo_transcurrido >= 900 and getIP() != '192.168.221.63')
	 {
		session_destroy();
		header("Location: control.php");
	}
	
	else
	{

		PageInit("Estado Equipos Sala $sala", "menu.php");
		?>
		<h1 class="shiny">Estado Equipos</h1>
		<table width="70%" align="center" border="1" cellspacing="0" cellpadding="2">
		<tr>
			<th align="center" width="50%">No. Equipo</th>
			<th width="50%">Estado</th>
		</tr>
		<?
		$conexion = DBConnect('controlsalas');
		
		if(!$conexion)
			echo("<tr><td colspan=\"2\">ha ocurrido un error al cargar desde la BD.</td></tr>");
		else
		{
			$rs = db_query("select * from computador where codigosala = '$sala' order by codigopc");
			while($obj = pg_fetch_object($rs))
			{
				$codigopc = $obj->codigopc;
				$disponible = $obj->disponible;
				
				
				?>
					<tr>
					<td class="normal" align="left" valign="middle">&nbsp;&nbsp;&nbsp;<?=$codigopc?></td>
					<td align="left" valign="middle" class="pestanaOn"><? echo ($disponible == 't'? "<font size=\"0\" color=\"#3399FF\">Disponible</font>" : "<font size=\"0\" color=\"#999999\">No Disponible</font>"); ?></td>
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