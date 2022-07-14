<?
/*
 * Formulario de registro de reservas de salas
 */
 
 session_start();
	if(!isset($_SESSION['adminSalas']))
	{
		header("Location: /Comunidad/Informatica/AsignacionSalasNew/Formularios/ingresar.php");
		die();
	}
	$root_path = "../../../..";
	require '../../../../functions.php';
	require_once '../../../../php-scripts/JSON.php';
	$conexion = DBConnect('controlsalas');
	 if(!$conexion){}
	date_default_timezone_set('UTC');
    $fecha= date('Y-m-d');
	$hora = date('H:i:s');
	$fecha_reserva = $_GET['fecha_sel'];
	$hora_reserva = $_GET['hora'];
	$id_sala =$_GET['sala'];
	
	if(@$_POST['ajax']=='true'){
		if(@$_POST['traer_h'] == 'true'){
			$fecha_reserva=$_POST['fecha'];
			$hora_reserva=$_POST['hora'];
			$sala=$_POST['sala'];
			$queryHoraFin= db_query("SELECT hora FROM horario_salas WHERE fecha='$fecha_reserva' AND hora > '$hora_reserva' AND estado='No Disponible' AND id_sala='$sala' ORDER BY hora ASC ");
			$result=pg_fetch_object($queryHoraFin);
			if($result==0){ $horaFin=21; }else{	$horaFin=$result->hora;	}
			$array=array();
			$array[]=array('id'=>'','name'=>'');
			for($a= $hora_reserva+1 ; $a <= $horaFin ; $a++){
			 	$array[]=array('id'=>$a.":00:00",'name'=>$a.":00:00");
			}
			$value = new Services_JSON();
			$out = $value->encode($array);
			echo $out;
		}
		if(@$_POST['compDisponibilidad'] == "true"){
			//php de validacion segun fecha y hora de reserva 
			$salaV=@$_POST['sala'];
			$tipo_reserva=@$_POST['tipo_reserva'];
			$tallerV=@$_POST['dateform'];
			$fechaIniV=@$_POST['fecha_reserva'];		
			$horaIniV=@$_POST['hora_ini'];
			$horaFinV=@$_POST['hora_fin'];
			$informV=@$_POST['dateform2'];
			$docente2=@$_POST['profesor'];
			$arrayDocente=explode(' ',$docente2);
			$docente=$arrayDocente[0];
			$plan=substr(@$_POST['plan'],0,4);
			DBConnect('profesores');
			$querpro = db_query("select * from profesores where cedula='$docente'");
			DBConnect('controlsalas');
			if(($tipo_reserva=='Clase Unica')||($tipo_reserva=='Clase Postgrado')||($tipo_reserva=='Clase Informatica')||($tipo_reserva=='Taller')){
				$quer = db_query("select * from planes where codigo='$plan'");
				$cantPlans=pg_num_rows($quer);
				if($cantPlans == 0){$error=' <br> ERROR: El plan no es valido, no se encuentra en la base de datos!!! <BR><BR>';}
			}else{
				$cantPlans=1;
			}
			if(pg_num_rows($querpro) == 0){$error=' <br> ERROR: El profesor no es valido, no se encuentra en la base de datos!!! <BR><BR>';}
				
			if($cantPlans > 0 && pg_num_rows($querpro) > 0){
				if(($tipo_reserva=='Capacitacion')||($tipo_reserva=='Clase Unica')||($tipo_reserva=='Clase Diplomado')||($tipo_reserva=='Practica Dirigida')||($tipo_reserva=='Clase Postgrado')){
					$error='<table align="center" border="1" width="500px" ><tr><td style="color:#DD0000; text-align:center;"><br> INFORME <br><br> No es posible realizar la reserva, ya que existen las siguientes eventos: <br> ';
					$result=disponibilidadReserva($fechaIniV,$horaIniV,$horaFinV,$salaV);
					if($result == 'reservar'){
						$error='reservar';
					}else{
						$error=$error." ".$result." <br></td></tr></table><br>";
					}				
				}
				if($tipo_reserva=='Taller'){
					$error='<table align="center" border="1" width="500px" ><tr><td style="color:#DD0000; text-align:center;"><br> INFORME <br><br> No es posible realizar la reserva, ya que existen las siguientes reservas: <br> ';
					$errores=0;
					$resul=disponibilidadReserva($fechaIniV,$horaIniV,$horaFinV,$salaV);
					if($resul != 'reservar'){
						$error=$error."".$resul;
						$errores++;
					}
					foreach($tallerV as $taller){
						if($taller!=""){
							$result=disponibilidadReserva($taller,$horaIniV,$horaFinV,$salaV);
							if($result != 'reservar'){
								$error=$error."".$result;
								$errores++;
							}
						}
					}
					
					if($errores==0){
						$error='reservar';
					}else{
						$error=$error." <br></td></tr></table><br>";
					}
				}
				if($tipo_reserva=='Clase Informatica'){
					$existeProxSem=true;
					$error='<table align="center" border="1" width="500px" ><tr><td style="color:#DD0000; text-align:center;"><br> <img src="../../../../Images/iconosSalas/advertencia.png" width="35px" height="35px" > INFORME <br><br> No es posible realizar la reserva, ya que existen las siguientes reservas: <br> ';
					$errores=0;
					$proximo=$fechaIniV;
					while($existeProxSem==true){
						$result=disponibilidadReserva($proximo,$horaIniV,$horaFinV,$salaV);
						if($result != 'reservar'){
							$error=$error." ".$result;
							$errores++;	
						}
						$proximo=dia_sig_sem_valida($proximo,$informV);
						if($proximo == 'No existe'){$existeProxSem=false; }else{ $existeProxSem=true;}
					}
					if($errores==0){
						$error='reservar';
					}else{
						$error=$error." <br></td></tr></table><br>";
					}
				}
			}
			///////////////////////////////////////////////////////////
			$value = new 
			Services_JSON();
			$out = $value->encode($error);
			echo $out;
		}
		exit;
	}
	
	PageInit("Formulario Reserva", "../menu.php");
	include '../../../../php-scripts/validadorFormularios/formReservaSalas.php';
	include "../../../../php-scripts/selectorFechas.php";
	include "../script/fechasDinm.php";
	include "../script/jFormulario.php";
	include "../script/planEstudios.php";
	include "../script/docentes.php";
	
	?><style type="text/css">  
			#ocultoTalleres{
				display:none;
			}
			#ocultoInformatica{
				display:none;
			}
			#ocultoMensDisp{
				display:none;
			}
	</style><?
  /*
  * Query para hallar el software disponible correspondiente a la sala escogida
  */
  $querySoftware= db_query("SELECT * FROM sala_software WHERE sala='$id_sala' "); 
  
 ?>
    <form name="reservaSalas" method="post" enctype="multipart/form-data" action="envioReserva.php" id="reservaSalas">
        <input type="hidden" name="fecha" value="<?=$fecha?>">
        <input type="hidden" name="hora" value="<?=$hora?>">
        <input type="hidden" name="disponible" id="disponible" value="false">
        <input type="hidden" name="ajax" id="ajax" value="true">	
        <input type="hidden" name="compDisponibilidad" id="compDisponibilidad" value="true">
        <table width="80%"  align="center" border="0">
        
        <tr>
            <td colspan="2" ><div align="left"><b>Fecha Actual: </b><?=makeDate($fecha)?><br><br>
                                              <b>Hora Actual: </b><?=$hora?><br><br>
                                              </div></td>
        </tr>
        <div id="ocultoMensDisp" style="color:#DD0000; font-weight:bold; " align="center" >

         </div>
        <tr>
            <td class="titulosContenidoInterno" >Sala:</td>
            <td style="padding-bottom:5px; "><input readonly name="sala" size="10" value="<? echo $id_sala;?>"  id="sala"></td>
        </tr>
        <tr>
            <td class="titulosContenidoInterno">Tipo Reserva: </td>
                                                <td><select name="tipo_reserva" id="tipo_reserva">
                                                  <option value=""></option>
                                                  <option value="Clase Unica"> Clase Unica</option>
                                                  <option value="Clase Informatica"> Clase Informatica</option>
                                                  <option value="Taller">Taller</option>
                                                  <option value="Clase Postgrado">Clase Postgrado</option>
                                                  <option value="Clase Diplomado">Clase Diplomado</option>
                                                  <option value="Capacitacion"> Capacitacion</option>
                                                  <option value="Practica Dirigida"> Practica Dirigida</option>
                                                 </select></td>
            
        </tr>
        <tr>
            <td height="38" class="titulosContenidoInterno">Fecha para reservar:</td>
            <td><input readonly name="fecha_reserva" size="30" value="<? echo $fecha_reserva;?>"  id="fecha_reserva" type="text" />&nbsp;(aa:mm:dd)</td>
        </tr>
        <tr>
            <td height="33" class="titulosContenidoInterno">Hora de inicio: </td>
            <td><p><input readonly name="hora_ini" size="30" value="<? echo $hora_reserva.":00";	?>" id="hora_ini" type="text" />&nbsp;(hh:mm)</td>
        </tr>
        <tr>
            <td class="titulosContenidoInterno">Hora de finalizaci&oacute;n:</td>
            <td><select name="hora_fin" id="hora_fin" disabled>
                 <option value=""></option>
                </select>
            </td>
        </tr> 
        </table>
        <table align="center">
        <tr id="ocultoTalleres"><!-- Para talleres que desean añadir mas fechas-->
            <td >
                <table id="otra_fecha">
                <br>
                    <tr>
                        <td><b>Otra fecha:</b></td>
                        <td colspan="2"><input class='dateform' name="dateform[0]"  type="text" size='10' maxlength='10' ></td>
                    </tr>
                </table>
            </td>
            <td><input type="button" name="agregarOtraF" onClick="agregarFecha()"value="A&ntilde;adir Otra Fecha" ></td>
        </tr>
        <tr id="ocultoInformatica"><!-- Para Clases Informatica que deben colocar la fecha de finalizacion de la reserva-->
            <td colspan="2">
                <table id="fecha_fin_">
                <br>
                    <tr>
                        <td><b>Fecha finalizacion:</b></td>
                        <td colspan="2"><input class='dateform' name="dateform2" id="dateform2" type="text" size='10' maxlength='10' ></td>
                    </tr>
                </table>
            </td>
        </tr>
        </table>
        <br>
        <br>
        <table width="80%" align="center">
        <tr>
            <td class="titulosContenidoInterno">Profesor: </td>
            <td ><input type="text" size="50" name="profesor" id="profesor"></td>
        </tr>
        <tr>
            <td class="titulosContenidoInterno">Tipo Software:</td>
            <td><select name="tipo_software" id="tipo_software">
                      <option value=""></option>
                      <? while($soft=pg_fetch_object($querySoftware)){
                            ?><option value="<? echo $soft->software;?>"><? echo $soft->software;?></option><?
                      }?> 
                 </select>
            </td>
        </tr>
        <tr>
            <td class="titulosContenidoInterno">Plan de estudios:</td>
            <td>
                <input name="plan" id="plan" type="text" size="50" title="Digite el codigo del plan de estudios!" value="<? echo $_POST['plan']; ?>">
	        </td>
        </tr>
		 <tr>
            <td class="titulosContenidoInterno">Tipo programa:</td>
            <td><select name="tipo_programa" id="tipo_programa">
                      <option value=""></option>
                      <option value="Pregrado">Pregrado</option>
					  <option value="Postgrado">Postgrado</option>
                </select>
            </td>
        </tr>	
        <tr>
            <td class="titulosContenidoInterno">Asignatura: </td>
            <td><input name="asignatura" type="text" size="50" value="" id="asignatura"></td>
        </tr>
        <tr>
            <td class="titulosContenidoInterno">No Estudiantes: </td>
            <td><p>
              <input name="no_estudiantes" type="text" size="4" value="" id="no_estudiantes"></td>
        </tr>
        <tr>
            <td class="titulosContenidoInterno">Grupo: </td>
            <td><p>
              <input name="grupo" type="text" size="10" value="" id="grupo"></td>
        </tr>
        <tr>
            <td class="titulosContenidoInterno">Contenido: </td>
            <td><textarea cols="40" rows="8" name="contenido" id="contenido"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input name="aceptar" id="aceptar" type="submit" value="Evaluar/Enviar">
                &nbsp;&nbsp;&nbsp;
                <input type="button" name="cancelar" value="Cancelar" onClick="location.href='/Comunidad/Informatica/AsignacionAuditorio/calendReserva.php?opcion=2&fecha=<? echo $fecha_reserva;?>'" />
            </td>
        </tr>
    </table>
    <br><br>
    </form>
<!-- http://administracion.univalle.edu.co/Comunidad/Informatica/AsignacionSalasNew/Formularios/reservar.php?fecha_sel=2011-03-10&hora=14:00&sala=1-->

