<?

	session_start();
	
	if(!isset($_SESSION['monitor']))
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/control.php");
		die();
	}
	$root_path = "../../..";
	require '../../../functions.php';
	
	if(isset($_POST['guardar'])){
			
		$conexion = DBConnect("controlsalas");
		if(!$conexion)
				echo "Error al conectarse con la BD.";
		else{
			$codigo=pg_escape_string($_POST['codigoEst']);
			$nombre=pg_escape_string($_POST['nombreEst']);
			$apellido=pg_escape_string($_POST['apellidoEst']);
			$tipodoc=pg_escape_string($_POST['tipodoc']);
			$numDoc=pg_escape_string($_POST['numDoc']);
			$codPlan=pg_escape_string($_POST['codigoPlan']);
			$email=pg_escape_string($_POST['emailEst']);
			$login=$codigo."-".$codPlan;
			$pass=$nombre[0].$numDoc.$apellido[0];
			
			$rs = db_query("update estudiantes set nombres='$nombre', apellidos='$apellido', 
							tipodoc='$tipodoc', nodoc='$numDoc', codplan='$codPlan', correo_electronico='$email',
							password='$pass', login='$login' where codigo='$codigo'");
			if(!$rs){
				?><script language="javascript">
					alert("No fue posible,  realizar la modificacion, intentelo de nuevo.");
					location.href="consultaEstudiantes.php?opc=1";
					</script>
				<?
			}else{
				?><script language="javascript">
					alert("Se realizo la actualizacion de datos satisfactoriamente");
					location.href="/Comunidad/Informatica/ControlUsuarios/control.php";
					</script>
				<?
			}
		}
	}
				
?>