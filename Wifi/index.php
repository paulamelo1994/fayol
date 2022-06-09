<?
	require '../../functions.php';
	
	session_start();
	   
	$root_path = "../..";
	
	$_GET['submenu_wifi'] = true;
	
	PageInit("Registro de Equipos para la Red Inalambrica", "../menu.php");
?>
	<h1 class="shiny">Registro de Equipos Red Inalambrica</h1>
	<p><br>
	Esta pagina esta para el 
	el registro, modificacion y eliminacion de usuario y equipos de la red inalambrica
	de la Facultad de Ciencias de la Aministraci&oacute;n</p>
	<center><img src="/Comunidad/FotoCampus.jpg" width="70%" alt=""></center>
	<ul>
		<li><a href="registrarpc.php">Registrar</a></li>
		<li><a href="listar.php">Listar</a></li>
	</ul>
<?	
	PageEnd();
?>