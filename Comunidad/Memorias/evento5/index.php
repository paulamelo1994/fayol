<?
	$rootPath = "../../..";
	require '../../../functions.php';
	
	$_GET['submenu_documentos'] = true;
	
	PageInit('II Congreso de Estudiantes de Contadur&iacute;a P&uacute;blica. "Etica en la formaci&oacute;n del Contador P&uacute;blico"', "../../menu.php");
	
	$dir = GraphicLS("archivos", "index.php");
	
	PageEnd();
?>