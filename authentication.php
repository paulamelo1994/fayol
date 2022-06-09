<?
  require '../functions.php';
  $rootPath = '../..';
  
  $authentication=false;
  $list=array('submenu_informatica'=>'Informatica/software.php', 'submenu_actas'=>'Actas/index.php', 'submenu_empleos'=>'BolsaEmpleos/index.php');
  $submenu='';
  if($_GET['submenu_informatica'])
  {
  	$submenu='submenu_informatica';
  }
  if($_GET['submenu_actas'])
  {
  	$submenu='submenu_actas';
  }
  if($_GET['submenu_empleos'])
  {
  	$submenu='submenu_empleos';
  }
  if ($_POST['autenticar']) {
		if(AutenticarUsuario($login, $password)){
			$authentication=true;
			header("Location: $list[$submenu]");
		}
		else
		{
				$authentication=false;			
		}
  }//if ($_POST['autenticar'])
  PageInit('Autenticación requerida', 'menu.php');
?>
<H1 CLASS="shiny">Autenticación requerida</H1>
<?
/*if($authenticationError)
{
	?>
		<CENTER><FONT COLOR=RED><B>La autenticacion ha fallado, posiblemente el login o el password son erroneos</B></FONT></CENTER><BR><BR>
	<?
}*/
?>
Para acceder a los documentos a disposici&oacute;n de los estudiantes debe
primero ser autenticado. Por favor escriba abajo su login y password del correo de dominio <FONT COLOR="#FF0000"><B>univalle.edu.co. </B></FONT>
<center><TABLE WIDTH=50% BORDER=0>
  <FORM METHOD="POST">
    <TR><TD><B>Login:</B></TD><TD><INPUT TYPE="TEXT" NAME="login" SIZE=12></TD><TR>
    <TR><TD><B>Password:</B></TD><TD><INPUT TYPE="PASSWORD" NAME="password" SIZE=12></TD><TR>
	<TR><TD COLSPAN=2><CENTER><INPUT TYPE=SUBMIT NAME="autenticar" VALUE="Autenticar"></CENTER></TR>
  </FORM>
  </TD></TR>
</TABLE>
</center>
	<?
  PageEnd();
?>
	
