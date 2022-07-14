<?
	/*$root_path = "../../..";
	require '../../../functions.php';
	$con = @DBConnect("controlsalas");
	$rs = db_query("SELECT DISTINCT (fecha),hora,id_sala,estado,color from horario where fecha >= '2011-01-01' and fecha <= '2011-12-31' AND id_sala='auditorio'");
	   while( $obj = pg_fetch_object($rs) ){
	   		$horaI=substr($obj->hora, 0, -5);
			$hora=$horaI.":00";
			echo "FECHA: ".$obj->fecha."   HORA: ".$hora." \n";
			$ingreso=db_query("INSERT INTO horario_auditorio (id_sala,fecha,hora,color,estado) VALUES('$obj->id_sala','$obj->fecha','$hora','$obj->color','$obj->estado')");
	   
	   }
*/

	
?>