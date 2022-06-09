<?
	/********************************************************
	Aplicacion: Solicitud Reserva de Salas
	Archivo: salir.php
	Objetivo: Modulo pára terminar una sesion de usuario (profesor).
	Autor: Angela Benavides
	Año: 2006
	*********************************************************/
	
	session_start();
	
	if(!isset($_SESSION["profesor"]))
	{
		header("Location: /Comunidad/Informatica/index.php");
		die();
	}
	
	require '../../../functions.php';
	$rootPath = '../../..';
	
	session_destroy();
	header("Location: /Comunidad/Informatica/SolicitudReserva/index.php");
	die();
?>