<?
MakeMenu();
	/*MakeMenuItem("Inicio Comunidad", "/Comunidad/index.php");
	MakeMenuItem("Correo Univalle", "/Comunidad/correo.php");
	MakeMenuItem("Aulas Informáticas", "/Comunidad/Informatica/index.php", false, isset($_GET['submenu_informatica']));
	MakeMenuItem("Bolsa de Empleos", "/Comunidad/authentication.php?submenu_empleos=true", false, isset($_GET['submenu_empleos']));
	MakeMenuItem("Egresados", "/Comunidad/Egresados/");
	MakeMenuItem("Foro", "/Comunidad/Authenticate.php");
	MakeMenuItem("Actas de la Facultad", "/Comunidad/Actas/index.php", false, isset($_GET['submenu_actas']));
	MakeMenuItem("Galer&iacute;a de Fotos", "/Comunidad/galeria.php");
	MakeMenuItem("Normativas y Resoluciones", "/Comunidad/normativas.php");
	MakeMenuItem("Himnos", "/Comunidad/himnos.php");
	MakeMenuItem("Enlaces de Inter&eacute;s", "/Comunidad/enlaces.php");
	MakeMenuItem("Memorias de Eventos", "/Comunidad/Memorias/index.php", false, (isset($_GET['submenu_memorias'])));
	if( getIP()=='192.168.220.126' ) {
		MakeMenuItem("Petici&oacute;n de Soporte", "/Comunidad/Soporte/index.php", false, isset($_GET['submenu_solicitudes']));
	}*/
	MakeMenuItem("Inicio de laComunidad", "/Comunidad/index.php");
	MakeMenuItem("Información Financiera", "/Comunidad/informacion-financiera.php");
	MakeMenuItem("Actas de la Facultad", "/Comunidad/Actas/index.php", false, (isset($_GET['submenu_actas'])));
	//if(getIP()==IP_ANGELA || getIP() == IP_GUILLERMO)
	MakeMenuItem("Documento Claustro de Profesores Sep-13-2010", "/Comunidad/documentosClaustro/index.php?item=1");
	MakeMenuItem("Aulas Idiomas", "/Comunidad/Idiomas/index.php", false, (isset($_GET['submenu_idiomas'])));
	MakeMenuItem("Aulas Informáticas", "/Comunidad/Informatica/index.php", false, (isset($_GET['submenu_informatica']) || isset($_GET['submenu_control']) || isset($_GET['submenu_asignacion'])));
	MakeMenuItem("Bolsa de Empleos", "/Comunidad/BolsaEmpleos/index.php", false, isset($_GET['submenu_empleos']));
	MakeMenuItem("Correo Univalle", "/Comunidad/correo.php");
	MakeMenuItem("Egresados", "/Comunidad/Egresados/");
	MakeMenuItem("Enlaces de Inter&eacute;s", "/Comunidad/enlaces.php");
	MakeMenuItem("Galer&iacute;a de Fotos", "/Comunidad/galeria.php");
	MakeMenuItem("Himnos", "/Comunidad/himnos.php");
	if( getIP()==IP_ANGELA || getIP() == IP_GUILLERMO || getIP() == '192.168.220.93' || getIP() == '192.168.220.TODO')
		MakeMenuItem("Inventario", "/Comunidad/Inventario/index.php", false, isset($_GET['submenu_inventario']));
	MakeMenuItem("Memorias de Eventos", "/Comunidad/Memorias/index.php", false, (isset($_GET['menu_memorias']) || isset($_GET['submenu_memorias']) || isset($_GET['submenu_documentos'])));
	MakeMenuItem("Normativas y Resoluciones", "/Comunidad/normativas.php");
	if( getIP()==IP_ANGELA || getIP() == IP_GUILLERMO || getIP() == '192.168.220.93') 
		MakeMenuItem("Petici&oacute;n de Soporte", "/Comunidad/Soporte/index.php", false, isset($_GET['submenu_solicitudes']));
		/*
		Estudiantes  	SF-ESTUDIANTES  	221  	10.221.0.0/19
		Administrativos 	SF-ADMIN 		222 	10.222.0.0/19
		Docentes 	SF-DOCENTES 			223 	10.223.0.0/19
		Invitados 	SF-INVITADOS 			224 	10.224.0.0/19
		Labortorio y posgrado 	SF-POSTLAB 	225 	10.225.0.0/19
		Videoconferencia 	SF-VIDEOC 		226 	10.226.0.0/19
		Sistemas de informacion 	SF-SII 	227 	10.227.0.0/19
		*/
	if(getIP() == IP_ANGELA || getIP() == IP_GUILLERMO || getIP()=='10.221.0.0/19' || getIP()=='10.222.0.0/19' || getIP()=='10.223.0.0/19' || getIP()=='10.224.0.0/19' || getIP()=='10.225.0.0/19' ||getIP()== '10.226.0.0/19' || getIP()=='10.227.0.0/19 ')
		MakeMenuItem("Simulacro ECAES", "/Comunidad/ECAES/bd_simulacro.php", false, isset($_GET['submenu_simulacro_ecaes']));
	if(getIP()==IP_D or getIP()==IP_GUILLERMO or getIP()==IP_ANGELA || getIP() == '192.168.220.93')
	{
		MakeMenuItem("Órdenes de pedido", "/Comunidad/Pedidos/index.php?item=1", false, isset($_GET['submenu_pedidos']));		
	}
EndMenu();
?>
