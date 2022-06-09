<?
	$rootPath = "../../..";
	require '../../../functions.php';
	
	$_GET['submenu_documentos'] = true;
	
	PageInit('Foro Reforma Tributaria 2013', "../../menu.php");
	
	$dir = GraphicLS("archivos", "index.php");
	
	PageEnd();
?>