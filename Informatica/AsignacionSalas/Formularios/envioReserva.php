<?
/*
 * Script para el envio de la reserva(guardar y actualizar la db)
 */
 session_start();
 if(!isset($_SESSION['adminSalas'])){
		header("Location: /Comunidad/Informatica/AsignacionSalas/Formularios/ingresar.php");
	die();
 }
	$root_path = "../../../..";
	require '../../../../functions.php';
	require_once '../../../../php-scripts/JSON.php';
	PageInit("", "../menu.php");
	
	 date_default_timezone_set('UTC');
	 $fecha= date('Y-m-d');
	 $hora = date('H:i:s');
	 $conexion = DBConnect('controlsalas');
	 if(!$conexion)
		echo("No se pudo lograr la conexi&oacute;n con la BD.");

	//Registro en bd la reserva
	if($_POST['disponible']=='true'){
		$docente2=$_POST['profesor'];
		$arrayDocente=explode(' ',$docente2);
		$docente=$arrayDocente[0];
		$tipo_reserva=pg_escape_string($_POST['tipo_reserva']);
		$fecha_reserva=pg_escape_string($_POST['fecha_reserva']);
		$hora_inicio=pg_escape_string($_POST['hora_ini']);
		$hora_termino=pg_escape_string($_POST['hora_fin']);
		$tipo_software=pg_escape_string($_POST['tipo_software']);
		$plan2=$_POST['plan'];
		$plan=@substr($plan2,0,4);
		$tipo_programa=pg_escape_string($_POST['tipo_programa']);
		$asignatura=pg_escape_string($_POST['asignatura']);
		$no_estudiantes=pg_escape_string($_POST['no_estudiantes']);
		$grupo=pg_escape_string($_POST['grupo']);
		$contenido=pg_escape_string($_POST['contenido']);
		$sala=pg_escape_string($_POST['sala']);
		$fechaTaller=@pg_escape_string($_POST['dateform']);
		$fechaInformatica=@pg_escape_string($_POST['dateform2']);
		$color=calcularColorReserva($tipo_reserva);
		/* COMPROBACION DE DATOS Y RESERVA : se verifica que no existan reserva en las fechas a las que se quiera reservar si no hay ningun problema pasa a reservar */
		db_query('begin');
		$id_head=guardarDBhead($fecha,$hora,$docente,$sala,$tipo_software,$tipo_reserva,$plan,$tipo_programa,$asignatura,$grupo,$no_estudiantes,$contenido);//GUARDO CABECERA
		echo "<div style='color:#777777; font-weight:bold; font-size:15px;' align='center' >Informe resultado de la reservaci&oacute;n sala $sala</div><br>";
		if($id_head=='false'){
			db_query('rollback');
			printError("La reserva no se pudo guardar en la base de datos, por favor intentelo de nuevo");
		}else{
			if(($tipo_reserva=='Capacitacion')||($tipo_reserva=='Clase Unica')||($tipo_reserva=='Clase Diplomado')||($tipo_reserva=='Practica Dirigida')||($tipo_reserva=='Clase Postgrado')){
				$result=disponibilidadReserva($fecha_reserva,$hora_inicio,$hora_termino,$sala);
				if($result != 'reservar'){
					//Error por cruze de reserva
					printError("No se puede realizar la reserva por que se cruza con otra reserva");
				}else{
					if(guardarDBbody($fecha_reserva,$id_head,$hora_inicio,$hora_termino,$sala,$color)!= true){
						db_query('rollback');
						printError("No fue posible guardar la reserva de $fecha_reserva");
					}else{
						db_query('commit');
						printOK("Se guardo exitosamente la reserva de $fecha_reserva , hora  $hora_inicio - $hora_termino <br>");
					}
				}					
			}elseif($tipo_reserva=='Taller'){
				$aux=0;
				$resul=disponibilidadReserva($fecha_reserva,$hora_inicio,$hora_termino,$sala);
				if($resul != 'reservar'){
					//Error por cruze de reserva
					printError("No se puede realizar la reserva de la fecha  $fecha_reserva por que se cruza con otra reserva <br>");
				}else{
					if(guardarDBbody($fecha_reserva,$id_head,$hora_inicio,$hora_termino,$sala,$color)!= true){
						printError("No fue posible guardar la reserva de la fecha $fecha_reserva <br>");
					}else{
						printOK("Se guardo exitosamente la reserva de la fecha $fecha_reserva , hora  $hora_inicio - $hora_termino <br>");
						$aux++;
					}	
				}	
				foreach($fechaTaller as $j){
					if($j!=""){
						$result=disponibilidadReserva($j,$hora_inicio,$hora_termino,$sala);
						if($result != 'reservar'){
							//Error por cruze de reserva
							printError("No se puede realizar la reserva de la fecha  $j por que se cruza con otra reserva <br>");
						}else{
							if(guardarDBbody($j,$id_head,$hora_inicio,$hora_termino,$sala,$color)!= true){
								printError("No fue posible guardar la reserva de la fecha $j <br>");
							}else{
								printOK("Se guardo exitosamente la reserva de la fecha $j , hora  $hora_inicio - $hora_termino <br>");
								$aux++;
							}	
						}	
					}
				}
				if($aux>0){db_query('commit');}else{db_query('rollback');}
					
			}elseif($tipo_reserva=='Clase Informatica'){
				$aux=0;
				$existeProxSem=true;
				$proximo=$fecha_reserva;
				while($existeProxSem==true){
					$result=disponibilidadReserva($proximo,$hora_inicio,$hora_termino,$sala);
					if($result != 'reservar'){
						printError("No se puede realizar la reserva de la fecha $proximo, esta se cruza con otra reserva <br>");
					}else{
						if(guardarDBbody($proximo,$id_head,$hora_inicio,$hora_termino,$sala,$color)!= true){
							printError("No fue posible guardar la reserva de la fecha $proximo <br>");
						}else{
							printOK("Se guardo exitosamente la reserva de la fecha $proximo  , hora  $hora_inicio - $hora_termino <br>");
							$aux++;
						}	
					 }	
					$proximo=dia_sig_sem_valida($proximo,$fechaInformatica);
					if($proximo == 'No existe'){$existeProxSem=false; }else{ $existeProxSem=true;}
				}
				if($aux>0){db_query('commit');}else{db_query('rollback');}
			}
	}
}		
		
?>