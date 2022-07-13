<?
	/**MakeMenu('Lista Programas');
		MakeMenuItem("Pregrado", makeURL("/Programas/pregrados.php"), false, $_GET['programas_pregrado']);
                MakeMenuItem("Postgrado", makeURL("/Programas/postgrados.php"), false, $_GET['programas_postgrado']);
                MakeMenuItem("Programas de Extesion", makeURL("/Programas/Diplomados/Extension.php"), false, $_GET['programas_extension']);
	EndMenu();*/
	
        MakeMenu();
		MakeMenuItem("Inicio", "index.php");
                MakeMenuItem("La Facultad", "/Facultad/index.php", false, (isset($_GET['submenu_tipo'])));
                MakeMenuItem("Programas Acad&eacute;micos", "/Programas/index.php", false, (isset($_GET['submenu_programas'])), 'ListaTipoProgramas');
                MakeMenuItem("Profesores", "/Docentes/index.php");
                MakeMenuItem("Investigaci&oacute;n", "/GruposInv/inde.php");
                MakeMenuItem("Publicaciones", "/Publicaciones/index.php");
                MakeMenuItem("Comunidad", "/Comunidad/index.php");
		/*MakeMenuItem("Proyectos 2010 - 2011", "/Comunidad/Proyectos/index.php", false, (isset($_GET['submenu_proyectos'])));
		MakeMenuItem("Actas de la Facultad", "/Comunidad/Actas/index.php", false, (isset($_GET['submenu_actas'])),'Listas de Actas');
		if(getIP()==IP_ANGELA || getIP() == IP_GUILLERMO){
			MakeMenuItem("Administraci&oacute;n Documentos Claustro", "/Comunidad/documentosClaustro/index.php",false,(isset($_GET['submenu_docClaustro'])),'Documentos Claustro');	
		}
		MakeMenuItem("Documento Claustro de Profesores Sep-13-2010", "/Comunidad/documentosClaustro/documentosC.php");	
		MakeMenuItem("Aulas Informáticas", "/Comunidad/Informatica/index.php", false, (isset($_GET['submenu_informatica']) || isset($_GET['submenu_control']) || isset($_GET['submenu_asignacion'])),'Aulas Informaticas');
		MakeMenuItem("Auditorios", "/Comunidad/Informatica/AsignacionSalas/horario.php",false,isset($_GET['egresados']),'Auditorios');
		if(getIP()==IP_WEB_MASTER){ //jjcarmu
		    MakeMenuItem("Salones", "/Comunidad/Informatica/AsignacionSalones/horario.php", false, isset($_GET['egresados']),'Salones');
		}
		MakeMenuItem("Bolsa de Empleos", "/Comunidad/BolsaEmpleos/index.php", false, isset($_GET['submenu_empleos']),'Bolsa de Empleos');
		MakeMenuItem("Correo Univalle", "/Comunidad/correo.php");
		MakeMenuItem("Egresados", "/Comunidad/Egresados/index.php", false, isset($_GET['egresados']),'Egresados');
		MakeMenuItem("Enlaces de Inter&eacute;s", "/Comunidad/enlaces.php");
		MakeMenuItem("Galer&iacute;a de Fotos", "/Comunidad/galeria.php");
		MakeMenuItem("Himnos", "/Comunidad/himnos.php");
		MakeMenuItem("Memorias de Eventos", "/Comunidad/Memorias/index.php", false, (isset($_GET['menu_memorias']) || isset($_GET['submenu_memorias']) || isset($_GET['submenu_documentos'])),"Memorias");
		MakeMenuItem("Normativas y Resoluciones", "/Comunidad/normativas.php");
		if( substr(getIP(), 0, 12) == '192.168.220.' || substr(getIP(), 0, 12) == '192.168.221.') 
			MakeMenuItem("Inventario de Recursos", "/Comunidad/Recursos/autenticar.php", false, isset($_GET['submenu_recursos']),'Inventario de Recursos');
		//if((ip2long(getIp()) >= ip2long("192.168.220.1") && ip2long(getIP()) <= ip2long("192.168.220.254")) || (ip2long(getIp()) >= ip2long("192.168.221.1") && ip2long(getIP()) <= ip2long("192.168.221.254"))|| (ip2long(getIp()) >= ip2long("10.222.31.2") && ip2long(getIP()) <= ip2long("10.222.31.254"))
		//if(  getIP()==IP_GUILLERMO || (ip2long(getIp()) >= ip2long("192.168.220.0") && ip2long(getIP()) <= ip2long("192.168.220.254"))
		 //|| (ip2long(getIp()) >= ip2long("192.168.221.0") && ip2long(getIP()) <= ip2long("192.168.221.254"))){
			//MakeMenuItem("Petici&oacute;n de Soporte Inform&aacute;tico", "/Comunidad/Soporte/index.php", false, isset($_GET['submenu_solicitudes']),'Solicitudes de Soporte');
		 //}
		
		//jjcarmu, se dan permisos para que sea visto en cualquier ip por pruebas desde la oitel- 24-junio-2013
		if (getIP()==IP_GUILLERMO || (ip2long(getIp()) >= ip2long("192.168.220.0") && ip2long(getIP()) <= ip2long("192.168.220.254"))
		 || (ip2long(getIp()) >= ip2long("192.168.221.0") && ip2long(getIP()) <= ip2long("192.168.221.254"))|| ip2long((getIp()) >= ip2long("10.221.0.0" )&& ip2long(getIP()) <= ip2long("10.221.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.222.0.0") && ip2long(getIP()) <= ip2long("10.222.0.19"))|| (ip2long(getIp()) >= ip2long("10.223.0.0") && ip2long(getIP()) <= ("10.223.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.224.0.0") && ip2long(getIP()) <= ip2long("10.224.0.19"))|| (ip2long(getIp()) >= ip2long("10.225.0.0") && ip2long(getIP() )<= ip2long("10.225.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.226.0.0") && ip2long(getIP()) <= ip2long("10.226.0.19"))|| (ip2long(getIp()) >= ip2long("10.227.0.0") && ip2long(getIP()) <= ip2long("10.227.0.19"))){
		    	MakeMenuItem("Petici&oacute;n de Soporte Inform&aacute;tico", "/Comunidad/Soporte/index.php", false, isset($_GET['submenu_solicitudes']),'Solicitudes de Soporte');
		 }
		
		
		MakeMenuItem("Solicitudes de mantenimiento", "/Mantenimiento_sf/Formularios/ingreso.php");
		//if(getIp() == '192.168.220.126' || getIp() == IP_GUILLERMO || getIp() == '192.168.220.95' || getIp() == '192.168.220.97' || getIp() == IP_NELSON)
			MakeMenuItem("Coordinaci&oacute;n Administrativa", "/Comunidad/CoordinacionAdministrativa/index.php", false, isset($_GET['submenu_coord_admin']),'Coordinaci&oacute;n administrativa');
//		if(substr(getIP(), 0, 3)=='192' || substr(getIP(), 0, 2)=='10')
                    MakeMenuItem("Eventos en vivo", "/Comunidad/Streaming.php");
		    MakeMenuItem("Encuentro Regional de Estudiantes en Contadur&iacute;a P&uacute;blica", "/Comunidad/EncuentroRegionalContaduria/index.html");
		    MakeMenuItem("Ver Videos de la Facultad", "https://www.youtube.com/user/UnivalleCanalFCA");
		*/    
	EndMenu();
	
	/*
|| ip2long((getIp()) >= ip2long("10.221.0.0" )&& ip2long(getIP()) <= ip2long("10.221.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.222.0.0") && ip2long(getIP()) <= ip2long("10.222.0.19"))|| (ip2long(getIp()) >= ip2long("10.223.0.0") && ip2long(getIP()) <= ("10.223.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.224.0.0") && ip2long(getIP()) <= ip2long("10.224.0.19"))|| (ip2long(getIp()) >= ip2long("10.225.0.0") && ip2long(getIP() )<= ip2long("10.225.0.19"))
		 || (ip2long(getIp()) >= ip2long("10.226.0.0") && ip2long(getIP()) <= ip2long("10.226.0.19"))|| (ip2long(getIp()) >= ip2long("10.227.0.0") && ip2long(getIP()) <= ip2long("10.227.0.19"))
*/
	?>