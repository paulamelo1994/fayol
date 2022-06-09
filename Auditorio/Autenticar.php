<?
	require "../../functions.php";
  require "functions.php";
  session_start();
	
	$login = $_POST['LoginAgenda'];
	$pasw = $_POST['ClaveAgenda'];
	
	$conexion = DBConnect('agenda');
	if(!conexion)
	{
		header("Location: ../Agenda");
		die();
	}
	
	$_SESSION['usuario'] = array();
	
	$correo = autenticarUsuario($_POST['LoginAgenda'], $_POST['ClaveAgenda']);
	# Si la autenticacion fue exitosa
	if( $correo )
	{
		$rs = db_query("SELECT * FROM usuarios WHERE login= '$_POST[LoginAgenda]'");
		$filas = pg_num_rows($rs);
		
		if($filas)
		{
			$obj = pg_fetch_object($rs);
			$_SESSION['usuario']['login'] = $obj->login;
			$_SESSION['usuario']['nombre'] = $obj->nombre;
			$_SESSION['usuario']['mail'] = $obj->correo;
			if ($_SESSION['usuario']['login'] == 'julianad' || $_SESSION['usuario']['login'] == 'admseacd')
				$_SESSION['usuario']['permisos'] = 'total';
			else
				$_SESSION['usuario']['permisos'] = 'parcial';
		}

		else
		{
			$_SESSION['usuario']['permisos'] = 'parcial';
		}
	   header("Location: inicioPrivado.php");
	   die();
	}
	else
	{
		
		$conexion = DBConnect('profesores');
		
		if(!conexion)
		{
			header("Location: /Comunidad");
			die();
		}
		
		$rs = db_query("SELECT * FROM profesores WHERE login= '$_POST[LoginAgenda]' and password = '$_POST[ClaveAgenda]'");
		
		$filas = pg_num_rows($rs);
		if($filas)
		{
			$obj = pg_fetch_object($rs);
			
			$_SESSION['usuario']['login'] = $obj->login;
			$_SESSION['usuario']['nombre'] = $obj->nombre;
			
			if($_SESSION['usuario']['login'] == 'langela' || $_SESSION['usuario']['login'] == 'admseacd' 
			)
				$_SESSION['usuario']['permisos'] = "total";
			else
				$_SESSION['usuario']['permisos'] = "parcial";
				
			header("Location: inicioPrivado.php");
	   		die();
			
		}
		else
		{
			echo "<script language=\"Javascript\" >
			 	alert(\"Nombre de usuario o contraseña incorrectos.\");
                </script>";
		}
	}
  #DEV:
//  $_SESSION['LoginUsuarioAgenda'] = 'dwilches';
//  $_SESSION['NombreUsuarioAgenda'] = 'Daniel Wilches';
//  header("Location: inicioPrivado.php");
  
?>