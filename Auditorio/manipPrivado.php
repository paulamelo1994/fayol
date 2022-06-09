<?
  require "../../functions.php";
  $rootPath = "..";
  
  session_start();
  
  $_GET['submenu_agenda'] = true;
  
  # Valido la sesión
  /*
  if( !isset($_SESSION['LoginUsuarioAgenda']) ) {
     header("Location: index.php");
	 die();
  }
  */
  
DBConnect("agenda");
  
if( isset($_POST['AgregarReset']) )
{
     unset( $_SESSION['PostAgregar'] );
	 header("Location: inicioPrivado.php?item=3");
	 die();
}
if( isset($_POST['Agregar']) )
{
  	
    $_SESSION['PostAgregar'] = $_POST;
    $nombre_evento = pg_escape_string( $_POST['nombre_evento'] );
	$organizador = pg_escape_string( $_POST['organizador'] );
    $fecha = pg_escape_string( $_POST['fecha'] );
	$array_date = split('-', $fecha);
	$dia=$array_date[2];
	$mes=$array_date[1];
	$ano=$array_date[0];
    $hora_inicio = pg_escape_string( $_POST['hora_inicio'] );
    $hora_fin = pg_escape_string( ($_POST['hora_inicio'] + 3).':00' );
    $tipo_evento = pg_escape_string( $_POST['tipo_evento'] );
	$descripcion = pg_escape_string( $_POST['descripcion'] );
	$email = pg_escape_string( $_POST['email'] );
	
	if(pg_num_rows(db_query("SELECT * FROM auditorio WHERE fecha='$fecha' and hora_inicio='$hora_inicio'")) != 1)
	{
	
		$r = @db_query("INSERT INTO auditorio(nombre_evento,organizador,fecha,hora_inicio,hora_fin,tipo_evento,descripcion, email)".
		"VALUES('$nombre_evento','$organizador','$fecha','$hora_inicio','$hora_fin','$tipo_evento', '$descripcion', '$email')");
		if( $r )
		{
			unset( $_SESSION['PostAgregar'] );
			$_SESSION['SuccededAgregar'] = true;
			header("Location: inicioPrivado.php?item=3&dia=$dia&mes=$mes&ano=$ano&agregar=true");
			die();
		}
		else
		{
			$error = pg_last_error();
			if( strstr($error, 'Bad date external representation') )
			{
				header("Location: inicioPrivado.php?item=3&error=fecha");
				die();
			}
			if( ereg("Bad time external representation '(.*)'", $error, $regs) )
			{
				if( $regs[1]==$_POST['hora_inicio'] )
					header("Location: inicioPrivado.php?item=3&error=hora_inicio");
				else
					header("Location: inicioPrivado.php?item=3&error=hora_fin");
				die();
			}
		}
	}
	else
	{
			?>
		<script language="javascript" type="text/javascript">
		alert("No se puede hacer guardar, la hora ingresada ya esta en uso");
		</script>
		<?
		header("Location: VerMes.php?agregar=true");
		die();
	}
}
if( isset($_POST['Cancelar']) )
{
	header("Location: VerMes.php?agregar=true");
	die();
}
?>