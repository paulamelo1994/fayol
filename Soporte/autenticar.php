<?
   require '../../functions.php';
   $rootPath = '../../';
   
   session_start();
   
   $_GET['submenu_solicitudes'] = true;
   
   if( $_GET['cerrarSesion'] )
   {
      unset($_SESSION['sesionValida']);
      header('Location: /Comunidad/Soporte/');
	  die();
   }
   
   if( isset($_POST['autenticar']) && $_POST['password']=='silicon96' )
   {
      $_SESSION['sesionValida'] = 't';
	  header('Location: actualizar.php?mostrar=espera');
	  die();
   }
   
   PageInit('Autenticacion del area de Soporte', '../menu.php');
?>
<h1>Administraci&oacute;n de peticiones de soporte.</h1>
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
