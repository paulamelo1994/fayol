<?
	session_start();
	
	$root_path = "../..";
	require '../../functions.php';
	
	$_GET['submenu_ecaes'] = true;
	
	if($_POST['autenticar'])
	{
		if(autenticarUsuario($login, $password))
		{
			$_SESSION['invitado'] = true;
		}
		else
			$usuario = "no";
	}
	
	if($_GET['salir'])
	{
		unset($_SESSION['invitado']);
		header("Location: /Comunidad/ECAES/index.php");
		die();
	}
	
if(!isset($_SESSION['invitado']))
{
	PageInit("Pruebas piloto ECAES", '../menu.php');
	
	?><h1 class="shiny">ECAES</h1><?
	
	if($usuario == "no")
		echo "<center><font color=\"#FF0000\"><b>La autenticacion ha fallado, posiblemente el login o el password son erroneos</b></font></center>";
?>
	<p align="justify">Es esta secci&oacute;n usted puede encontrar documentos que contienen pruebas piloto del ECAES.
	<br>
	<br>
	Para acceder a estos documentos usted primero debe ser autenticado. Por favor escriba su login y password del 
	correo de dominio <font color="#FF0000"><b>univalle.edu.co</b></font></p>
	<table width="50%" align="center" border="0">
	<form method="post" enctype="multipart/form-data" name="autenticar">
	<tr><td><b>Login:</b></td><td><input type="text" name="login" size="12"></td></tr>
	<tr><td><b>Password:</b></td><td><input type="password" name="password" size="12"></td></tr>
	<tr><td colspan="2"><br></td></tr>
	<tr><td colspan="2" align="center"><input type="submit" name="autenticar" value="Autenticar"></td></tr>
	</form>
	</table>
<?
}
else
{
	$_GET['submenu_ecaes'] = true;
	
	PageInit("Pruebas piloto ECAES", '../menu.php');
?>
	<h1 class="shiny">Documentos</h1>
	
	<table width="90%" align="center" border="0">
	<tr><td colspan="2"><br></td></tr>
	<tr><td class="titulosContenidoInterno">Prueba piloto ECAES Administraci&oacute;n 2007.</td><td><a href="Prueba piloto ECAES Administracion 2007.pdf" target="_blank"><img src="../../Images/PDFFile.jpg"></a></td></tr>
	<tr><td colspan="2"><br></td></tr>
	<tr><td class="titulosContenidoInterno">Prueba Piloto ECAES Contaduria P&uacute;blica 2007.</td><td><a href="Prueba Piloto ECAES Contaduria Publica 2007.pdf" target="_blank"><img src="../../Images/PDFFile.jpg"></a></td></tr>
	<tr><td colspan="2"><br></td></tr>
	</table>
<?
}
	PageEnd();
?>