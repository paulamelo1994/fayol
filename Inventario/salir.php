<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: salir.php
	Objetivo: Archivo que cierra la secci�n del usuario retornandolo a la paguina de logueo inicial
	Autor: Angela Benavides
	A�o: 2007
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