<?
		MakeMenu('Menu');
		if(isset($_SESSION['adminSalas'])){
			MakeMenuItem("Ver Horario", "/Comunidad/Informatica/AsignacionSalasNew/calendarioMensual.php?opcion=1");
			MakeMenuItem("Reservar", "/Comunidad/Informatica/AsignacionSalasNew/calendarioMensual.php?opcion=2");
			MakeMenuItem("Cancelar", "/Comunidad/Informatica/AsignacionSalasNew/calendarioMensual.php?opcion=3");
			MakeMenuItem("Listar Reservas", "/Comunidad/Informatica/AsignacionSalasNew/listaReservas.php?op=1");
			MakeMenuItem("Cancelaciones", "/Comunidad/Informatica/AsignacionSalasNew/cancelaciones.php");
			MakeMenuItem("Estadisticas", "/Comunidad/Informatica/AsignacionSalasNew/estadisticas.php");
			MakeMenuItem("Pdf reservas", "/Comunidad/Informatica/AsignacionSalasNew/pdf_reserva.php");
			MakeMenuItem("Cerrar Sesi&oacute;n", "/Comunidad/Informatica/AsignacionSalasNew/salir.php");
		}
		EndMenu();
     
?>
