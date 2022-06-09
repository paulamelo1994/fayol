<?

$root_path = "../../..";
	require '../../../functions.php';
	$con = @DBConnect("controlsalas");
	$rs = db_query("select * from reserva where id_sala='auditorio'   ");
	   while( $obj = pg_fetch_object($rs) ){
	   		$tipo_reserva=$obj->tipo_reserva;
			
	    switch($tipo_reserva){
									//video conferencia
										case 'vc':
											$newtr = "Video Conferencia";
											break;
									//charla		
										case 'ch':
											$newtr = "Charla";
											break;
									//Foro
										case 'fr':
											$newtr = "Foro";
											break;
									//cineforo		
										case 'cf':
											$newtr = "Cine Foro";
											break;
									//pelicula
										case 'pe':
											$newtr = "Pelicula";
											break;
								}
								
			$ingreso=db_query("update reserva set tipo_reserva='$newtr' where indice='$obj->indice'");
	   
	   }

?>
