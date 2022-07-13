<?php
	/********************************************************
	Aplicacion: Control Salas
	Archivo: control.php
	Objetivo: Modulo de autenticacion de la aplicacion.
				Autentica la entrada de datos para el acceso a la aplicacion y determina si da o no acceso a la misma.
				En caso de que el usuario validado sea uno de los administradores permite que se seleccione 
				cualquiera de las salas para ver su progreso en el momento.
				Analiza y determina a partir de la IP de conexion desde que sala se accede y lista solo la informacion
				referente a ella.
	Autor: Angela Benavides
	A&ntilde;o: 2006
	*********************************************************/
	
	session_start();
	
	$rootPath = '../../..';
	require '../../../functions.php';
	date_default_timezone_set('GMT-4'); //Establece zona horaria, evita desfaces
		
	$_GET['submenu_informatica'] = true;
	
	//echo "<br>antes autenticar ".$_SESSION['idsala'];
	
	if($_POST['autenticar'])
	{			
		$conexion = DBConnect('controlsalas');
		
		if(!conexion)
		{
			header("Location: /Comunidad");
			die();
		}
		$login=pg_escape_string($_POST['Login']);
		$pass=pg_escape_string($_POST['Password']);
		$rs = db_query("SELECT * FROM monitor WHERE login= '$login' and password = '$pass' and activo='true'");
		
		$filas = pg_num_rows($rs);
		if($filas)
		{
			$obj = pg_fetch_object($rs);
			$login = $_POST['Login'];
			$_SESSION['monitor'] = $login;
			$_SESSION['nombrem'] = $obj->nombre;
			$_SESSION['apellidom'] = $obj->apellido;
			$_SESSION['ultimoAcceso'] = date("Y-n-j H:i:s"); 
			
			$IP = getIP();
			$sala = null;
			
			$_GET['submenu_control'] = true;
			$_GET['submenu_informatica'] = null;
			
			switch($IP)
			{
				//IP mia
				case '192.168.220.126':
					$sala = "Pendiente";
					$_SESSION['idsala'] = $sala;
					$_GET['item_login'] = true;
					break;
				//IP Guillermo
				case '192.168.220.176':
					$sala = "Pendiente";
					$_SESSION['idsala'] = $sala;
					$_GET['item_login'] = true;
					break;
					//IP Nelson
				case '192.168.220.213':
					$sala = "Pendiente";
					$_SESSION['idsala'] = $sala;
					$_GET['item_login'] = true;
					break;
				case '192.168.220.119':
					$sala = 1;
					$_SESSION['idsala'] = $sala;
					break;
				case '192.168.221.63':
					$sala = 2;
					$_SESSION['idsala'] = $sala;
					break;
				case '192.168.221.91':
					$sala = 4;
					$_SESSION['idsala'] = $sala;
					break;
				case '192.168.221.121':
					$sala = "idiomas";
					$_SESSION['idsala'] = $sala;
					break;
				/*case '192.168.221.145':
					$sala = "idiomas";
					$_SESSION['idsala'] = $sala;
					break;
				case '192.168.221.146':
					$sala = "idiomas";
					$_SESSION['idsala'] = $sala;
					break;*/ 
				 case '10.222.31.252':
					$sala = "CUSE";
					$_SESSION['idsala'] = $sala;
					break;
				default:
					$sala = "CUSE";
                    $_SESSION['idsala'] = $sala;
                    $_GET['item_login'] = true;
					break;
		    }
		}
		else
		{
			echo "<script language=\"Javascript\" >
			 	alert(\"Nombre de usuario o contrase&ntilde;a incorrectos.\");
                </script>";
		}
	}
	
	//echo "<br>antes  select sala ".$_SESSION['idsala'];
	if($_GET['sala'])
	{
		$sala = $_GET['sala'];
		$_SESSION['idsala'] = $sala;
		$_GET['submenu_control'] = true;
		$_GET['item_login'] = false;
		$_GET['submenu_informatica'] = null;
	}
	
	//echo "<br>antes select salaII ".$_SESSION['idsala'];
	if(!isset($_SESSION['monitor']))
	{
		PageInit("Asignaci&oacute;n de Equipos", '../../menu.php');
?>
		<H1 CLASS="shiny">Autenticaci&oacute;n Requerida</H1>
		<P>Esta &aacute;rea de nuestra p&aacute;gina esta restringida solo para el uso de los monitores de las salas, no hay raz&oacute;n para que un usuario com&uacute;n necesite acceder a estas p&aacute;ginas, es m&aacute;s, ni siquiera deber&iacute;a estar viendo este mensaje.</P>
		<P>Para ingresar al &aacute;rea de control de las salas por favor ingrese abajo su clave de autenticaci&oacute;n.</P>
		<p>Recuerde: Su sesi&oacute;n caducar&aacute; si hay inactividad cada 15 minutos.</p>
		<center>
		<form method="post" action="control.php" name="autenticacion" enctype="multipart/form-data">
		<table cellpadding="2" cellspacing="2">
		<tr>
			<td width="50">LOGIN:</td>
			<td width="50"><INPUT TYPE=TEXT NAME="Login" value=""></td>
		</tr>
		<tr>
			<td>PASSWORD:</td>
			<td><INPUT type= password  NAME="Password" value=""></td>
		</tr>
		<tr>
			<td colspan="2">
			<div align="center">
			<input name="autenticar" type="submit" value="Autenticar Usuario">
			</div>
			</td>
		</tr>
		</table>
		</form>
		</center>
<?
		PageEnd();
		die();
	}
	
	if(isset($_SESSION['monitor']))
	{
		//echo "".$_SESSION['idsala'];
		$fechaGuardada = $_SESSION['ultimoAcceso'];
		$ahora = date("Y-n-j H:i:s");
		$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
		
		 if($tiempo_transcurrido >= 900 and getIP() != '192.168.221.63')
		 {
		 	session_destroy();
			header("Location: control.php?caducado=true");
		}
		
		else
		{
			$_GET['submenu_control'] = true;
			$_GET['submenu_informatica'] = null;
			
			
			PageInit("Control Salas", 'menu.php');
	?>
			<form method="get" name="ControlSalas" action="control.php">
			
			<center>
			<H1 class="shiny">Control de salas. Sala 
			<?
			if($_SESSION['idsala'] == "Pendiente")
			{
				$conexion = DBConnect('controlsalas');
		
				if(!conexion)
				{
					header("Location: /Comunidad");
					die();
				}
				
				$rs = db_query("SELECT distinct on (codigosala) codigosala from computador;");
		
				?>
				<select name="opcsala">
				<option>Seleccione...</option>
				<?
				while($obj = pg_fetch_object($rs))
				{
					if( $obj->codigosala != "auditorio")
					{
				?>
					<option onClick="document.location.href='control.php?sala=<?=$obj->codigosala?>'"><?=$obj->codigosala?></option>
				<?	
					}
				}
				?>
				</select>
				<?
			}
			else
				echo $sala;
			?></H1>
			
			<IMG SRC="<?=$rootPath?>/Images/salas.jpg" ALT="foto">
			<H2>Facultad de Ciencias de la Administraci&oacute;n<BR>Universidad del Valle</H2>
			</center>
		<h4 align="right">Monitor :<?=$_SESSION['nombrem'];?> <?=$_SESSION['apellidom'];?> <br>
			Tiempo Logueado: <?=number_format ( $tiempo_transcurrido/60, 2);?> minutos</h4>
</form>
<!--
<script language="JavaScript" type="text/JavaScript">
    var Hoy = new Date("<?//php echo date("d M Y G:i:s");?>");
function Reloj()
{ 
    Hora = Hoy.getHours() 
    Minutos = Hoy.getMinutes() 
    Segundos = Hoy.getSeconds() 
    if (Hora<=9) Hora = "0" + Hora 
    if (Minutos<=9) Minutos = "0" + Minutos 
    if (Segundos<=9) Segundos = "0" + Segundos 
    var Dia = new Array("Domingo", "Lunes", "Martes", "Mi&eacute;rcoles", "Jueves", "Viernes", "S&aacute;bado", "Domingo"); 
    var Mes = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
    var Anio = Hoy.getFullYear(); 
    var Fecha = ""; 
    var Inicio, Script, Final, Total 
    Inicio = "<font size=3 color=black>" 
    Script = Fecha + Hora + ":" + Minutos + ":" + Segundos 
    Final = "</font>" 
    Total = Inicio + Script + Final 
    document.getElementById('Fecha_Reloj').innerHTML = Total 
    Hoy.setSeconds(Hoy.getSeconds() +1)
    setTimeout("Reloj()",1000) 
} 
</script>
</head>
<body onload="Reloj()">
<div id="Fecha_Reloj"></div> -->


<?
			PageEnd();
		}
	}
?>
