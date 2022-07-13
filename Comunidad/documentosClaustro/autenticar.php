<?
   require '../../functions.php';
   $rootPath = '../../';
   
   session_start();
   
   $_GET['submenu_recursos'] = true;
   
   if( $_GET['cerrarSesion'] )
   {
      unset($_SESSION['sesionClaustro']);
      header('Location: /Comunidad/');
	  die();
   }
   
   if( isset($_POST['autenticar']) && $_POST['password']=='luisxx' )
   {
      $_SESSION['sesionClaustro'] = 't';
	  header('Location: index.php');
	  die();
   }
   
   PageInit('Autenticacion documentos Claustro', '../menu.php');
?>
<h1>Administraci&oacute;n de documentos Claustro.</h1>
<br><br>
<TABLE ALIGN="CENTER" BGCOLOR="#CC0000">
<TR>
	<TD STYLE="color:white;" ALIGN="CENTER"><B>Autenticaci&oacute;n</B></TD>
</TR>
<TR>
	<TD>
	<FORM METHOD="POST" action="">
	<TABLE WIDTH="50%" BORDER="0" BGCOLOR="#FFFFFF">
	<TR><TD ALIGN="CENTER"><B>Password:</B></TD></TR>
	<TR><TD ALIGN="CENTER"><INPUT TYPE="PASSWORD" NAME="password" SIZE="12"></TD></TR>
	<TR><TD COLSPAN="2"><CENTER><INPUT TYPE="SUBMIT" NAME="autenticar" VALUE="Autenticar Usuario"></CENTER></TR>
	</TABLE>
	</FORM>
	</TD>
</TR>
</TABLE>
<?
   PageEnd();
?>
