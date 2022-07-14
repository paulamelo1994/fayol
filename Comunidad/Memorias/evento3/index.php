<?
	$rootPath = "../../..";
	require '../../../functions.php';
	
	$_GET['submenu_documentos'] = true;
	
	PageInit("I Congreso de Estudiantes de Contadur&iacute;a P&uacute;blica", "../../menu.php");
	
	$dir = GraphicLS("archivos", "index.php");
	
	PageEnd();
?>