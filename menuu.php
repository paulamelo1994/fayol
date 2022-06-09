<?
/*if ($_GET['submenu_actas']) 
{*/
	MakeMenu('Listas de Actas');
		//MakeMenuItem("Inicio: Listas de Actas", "/Comunidad/Actas/index.php");
		MakeMenuItem("Actas de Comit&Eacute; de Posgrados", makeURL("/Comunidad/Actas/Comite Posgrados/index.php"), false, $_GET['actas_posgrados']);
		MakeMenuItem("Actas del Consejo de Facultad", makeURL("/Comunidad/Actas/Consejo Facultad/index.php"), false, $_GET['actas_facultad']);
		MakeMenuItem("Actas del Comit&eacute; de Curr&iacute;culo", makeURL("/Comunidad/Actas/Comite Curriculo/index.php"), false, $_GET['actas_curriculo']);
		MakeMenuItem("Actas del Comit&eacute; de Contadur&iacute;a P&uacute;blica", "/Comunidad/Actas/Contaduria/index.php", false, $_GET['actas_contaduria']);
		MakeMenuItem("Actas de la Maestr&iacute;a en Administraci&oacute;n de Empresas y Ciencias de la Organizaci&oacute;n", "/Comunidad/Actas/MaAdmon/index.php", false, $_GET['actas_MaAdmon']);
		MakeMenuItem("Actas del comit&eacute; del Departamento de Contabilidad y Finanzas", "/Comunidad/Actas/Comite_contabilidad_finanzas/index.php");
		MakeMenuItem("Actas del Departamento de Administraci&oacute;n y Organizaciones", "/Comunidad/Actas/DepAdminOrgan/index.php");
		MakeMenuItem("Normas y Conceptos Jur&iacute;dicos de Inter&eacute;s", "/Comunidad/Actas/Juridico/index.php", false, $_GET['conceptos_juridicos']);
		if(  getIP()==IP_GUILLERMO || getIp()==IP_ANGELA  || getIp()=='192.168.220.213'){
			MakeMenuItem("Administrar Documentos Jur�dicos", "/Comunidad/Adm");
			MakeMenuItem("Administrador Actas Facultad", "/Comunidad/Actas/Administrador/autenticar.php");
		}
		
		//MakeMenuItem("Salir", "/Comunidad/Actas/index.php?item=s");
	EndMenu();
//}
	/* if($_GET['submenu_docClaustro'])
	{*/
	MakeMenu("Documentos Claustro");
			
		if(isset($_SESSION['sesionClaustro'])) 
		{
			MakeMenuItem("Ingresar nuevo documento", "/Comunidad/documentosClaustro/index.php?item=1", false, $_GET['item']==1);
			MakeMenuItem("Lista de documentos", "/Comunidad/documentosClaustro/index.php?item=2", false, $_GET['item']==2 );
			MakeMenuItem("Salir", "/Comunidad/documentosClaustro/autenticar.php?cerrarSesion=1", false, $_GET['item']==2 );
		}else{
 			MakeMenuItem("Autenticar", "/Comunidad/documentosClaustro/autenticar.php", false, $_GET['item']==1);
		}
	EndMenu();
//}

/*if ($_GET['submenu_informatica']) 
{*/
	MakeMenu('Aulas Inform�ticas');
		MakeMenuItem("Informaci&oacute;n General", "/Comunidad/Informatica/index.php");
		MakeMenuItem("Descarga de Software", "/Comunidad/Informatica/software.php");
		MakeMenuItem("Disponibilidad Salas de C&oacute;mputo", "/Comunidad/Informatica/itemHorario.php?item=0&pagina=1", false, $_GET['pagina']==1);
		MakeMenuItem("Reglamento de uso", "/Comunidad/Files/Reglamento%20salas.pdf", '_BLANK');
		MakeMenuItem("Nuestros Recursos Tecnol&oacute;gicos", "/Facultad/Nuestro_recursos_2011.pdf", "_blank");
		MakeMenuItem("Miembros Equipo Soporte Sistemas", "/Comunidad/Informatica/miembros.php");
		
		if(getIP() == "192.168.220.126" || getIP() == "10.222.24.226" || getIP() == "192.168.220.165" || getIP() == "192.168.220.176" || getIP() == "192.168.220.213" || 
		getIP() == "192.168.220.119" || getIP() == "192.168.221.63" || getIP() == "192.168.221.91" || getIP() == "192.168.221.121" || 
		getIP() == "192.168.221.145" || getIP() == "192.168.221.146" || getIP() == "192.168.221.143" || getIP() == "192.168.221.144" || 
		getIP() == "192.168.221.156" || getIP() == "192.168.220.98" || getIP() == "192.168.221.35" || getIp() ==  "192.168.220.3" || 
		getIp() == IP_ANGELA || getIp() ==  "192.168.205.43" || getIp() ==  "192.168.220.165" || (getIp() >= "192.168.220.2" && getIP() <= "192.168.220.225") )
		{
			MakeMenuItem("Control de salas",  "/Comunidad/Informatica/ControlUsuarios/control.php");
		}
		
		//MakeMenuItem("Solicitud Reserva Sala", "/Comunidad/Informatica/SolicitudReserva/index.php");
	EndMenu();
//}

if( getIP() == IP_ANGELA || getIP() == "192.168.221.121" || getIP() == "10.222.24.226" || getIp() >= "192.168.221.121" && getIP() <= "192.168.221.147") 
{
	/*if ($_GET['submenu_solicitud_reserva']) 
	{*/	
		MakeMenu('Solicitud de Reserva de Sala');
		MakeMenuItem("Solicitar Sala", "/Comunidad/Informatica/SolicitudReserva/disponibilidad.php");
		MakeMenuItem("Salir", "/Comunidad/Informatica/SolicitudReserva/salir.php");
	
		EndMenu();
	//}
}

/*if ($_GET['submenu_solicitudes']) 
{*/	
		MakeMenu('Solicitudes de Soporte');
		MakeMenuItem("Inicio", "/Comunidad/Soporte/index.php");
		if(  getIP()==IP_GUILLERMO || (ip2long(getIp()) >= ip2long("192.168.220.0") && ip2long(getIP()) <= ip2long("192.168.220.254"))
		 || (ip2long(getIp()) >= ip2long("192.168.221.0") && ip2long(getIP()) <= ip2long("192.168.221.254"))|| ip2long((getIp()) >= ip2long("10.221.0.0" )&& ip2long(getIP()) <= ip2long("10.221.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.222.0.0") && ip2long(getIP()) <= ip2long("10.222.0.19"))|| (ip2long(getIp()) >= ip2long("10.223.0.0") && ip2long(getIP()) <= ("10.223.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.224.0.0") && ip2long(getIP()) <= ip2long("10.224.0.19"))|| (ip2long(getIp()) >= ip2long("10.225.0.0") && ip2long(getIP() )<= ip2long("10.225.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.226.0.0") && ip2long(getIP()) <= ip2long("10.226.0.19"))|| (ip2long(getIp()) >= ip2long("10.227.0.0") && ip2long(getIP()) <= ip2long("10.227.0.19"))){
		MakeMenuItem("Enviar petici&oacute;n", "/Comunidad/Soporte/realizar.php");
		MakeMenuItem("Listado de Peticiones", "/Comunidad/Soporte/revisar.php");
		//if( !isset($_SESSION['sesionValida']) && getIP() == IP_ANGELA)
		MakeMenuItem("Estadisticas del Servicio", "/Comunidad/Soporte/estCalifSoporte.php");
		MakeMenuItem("Autenticaci&oacute;n", "/Comunidad/Soporte/autenticar.php");
		}
		if( isset($_SESSION['sesionValida']) ) 
		{
			MakeMenuItem("Peticiones en espera", "/Comunidad/Soporte/actualizar.php?mostrar=espera", false, $_GET['mostrar']=='espera');
			MakeMenuItem("Peticiones en atenci&oacute;n", "/Comunidad/Soporte/actualizar.php?mostrar=pendientes", false, $_GET['mostrar']=='pendientes');
			MakeMenuItem("Peticiones finalizadas", "/Comunidad/Soporte/actualizar.php?mostrar=finalizadas", false, $_GET['mostrar']=='finalizadas');
			MakeMenuItem("Reporte de Fallas", "/Comunidad/Soporte/listafallas.php", false, $_GET['mostrar']=='finalizadas');
			MakeMenuItem("Cerrar Sesi&oacute;n", "/Comunidad/Soporte/autenticar.php?cerrarSesion=t");
		}
	EndMenu();
//}


/*if ($_GET['submenu_empleos']) 
{*/
	MakeMenu('Bolsa de Empleos');
		MakeMenuItem("Lista de Empleos", "/Comunidad/BolsaEmpleos/index.php");
		if (getIP()=="192.168.220.90" || getIP()=="192.168.220.95" || getIP()=="192.168.220.126" || getIP()=="192.168.220.85" || getIP()=="192.168.220.61" || getIP()=="192.168.220.105") 
		{
			MakeMenuItem("Agregar una oferta", "/Comunidad/BolsaEmpleos/agregar.php");
			MakeMenuItem("Eliminar una oferta", "/Comunidad/BolsaEmpleos/eliminar.php");
		}
		MakeMenuItem("Version Imprimible", "/Comunidad/BolsaEmpleos/imprimible.php");
	EndMenu();
//}

/*if($_GET['submenu_control'])
{*/
	MakeMenu('Control Salas');
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
			
			if(getIP() == "192.168.220.126" || getIp() == "192.168.220.176" || getIP() == "10.222.24.226" || getIP() == "192.168.221.121" || getIP() == "192.168.221.145" || getIP() == "192.168.221.146" || (getIp() >= "192.168.220.0" && getIP() <= "192.168.220.225") )
			{
				MakeMenuItem("Reportes", "/Comunidad/Informatica/ControlUsuarios/reportes.php");
				MakeMenuItem("Reportes Tiempo Uso", "/Comunidad/Informatica/ControlUsuarios/reportesPorUsuario.php");
				MakeMenuItem("Estadisticas", "/Comunidad/Informatica/ControlUsuarios/estadisticas.php");
			}
			MakeMenuItem("Salir", "/Comunidad/Informatica/ControlUsuarios/salir.php");
		}
	EndMenu();
//}

if($_GET['submenu_asignacion'])
{
	MakeMenu('Asignaci&oacute;n Salas');
		MakeMenuItem("Inicio", "/Comunidad/Informatica/AsignacionSalas/index.php");
		MakeMenuItem("Instrucciones", "/Comunidad/Informatica/AsignacionSalas/instrucciones.php");
		if($_SESSION['profesor']['login'] == 'admseacd')
			MakeMenuItem("Horario Semanal", "/Comunidad/Informatica/AsignacionSalas/horario.php?sala=auditorio");
		else
			MakeMenuItem("Horario Semanal", "/Comunidad/Informatica/AsignacionSalas/horario.php");
		if($_SESSION['profesor']['permisos'] == 'total')
		{
			MakeMenuItem("Reservar", "/Comunidad/Informatica/AsignacionSalas/disponibilidad.php", false, ($PAGE_NAME == 'disponibilidad.php' || $PAGE_NAME == 'reserva.php' || $PAGE_NAME == 'extension.php'));
			MakeMenuItem("Cancelar", "/Comunidad/Informatica/AsignacionSalas/buscarClase.php", false, ($PAGE_NAME == 'buscarClase.php' || $PAGE_NAME == 'cancelar.php'));
			MakeMenuItem("Reservas", "/Comunidad/Informatica/AsignacionSalas/reservas.php");
			MakeMenuItem("Estadisticas", "/Comunidad/Informatica/AsignacionSalas/estadisticas.php");
			MakeMenuItem("Cancelaciones", "/Comunidad/Informatica/AsignacionSalas/cancelaciones.php");
		}
		else if($_SESSION['profesor']['login'] == 'admseacd')
		{
			MakeMenuItem("Reservar", "/Comunidad/Informatica/AsignacionSalas/disponibilidad.php?sala=auditorio", false, ($PAGE_NAME == 'disponibilidad.php' || $PAGE_NAME == 'reserva.php' || $PAGE_NAME == 'extension.php'));
			MakeMenuItem("Cancelar", "/Comunidad/Informatica/AsignacionSalas/buscarClase.php?sala=auditorio", false, ($PAGE_NAME == 'buscarClase.php' || $PAGE_NAME == 'cancelar.php'));
		}
		MakeMenuItem("Salir", "/Comunidad/Informatica/AsignacionSalas/salir.php");
	EndMenu();
}

if(isset($_SESSION['acceso']))
{
	MakeMenu('Test');
		MakeMenuItem("Salir", "/Comunidad/Idiomas/Test/index.php?salir=true");
	EndMenu();
}

/*if($_GET['submenu_idiomas'])
{*/
	MakeMenu('Aulas de Idiomas');
		MakeMenuItem("Inicio", "/Comunidad/Idiomas/index.php");
		MakeMenuItem("Conversation Club", "/Comunidad/Idiomas/conversationClub.php");
		MakeMenuItem("Cr&eacute;ditos", "/Comunidad/Idiomas/creditos.php");
		if( getIP() == IP_ANGELA ||  getIP() == "192.168.220.176" || ip2long(getIp()) >= ip2long("192.168.221.121") && ip2long(getIP()) <= ip2long("192.168.221.147") ) 
		{
			if(isset($_SESSION['usuario']))
			{
				if($_SESSION['usuario']['permisos'] == "limitado")
				{
					MakeMenuItem("Bit&aacute;cora", "/Comunidad/Idiomas/bitacora.php");
					MakeMenuItem("Presentaciones", "/Comunidad/documentos/PRESENTACION_LABORATORIO_Agosto_2010.ppsx", '_blank');
					MakeMenuItem("Sesiones", "/Comunidad/Idiomas/sesiones.php");	
					MakeMenuItem("Test", "/Comunidad/Idiomas/Test/test.php");
				}
				else
				{
					MakeMenuItem("Revisar Bit&aacute;coras", "/Comunidad/Idiomas/revisar.php", false, ($PAGE_NAME == 'revisar.php' || $PAGE_NAME == 'sesiones.php'));
					MakeMenuItem("Test", "/Comunidad/Idiomas/Test/index.php");
					MakeMenuItem("Notas", "/Comunidad/Idiomas/Test/notas.php");
				}
				
				MakeMenuItem("Salir", "/Comunidad/Idiomas/salir.php");
			}
		}
	EndMenu();
//}

/*if($_GET['submenu_memorias'])
{*/
	MakeMenu('Memorias');
		MakeMenuItem("Inicio", "/Comunidad/Memorias/index.php");
		MakeMenuItem("Salir", "/Comunidad/Memorias/index.php?salir=true;");///////////////////////////////////////////////////////////////
	EndMenu();
//}

/*if($_GET['submenu_documentos'])
{*/
	MakeMenu('Documentos');
		MakeMenuItem("Inicio", "index.php", false, 1);
		MakeMenuItem("Principal", "/Comunidad/Memorias/index.php");
		MakeMenuItem("Salir", "/Comunidad/Memorias/index.php?salir=true;");
	EndMenu();
//}

if($_GET['submenu_ecaes'])
{
	MakeMenu('Pruebas Piloto ECAES');
		MakeMenuItem("Inicio", "/Comunidad/ECAES/index.php");
		if(isset($_SESSION['invitado']))
			MakeMenuItem("Salir", "/Comunidad/ECAES/index.php?salir=true;");
	EndMenu();
}

if(getIP()==IP_DANIEL or getIP()==IP_GUILLERMO or getIP()==IP_D)
{
	if($_GET['submenu_pedidos'])
	{
		MakeMenu('Pedidos');
			MakeMenuItem('Nueva orden de pedido', "/Comunidad/Pedidos/index.php?item=1", false, $_GET['item']==1 or $_GET['item']==2);
			MakeMenuItem('Ver &oacute;rdenes de pedidos', "/Comunidad/Pedidos/index.php?item=3", false, $_GET['item']==3 or $_GET['item']==4 or $_GET['item']==5);
		EndMenu();
	}
}

/*if($_GET['submenu_inventario'])
{*/
	MakeMenu('Inventario');
		MakeMenuItem("Inicio", "/Comunidad/Inventario/index.php");
		if(isset($_SESSION['inventario']))
		{
			MakeMenuItem("Catalogo", "/Comunidad/Inventario/catalogo.php");
			MakeMenuItem("Inventario", "/Comunidad/Inventario/inventario.php");			
			MakeMenuItem("Ventas", "/Comunidad/Inventario/salidas.php");
			
			
			if($_SESSION['inventario']['permisos'] == 'administrador' || $_SESSION['inventario']['permisos'] == 'responsable')
			{
				MakeMenuItem("Donaciones", "/Comunidad/Inventario/donaciones.php");
				MakeMenuItem("Ingresar", "/Comunidad/Inventario/ingresos.php");
				MakeMenuItem("Consignar", "/Comunidad/Inventario/consignaciones.php");
				MakeMenuItem("Recibir Devoluci&oacute;n", "/Comunidad/Inventario/devoluciones.php");			
			}
			MakeMenuItem("Salir", "/Comunidad/Inventario/salir.php");
			
		}
	EndMenu();
	
	
	MakeMenu('Administraci�n Catalogo');
	if($_SESSION['inventario']['permisos'] == 'administrador' || $_SESSION['inventario']['permisos'] == 'responsable')
	{	
		
		MakeMenuItem("Agregar Existencia", "/Comunidad/Inventario/agregar.php");
		MakeMenuItem("Editar Existencia", "/Comunidad/Inventario/editar.php");
		MakeMenuItem("Eliminar Existencia", "/Comunidad/Inventario/eliminar.php");
		
	
	}
	if(getIP()==IP_ANGELA)
	{
		MakeMenuItem("Modificar Ventas", "/Comunidad/Inventario/modificarVentas.php");
				
	}
		MakeMenuItem("Reportes", "/Comunidad/Inventario/reportes.php");
	EndMenu();
//}

if($_GET['submenu_simulacro_ecaes'])
{
	MakeMenu("ECAES");
		MakeMenuItem("Registrados Simulacro ECAES", "/Comunidad/ECAES/bd_simulacro.php");
		MakeMenuItem("Subir respuestas ECAES", "/Comunidad/ECAES/respuestas.php");
		if( getIP()==IP_ANGELA || getIP() == IP_GUILLERMO)
			MakeMenuItem("Archivos respuestas ECAES", "/Comunidad/ECAES/lista_archivos.php");
		if(isset($_SESSION['ecaes']))
			MakeMenuItem("Cerrar Sesi&oacute;n", "/Comunidad/ECAES/salir.php");
	EndMenu();
}

/*if ($_GET['submenu_recursos']) 
{*/	
	MakeMenu('Inventario de Recursos');
	if( getIP() == IP_ANGELA || getIP() == IP_GUILLERMO || ip2long(getIp()) >= ip2long("192.168.221.121") && ip2long(getIP()) <= ip2long("192.168.221.147")) 
	{
		MakeMenuItem("Iniciar Seccion", "/Comunidad/Recursos/autenticar.php");
		if( isset($_SESSION['sesionValida']) ) 
		{
			MakeMenuItem("Ingresar Inventario", "/Comunidad/Recursos/inventario.php");
			MakeMenuItem("Listado de Inventario", "/Comunidad/Recursos/listado.php");
			MakeMenuItem("Cerrar Sesi&oacute;n", "/Comunidad/Recursos/autenticar.php?cerrarSesion=t");
		}
	}
	EndMenu();
//}

if ($_GET['submenu_agenda']) 
{	
	MakeMenu('Agenda de Auditorio');
	if( getIP() == IP_ANGELA ) 
	{

		MakeMenuItem("Consultar Agenda", "VerMes.php?item=2",false);
		if($_SESSION['usuario']['permisos'] == 'total')
		{
			MakeMenuItem("Agregar Evento", "VerMes.php?agregar=true",false);
			MakeMenuItem("Modificar o Eliminar Evento", "VerMes.php?editar=true", false);
			
		}

		MakeMenuItem("Cerrar Sesi&oacute;n", "inicioPrivado.php?item=6", false);
	}
	EndMenu();
}


/*if ($_GET['submenu_coord_admin']) 
{*/
	MakeMenu('Coordinaci�n administrativa');
	MakeMenuItem("Inicio", "/Comunidad/CoordinacionAdministrativa/index.php", false, $_GET['inicio']);
	
	if( getIP() == IP_ANGELA || getIP() == "192.168.220.176" || getIP() == "192.168.220.95" || ip2long(getIp()) >= ip2long("192.168.220.2") && ip2long(getIP()) <= ip2long("192.168.220.254"))

	MakeMenuItem("Administrar", "/Comunidad/CoordinacionAdministrativa/administrar.php", false, $_GET['administrar']);
	EndMenu();
//}
/*if ($_GET['egresados']) 
{*/
	MakeMenu('Egresados');
	MakeMenuItem("Inicio", "/Comunidad/Egresados/index.php", false, $_GET['inicio']);
	
	//if( getIP() == IP_ANGELA || getIP() == "192.168.220.176" || getIP() == "192.168.220.95" || getIp() >= "192.168.220.2" && getIP() <= "192.168.220.254")

	MakeMenuItem("Archivos", "/Comunidad/Egresados/archivos.php", false, $_GET['archivos']);
	MakeMenuItem("Administrar", "/Comunidad/Egresados/administrar.php", false, $_GET['administrar']);
	
	EndMenu();

	MakeMenu('Auditorios');
	MakeMenuItem("Disponibilidad Auditorio", "/Comunidad/Informatica/AsignacionAuditorio/calendarioMensual.php?opcion=1");
	if(getIP() == "192.168.220.126" || getIP() == "192.168.220.165" || getIP() == "192.168.220.176" || getIP() == "192.168.220.213" || 
		getIP() == "192.168.220.119" || getIP() == "192.168.221.63" || getIP() == "192.168.221.91" || getIP() == "192.168.221.121" || 
		getIP() == "192.168.221.145" || getIP() == "192.168.221.146" || getIP() == "192.168.221.143" || getIP() == "192.168.221.144" || 
		getIP() == "192.168.221.156" || getIP() == "192.168.220.98" || getIP() == "192.168.221.35" || getIp() ==  "192.168.220.3" || 
		getIp() == IP_ANGELA || getIp() ==  "192.168.205.43" || getIp() ==  "192.168.220.165" || (getIp() >= "192.168.220.2" && getIP() <= "192.168.220.225") )
		{
			MakeMenuItem("Asignaci&oacute;n de Auditorio ",  "/Comunidad/Informatica/AsignacionAuditorio/Formularios/ingresar.php");
			//MakeMenuItem("Asignaci&oacute;n de Auditorio",  "/Comunidad/Informatica/AsignacionSalas/index.php");
		}
	if(getIp()==IP_ANGELA)
		MakeMenuItem("Asignaci&oacute;n de Auditorio New",  "/Comunidad/Informatica/AsignacionAuditorio/Formularios/ingresar.php");
	EndMenu();
//}

/*
if ($_GET['submenu_actas']) 
{
	MakeMenu('Listas de Actas');
		MakeMenuItem("Inicio: Listas de Actas", "/Comunidad/Actas/index.php");
		MakeMenuItem("Actas del Consejo de Facultad", makeURL("/Comunidad/Actas/Consejo Facultad/index.php"), false, $_GET['actas_facultad']);
		MakeMenuItem("Actas del Comit&eacute; de Curr&iacute;culo", makeURL("/Comunidad/Actas/Comite Curriculo/index.php"), false, $_GET['actas_curriculo']);
		MakeMenuItem("Actas del Comit&eacute; de Contadur&iacute;a P&uacute;blica", "/Comunidad/Actas/Contaduria/index.php", false, $_GET['actas_contaduria']);
		MakeMenuItem("Actas de la Maestr&iacute;a en Administraci&oacute;n de Empresas y Ciencias de la Organizaci&oacute;n", "/Comunidad/Actas/MaAdmon/index.php", false, $_GET['actas_MaAdmon']);
		MakeMenuItem("Actas del comit&eacute; del Departamento de Contabilidad y Finanzas", "/Comunidad/Actas/Comite_contabilidad_finanzas/index.php");
		MakeMenuItem("Salir", "/Comunidad/Actas/index.php?item=s");
	EndMenu();
}
*/

MakeMenu();
	MakeMenuItem("Inicio Comunidad", "/Comunidad/index.php");
	MakeMenuItem("Información Financiera", "/Comunidad/informacion-financiera.php");
	MakeMenuItem("Proyectos 2010 - 2011", "/Comunidad/Proyectos/index.php", false, (isset($_GET['submenu_proyectos'])));
	MakeMenuItem("Actas de la Facultad", "/Comunidad/Actas/index.php", false, (isset($_GET['submenu_actas'])),'Listas de Actas');
	if(getIP()==IP_ANGELA || getIP() == IP_GUILLERMO){
		MakeMenuItem("Administraci&oacute;n Documentos Claustro", "/Comunidad/documentosClaustro/index.php",false,(isset($_GET['submenu_docClaustro'])),'Documentos Claustro');	
	}
	MakeMenuItem("Documento Claustro de Profesores Sep-13-2010", "/Comunidad/documentosClaustro/documentosC.php");	
	MakeMenuItem("Aulas Idiomas", "/Comunidad/Idiomas/index.php", false, (isset($_GET['submenu_idiomas'])),'Aulas de Idiomas');
	MakeMenuItem("Aulas Inform&aacute;ticas", "/Comunidad/Informatica/index.php", false, (isset($_GET['submenu_informatica']) || isset($_GET['submenu_control']) || isset($_GET['submenu_asignacion'])),'Aulas Inform�ticas');
	MakeMenuItem("Auditorios", "/Comunidad/Informatica/AsignacionSalas/horario.php",false,isset($_GET['egresados']),'Auditorios');
	MakeMenuItem("Bolsa de Empleos", "/Comunidad/BolsaEmpleos/index.php", false, isset($_GET['submenu_empleos']),'Bolsa de Empleos');
	MakeMenuItem("Correo Univalle", "/Comunidad/correo.php");
	//MakeMenuItem("Egresados", "/Comunidad/Egresados/", false, $_GET['egresados']);
	MakeMenuItem("Egresados", "/Comunidad/Egresados/index.php", false, isset($_GET['egresados']),'Egresados');
	MakeMenuItem("Enlaces de Inter&eacute;s", "/Comunidad/enlaces.php");
	MakeMenuItem("Galer&iacute;a de Fotos", "/Comunidad/galeria.php");
	MakeMenuItem("Himnos", "/Comunidad/himnos.php");
	if( getIP()==IP_ANGELA || getIP() == IP_GUILLERMO || getIP() == '192.168.220.93' || getIP() == '192.168.220.TODO' || getIP() == '192.168.220.85' || getIP() == '192.168.220.61'){
		//MakeMenuItem("Inventario", "/Comunidad/Inventario/index.php", false, isset($_GET['submenu_inventario']),'Inventario');
		//MakeMenuItem("Administracion Cat�logo", "/Comunidad/Inventario/index.php", false, isset($_GET['submenu_inventario']),'Administraci�n Catalogo');
		}
	if( substr(getIP(), 0, 12) == '192.168.220.' || substr(getIP(), 0, 12) == '192.168.221.') 
		//MakeMenuItem("Equipos Red Inalambrica", "/Comunidad/Wifi/autenticar.php", false, isset($_GET['submenu_wifi']));
 	
	MakeMenuItem("Memorias de Eventos", "/Comunidad/Memorias/index.php", false, (isset($_GET['menu_memorias']) || isset($_GET['submenu_memorias']) || isset($_GET['submenu_documentos'])),"Memorias");
	MakeMenuItem("Normativas y Resoluciones", "/Comunidad/normativas.php");
	
	if( substr(getIP(), 0, 12) == '192.168.220.' || substr(getIP(), 0, 12) == '192.168.221.') 
		MakeMenuItem("Inventario de Recursos", "/Comunidad/Recursos/autenticar.php", false, isset($_GET['submenu_recursos']),'Inventario de Recursos');
	
	//if( (getIp() >= "192.168.220.0" && getIP() <= "192.168.220.254") || (getIp() >= "192.168.221.0" && getIP() <= "192.168.221.254"))
		if( (ip2long(getIp()) >= ip2long("192.168.220.0") && ip2long(getIP()) <= ip2long("192.168.220.254")) || (ip2long(getIp()) >= ip2long("192.168.221.0") && ip2long(getIP()) <= ip2long("192.168.221.254")))
		MakeMenuItem("Petici&oacute;n de Soporte", "/Comunidad/Soporte/index.php", false, isset($_GET['submenu_solicitudes']),'Solicitudes de Soporte');
	
	if(getIp() == '192.168.220.126')
		MakeMenuItem("Asignaci&oacute;n Auditorio", "/Comunidad/Auditorio/index.php");
		

		
	MakeMenuItem("Coordinaci&oacute;n Administrativa", "/Comunidad/CoordinacionAdministrativa/index.php", false, isset($_GET['submenu_coord_admin']),'Coordinaci�n administrativa');
        
	
EndMenu();
?>
