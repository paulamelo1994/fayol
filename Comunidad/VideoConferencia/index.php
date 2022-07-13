<?
	session_start();

	require '../../functions.php';
	$root_path = "../..";
	$_GET['submenu_agenda'] = true;
	
	
  $_GET[item] = 2;

	  
  $valign = 'TOP';
  PageInit("Agenda", "../menu.php", 7);

  echo '<BR>'.Titulo('Entrada Privada');
  
  // echo "<br>Espero un momento por favor mientras lo redireccionamos a la agenda de la facultad";
  if ($_SESSION['usuario']['permisos'] == 'total' || $_SESSION['usuario']['permisos'] == 'parcial' )
  {?>
  	<script type="text/javascript"> 
	window.location="VerMes.php?item=2"; 
	</script>
	<?
  }
  else 
  {
   ?>


   
  <TABLE WIDTH="90%"><TR><TD>
  <P>
  Para entrar a la sección privada de la Agenda necesita introducir el Login (nombre de usuario) y Password
  (o contraseña) de su cuenta de correo con la Universidad.
  </P>


  <FORM ACTION="Autenticar.php" METHOD="POST">
  <TABLE ALIGN="CENTER">
  <tr><td>Login:</td><td><input TYPE="TEXT" NAME="LoginAgenda" WIDTH="15"></td></tr>
  <tr><td>Password:</td><td><input TYPE="PASSWORD" NAME="ClaveAgenda" WIDTH="15"></td></tr>
  <tr><td COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="SUBMIT" VALUE="Entrar"></td></tr>
  </TABLE>
  </FORM>
  </P>
  </TD></TR></TABLE>
  
  
  <?
  }
  PageEnd();
?>