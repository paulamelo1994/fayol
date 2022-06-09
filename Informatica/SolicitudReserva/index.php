<?
	/********************************************************
	Aplicacion: Solicitud Reserva de Salas
	Archivo: index.php
	Objetivo: Modulo de autenticacion de la aplicacion.
		Autentica la entrada de datos para el acceso a la aplicacion y determina si da o no acceso a la misma.
	Autor: Juliana Davila
	Año: 2008
	*********************************************************/
	
	session_start();
	
	$root_path = "../../..";
	require '../../../functions.php';
	
	$_GET['submenu_informatica'] = true;

	
	if($_POST['autenticar'])
	{
		$conexion = DBConnect('profesores');
		
		if(!conexion)
		{
			header("Location: /Comunidad/SolicitudReserva");
			die();
		}
		
		$rs = db_query("SELECT * FROM profesores WHERE login= '$_POST[Login]' and password = '$_POST[Password]'");
		
		$filas = pg_num_rows($rs);
		if($filas)
		{
			$obj = pg_fetch_object($rs);
			
			$_SESSION['profesor'] = array();
			$_SESSION['profesor']['login'] = $obj->login;
			$_SESSION['profesor']['nombre'] = $obj->nombre;
			$_SESSION['profesor']['mail'] = $obj->mail;
			
			if($_SESSION['profesor']['login'] == 'langela' || $_SESSION['profesor']['login'] == 'luispena')
				$_SESSION['profesor']['permisos'] = "total";
			else
				$_SESSION['profesor']['permisos'] = "limitado";
			
			$_GET['submenu_asignacion'] = null;
			$_GET['submenu_informatica'] = null;
		}
		else
		{
			echo "<script language=\"Javascript\" >
			 	alert(\"Nombre de usuario o contraseña incorrectos.\");
                </script>";
		}
	}
	
	if(!isset($_SESSION['profesor']))
	{
		PageInit("Asignaci&oacute;n de Salas de Computo", '../../menu.php');
		?>
		<H1 CLASS="shiny">Autenticaci&oacute;n Requerida</H1>
		<P>Esta area de nuestra p&aacute;gina esta restringida solo para el uso de los profesores, no hay raz&oacute;n para que un usuario com&uacute;n necesite acceder a estas p&aacute;ginas.</P>
		<P>Para ingresar al area de solicitud de reserva de salas por favor ingrese abajo su clave de autenticaci&oacute;n.</P>
		<form method="post" action="index.php" name="autenticacion" enctype="multipart/form-data">
		<table cellpadding="2" cellspacing="2" align="center">
		<tr>
			<td width="50">LOGIN:</td>
			<td width="50"><INPUT TYPE=TEXT NAME="Login" value=""></td>
		</tr>
		<tr>
			<td>PASSWORD:</td>
			<td><INPUT type= password  NAME="Password" value=""></td>
		</tr>
		<tr>
			<td colspan="2">
			<div align="center">
			<input name="autenticar" type="submit" value="Autenticar Usuario">
			</div>
			</td>
		</tr>
		</table>
		</form>
		<?
		PageEnd();
		die();
	}
	
	if(isset($_SESSION['profesor']))
	{
		$_GET['submenu_informatica'] = null;
		$_GET['submenu_asignacion'] = null;
		$_GET['submenu_solicitud_reserva'] = true;
		
		PageInit("Asignaci&oacute;n de Salas", '../../menu.php');
		?>
		<form method="get" name="ControlSalas" action="control.php">
		<center>
		<H1 class="shiny">Solicitud Reserva de Salas</H1>
		<IMG SRC="<?=$rootPath?>/Images/asig_salas.png" ALT="foto">
		<H2>Facultad de Ciencias de la Administraci&oacute;n<BR>Universidad del Valle</H2>
		</center>
		</form>
		<?
		PageEnd();
	}
?>