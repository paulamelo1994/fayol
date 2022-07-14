<?
require "../../functions.php";
$rootPath = "../..";

session_start();

if ( $_GET[close] ) 
	unset($_SESSION['proyectos']);


$valign = 'top';
$centrar_contenido = false;

$_GET['submenu_proyectos'] = true;

PageInit("Proyectos 2010 - 2011", "../menu.php");
require "autenticacion.php";

listaProyecto( false );
 	
PageEnd();
?>
