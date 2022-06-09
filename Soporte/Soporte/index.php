<?
	require '../../functions.php';
	
	$root_path = "../..";
	
	$_GET['submenu_solicitudes'] = true;
	
	PageInit("Petici&oacute;n de Soporte", "../menu.php");
?>
	<h1 class="shiny">Soporte</h1>
	<br>En esta p&aacute;gina encontrar&aacute; acceso al modulo de petici&oacute;n de soporte. Solo debe llenar el formulario
	y esperar con los datos correspondientes para enviarlo a nuestra oficina.
	<br><br>
	Puede saber el estado de su petici&oacute;n cuando desee visitando esta p&aacute;gina nuevamente.
	<br><br>
	<!--<center><img src="/Comunidad/FotoCampus.jpg" width="70%" alt=""></center>-->
	<center><img src="/Comunidad/FotoCampus.jpg"  alt=""></center>
<?	
	PageEnd();
?>