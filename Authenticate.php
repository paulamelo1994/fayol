<?
	session_start();
	
	if (isset($_GET['first_time'])) {
		$_SESSION['RedirectPage'] = 'FramesForo.php';
	}
    $_SESSION['RedirectPage'] = 'FramesForo.php';
	
	require "../functions.php";
	$rootPath = '..';
	
	if( isset($_GET['RedirectPage']) )
	{
	   $_SESSION['RedirectPage'] = $_GET['RedirectPage'];
	   header('Location: Authenticate.php');
	   die();
	}
	
	if( isset($_SESSION['UserName']) )
	{
	   header("Location: ".$_SESSION['RedirectPage']);
	   die();
	}
	
	if( !isset($_SESSION['RedirectPage']) )
	{
	   header('Location: http://administracion.univalle.edu.co/');
	   die();
	}
	
	if( isset($_POST['Submit']) )
	{
		$correo = autenticarUsuario($_POST['login_username'], $_POST['secretkey']);
		# Si la autenticacion fue exitosa
		if( $correo )
		{
		   $_SESSION['UserName'] = $_POST['login_username'];
		   $_SESSION['UserEmail'] = $correo;
		   header("Location: ".$_SESSION['RedirectPage']);
		   die();
		}
	}
	
	$valign = 'top';
	$centrar_contenido = false;
	$width = '100%';
	PageInit("Nuestra Comunidad");

	$default_login = (getIP()=='192.168.220.126')? "wilches" : "";
	?>
	<H1>Autenticaci&oacute;n de Usuario</H1>
	<table ALIGN="CENTER"><tr>
			<td ALIGN="CENTER">
		Ingrese aqui el login y password de su cuenta en Univalle.<br>
		Por ejemplo si su correo es <FONT COLOR="green">usuario@univalle.edu.co</FONT>
		su login es <FONT COLOR="green">usuario</FONT>.
		<FORM METHOD="POST" ALIGN="center">
		<table ALIGN="CENTER">
			<tr><td><B>Login:</B></td><td><INPUT NAME="login_username" VALUE="<?=$default_login?>" TYPE="text" SIZE="12"></td></tr>
			<tr><td><B>Password:</B></td><td><INPUT NAME="secretkey" TYPE="password" SIZE="12"></td></tr>
			<tr><td COLSPAN="2" ALIGN="CENTER"><INPUT NAME="Submit" TYPE="submit" VALUE="Autenticar" SIZE="10"></td></tr>
		</table>
		</FORM>
		</td></tr></table>
<?
	PageEnd();
?>