<?
	# Definicion de constantes para Fayol
	$FacuTitle = "Facultad de Ciencias de la Administraci&oacute;n";
	$QUOTA_MATERIAL_APOYO = 50*1024*1024; #50 Megas APARTIR DEL 24-03-2011

	/*Sistema anterior. Realizado por Daniel Wilches*/
	/*$codigosNedStat = array(
	                 'ACjgfQ8SVh4WgawYZkNgKPkHOB7A', 'ACjgfg0zECtolJwcq5lUvoTqvO9A',
	                 'ACjgfwN3LMI3+UXiIMlySTwFmwmQ', 'ACjggQtktvBR09Nra7yjTeKRlg1g',
					 'ACjgggKpiSLYSslq0QP4ZN+L5GbA', 'ACjggwxWa4Srru4T/kc3w417g46g',
					 'ACjghQ/b2rKe21nKA/uC6Ej0iDfg', # Hasta aqui, pestañas
					 'ACvUsQ0Q+85ltdgEs815cciwnUGg', # Esta es de la pagina de material de apoyo
					 'AC4uuQp7yX3T0ZoKnBaxuYy7DHxg'  # Esta es la pagina de Acreditacion
					 );*/
	
	/*Sistema actual. Realizado por Juan Camilo*/
	$codigosNedStat = array(
	                 'ADilZwPsJKB+vAAPZ1vHUeNyDNFw', 'ADilaQIkV+ETjNF1N30ECT1tr2ag',
	                 'ADilbA2sLCLpSsOTIDbjLLEffglw', 'ADilbgj4X+qU0oG30dty5oD2qkxw',
					 'ADilbwbE4E/JAT2AcBN9QemJQGbA', 'ADilcAWfMj0uebMPiEzotEVkHT5w',
					 'ADilcQF6AtWa4WMPtEoWzHlBHYwA', # Hasta aqui, pestañas
					 'ADiljANsL0KGJ33d3oAYSvCGOKyg', # Esta es de la pagina de material de apoyo
					 'ADiljwDJhW5p+4eUuynsRProYKBA', # Esta es la pagina de Acreditacion
					 'ADiliQ+kpFNtCIAKYdtLF1pwgWQA', # Esta es de la pagina de docentes
					 'ADilkgEvo5Tg2mm38iP3Xmf88oOw', # Programa de administración de empresas
					 'ADillAshpoZzHDisBDJZWXt558ZA', # Programa de contaduría pública
					 'ADillgxazwod8gvXNuiR1wPeKixQ', # Programa de comercio exterior
					 'ADillwUz5pBEDiUxYnuWEKGWWjUQ', # Programa de tecnología en gestión ejecutiva
					 'ADiloARZ0oYEUfgtfOSKlIodIjLw', # Programa de magisadm 14
					 'ADilog1lLBVPSx3nqB7FxH85GzVQ', # Programa de magisorg 15
					 'ADilowK8w15lnCYBIbkpTZdyDjwg', # Programa de magispol 16
					 'ADilpAx5Xg30wUSl53O+htArkmFg', # Programa de espefinanzas 17
					 'ADilpQ+Z8rtkI3ANwys0CoWaDz+Q', # Programa de espemarket 18
					 'ADilpgWJ2U5zTr7L5YO1lXMAR0qA', # Programa de especalidad 19
					 'ADilpwHO9gBU8sccWts/cSwv0aEg', # Programa de espeadmon 20
					 'ADilqAeg8q6A7TrcXhiQouvlcCHQ', # Programa de espepolitica 21
					 'ADipgQb/XHj4FmLyO4jRfHr+2lyw', # Créditos del portal
					 'ADipsw9TLvkotDiSRZswEzWxX+7Q', # Material público
					 'ADi4YwrKKsJEhLLwUU4IU+gvdvBg', # Dip
					 'ADi4ZAFGzOEp30JjLjRuTSX//m4Q', # Dip
					 'ADi4ZgSHPnrKdF5KzmbOTCXPuU8w', # Dip
					 'ADi4aARNV5DEPNHziz9PJD1z3I1Q', # Dip
					 'ADi4bAImDm4eE0E3gg1yF2w9WkGA', # Dip
					 'ADi4bgqt2446wC+zDBCRPNx2DcMw', # Dip
					 'ADi4cQllK6rwFVFuPD4KuxycgUXA', # Dip
					 'ADi4cgXb51UZb3olaW/qcdyV+H9A', # Dip
					 'ADi4dAQQyUkQ+gP+gsyosaur92Vw', # Dip
					 'ADi4dgFtGT2RowKLs0Egy4ule1LQ', # Dip
					 'ADi4eQhJ7Y+mV7N71GOZrPTH/OYw', # Dip
					 'ADi4eweU6YSd9oDKas6SahOWYWUg', # Dip
					 'ADi4fQp1ThuHHubhQYSV4+iEe1Pg', # Dip
					 'ADi4fwoqtnUYOtTQDouCwBqRcaqQ', # Dip
					 );
	
	$colors = array( 'red' => '#CC0000', 'pink' => '#CC6666', 'gray' => '#999999' );
	
	define('IP_GUILLERMO', '192.168.220.176');
	define('IP_DANIEL',    '192.168.220.126');
	define('IP_ANGELA',    '192.168.220.126');
	define('IP_NELSON',    '192.168.220.213');
	define('IP_DIEGO',    '192.168.220.165');
	define('IP_WEB_MASTER',    '192.168.220.126');
	//define('IP_CONTADORA',    '192.168.220.126');
	define('IP_D',    '192.168.220.95');
	
	# Constantes para realizar la conexion a la BD
	# Gracias a esto puedo tener varias versiones de fayol corriendo con bases de datos independientes
	define('DATABASE_HOST', 'localhost');
	
	define('DATABASE_USER', 'internet');
	define('DATABASE_PASS', 'Ocarina$');
	
	//define('DATABASE_USER', 'postgres');
	//define('DATABASE_PASS', 'w_f4y01');
	
	define('DATABASE_PORT', '5432');
	
	define ('IMAGEN_ACTAS', '<IMG SRC="/Images/folder-actas.jpg" WIDTH="48" HEIGHT="46" alt="">');
	define ('IMAGEN_ACTAS_MINI', '<IMG SRC="/Images/mini-folder-actas.jpg" alt="">');
	
	#define('WEB_ERROR_LOG', 'C:\\Web_Fayol_Mirror_Log.log');
	define('WEB_ERROR_LOG', '/tmp/Web_Fayol_Mirror_Log.log');
	
	preg_match('/^[a-z_0-9]+\.php/i', $_SERVER['PHP_SELF'], $registros);
	$PAGE_NAME = $registros[0];
	
	define('PASS_ECAES', 'ndj415');
?>