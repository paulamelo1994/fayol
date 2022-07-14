<?
	/********************************************************
	Aplicacion: Control Salas
	Archivo: codigoPlan.php
	Objetivo: Modulo que lista los codigos y nombres de los programas de la Universidad.
				Existen en el listado tres (3) tipos de programas diferentes:
				- 1111 DOCENTES
				- 2222 OTRAS SEDES
				- 3333 EMPLEADOS
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
	
	if(isset($_SESSION['monitor']))
	{
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
	
			PageInit("Codigos de los Planes", "menu.php");
			?>
			
			<h1 class="shiny">Codigos de los Planes</h1>
			<table width="90%" align="center" border="1" cellspacing="0" cellpadding="2">
			<tr>
				<th width="20%">Codigo</th>
				<th width="70%">Plan</th>
			</tr>
			<?
			$conexion = DBConnect('controlsalas');
			
			if(!$conexion)
				echo("<td colspan=\"2\">ha ocurrido un error al cargar desde la BD.</td>");
			else
			{
				$rs = db_query("select * from planes order by nombre");
				while($obj = pg_fetch_object($rs))
				{
					$codigoplan = $obj->codigo;
					$nombre = $obj->nombre;
					?>
					<tr>
					<td align="center" valign="middle"><? echo ($codigoplan == '1111' || $codigoplan == '2222' || $codigoplan == '3333'? "<font size=\"1\" color=\"#3399FF\">$codigoplan</font>" : "<font size=\"0\" color=\"#999990\">$codigoplan</font>"); ?></td>
					<td align="left" valign="middle"><? echo ($codigoplan == '1111' || $codigoplan == '2222' || $codigoplan == '3333'? "<font size=\"0\" color=\"#3399FF\">$nombre</font>" : "<font size=\"0\" color=\"#999990\">$nombre</font>"); ?></td>
					</tr>
					<?
				}
			}
			?>
			</table>
			<?
		}
	}
	
	PageEnd();
?>