<?
	/********************************************************
	Aplicacion: Asignacion Auditorio
	Archivo: calendarioMensual.php
	Objetivo: Este archivo muestra el horario de el auditorio, las horas libres y las reservadas. Segun la opcion 
			  indicada en la variable $_GET['opcion'], se redirecciona a el calendario semanal: reserva, reservar o cancelar.
	Autor: Andrea Cordoba
	Año: 2011
         * 
         * Modificado: enero 2012
         * Oliver Felipe Idarraga
         * 
         * optimizaciones en el esquema de guardado en la BD, adaptación de la aplicaciíón para funcionamiento con el nuevo esquema
	*********************************************************/
	
	session_start();
	/*
	 * opcion= 1 (reserva), opcion=2 (reservar), opcion=3 (cancelar)
	 */
		
	
	if(!isset($_GET['opcion'])){
			$opcion=1;
	}else{
			$opcion=$_GET['opcion'];
	}
	
	if($opcion!=1){
		if(!isset($_SESSION['profesor']))
		{
			header("Location: /Comunidad/Informatica/AsignacionSalas/index.php");
			die();
		}
	}	
	$root_path = "../../..";
	require '../../../functions.php';
	
	$_GET['submenu_asignacion'] = true; ?>
	
<iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=0u2r8cnlivlrjd7vd6oo3mcmmk%40group.calendar.google.com&amp;color=%23db9dc5&amp;src=dmlj0gr5a0tdh3ecb8b1l44pos%40group.calendar.google.com&amp;color=%231bd89f&amp;src=995vboul0q2q61i43c6rfol3qc%40group.calendar.google.com&amp;color=%236B3304&amp;src=v8ekoikhfm5ntqpkutd7sbrbmg%40group.calendar.google.com&amp;color=%2323164E&amp;src=8ksils1dfubk07maj5sids5t6s%40group.calendar.google.com&amp;color=%23AB8B00&amp;src=tscseil06taa5ve0i3lhbvueik%40group.calendar.google.com&amp;color=%23AB8B00&amp;ctz=America%2FBogota" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
		

