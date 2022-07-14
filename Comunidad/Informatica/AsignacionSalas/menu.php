<?
		MakeMenu('Menu');
		if(isset($_SESSION['adminSalas'])){
			MakeMenuItem("Ver Horario", "/Comunidad/Informatica/AsignacionSalas/calendarioMensual.php?opcion=1");
			MakeMenuItem("Reservar", "/Comunidad/Informatica/AsignacionSalas/calendarioMensual.php?opcion=2");
			MakeMenuItem("Cancelar", "/Comunidad/Informatica/AsignacionSalas/calendarioMensual.php?opcion=3");
			MakeMenuItem("Listar Reservas", "/Comunidad/Informatica/AsignacionSalas/listaReservas.php?op=1");
			MakeMenuItem("Cancelaciones", "/Comunidad/Informatica/AsignacionSalas/cancelaciones.php");
			MakeMenuItem("Estadisticas", "/Comunidad/Informatica/AsignacionSalas/estadisticas.php");
			MakeMenuItem("Pdf reservas", "/Comunidad/Informatica/AsignacionSalas/pdf_reserva.php");
			MakeMenuItem("Cerrar Sesi&oacute;n", "/Comunidad/Informatica/AsignacionSalas/salir.php");
		}
		EndMenu();
     
?>
