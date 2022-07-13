<?
	$rootPath = "../../..";
	require '../../../functions.php';
	
	$_GET['submenu_documentos'] = true;
	
	PageInit('Encuentro de Investigadores en Prospectiva, Innovaci&oacute;n y Gesti&oacute;n del Conocimiento"', "../../menu.php");
	
	$dir = GraphicLS("archivos", "index.php");
	
	PageEnd();
?>