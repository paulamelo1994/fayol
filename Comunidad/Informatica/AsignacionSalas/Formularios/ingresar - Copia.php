<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: ingresar.php
	Objetivo: Modulo de autenticacion de la aplicacion.
				Autentica la entrada de datos para el acceso a la aplicacion y determina si da o no acceso a la misma.
	Autor: Angela Benavides
	Año: 2006
	Modificacion : 09-2011 por Oliver Felipe Idarraga.
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
		
		//$rs = db_query("SELECT * FROM profesores WHERE login= '$_POST[Login]' and password = '$_POST[Password]'");
		
		if((($_POST['Login']=='luispena')&&($_POST['Password']=='luisxx'))||($_POST['Login']=='nelson')&&($_POST['Password']=='nelsonxxx')||($_POST['Login']=='jjcarmu')&&($_POST['Password']=='94060799'))
		{
			
			$_SESSION['adminSalas'] = array();
			$_SESSION['adminSalas']['login'] = 'luispena';
			$_SESSION['adminSalas']['permisos'] = "total";
						
					
		}
		else
		{
			echo "<script language=\"Javascript\" >
			 	alert(\"Nombre de usuario o contrase\xf1a incorrectos.\");
				location.href='/Comunidad/Informatica/AsignacionSalas/Formularios/ingresar.php';
                </script>";
		}
	}

	
	if(!isset($_SESSION['adminSalas']))
	{
		
		include '../../../../php-scripts/validadorFormularios/formReserva.php';
		?>
		<H2 CLASS="shiny" align="center">Autenticaci&oacute;n Requerida Administracion Salas</H2>
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
	
	if(isset($_SESSION['adminSalas']))
	{
				
		PageInit("Asignaci&oacute;n de Salas ", '../menu.php');
		?>
		<form method="get" name="ControlSalas" action="control.php">
		<center>
		<H1 class="shiny">Asignaci&oacute;n de Salas</H1>
		<IMG SRC="<?=$rootPath?>/Images/asig_salas.png" ALT="foto">
		<H2>Facultad de Ciencias de la Administraci&oacute;n<BR>Universidad del Valle</H2>
		</center>
		</form>
		<?
		PageEnd();
	}
?>