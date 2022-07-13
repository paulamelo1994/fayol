<?
	/********************************************************
	Aplicacion: Control Salas
	Archivo: salir.php
	Objetivo: Modulo p&aacute;ra terminar una sesion de usuario (monitor).
	Autor: Angela Benavides
	A&ntilde;o: 2006
	*********************************************************/
	
	session_start();
	date_default_timezone_set('GMT-4'); //Establece zona horaria, evita desfaces
	if(!isset($_SESSION["monitor"]))
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/control.php");
		die();
	}
	
	require '../../../functions.php';
	$rootPath = '../../..';
	
	session_destroy();
	header("Location: /Comunidad/Informatica/index.php");
	die();
?>