<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: salir.php
	Objetivo: Archivo que cierra la sección del usuario retornandolo a la paguina de logueo inicial
	Autor: Angela Benavides
	Año: 2007
	*********************************************************/
	session_start();
	
	if(!isset($_SESSION['inventario']))
	{
		header ("Location: /Comunidad/Inventario/index.php");
		die();
	}
	
	require '../../functions.php';
	$rootPath = '../..';
	
	session_destroy();
	header("Location: /Comunidad/Inventario/index.php");
	die();
?>