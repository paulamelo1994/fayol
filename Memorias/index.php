<?
	session_start();
	
	$root_path = "../..";
	require '../../functions.php';
	
	$_GET['menu_memorias'] = true;
	
	if($_POST['autenticar'])
	{
		if(autenticarUsuario($login, $password))
			$_SESSION['invitado'] = true;
		else
			$usuario = "no";
		$_SESSION['invitado'] = true;
	}
	
	if($_GET['salir'])
	{
		unset($_SESSION['invitado']);
		header("Location: /Comunidad/Memorias/index.php");
		die();
	}
	
if(!isset($_SESSION['invitado']))
{
	PageInit("Memorias de Eventos", '../menu.php');
	
	?><h1 class="shiny">Autenticaci&oacute;n Requerida</h1><?
	
	if($usuario == "no")
		echo "<center><font color=\"#FF0000\"><b>La autenticacion ha fallado, posiblemente el login o el password son erroneos</b></font></center>";
	?>
	<p>Es esta secci&oacute;n se puede encontrar una recopilaci&oacute;n de los documentos generados
	en los diversos congresos, conferencias, seminarios y/o simposios a los cuales has asistido tanto profesores como
	estudiantes de la Universidad del Valle.
	<br>
	<br>
	Para acceder a estos documentos usted primero debe ser autenticado. Por favor escriba su login y password del 
	correo de dominio <font color="#FF0000"><b>univalle.edu.co</b></font></p>
	<form method="post" enctype="multipart/form-data" name="autenticar" action="">
	<table width="50%" align="center" border="0">
	<tr>
		<td><b>Login:</b></td>
		<td><input type="text" name="login" size="12"></td>
	</tr>
	<tr>
		<td><b>Password:</b></td>
		<td><input type="password" name="password" size="12"></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="autenticar" value="Autenticar"></td>
	</tr>
	</table>
	</form>
	<?
}
else
{
	$_GET['submenu_memorias'] = true;
	
	PageInit("Memorias de Eventos", '../menu.php');
?>
	<h1 class="shiny">Documentos</h1>
	
	<table width="90%" align="center" border="0">
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td>IV Foro Nacional de Educaci&oacute;n Contable, 13, 14 y 15 de Octubre de 2006.</td>
		<td><a href="evento1/index.php"><img src="../../Images/CarpetaBig.jpg" alt=""></a></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td>XXIII Simposio Sobre la Revisor&iacute;a Fiscal, 11 al 12 de Octubre de 2006.</td>
		<td><a href="evento2/index.php"><img src="../../Images/CarpetaBig.jpg" alt=""></a></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td>I Congreso de Estudiantes de Contadur&iacute;a P&uacute;blica, 14 de Octubre de 2006.</td>
		<td><a href="evento3/index.php"><img src="../../Images/CarpetaBig.jpg" alt=""></a></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td>II Congreso de Estudiantes de Contadur&iacute;a P&uacute;blica. "Etica en la formaci&oacute;n del Contador P&uacute;blico", 7 de Octubre de 2006.</td>
		<td><a href="evento4/index.php"><img src="../../Images/CarpetaBig.jpg" alt=""></a></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td>I Encuentro Nacional de Ensayo Contable, 3 y 4 de Noviembre de 2006.</td>
		<td><a href="evento5/index.php"><img src="../../Images/CarpetaBig.jpg" alt=""></a></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td>Encuentro de Investigadores en Prospectiva, Innovaci&oacute;n y Gesti&oacute;n del Conocimiento</td>
		<td><a href="evento6/index.php"><img src="../../Images/CarpetaBig.jpg" alt="" border="0"></a></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td>Foro Reforma Tributaria 2013</td>
		<td><a href="evento7/index.php"><img src="../../Images/CarpetaBig.jpg" alt="" border="0"></a></td>
	</tr>
	</table>
<?
}
	PageEnd();
?>