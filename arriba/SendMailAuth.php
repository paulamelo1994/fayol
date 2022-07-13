<?
	require "functions.php";

/*
	if( isset($_GET['iddocente']) )
	{
		DBConnect("profesores");
		$rs = db_query("select mail from profesores where serial=$iddocente");
		$obj = pg_fetch_object($rs);
		$_GET['destinatario'] = $obj->mail;
	}
	*/

  if(isset($_POST['sendSubmit'])) {
    if($_POST['destinatario'] && $_POST['subject'] && $_POST['mensaje'])
	{
      mail($_POST['destinatario'], $_POST['subject'], $_POST['mensaje'], "From: $_POST[remitente]");
	  echo "<CENTER><FONT COLOR=BLUE><B>Su mensaje esta siendo mandado por el servidor, ya puede cerrar esta ventana</B></FONT></CENTER>";
	  die();
	}
	else
	  $correo = $login = $_POST['remitente'];
  }
  
	if(isset($_POST['authSubmit'])) {
		$correo = autenticarUsuario($_POST['login'], $_POST['password']);
	}
?>
<HTML>
<HEAD>
<TITLE>Autenticaci&oacute;n de usuario</TITLE>
<LINK HREF="estiloweb.css" TYPE="TEXT/CSS" REL="STYLESHEET">
</HEAD>
<BODY STYLE=" margin:10px;">
<?
if(!$correo)
	echo '<h1 CLASS="shiny">Autenticaci&oacute;n de Usuario</h1>';
else
	echo '<h1 CLASS="shiny">Correo instant&aacute;neo</h1>';
  
?>
<P>
<?
  # Si la autenticacion fallo
  if(isset($correo) && !$correo && $login) {
  ?>
	<FONT COLOR=navy><B>La autenticaci&oacute;n del usuario fall&oacute;, por favor trate de nuevo</B></FONT>
  <?
  #Si la autenticacion no se ha hecho
  } elseif(!isset($correo) || !$login) {
  ?>
  Para poder mandar un correo debemos autenticar su nombre de usuario y contraseña, por favor escribalos aqui abajo.<BR>
  Su cuenta de correo debe pertenecer al dominio <FONT COLOR=navy><B>univalle.edu.co</B></FONT>.<BR>
  Por ejemplo, si su correo es <FONT COLOR=red>usuario@univalle.edu.co</FONT> escriba tan solo <FONT COLOR=red>usuario</FONT>
  en el campo <B>login</B>.
  <?
  # Si la autenticacion tuvo exito
  } else {
    ?>
	<TABLE BORDER=0>
	<FORM METHOD="POST">
	<TR><TD><B>Remitente:</B></TD><TD><?=$correo?><INPUT TYPE=HIDDEN NAME="remitente" VALUE="<?=$correo?>"></TD></TR>
	<TR><TD><B>Destinatario:</B></TD><TD><INPUT TYPE=TEXT NAME="destinatario" VALUE="<?=$destinatario?>" SIZE=40></TD></TR>
	<TR><TD><B>Asunto: </B></TD><TD><INPUT TYPE=TEXT NAME="subject" VALUE="<?=$subject?>" SIZE=40></TD></TR>
	<TR><TD COLSPAN=2><B>Mensaje:</B><BR><TEXTAREA ROWS=6 COLS=45 NAME="mensaje"><?=$mensaje?></TEXTAREA></TD></TR>
	<TR><TD COLSPAN=2><CENTER><INPUT TYPE=SUBMIT VALUE="Mandar Mensaje" NAME="sendSubmit"></CENTER></TD></TR>
	</FORM>
	</TABLE>
	<?
	die();
  }
  ?>
</P>
<CENTER>
<TABLE WIDTH=50% BORDER=0>
  <FORM METHOD="POST">
    <INPUT TYPE=HIDDEN NAME="destinatario" VALUE="<?=$destinatario?>">
    <TR><TD><B>Login:</B></TD><TD><INPUT TYPE="TEXT" NAME="login" VALUE="<?=$login?>" SIZE=12></TD><TR>
    <TR><TD><B>Password:</B></TD><TD><INPUT TYPE="PASSWORD" NAME="password" SIZE=12></TD><TR>
	<TR><TD COLSPAN=2><CENTER><INPUT TYPE="SUBMIT" NAME="authSubmit" VALUE="Autenticar Usuario"></CENTER></TR>
  </FORM>
  </TD></TR>
</TABLE>
</CENTER>
</BODY>
</HTML>