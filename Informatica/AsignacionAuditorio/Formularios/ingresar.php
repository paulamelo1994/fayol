<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: ingresar.php
	Objetivo: Modulo de autenticacion de la aplicacion.
				Autentica la entrada de datos para el acceso a la aplicacion y determina si da o no acceso a la misma.
	Autor: Angela Benavides
	Año: 2006
	Modificacion : 02-2011
	*********************************************************/
	
	session_start();
	
	$root_path = "../../../..";
	require '../../../../functions.php';
	
		
	if($_POST['autenticar'])
	{
		$conexion = DBConnect('profesores');
		
		if(!conexion)
		{
			header("Location: /Comunidad");
			die();
		}
		
		$sql ="SELECT * FROM profesores WHERE login= '$_POST[Login]' and password = '$_POST[Password]'";
		$rs = db_query($sql);
		
		//echo 'SQL-> '.$sql.'  RS-> '.$rs; 
		
		$filas = pg_num_rows($rs);
		if($filas)
		{
			$obj = pg_fetch_object($rs);
			
			$_SESSION['profesor'] = array();
			$_SESSION['profesor']['login'] = $obj->login;
			$_SESSION['profesor']['nombre'] = $obj->nombre;
			
			if($_SESSION['profesor']['login'] == 'langela' || $_SESSION['profesor']['login'] == 'luispena' || $_SESSION['profesor']['login'] == 'ana'
				|| $_SESSION['profesor']['login'] == 'sinsa' || $_SESSION['profesor']['login']=='olifeig'||$_SESSION['profesor']['login']=='jjcarmu'
			){
				$_SESSION['profesor']['permisos'] = "total";
				//echo __LINE__.__FILE__."<br>"; prin_r($POST); echo "</br>";
			}
			else
				$_SESSION['profesor']['permisos'] = "limitado";
				
					
		}
		else
		{
			echo "<script language=\"Javascript\" >
			 	alert(\"Nombre de usuario o contrase&ntilde;a incorrectos.\");
				location.href='/Comunidad/Informatica/AsignacionAuditorio/Formularios/ingresar.php';
                </script>";
		}
	}

	if(!isset($_SESSION['profesor']))
	{
	   	PageInit("Asignaci&oacute;n de Auditorio", '../../../menu.php');
		include '../../../../php-scripts/validadorFormularios/formReserva.php';
		?>
		<H1 CLASS="shiny">Autenticaci&oacute;n Requerida</H1>
		<P>Esta &aacute;rea de nuestra p&aacute;gina esta restringida solo para el uso de los profesores, no hay raz&oacute;n para que un usuario com&uacute;n necesite acceder a estas p&aacute;ginas, es m&aacute;s, ni siquiera deber&iacute;a estar viendo este mensaje.</P>
		<P>Para ingresar al area de asignaci&oacute;n de las salas por favor ingrese abajo su clave de autenticaci&oacute;n.</P>
		<form method="post" action="ingresar.php" name="reserva4" id="reserva4" enctype="multipart/form-data">
		<table cellpadding="2" cellspacing="2" align="center">
		<tr>
			<td width="50">LOGIN:</td>
			<td width="50"><INPUT TYPE=TEXT id="Login" NAME="Login" value=""></td>
		</tr>
		<tr>
			<td>PASSWORD:</td>
			<td><INPUT type= password  id="Password" NAME="Password" value=""></td>
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
		PageInit("Asignaci&oacute;n de Auditorio", '../menu.php');
		?>
		<form method="get" name="ControlSalas" action="control.php">
		<center>
		<H1 class="shiny">Asignaci&oacute;n de Auditorio</H1>
		<IMG SRC="<?=$rootPath?>/Images/asig_salas.png" ALT="foto">
		<H2>Facultad de Ciencias de la Administraci&oacute;n<BR>Universidad del Valle</H2>
		</center>
		</form>
		<?
		PageEnd();
	}
?>