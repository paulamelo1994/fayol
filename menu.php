<?
	MakeMenu('Listas de Actas');
		MakeMenuItem("Actas del Consejo de Facultad", makeURL("/Comunidad/Actas/Consejo Facultad/index.php"), false, $_GET['actas_facultad']);
		MakeMenuItem("Actas del Comit&eacute; de Curr&iacute;culo", makeURL("/Comunidad/Actas/Comite Curriculo/index.php"), false, $_GET['actas_curriculo']);
		MakeMenuItem("Actas de Claustro", makeURL("/Comunidad/Actas/Claustro/index.php"), false, $_GET['actas_claustro']);
		MakeMenuItem("Actas del Comit&eacute; de Contadur&iacute;a P&uacute;blica", "/Comunidad/Actas/Contaduria/index.php", false, $_GET['actas_contaduria']);
		MakeMenuItem("Actas de Comit&eacute; de posgrados", "/Comunidad/Actas/Comite Posgrados/index.php", false, $_GET['actas_posgrados']);
		MakeMenuItem("Actas de la Maestr&iacute;a en Administraci&oacute;n de Empresas y Ciencias de la Organizaci&oacute;n", "/Comunidad/Actas/MaAdmon/index.php", false, $_GET['actas_MaAdmon']);
		MakeMenuItem("Actas del comit&eacute; del Departamento de Contabilidad y Finanzas", "/Comunidad/Actas/Comite_contabilidad_finanzas/index.php");
		MakeMenuItem("Actas del Departamento de Administraci&oacute;n y Organizaciones", "/Comunidad/Actas/DepAdminOrgan/index.php");
		MakeMenuItem("Normas y Conceptos Jur&iacute;dicos de Inter&eacute;s", "/Comunidad/Actas/Juridico/index.php", false, $_GET['conceptos_juridicos']);
		if(  getIP()==IP_GUILLERMO || getIp()==IP_ANGELA  || getIp()=='192.168.220.213'){
			MakeMenuItem("Administrar Documentos Jur&uacute;dicos", "/Comunidad/Adm");
			MakeMenuItem("Administrador Actas Facultad", "/Comunidad/Actas/Administrador/autenticar.php");
		}
	EndMenu();
	
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

	MakeMenu('Aulas Informaticas');
		MakeMenuItem("Informaci&oacute;n General", "/Comunidad/Informatica/index.php");
		MakeMenuItem("Descarga de Software", "/Comunidad/Informatica/software.php");
		MakeMenuItem("Disponibilidad Salas de C&oacute;mputo", "/Comunidad/Informatica/itemHorario.php?item=0&pagina=1", false, $_GET['pagina']==1);
		MakeMenuItem("Reglamento de uso", "/Comunidad/Files/Reglamento%20salas.pdf", '_BLANK');
		MakeMenuItem("Nuestros Recursos Tecnol&oacute;gicos", "/Facultad/DocumentoderecursosaOctubre2012.pdf", "_blank");
		MakeMenuItem("Miembros Equipo Soporte Sistemas", "/Comunidad/Informatica/miembros.php");
		if(getIP() == "10.222.31.252" || getIP() == "192.168.220.126" || getIP() == "192.168.220.165" || getIP() == "192.168.220.176" || getIP() == "192.168.220.213" || 
		getIP() == "192.168.220.119" || getIP() == "192.168.221.63" || getIP() == "192.168.221.91" || getIP() == "192.168.221.121" || 
		getIP() == "192.168.221.145" || getIP() == "192.168.221.146" || getIP() == "192.168.221.143" || getIP() == "192.168.221.144" || 
		getIP() == "192.168.221.156" || getIP() == "192.168.220.98" || getIP() == "10.222.24.226" || getIP() == "192.168.221.35" || getIp() ==  "192.168.220.3" || 
		getIp() == IP_ANGELA || getIp() ==  "192.168.205.43" || getIp() ==  "192.168.220.165" || (getIp() >= "192.168.220.2" && getIP() <= "192.168.220.225") )
		{
			MakeMenuItem("Control de salas",  "/Comunidad/Informatica/ControlUsuarios/control.php");
		}
		if(getIp() == IP_ANGELA || getIP()==IP_GUILLERMO || getIP() == "10.222.24.226" || getIP()==IP_NELSON ){
			MakeMenuItem("Ver Disponibilidad Salas", "/Comunidad/Informatica/AsignacionSalas/calendarioMensual.php");
			MakeMenuItem("Administrar Salas", "/Comunidad/Informatica/AsignacionSalas/Formularios/ingresar.php");
		}
	EndMenu();
//OJO AQUI organizar peticion soporte---  jjcarmu 24-junio-2013 se dan permisos para la oitel
	MakeMenu('Solicitudes de Soporte');
		MakeMenuItem("Inicio", "/Comunidad/Soporte/index.php");
                MakeMenuItem("Enviar petici&oacute;n", "/Comunidad/Soporte/realizar.php");
                //echo "IP: "+ (ip2long("192.168.220.255"));
		if(getIP()==IP_GUILLERMO 
                    || (ip2long(getIp()) >= ip2long("192.168.220.0") && ip2long(getIP()) <= ip2long("192.168.220.255"))
                    || (ip2long(getIp()) >= ip2long("192.168.221.0") && ip2long(getIP()) <= ip2long("192.168.221.255")) 
                    || (ip2long(getIp()) >= ip2long("10.221.0.0") && ip2long(getIP()) <= ip2long("10.221.0.255"))
                    || (ip2long(getIp()) >= ip2long("10.222.0.0") && ip2long(getIP()) <= ip2long("10.222.0.255")) 
                    || (ip2long(getIp()) >= ip2long("10.223.0.0") && ip2long(getIP()) <= ip2long("10.223.0.255"))
                    || (ip2long(getIp()) >= ip2long("10.224.0.0") && ip2long(getIP()) <= ip2long("10.224.0.255")) 
                    || (ip2long(getIp()) >= ip2long("10.225.0.0") && ip2long(getIP()) <= ip2long("10.225.0.255"))
                    || (ip2long(getIp()) >= ip2long("10.226.0.0") && ip2long(getIP()) <= ip2long("10.226.0.255")) 
                    || (ip2long(getIp()) >= ip2long("10.227.0.0") && ip2long(getIP()) <= ip2long("10.227.0.255"))){
			//
			MakeMenuItem("Listado de Peticiones", "/Comunidad/Soporte/revisar.php");
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

	MakeMenu('Bolsa de Empleos');
		MakeMenuItem("Lista de Empleos", "/Comunidad/BolsaEmpleos/index.php");
		/*if (getIP()=="192.168.220.90" || getIP()=="192.168.220.95" || getIP()=="192.168.220.126" || getIP()=="192.168.220.85" || getIP()=="192.168.220.61" || getIP()=="192.168.220.105") 
		{*/
			MakeMenuItem("Agregar una oferta", "/Comunidad/BolsaEmpleos/agregar.php");
			MakeMenuItem("Eliminar una oferta", "/Comunidad/BolsaEmpleos/eliminar.php");
		//}
		MakeMenuItem("Version Imprimible", "/Comunidad/BolsaEmpleos/imprimible.php");
	EndMenu();
	
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
			
			if(getIP() == "192.168.1.1" || getIP() == "192.168.220.126" || getIp() == "192.168.220.176" || getIP() == "192.168.221.121" || getIP() == "192.168.221.145" || getIP() == "192.168.221.146" || (getIp() >= "192.168.220.0" && getIP() <= "192.168.220.225") )
			{
				MakeMenuItem("Reportes", "/Comunidad/Informatica/ControlUsuarios/reportes.php");
				MakeMenuItem("Reportes Tiempo Uso", "/Comunidad/Informatica/ControlUsuarios/reportesPorUsuario.php");
				MakeMenuItem("Estadisticas", "/Comunidad/Informatica/ControlUsuarios/estadisticas.php");
			}
			MakeMenuItem("Salir", "/Comunidad/Informatica/ControlUsuarios/salir.php");
		}
	EndMenu();
	
	/*if($_GET['submenu_asignacion'])
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
	}*/

	if(isset($_SESSION['acceso']))
	{
		MakeMenu('Test');
			MakeMenuItem("Salir", "/Comunidad/Idiomas/Test/index.php?salir=true");
		EndMenu();
	}

	/*MakeMenu('Aulas de Idiomas');
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
	EndMenu();*/
	
	MakeMenu('Memorias');
		MakeMenuItem("Inicio", "/Comunidad/Memorias/index.php");
		MakeMenuItem("Salir", "/Comunidad/Memorias/index.php?salir=true;");
	EndMenu();
	
	MakeMenu('Documentos');
		MakeMenuItem("Inicio", "index.php", false, 1);
		MakeMenuItem("Principal", "/Comunidad/Memorias/index.php");
		MakeMenuItem("Salir", "/Comunidad/Memorias/index.php?salir=true;");
	EndMenu();


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
	
	MakeMenu('Administraci&oacute;n Catalogo');
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
	
	/*if ($_GET['submenu_agenda']) 
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
	}*/


	MakeMenu('Coordinaci&oacute;n administrativa');
		MakeMenuItem("Inicio", "/Comunidad/CoordinacionAdministrativa/index.php", false, $_GET['inicio']);
		if(  getIP() == IP_NELSON || getIP()==IP_GUILLERMO || getIP() == "192.168.220.76" || getIP() == "192.168.220.176" || getIP() == "192.168.220.95" || getIP()==IP_ANGELA)
		{MakeMenuItem("Administrar", "/Comunidad/CoordinacionAdministrativa/administrar.php", false, $_GET['administrar']);}
	EndMenu();

	MakeMenu('Egresados');
		MakeMenuItem("Inicio", "/Comunidad/Egresados/index.php", false, $_GET['inicio']);
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
			}
	EndMenu();
	
	MakeMenu();
		MakeMenuItem("Inicio Comunidad", "/Comunidad/index.php");
		MakeMenuItem("Información Financiera", "/Comunidad/informacion-financiera.php");
		MakeMenuItem("Proyectos 2010 - 2011", "/Comunidad/Proyectos/index.php", false, (isset($_GET['submenu_proyectos'])));
		MakeMenuItem("Actas de la Facultad", "/Comunidad/Actas/index.php", false, (isset($_GET['submenu_actas'])),'Listas de Actas');
		if(getIP()==IP_ANGELA || getIP() == IP_GUILLERMO){
                    MakeMenuItem("Administraci&oacute;n Documentos Claustro", "/Comunidad/documentosClaustro/index.php",false,(isset($_GET['submenu_docClaustro'])),'Documentos Claustro');	
		}
		MakeMenuItem("Documento Claustro de Profesores Sep-13-2010", "/Comunidad/documentosClaustro/documentosC.php");	
		MakeMenuItem("Aulas Informáticas", "/Comunidad/Informatica/index.php", false, (isset($_GET['submenu_informatica']) || isset($_GET['submenu_control']) || isset($_GET['submenu_asignacion'])),'Aulas Informaticas');
		MakeMenuItem("Auditorios", "/Comunidad/Informatica/AsignacionSalas/horario.php",false,isset($_GET['egresados']),'Auditorios');
		if(getIP()==IP_WEB_MASTER){ //jjcarmu
		    MakeMenuItem("Salones", "/Comunidad/Informatica/AsignacionSalones/calendarioMensual.php", false, isset($_GET['egresados']),'Salones');
		}
		MakeMenuItem("Bolsa de Empleos", "/Comunidad/BolsaEmpleos/index.php", false, isset($_GET['submenu_empleos']),'Bolsa de Empleos');
		//MakeMenuItem("Correo Univalle", "/Comunidad/correo.php");
		MakeMenuItem("Egresados", "/Comunidad/Egresados/index.php", false, isset($_GET['egresados']),'Egresados');
		MakeMenuItem("Enlaces de Inter&eacute;s", "/Comunidad/enlaces.php");
		
		MakeMenuItem("Memorias de Eventos", "/Comunidad/Memorias/index.php", false, (isset($_GET['menu_memorias']) || isset($_GET['submenu_memorias']) || isset($_GET['submenu_documentos'])),"Memorias");
		MakeMenuItem("Normativas y Resoluciones", "/Comunidad/normativas.php");
                //if(getIp() == '192.168.220.126' || getIp() == IP_GUILLERMO || getIp() == '192.168.220.95' || getIp() == '192.168.220.97' || getIp() == IP_NELSON)
			MakeMenuItem("Coordinaci&oacute;n Administrativa", "/Comunidad/CoordinacionAdministrativa/index.php", false, isset($_GET['submenu_coord_admin']),'Coordinaci&oacute;n administrativa');
		if( substr(getIP(), 0, 12) == '192.168.220.' || substr(getIP(), 0, 12) == '192.168.221.'){ 
			MakeMenuItem("Inventario de Recursos", "/Comunidad/Recursos/autenticar.php", false, isset($_GET['submenu_recursos']),'Inventario de Recursos');
                }
                // MakeMenuItem("Solicitudes de mantenimiento", "/Mantenimiento_sf/Formularios/ingreso.php"); 
		//if((ip2long(getIp()) >= ip2long("192.168.220.1") && ip2long(getIP()) <= ip2long("192.168.220.254")) || (ip2long(getIp()) >= ip2long("192.168.221.1") && ip2long(getIP()) <= ip2long("192.168.221.254"))|| (ip2long(getIp()) >= ip2long("10.222.31.2") && ip2long(getIP()) <= ip2long("10.222.31.254"))
		//if(  getIP()==IP_GUILLERMO || (ip2long(getIp()) >= ip2long("192.168.220.0") && ip2long(getIP()) <= ip2long("192.168.220.254"))
		 //|| (ip2long(getIp()) >= ip2long("192.168.221.0") && ip2long(getIP()) <= ip2long("192.168.221.254"))){
			//MakeMenuItem("Petici&oacute;n de Soporte Inform&aacute;tico", "/Comunidad/Soporte/index.php", false, isset($_GET['submenu_solicitudes']),'Solicitudes de Soporte');
		 //}
		
		//jjcarmu, se dan permisos para que sea visto en cualquier ip por pruebas desde la oitel- 24-junio-2013
                // no se elimina el códido de restricción de ip's por posible utilización posterior y se deja true en la condición del if.
		if ( true 
                    // getIP()==IP_GUILLERMO
                    /*|| (ip2long(getIp()) >= ip2long("192.168.220.0") && ip2long(getIP()) <= ip2long("192.168.220.255"))
                    || (ip2long(getIp()) >= ip2long("192.168.221.0") && ip2long(getIP()) <= ip2long("192.168.221.255"))
                    || (ip2long(getIp()) >= ip2long("10.221.0.0" )&& ip2long(getIP()) <= ip2long("10.221.0.255"))
                    || (ip2long(getIp()) >= ip2long("10.222.0.0") && ip2long(getIP()) <= ip2long("10.222.0.255"))
                    || (ip2long(getIp()) >= ip2long("10.223.0.0") && ip2long(getIP()) <= ip2long("10.223.0.255"))
                    || (ip2long(getIp()) >= ip2long("10.224.0.0") && ip2long(getIP()) <= ip2long("10.224.0.255"))
                    || (ip2long(getIp()) >= ip2long("10.225.0.0") && ip2long(getIP() )<= ip2long("10.225.0.255"))
                    || (ip2long(getIp()) >= ip2long("10.226.0.0") && ip2long(getIP()) <= ip2long("10.226.0.255"))
                    || (ip2long(getIp()) >= ip2long("10.227.0.0") && ip2long(getIP()) <= ip2long("10.227.0.255*))*/){
		    	MakeMenuItem("Petici&oacute;n de Soporte Inform&aacute;tico", "/Comunidad/Soporte/index.php", false, isset($_GET['submenu_solicitudes']),'Solicitudes de Soporte');
		 }
		
		
		
		
//		if(substr(getIP(), 0, 3)=='192' || substr(getIP(), 0, 2)=='10')
                    MakeMenuItem("Himnos", "/Comunidad/himnos.php");
                    MakeMenuItem("Mapas Campus", "http://www.univalle.edu.co/mapas/index.html");
                    MakeMenuItem("Ver Videos de la Facultad", "https://www.youtube.com/user/UnivalleCanalFCA");
                    MakeMenuItem("Galer&iacute;a de Fotos", "/Comunidad/galeria.php");
                    MakeMenuItem("Eventos en vivo", "/Comunidad/Streaming.php");
		     //MakeMenuItem("Encuentro Regional de Estudiantes en Contadur&iacute;a P&uacute;blica", "/Comunidad/EncuentroRegionalContaduria/index.html");
		    
		    
	EndMenu();
	
	/*
|| ip2long((getIp()) >= ip2long("10.221.0.0" )&& ip2long(getIP()) <= ip2long("10.221.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.222.0.0") && ip2long(getIP()) <= ip2long("10.222.0.19"))|| (ip2long(getIp()) >= ip2long("10.223.0.0") && ip2long(getIP()) <= ("10.223.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.224.0.0") && ip2long(getIP()) <= ip2long("10.224.0.19"))|| (ip2long(getIp()) >= ip2long("10.225.0.0") && ip2long(getIP() )<= ip2long("10.225.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.226.0.0") && ip2long(getIP()) <= ip2long("10.226.0.19"))|| (ip2long(getIp()) >= ip2long("10.227.0.0") && ip2long(getIP()) <= ip2long("10.227.0.19"))
*/
	?>


