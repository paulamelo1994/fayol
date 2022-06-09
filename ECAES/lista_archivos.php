<?
	require '../../functions.php';
	$rootPath = "../..";
	
	$_GET['submenu_simulacro_ecaes'] = true;
	
	PageInit("Subir respuestas ECAES", "../menu.php");
	
	?>
		
	<h2>Archivos respuestas ECAES</h2>
	<?
	$someEntry = GraphicLS('archivos', 'lista_archivos.php');
	
	if(!$someEntry)
		echo "<h1>No se han reportado archivos de respuestas.</h1>";
	
	PageEnd();
?>