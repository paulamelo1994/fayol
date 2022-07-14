<?
$root_path = "../../../..";
	require '../../../../functions.php';
	$conexion = DBConnect('controlsalas');
	
	$fechaIniV ='2011-03-10';
	$horaIniV = '17:00';
	$horaFinV ='19:00';
	$salaV ='1';
	$result=disponibilidadReserva($fechaIniV,$horaIniV,$horaFinV,$salaV);
	if($result == true){
		$error='true';
	}else{
		$error=$error." kk ".$result;
	}		
	echo "error: $error";
	echo "ok";
	
?>
