<?php
/*
 * Devuelve el titulo de la pag segun la opcion recibida
 */

function tituloHorario($opcion) {
    switch ($opcion) {
	case 1:
	    $titulo = "Disponibilidad";
	    break;
	case 2:
	    $titulo = "Reservar";
	    break;
	case 3:
	    $titulo = "Cancelaciones";
	    break;
    }
    return $titulo;
}

/*
 * Calcula el color que respresenta la reserva en el calendario segun el tipo de reserva
 */

function calcularColorReserva($tipo_reserva) {
    switch ($tipo_reserva) {
	case 'Capacitacion':
	    $color = "#3399CC";
	    break;
	case 'Clase Unica':
	    $color = "#FFCC66";
	    break;
	case 'Clase Diplomado':
	    $color = "#FF8000";
	    break;
	case 'Practica Dirigida':
	    $color = "#B97BC4";
	    break;
	case 'Clase Postgrado':
	    $color = "#99CC00";
	    break;
	case 'Taller':
	    $color = "#006699";
	    break;
	case 'Clase Informatica':
	    $color = "#FF6666";
	    break;
    }
    return $color;
}

/*
 * Guarda en la db la reserva
 */

function guardarDBhead($fecha, $hora, $docente, $sala, $tipo_software, $tipo_reserva, $plan, $tipo_programa, $asignatura, $grupo, $no_estudiantes, $contenido) {
    DBConnect('controlsalas');
    // Guardar cabecera reserva
    $rs = db_query("insert into head_reserva 
				(fecha, hora, docente, sala, software, tipo_reserva, plan, tipo_programa,asignatura, grupo, estudiantes, contenido)
				values
				('$fecha', '$hora', '$docente', '$sala', '$tipo_software', '$tipo_reserva', '$plan','$tipo_programa','$asignatura',
				'$grupo', '$no_estudiantes', '$contenido')");
    if (!$rs) {
	return 'false';
    } else {
	$rs2 = db_query("select last_value from head_reserva_id_head_seq");
	$id = pg_fetch_object($rs2)->last_value;
	return $id;
    }
}

/*
 * Guarda en la db la reserva
 */

function guardarDBbody($fecha, $id_head, $horaI, $horaF, $sala, $color) {
    DBConnect('controlsalas');
    $rs2 = db_query("insert into body_reserva (id_head,fecha_reserva,hora_inicio,hora_final,estado)
					values ('$id_head','$fecha', '$horaI', '$horaF','activo')");
    if (!$rs2) {
	return false;
    } else {
	for ($hora = substr($horaI, 0, 2); $hora < substr($horaF, 0, 2); $hora++) {
	    $rs3 = db_query("insert into horario_salas(id_sala, fecha, hora, color, estado) values('" . $sala . "', '" . $fecha . "', '" . $hora . ":00:00', '" . $color . "','No Disponible');");
	}
	if (!$rs3) {
	    return false;
	} else {
	    return true;
	}
    }
}

function dateplus($date, $dd=0, $mm=0, $yy=0, $hh=0, $mn=0, $ss=0) {
    $date_r = getdate(strtotime($date));
    $date_result = date('Y-m-d', mktime(($date_r["hours"] + $hh), ($date_r["minutes"] + $mn), ($date_r["seconds"] + $ss), ($date_r["mon"] + $mm), ($date_r["mday"] + $dd), ($date_r["year"] + $yy)));
    return $date_result;
}

/*
 * Evalua que la en la fecha, hora, sala recibida no hayan otras reservas ya hechas. 
 */

function disponibilidadReserva($fecha, $hora1, $hora2, $sala) {
    DBConnect('controlsalas');
    $quer = db_query("select * from horario_salas where id_sala='$sala' and  fecha='$fecha' and 
							hora>='$hora1' and hora <'$hora2' and estado='No Disponible'");
    if (pg_num_rows($quer) > 0) {
	while ($infoReserva = pg_fetch_object($quer)) {
	    $error = ' ->  El ' . $infoReserva->fecha . ' a la ' . $infoReserva->hora . ' no se encuentra disponible <br>';
	}
	return $error;
    } else {
	return 'reservar';
    }
}

/* Evalua para el area de reserva de salas si el dia de la siguiente semana esta entre las fechas entregadas 
 * o no, si si, devuelve la fecha, sino devuelve false 
 */

function dia_sig_sem_valida($fecha1, $fecha2) {
    $fechaSig = date("Y-m-d", strtotime("+7 days", strtotime($fecha1)));
    if ($fechaSig > $fecha2) {
	return 'No existe';
    } else {
	return $fechaSig;
    }
}

function cambiarMes($date) {
    $meses = array("", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
    $month = (int) substr($date, 5, 2);
    $mes = $meses[$month];
    return $mes;
}

function cambiarMesCompleto($date) {
    $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $month = (int) substr($date, 5, 2);
    $mes = $meses[$month];
    return $mes;
}

function existe($cadena, $caracter) {
    if (strstr($cadena, $caracter))
	return true;
    else
	return false;
}

function getFileType($file) {
    $type = strtoupper(substr(strrchr($file, '.'), 1));

    return $type;
}

function monthTransform($date, $option) {
    $year = intval(splitDate($date, 'year'));
    $month = intval(splitDate($date, 'month'));

    switch ($option) {
	case 'next':
	    if ($month == 12) {
		$month = 1;
		$year++;
	    }
	    else
		$month++;
	    break;
	case 'before':
	    if ($month == 1) {
		$month = 12;
		$year--;
	    }
	    else
		$month--;
	    break;
    }

    if ($month < 10)
	$month = "0" . $month;

    return $year . "-" . $month . "-01";
}

function startMonth($date) {
    $year = splitDate($date, 'year');
    $month = splitDate($date, 'month');

    return $year . "-" . $month . "-01";
}

function endMonth($date) {
    $year = splitDate($date, 'year');
    $month = splitDate($date, 'month');
    $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    return $year . "-" . $month . "-" . $day;
}

function splitDate($date, $option) {
    switch ($option) {
	case 'year':
	    $result = substr($date, 0, 4);
	    break;
	case 'month':
	    $result = substr($date, 5, 2);
	    break;
	case 'day':
	    $result = substr($date, 8, 2);
	    break;
    }

    return $result;
}

function getNextRequestNumber() {
    DBConnect('fayol');
    $result = db_query("select max(numero) from pedidos");
    $queryValue = pg_fetch_object($result);
    $r = $queryValue->max + 1;
    if ($r == "")
	$r = 1;
    return $r;
}

function toFormat($number) {
    $stringNumber == "";
    if ($number < 10) {
	$stringNumber = "00" . $number;
    }
    if ($number >= 10 && $number < 100) {
	$stringNumber = "0" . $number;
    }
    if ($number >= 100) {
	$stringNumber = "" . $number;
    }
    return $stringNumber;
}

# Funciones varias

function validFilenamen($filename) {
    //return preg_match("/^[[:alnum:]. ]+$/i", $filename);
    return preg_match("/^[[:alnum:]. ]+$/i", $filename);
}

/* This doesn't allow .exe files */

function validFilename($filename) {
    print($filename);
    //$valid = preg_match("/^[[:alnum:]. ]+$/i", $filename);
    $valid = preg_match("/^[[:alnum:]. ]+$/i", $filename);
    if ($valid) {
	if (substr($filename, -3, 3) == 'exe') {
	    $valid = false;
    	    echo " <script> 
		   alert('No se permiten archivos con extencion .exe');
		   </script>
	    ";
	}
    }else{
	echo "	<script> 
		   alert('El nombre del archivo solo debe ser alfanumerico');
		</script>
	    ";
    }
    return $valid;
}

function printOK($message) {
    echo "<P STYLE='text-align:center; color:green'><B>" . parseHtml($message) . "</B></P>";
}

function printError($message) {
    echo "<P STYLE='text-align:center; color:#DD0000;'><B>" . parseHtml($message) . "</B></P>";
}

function parseHtml($texto) {
    $patterns = array ();
    $patterns[] = '/á/';
    $patterns[] = '/é/';
    $patterns[] = '/í/';
    $patterns[] = '/ó/';
    $patterns[] = '/ú/';
    
    $patterns[] = '/Á/';
    $patterns[] = '/É/';
    $patterns[] = '/Í/';
    $patterns[] = '/Ó/';
    $patterns[] = '/Ú/';
    
    $patterns[] = '/ñ/';
    $patterns[] = '/Ñ/';
    $patterns[] = '/"/';
//    $patterns[] = '/&/';
    
    $replacements = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;',
			  '&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;',
			  '&ntilde;', '&Ntilde;', '&quot;', '&amp;');
    
    return preg_replace($patterns, $replacements, $texto);
}

function makeHtml($texto) {
    $texto = parseHtml($texto);
    $texto = preg_replace("/\n/", "<br>", $texto);
    return $texto;
}

function NewLinesToHtml($texto) {
    return preg_replace("\n", "<br>", $texto);
}

function Titulo($text) {
    echo "<H2>" . parseHtml($text) . "</H2>";
}

function getDocente($login) {
    $rs = pg_query("select * from profesores where login='$login'");
    if (pg_num_rows($rs) == 0)
	return 0;
    return pg_fetch_object($rs);
}

function getDocenteByMailLogin($mailLogin) {
    $rs = pg_query("select * from profesores where mail like '$mailLogin@%univalle.edu.co'");
    if (pg_num_rows($rs) == 0)
	return 0;
    return pg_fetch_object($rs);
}

function getDocenteBySerial($serial) {
    $rs = pg_query("select * from profesores where serial='$serial'");
    if (pg_num_rows($rs) == 0)
	return 0;
    return pg_fetch_object($rs);
}

function getDocenteSerial($serial) {
    DBConnect("profesores");
    $rs = db_query("select * from profesores where serial='$serial'");
    if (!pg_numrows($rs))
	return 0;
    return pg_fetch_object($rs);
}

function getIP() {
    # Si el computador esta detras de un proxy, cojo la direccion del computador, no la del proxy
    if ($for = getenv('HTTP_X_FORWARDED_FOR')) {
	$tmp = explode(",", $for);
	return trim($tmp[0]);
    }
    return getenv('REMOTE_ADDR');
}

function DateiSize($DateiName) {
    $size = filesize($DateiName);

    #Selecciono el formato en el que devolvere el tama�o
    if ($size < 1024)
	return $size . " bytes";
    else
	return round($size / 1024) . " Kb";
}

function DirSize($dirName) {
    $dir = @opendir($dirName);
    if (!$dir)
	return 0;

    while ($file = readdir($dir)) {
	if ($file == '.' || $file == '..')
	    continue;
	if (@dir("$dirName/$file")) {
	    $size += DirSize("$dirName/$file");
	} else {
	    $info = stat("$dirName/$file");
	    $size += $info['size'];
	}
    }
    return $size;
}

#
# Esta funcion lista todas las entradas del directorio $DirName, es decir
# todos los archivos y directorios que estan dentro de el, colocando un
# icono adecuado para representar cada entrada.
#
# Para permitir la manipulacion de estas entradas, es decir, colocar enlaces
# sobre los iconos de las entradas, de manera que un archivo pueda ser
# descargado y un directorio pueda ser explorado (con esta misma funci�n),
# se deben suplir 1 argumento mas a esta funcion: la pagina destino de todos
# los enlaces a directorios.
#
# La pagina $linkPage debe tener uno de estos dos formatos: 'pagina.php?' o 'pagina.php?var=4&'
# esta pagina es llamada pasandole una variable GET llamada EntryClicked.
# Esta variable es un indice sobre el array de parejas $_SESSION['entradas'],
# cada pareja contiene el nombre de una de las entradas que fueron listadas en [0]
# y su tipo: directorio (true) o archivo (false), en [1].
#
# Adicionalmente, se entrega otra variable GET que indica la accion a tomar sobre el
# elemento seleccionado: OpenDirectory, RemoveDirectory o RemoveFile
#
# El parametro $AllowGoUp se refiere a si debe darse la posibilidad de ir al directorio
# padre, osea ..
#
# Retorna true si habia algun directorio o archivo en la carpeta listada (sin contar a ..)
#
# { PRE: Debe habere una sesi�n iniciada }
# { POS: El contenido de $_SESSION['entradas'] es reemplazado por la lista de las nuevas entradas }

#
	function GraphicLSAdmin($DirName, $linkPage, $AllowGoUp = false, $aplicacion='Docentes') {
    global $rootPath;

    unset($_SESSION[$aplicacion]['entradas']);

    $dir = @opendir($DirName);

    # Si el folder no existe lo creo
    if (!$dir) {
	mkdir($DirName);
	chmod($DirName, 0770);
	chgrp($DirName, "nobody");
	$dir = opendir($DirName);
    }
    ?>
    <br>
    <center>
        <table width="80%" border="0">
	    <?php
	    $numEntrada = 0;

	    # Si les debo brindar a los usuarios la oportunidad de ir a la carpeta padre
	    if ($AllowGoUp) {
		$numEntrada++;
		$_SESSION[$aplicacion]['entradas'][] = array('..', true);
		?>
		<tr>
		    <td align="center" colspan="4">
			<a href="<?php echo ${linkPage} ?>OpenDirectory&amp;EntryClicked=0"><b>Ir a la carpeta superior</b></a>
		    </td>
		</tr>
		<?php
	    }

	    # Primero listo las entradas que son directorios
	    while ($directorio = readdir($dir)) {
		# Si es un directorio oculto lo ignoro
		if ($directorio[0] == '.')
		    continue;

		# Listar solo si es un directorio
		if (@opendir("$DirName/$directorio")) {
		    ?>
	    	<tr>
	    	    <td width="50" align="center">
	    		<img src="/Images/CarpetaBig.jpg" border="0" alt="">
	    	    </td>
	    	    <td width="30">&nbsp;</td>
	    	    <td><b><?php echo $directorio ?></b></td>
	    	    <td align="center">
	    		<a href="<?php echo ${linkPage} ?>OpenDirectory&amp;EntryClicked=<?php echo ${numEntrada} ?>"><b>Abrir</b></a>
	    		&nbsp;&nbsp;&nbsp;<a href="<?php echo ${linkPage} ?>RemoveDirectory&amp;EntryClicked=<?php echo ${numEntrada} ?>"><b>Eliminar</b></a>
	    	    </td>
			<?php
			$numEntrada++;
			$_SESSION[$aplicacion]['entradas'][] = array($directorio, true);
		    }
		}

		rewinddir($dir);
		# Luego listo las entradas que son archivos

		while ($archivo = readdir($dir)) {
		    if ($archivo[0] == '.')
			continue;
		    # Listar solo si es un archivo
		    if (!@opendir("$DirName/$archivo")) {
			# Dependiendo de la extension del archivo muestro una imagen
			$extension = strtoupper(substr(strrchr($archivo, '.'), 1));
			# Selecciono el icono del documento dependiendo de su extension			  
			$imagen = (@file("$rootPath/Images/${extension}File.jpg")) ? "${extension}File.jpg" : "WNFile.jpg";
			?>
			    <tr>
				<td align="center">
				    <img border="0" src="/Images/<?php echo $imagen ?>" alt="">
				</td>
				<td width="30">&nbsp;</td>
				<td>
				    <b><?php echo $archivo ?></b>
				    <br><?php echo DateiSize("$DirName/$archivo"); ?>
				</td>
				<td align="center">
				    <a href="<?php echo ${linkPage} ?>RemoveFile&amp;EntryClicked=<?php echo $numEntrada; ?>">
					<b>Eliminar</b>
				    </a>
				</td>
			    </tr>
		<?php
		    $numEntrada++;
		    $_SESSION[$aplicacion]['entradas'][] = array($archivo, false);
		    continue;
		}
	    }
	    echo "</TABLE></CENTER>";
	    closedir($dir);

	    if ($AllowGoUp == false)
		return ($numEntrada != 0);
	    else
		return ($numEntrada > 1);
	}

	#
	# Igual que GraphicLSAdmin pero no brinda la posibilidad de eliminar directorios ni archivos,
	# solo permite abrir directorios y descargar archivos. $_SESSION[entradas] contendra solo
	# nombres de Directorios

	#
	function GraphicLS($DirName, $linkPage, $AllowGoUp = false, $aplicacion='Docentes') {
	    global $rootPath;

	    unset($_SESSION[$aplicacion]['entradas']);

	    $dir = @opendir($DirName);

	    # Si el folder no existe lo creo
	    if (!$dir) {
		echo "Directory " . $DirName . " created  ";

		/* if($aplicacion == 'Programas')
		  {
		  mkdir("prueba");
		  } */

		mkdir($DirName);
		chmod($DirName, 0770);
		chgrp($DirName, "nobody");
		$dir = opendir($DirName);
	    }
	    ?>
    	<br/>
    	<center>
    	    <table width="80%" border="0">
    		<tr><td></td></tr>
		    <?php
		    $numEntrada = 0;

		    # Si les debo brindar a los usuarios la oportunidad de ir a la carpeta padre
		    if ($AllowGoUp) {
			$numEntrada++;
			$_SESSION[$aplicacion]['entradas'][] = array('..', true);
			?>
			<tr>
			    <td align="center" colspan="4">
				<a href="<?= ${linkPage} ?>OpenDirectory&amp;EntryClicked=0"><b>Ir a la carpeta superior</b></a>
				<br>&nbsp;
			    </td>
			</tr>
			<?php
		    }

		    # Primero listo las entradas que son directorios
		    while ($directorio = readdir($dir)) {
			# Si es un directorio oculto lo ignoro
			if ($directorio[0] == '.')
			    continue;

			# Listar solo si es un directorio
			if (@opendir("$DirName/$directorio")) {
			    ?>
	    		<tr>
	    		    <td width="50" align="center">
	    			<a href="<?= ${linkPage} ?>OpenDirectory&amp;EntryClicked=<?= ${numEntrada} ?>">
	    			    <img src="/Images/CarpetaBig.jpg" border="0" alt=""></a>
	    		    </td>
	    		    <td width="30">&nbsp;</td>
	    		    <td>
	    			<a href="<?= ${linkPage} ?>OpenDirectory&amp;EntryClicked=<?= ${numEntrada} ?>">
	    			    <b><?= $directorio ?></b>
	    			</a>
	    		    </td>
	    		</tr>
			    <?php
			    $numEntrada++;
			    $_SESSION[$aplicacion]['entradas'][] = array($directorio, true);
			}
		    }

		    rewinddir($dir);
		    # Luego listo las entradas que son archivos
		    while ($archivo = readdir($dir)) {
			if ($archivo[0] == '.')
			    continue;
			# Listar solo si es un archivo
			if (!@opendir("$DirName/$archivo")) {
			    # Dependienedo de la extension del archivo muestro una imagen
			    $extension = strtoupper(substr(strrchr($archivo, '.'), 1));

			    # Selecciono el icono del documento dependiendo de su extension			  
			    $imagen = (@file("$rootPath/Images/${extension}File.jpg")) ? "${extension}File.jpg" : "WNFile.jpg";
			    ?>
	    		<tr>
	    		    <td align="center">
	    			<a href="<?= makeURL("$DirName/$archivo") ?>">
	    			    <img border="0" src="/Images/<?= $imagen ?>" alt=""></a>
	    		    </td>
	    		    <td width="30">&nbsp;</td>
	    		    <td>
	    			<a href="<?= makeURL("$DirName/$archivo") ?>"><b><?= $archivo ?></b></a>
	    			<br><?php echo DateiSize("$DirName/$archivo"); ?>
	    		    </td>

	    		    <td>
				    <?php echo `cat "$DirName/.ABOUT.$archivo"`; ?>
	    		    </td>
	    		</tr>
			    <?php
			    $numEntrada++;
			    continue;
			}
		    }

		    echo "</TABLE></CENTER>";
		    closedir($dir);

		    if ($AllowGoUp == false)
			return ($numEntrada != 0);
		    else
			return ($numEntrada > 1);
		}

# Devuelve el correo del usuario

		function autenticarUsuario($login, $passwd) {
		    // INICIO PILAR AVILA: LDAP Est� presentado problemas, se pone directamente autenticando login y password = estudiante
		    /*
		      $ds = @ldap_connect("ldap://libertad.univalle.edu.co/");
		      if(!$ds)
		      return 0;

		      if(!ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3))
		      {
		      echo "Failed to set LDAP Protocol version to 3, TLS not supported.<p>";
		      return 0;
		      }

		      # Aqui es donde realmente se verifica la clave
		      $bind = @ldap_bind($ds,"uid=$login,ou=Usuarios,dc=univalle,dc=edu,dc=co","$passwd");
		      //echo ldap_error($ds);
		      if(!$bind)
		      return 0;

		      # De aqui en adelante ya es hacer busquedas, etc, no es necesario
		      $atributos = array("mail");
		      $result = @ldap_search($ds,"uid=$login,ou=Usuarios,dc=univalle,dc=edu,dc=co","cn=*");
		      $info = @ldap_get_entries($ds, $result);
		      ldap_close($ds);
		      return $info[0]["mail"][0];

		     */ // FIN PILAR AVILA: LDAP Est� presentado problemas, se pone directamente autenticando login y password = estudiante
		    if ($login == "estudiante" && $passwd == "estudiante") {
			return "estudiante@univalle.edu.co";
		    }



		    // ALEJANDRO Agregar para que los de bolsas de empleos se puedan autenticar
		    if ($login == "empleos" && $passwd == "empleos2001")
			return true;

		    return false;
		}

		/*
		 * Registra en la base de datos los usuarios autenticasdos para visualizar material de apoyo 
		 * (solo es posible un solo registro por autenticado, asi el estudiante haya visitado material de otros profesores)
		 */

		function registroDBingresoUsuarios($loginEst) {

		    $con = @DBConnect('new_fayol');
		    if (!empty($con)) {

			$fecha = date("Y-m-d");
			$time = date("H:i:s");
			$datetime = date("Y-m-d H:i:s");
			//IP
			$ip = getIP();
			//URL de procedencia de la visita 				
			$procedencia = $HTTP_REFERER;
			if ($procedencia == "") {
			    $procedencia = "directamente de la pagina";
			}
			$navegador = "Otro";
			// Detecci�n del navegador 
			$ua = getBrowser();
			$agente = $ua['userAgent'];
			$navegador = $ua['name'];
			$so = $ua['platform'];
			//Registro en la base de datos
			/* $consulta="insert into usua_autent_material_prof (ip, fecha, hora_inicio,navegador,sistema_operativo,procedencia, ultimo_acceso, is_logged_in) 
			  values ('$ip','$fecha','$time','$navegador','$so','$procedencia','$datetime','1')";
			  db_query($consulta);
			  $consulta2="select id from usua_autent_material_prof where ip='$ip' and fecha='$fecha' and hora_inicio='$time' and navegador='$navegador' and sistema_operativo='$so' and procedencia='$procedencia'";
			  $rs = db_query($consulta2);
			  $obj = pg_fetch_object($rs);
			  $idRegistro=$obj->id;
			  return $idRegistro;
			 */

			//Registro en la base de datos
			$consulta = "insert into usua_autent_material_prof (ip, fecha, hora_inicio,navegador,sistema_operativo,procedencia, ultimo_acceso, is_logged_in,login) 
				values ('$ip','$fecha','$time','$navegador','$so','$procedencia','$datetime','1','$loginEst')";
			db_query($consulta);
			$consulta2 = "select id from usua_autent_material_prof where ip='$ip' and fecha='$fecha' and hora_inicio='$time' and navegador='$navegador' and sistema_operativo='$so' and procedencia='$procedencia' and login ='$loginEst'";
			$rs = db_query($consulta2);
			$obj = pg_fetch_object($rs);
			$idRegistro = $obj->id;
			return $idRegistro;
		    }
		}

		function registroDBcierreSeccion($idRegistro) {
		    $con = @DBConnect('new_fayol');
		    if (!empty($con)) {
			$fecha = date("Y-m-d");
			$time = date("H:i:s");
			if ($idRegistro != '') {
			    pg_query("UPDATE usua_autent_material_prof SET hora_salida ='$time', fecha_salida='$fecha', is_logged_in='0' WHERE id =$idRegistro");
			}
		    }
		}

		function getBrowser() {
		    $u_agent = $_SERVER['HTTP_USER_AGENT'];
		    $bname = 'Unknown';
		    $platform = 'Unknown';
		    $version = "";

		    //First get the platform?
		    if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		    } elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		    }

		    // Next get the name of the useragent yes seperately and for good reason
		    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		    } elseif (preg_match('/Firefox/i', $u_agent)) {
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		    } elseif (preg_match('/Chrome/i', $u_agent)) {
			$bname = 'Google Chrome';
			$ub = "Chrome";
		    } elseif (preg_match('/Safari/i', $u_agent)) {
			$bname = 'Apple Safari';
			$ub = "Safari";
		    } elseif (preg_match('/Opera/i', $u_agent)) {
			$bname = 'Opera';
			$ub = "Opera";
		    } elseif (preg_match('/Netscape/i', $u_agent)) {
			$bname = 'Netscape';
			$ub = "Netscape";
		    }


		    return array(
			'userAgent' => $u_agent,
			'name' => $bname,
			'platform' => $platform,
		    );
		}

		function autenticarUsuarios($login, $passwd) {

		    // INICIO PILAR AVILA: LDAP Est� presentado problemas, se pone directamente autenticando login y password = estudiante
		    /*
		      $ldaphost = "ldap://libertad.univalle.edu.co/";
		      $ds=ldap_connect("$ldaphost") or die( "Could not connect to {$ldaphost}" );
		      if ($ds)
		      {
		      if (!ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3))
		      {
		      echo "Failed to set LDAP Protocol version to 3, TLS not supported.<p>";
		      }
		      // Aqui es donde realmente se verifica la clave
		      $bind=@ldap_bind($ds,"uid=$login,ou=Usuarios,dc=univalle,dc=edu,dc=co","$passwd");
		      if (!$bind)
		      {
		      return "";
		      }
		      // De aqui en adelante ya es hacer busquedas, etc, no es necesario
		      $atributos = array("mail");
		      $nombrediuser="$login";
		      $result=@ldap_search($ds,"uid=$nombrediuser,ou=Usuarios,dc=univalle,dc=edu,dc=co","cn=*");
		      $info = @ldap_get_entries($ds, $result);
		      $email=$info[0]["mail"][0];
		      /* list ($aliasLogin,$aliasServidor) = split("@",$email);
		      return $aliasServidor; */
		    /*    }
		      ldap_close($ds);
		      return $email;

		      // FIN PILAR AVILA: LDAP Est� presentado problemas, se pone directamente autenticando login y password = estudiante

		      if ($login=="estudiante" && $passwd=="estudiante")
		      {
		      return "estudiante@univalle.edu.co";
		      }
		     */
		    /*
		     * Nuevo sistema de autenticacion de usuarios para la consulta de material de profesores
		     * La contrase�a y login sera localizada en la tabla estudiantes de la base de datos controlsalas
		     * Enero - 18 -2011
		     * Andrea Cordoba -webmaster (dalatinrofrau@gmail.com)
		     */
		    /* if ($login=="estudiante" && $passwd=="estudiante")
		      {
		      return "0000000";
		      }else{ */
		    $con = @DBConnect('controlsalas');
		    $login1 = pg_escape_string($login);
		    $passwd1 = pg_escape_string($passwd);
		    $rs = db_query("SELECT codigo from estudiantes where login='$login1' and password='$passwd1' ");
		    $obj = pg_fetch_object($rs);
		    $result = $obj->codigo;
		    if ($result != '') {
			return $result;
		    }
		}

		function MailLink($correo) {
		    return "<A HREF=\"#\" onClick=\"window.open('/SendMailAuth.php?destinatario=$correo', '', 'toolbar=no,directories=no,menubar=no,status=no,width=410,height=310')\">$correo</A>";
		}

		function FechaActual() {
		    $fecha = date("F j of Y");
		    $fecha = preg_replace("January", "ENERO", $fecha);
		    $fecha = preg_replace("February", "FEBRERO", $fecha);
		    $fecha = preg_replace("March", "MARZO", $fecha);
		    $fecha = preg_replace("April", "ABRIL", $fecha);
		    $fecha = preg_replace("May", "MAYO", $fecha);
		    $fecha = preg_replace("June", "JUNIO", $fecha);
		    $fecha = preg_replace("July", "JULIO", $fecha);
		    $fecha = preg_replace("August", "AGOSTO", $fecha);
		    $fecha = preg_replace("September", "SEPTIEMBRE", $fecha);
		    $fecha = preg_replace("October", "OCTUBRE", $fecha);
		    $fecha = preg_replace("November", "NOVIEMBRE", $fecha);
		    $fecha = preg_replace("December", "DICIEMBRE", $fecha);

		    $fecha = preg_replace("of", "DE", $fecha);
		    return $fecha;
		}

		function MarcoInit($titulo, $color, $width='100%') {
		    $titulo = parseHtml($titulo);
		    echo "<table width='$width' BGCOLOR=\"$color\" CELLPADDING='3'>
          <tr><td><CENTER><FONT STYLE=\"font-size:11pt;\"><B>$titulo</B></FONT></CENTER></td></tr>
          <tr><td BGCOLOR=WHITE>";
		}

		function Succeded($desc, $width='90%') {
		    echo "<BR><table width='$width' BGCOLOR='green' CELLPADDING='3'>
           <tr><td bgcolor='white'><CENTER><FONT STYLE='font-size:11pt; color:green;'><B>$desc</B></FONT></CENTER></td></tr>
           </table><BR>";
		}

		function Failed($desc, $width='90%') {
		    echo "<BR><table width='$width' BGCOLOR='#CC0000' CELLPADDING='3'>
           <tr><td bgcolor='white'><CENTER><FONT STYLE='font-size:11pt; color:#CC0000;'><B>$desc</B></FONT></CENTER></td></tr>
           </table><BR>";
		}

		function MarcoEnd() {
		    echo "</td></tr></table>";
		}

		function BorderInit($color="white", $width="100%") {
		    echo "<table width=\"$width\" BGCOLOR=\"$color\" CELLPADDING='3' border=\"0\">
          <tr>
		  	<td BGCOLOR='WHITE'>
			";
		}

		function BorderEnd() {
		    echo "
	</td></tr></table>";
		}

		function hasRareChars($texto) {
		    # true si alguno de los caracteres raros esta en la cadena $texto
		    return!((bool) (strcspn($texto, "������������#") == strlen($texto)));
		}

		function Cell($text, $width='100%') {
		    $text = parseHtml($text);
		    /*
		      <CENTER>
		      <TABLE BORDER="0" WIDTH="<?php= $width ?>" cellpadding="0" cellspacing="0">
		      <TR bgcolor="#104a7b" height="5"><TD></TD></TR>
		      <TR>
		      <TD BGCOLOR="#D0DEE9">
		      <FONT STYLE="font-size:11pt;" COLOR="black"><CENTER><B><?php= $text ?></B></CENTER></FONT>
		      </TD>
		      </TR>
		      <TR bgcolor="#104a7b" height="5"><TD></TD></TR>
		      </TABLE>
		      </CENTER>
		     */
		    echo "<h1>$text</h1>";
		}

		function SeccionProgramaAcademico($texto) {
		    echo Titulo($texto, '#104a7b', '95%', 'white');
		}

		function SeccionInit($texto, $halign='center', $rojo=true) {
		    ?>
    		<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
    		    <TR>
    			<TD WIDTH="9" VALIGN="TOP" BGCOLOR="<?= $rojo ? '#CC0000' : '#999999' ?>"><IMG SRC="/Images/plantilla/esquina<?= $rojo ? 'roja.jpg' : 'gris.gif' ?>" WIDTH="9" HEIGHT="14"></TD>
    			<TD ALIGN="<?= $halign ?>" BGCOLOR="<?= $rojo ? '#CC0000' : '#999999' ?>" CLASS="titulos"><?= $texto ?></TD>
    			<TD WIDTH="9" BGCOLOR="<?= $rojo ? '#CC0000' : '#999999' ?>"></TD>
    		    </TR>
    		    <TR>
    			<TD COLSPAN="3" BGCOLOR="#f2f2f2">
    			    <TABLE WIDTH="100%" BORDER="0" ALIGN="CENTER" BGCOLOR="<?= $rojo ? '#CC6666' : '#999999' ?>" CELLPADDING="0" CELLSPACING="1">
    				<TR><TD>
    					<TABLE WIDTH="100%" BORDER="0" ALIGN="CENTER" BGCOLOR="#f2f2f2" CELLPADDING="5" CELLSPACING="5">
    					    <TR><TD>
							<?php
						    }

						    function SeccionEnd() {
							?>
    						</TD></TR>
    					</TABLE>
    				    </TD></TR>
    			    </TABLE>
    			</TD>
    		    </TR>
    		</TABLE>

		    <?php
		}

		function WriteLog($file, $line, $string) {
		    $fd = fopen(WEB_ERROR_LOG, "a");
		    fwrite($fd, $string);
		    fwrite($fd, "\nAt File: $file\nAtLine: $line\nAt time: " . (date('d-m-Y, D H:i:s', time())) . "\n\n\n");
		    fclose($fd);
		}

		function ultima_actualizacion() {
		    return makeMonth(date('Y-m-d'));
		}

		function makeDate($date) {
		    list ($year, $m, $day) = preg_split('[-]', $date);

		    if (strlen($day) == 2 && $day[0] == 0) {
			$day = $day[1];
		    }

		    $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		    $month = $meses[(int) $m];
		    $fecha = $day . " de " . $month . " de " . $year;
		    return $fecha;
		}

		function makeMonth($date) {
		    list ($year, $m, $day) = preg_split('/[-]/', $date);

		    if (strlen($day) == 2 && $day[0] == 0) {
			$day = $day[1];
		    }

		    $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		    $month = $meses[(int) $m];
		    $fecha = $month . " de " . $year;
		    return $fecha;
		}

		function esCodigo($codigo) {
		    $digitos = strlen($codigo);
		    if ($digitos != 9 && $digitos != 10)
			return false;
		    else
			return true;
		}

		function parseTilde($texto) {
		    $texto = preg_replace("á", "a", $texto);
		    $texto = preg_replace("é", "e", $texto);
		    $texto = preg_replace("í", "i", $texto);
		    $texto = preg_replace("ó", "o", $texto);
		    $texto = preg_replace("ú", "u", $texto);

		    $texto = preg_replace("Á", "A", $texto);
		    $texto = preg_replace("É", "E", $texto);
		    $texto = preg_replace("Í", "I", $texto);
		    $texto = preg_replace("Ó", "O", $texto);
		    $texto = preg_replace("Ú", "U", $texto);

		    return $texto;
		}

		function makeURL($texto) {
		    $texto = preg_replace("/ /", "%20", $texto);
		    $texto = preg_replace("/ñ/", "%F1", $texto);

		    return $texto;
		}

//Suma 2 tiempos 
		function timeadd($time1, $time2) {
		    $time_r1 = getdate(strtotime($time1));
		    $time_r2 = getdate(strtotime($time2));

		    $time_result = date("H:i:s", mktime(($time_r1["hours"] + $time_r2["hours"]), ($time_r1["minutes"] + $time_r2["minutes"]), ($time_r1["seconds"] + $time_r2["seconds"])));

		    return $time_result;
		}
		?>