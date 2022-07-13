<?
	/*
	session_start();
	
	require "../../functions.php";
	$rootPath = "../..";
	
	$_GET['submenu_proyectos'] = true;

	PageInit("Proyectos 2010 - 2011", "../menu.php");
	*/
	?>
<form name="form1" method="post" action="">
<table width="200" border="0">
  <tr>
    <td>Usuario</td>
    <td>
      <input type="login" name="textfield">
  </tr>
  <tr>
    <td>Contrase&ntilde;a</td>
    <td><input type="clave" name="password"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Enviar">
    </td>
  </tr>
</table>
</form> 		
	<?
	PageEnd();
?>
