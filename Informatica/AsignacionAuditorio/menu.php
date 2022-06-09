<?
		MakeMenu('Menu');
		MakeMenuItem("Ver Horario", "/Comunidad/Informatica/AsignacionAuditorio/calendarioMensual.php?opcion=1");
		if(isset($_SESSION['profesor'])){
						
			if($_SESSION['profesor']['permisos'] == 'total'){
				MakeMenuItem("Listar Reservas", "/Comunidad/Informatica/AsignacionAuditorio/reservas.php");
				MakeMenuItem("Cancelaciones", "/Comunidad/Informatica/AsignacionAuditorio/cancelaciones.php");
			}
			
			if($_SESSION['profesor']['login'] == 'admseacd'||$_SESSION['profesor']['login'] == 'jjcarmu'||$_SESSION['profesor']['login'] == 'luispena'){
				MakeMenuItem("Reservar", "/Comunidad/Informatica/AsignacionAuditorio/calendarioMensual.php?opcion=2");
				MakeMenuItem("Cancelar", "/Comunidad/Informatica/AsignacionAuditorio/calendarioMensual.php?opcion=3");
			}
			MakeMenuItem("Cerrar Sesi&oacute;n", "/Comunidad/Informatica/AsignacionAuditorio/salir.php");
		}
		EndMenu();
     
?>