<?
	$rootPath = "../../..";
	require '../../../functions.php';
	
	$_GET['submenu_documentos'] = true;
	
	PageInit("XXIII Simposio Sobre la Revisor&iacute;a Fiscal", "../../menu.php");
	
	?>
	<h3>Conferencias</h3>
	<?
	$dir = GraphicLS("archivos/Conferencias", "index.php");
	?>
	<br><h3>Inventigaciones</h3>
	<?
	$dir = GraphicLS("archivos/Investigaciones", "index.php");
	
	PageEnd();
?>