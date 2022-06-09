<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: salir.php
	Objetivo: Modulo pára terminar una sesion de usuario (monitor).
	Autor: Angela Benavides
	Año: 2006
	*********************************************************/
	
	session_start();
	
	if(!isset($_SESSION['profesor']))
	{
		header("Location: /Comunidad/Informatica/AsignacionUsuarios/index.php");
		die();
	}
	
	$root_path = "../../..";
	require '../../../functions.php';
		
	session_destroy();
	header("Location: /Comunidad/Informatica/AsignacionAuditorio/Formularios/ingresar.php");
	die();
?>