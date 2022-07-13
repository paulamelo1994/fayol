<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: salir.php
	Objetivo: Termina una sesion iniciada.
	Autor: Angela Benavides
	Año: 2007
	*********************************************************/
	
	session_start();
	
	if(!isset($_SESSION['usuario']))
	{
		header("Location: /Comunidad/Idiomas/index.php");
		die();
	}
	
	require '../../functions.php';
	$rootPath = '../../';
	
	session_destroy();
	header("Location: /Comunidad/Idiomas/index.php");
	die();
?>