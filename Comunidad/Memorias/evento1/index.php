<?
	$rootPath = "../../..";
	require '../../../functions.php';
	
	$_GET['submenu_documentos'] = true;
	
	PageInit("Cuarto Foro Nacional de Educaci&oacute;n Contable", "../../menu.php");

	$dir = GraphicLS("archivos", "index.php");
	
	PageEnd();
?>