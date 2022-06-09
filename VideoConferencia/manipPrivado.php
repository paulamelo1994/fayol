<?
  require "../../functions.php";
  $rootPath = "..";
  
  session_start();
  
  $_GET['submenu_agenda'] = true;
  
  # Valido la sesi&oacute;n
  /*
  if( !isset($_SESSION['LoginUsuarioAgenda']) ) {
     header("Location: index.php");
	 die();
  }
  */
  
DBConnect("fayol");
  
if( isset($_POST['AgregarReset']) )
{
     unset( $_SESSION['PostAgregar'] );
	 header("Location: inicioPrivado.php?item=3");
	 die();
}
if( isset($_POST['Agregar']) )
{
  	
    $_SESSION['PostAgregar'] = $_POST;
	
   
	$fecha = pg_escape_string( $_POST['fecha'] );
	$array_date = split('-', $fecha);
	$dia=$array_date[2];
	$mes=$array_date[1];
	$ano=$array_date[0];
    $hora_inicio = pg_escape_string( $_POST['hora_inicio'] );
    $duracion = pg_escape_string( $_POST['duracion'] );
	$espacio = pg_escape_string( $_POST['espacio'] );
	$tema = pg_escape_string( $_POST['tema'] );
	$tipo_vid_conf = pg_escape_string( $_POST['tipo_vid_conf'] );
	$num_participantes = pg_escape_string( $_POST['num_participantes'] );
	$solicitante = pg_escape_string( $_POST['solicitante'] );
	$correo_sol = pg_escape_string( $_POST['correo_sol'] );
	$protocolo = pg_escape_string( $_POST['protocolo'] );
	$contenido = pg_escape_string( $_POST['contenido'] );

	$r = @db_query("INSERT INTO video_conferencia(fecha, hora_inicio, duracion, espacio, tema, tipo_vid_conf,
	num_participantes, solicitante, correo_sol, protocolo, contenido)".
	"VALUES('$ano-$mes-$dia', '$hora_inicio', '$duracion', '$espacio', '$tema', '$tipo_vid_conf','$num_participantes',
	'$solicitante', '$correo_sol', '$protocolo', '$contenido')");
	
	if( $r )
	{
	  unset( $_SESSION['PostAgregar'] );
	  $_SESSION['SuccededAgregar'] = true;
	  header("Location: VerMes.php?agregar=true");
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
?>