<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: salir.php
	Objetivo: Modulo para terminar una sesion de usuario (monitor).
	Autor: Angela Benavides
	A�o: 2006
	*********************************************************/
	
	session_start();
	
	if(!isset($_SESSION['adminSalas']))
	{
		header("Location: /Comunidad/Informatica/AsignacionSalasNew/Formularios/ingresar.php");
		die();
	}
	
	$root_path = "../../..";
	require '../../../functions.php';
		
	session_destroy();
	header("Location: /Comunidad/Informatica/AsignacionSalas/Formularios/ingresar.php");
	die();
?>