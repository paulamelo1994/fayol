<?
	session_start();
	require "../functions.php";
	$rootPath = '..';
	
	$_GET['item'] = 7;
	
	$valign = 'top';
	$centrar_contenido = false;
	$width = '100%';
	PageInit("Nuestra Comunidad");
	$default_login = (getIP()=='192.168.220.165')? "wilches" : "";
	?>
	<H1 class="shiny">Revisar Correo de Univalle</H1>
	<table ALIGN="CENTER">
	<tr>
		<td ALIGN="CENTER">
		Ingresa aqui el login y password de tu cuenta en Univalle.<br>
		Por ejemplo si tu correo es <FONT COLOR="green">usuario@univalle.edu.co</FONT>
		tu login es <FONT COLOR="green">usuario</FONT>.
		<FORM NAME="form" ACTION="/correo-uv.php" METHOD="POST">
		<table ALIGN="CENTER">
		<tr>
			<td><B>Login:</B></td>
			<td><INPUT NAME="login_username" VALUE="<?=$default_login?>" TYPE="text" SIZE="12"></td>
		</tr>
		<tr>
			<td><B>Password:</B></td>
			<td><INPUT NAME="secretkey" TYPE="password" SIZE="12"></td>
		</tr>
		<tr>
			<td COLSPAN="2" ALIGN="CENTER"><INPUT NAME="submit" TYPE="submit" VALUE="Entrar" SIZE="10"></td>
		</tr>
		</table>
		</FORM>
		</td>
	</tr>
	</table>
	<?
	
	PageEnd();
?>