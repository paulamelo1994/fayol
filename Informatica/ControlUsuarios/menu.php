<? 

	MakeMenu('Menu Control Salas');
		if($_GET['item_login'])
			MakeMenuItem("Inicio", "/Comunidad/Informatica/ControlUsuarios/control.php");
		else
		{
			if(getIP() == "192.168.220.126" || getIp() == "192.168.220.176")
			{
				MakeMenuItem("Seleccionar Sala", "/Comunidad/Informatica/ControlUsuarios/control.php?sala=Pendiente", false, ($PAGE_NAME == 'control.php'));
				MakeMenuItem("Registrar Monitor", "/Comunidad/Informatica/ControlUsuarios/registrarMonitor.php");
			}
			MakeMenuItem("Registrar Estudiante", "/Comunidad/Informatica/ControlUsuarios/registrarEstudiante.php");
			MakeMenuItem("Asignar Equipo", "/Comunidad/Informatica/ControlUsuarios/asignarEquipo.php");
			MakeMenuItem("Estado Equipos", "/Comunidad/Informatica/ControlUsuarios/estadoEquipos.php");
			MakeMenuItem("Sesiones", "/Comunidad/Informatica/ControlUsuarios/sesiones.php");
			MakeMenuItem("Terminar Sesi&oacute;n", "/Comunidad/Informatica/ControlUsuarios/terminarSesion.php");
			MakeMenuItem("Codigo Planes", "/Comunidad/Informatica/ControlUsuarios/codigoPlan.php");
			
			if(getIP() == "10.222.31.252" || getIP() == "192.168.220.126" || getIp() == "192.168.220.176" || getIP() == "192.168.221.121" || getIP() == "192.168.221.145" || getIP() == "192.168.221.146" || (getIp() >= "192.168.220.0" && getIP() <= "192.168.220.225") )
			{
				MakeMenuItem("Reportes", "/Comunidad/Informatica/ControlUsuarios/reportes.php");
				MakeMenuItem("Reportes Tiempo Uso", "/Comunidad/Informatica/ControlUsuarios/reportesPorUsuario.php");
				MakeMenuItem("Estadisticas", "/Comunidad/Informatica/ControlUsuarios/estadisticas.php");
			}
			if( getIP()==IP_GUILLERMO || getIp()==IP_ANGELA  || getIp()=='192.168.220.213'){
				MakeMenuItem("Consultar Estudiante", "/Comunidad/Informatica/ControlUsuarios/consultaEstudiantes.php?opc=1");
			}
		
			
			MakeMenuItem("Salir", "/Comunidad/Informatica/ControlUsuarios/salir.php");
		}
	EndMenu();
?>