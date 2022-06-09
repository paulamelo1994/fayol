<?
   require("mail.php");
   require '../../functions.php';
   $rootPath = '../../';
   
   session_start();   
   if( !isset($_SESSION['sesionValida']) )
   {
      header('Location: /Error404.php');
	  die();
   }
   
   $_GET['submenu_solicitudes'] = true;
   
   switch($_GET['mostrar'])
   {
     case 'espera':
	    $estado_mostrar='e';
		$descripcion_estado='En Espera';
		//$_GET['item'] = 1;
		break;
     case 'pendientes':
	    $estado_mostrar='p';
		$descripcion_estado='Pendientes';
		//$_GET['item'] = 2;
		break;

     case 'finalizadas':
	    $estado_mostrar='t';
		$descripcion_estado='Finalizadas';
		//$_GET['item'] = 4;
		break;
   }
   
   DBConnect('fayol');

   $valign = 'top';
   PageInit('Administraci&oacute;n Solicitud de Soporte T&eacute;cnico', '../menu.php');
      
	
	
	
	function enviarCorreo()
	{
	
		$message_body = "Solicitud Nùmero: $_POST[numpeticion]";
		$message_body = $message_body."<br>"."Responsable: $_POST[responsable]";
		$message_body = $message_body."<br>"."Elemento: $_POST[elemento]";
		$message_body = $message_body."<br>"."Nùmero de Inventario: $_POST[inventario]"; 
		$message_body = $message_body."<br>"."Descripciòn Falla: $_POST[descripcion]"; 	
		$message_body = $message_body."<br><br><br> <b>INFORMACIÒN DEL MANTENIMIENTO</b>";
		$message_body = $message_body."<br><br>"."Hora/Fecha Atenciòn: $_POST[horaatencion]";
	
		//Estado
		$message_body = $message_body."<br>"."Estado: ";	
		if($_POST['estado']=='e')
		{
			$message_body = $message_body."Aùn no atendida";
		}
		else if($_POST['estado']=='p')
		{
			$message_body = $message_body."Pendientes ";
			$message_body = $message_body."Motivo(Estado Pendiente): $_POST[motivoEstado])";
		}
		else if($_POST['estado']=='t')
		{
			$message_body = $message_body."Ya fue atendida";
		}		
		
		//Tipo Trabajo
		$message_body = $message_body."<br>"."Tipo: ";
		
		if($_POST['tipoTrabajo']=='s')
		{
			$message_body = $message_body."Soporte";
		}
		else if($_POST['tipoTrabajo']=='p')
		{
			$message_body = $message_body."Preventivo";
		}
		else if($_POST['tipoTrabajo']=='f')
		{
			$message_body = $message_body."Falla (Correctivo)";
		}
		
		//Descripcion Falla
		$message_body = $message_body."<br>"."Descripciòn Soporte Realizado: $_POST[trabajoRealizado] ";
			
		//Causa Falla
		$message_body = $message_body."<br>"."Causa Falla: ";
		if( $_POST['causaFalla']=='t')
		{
			$message_body = $message_body."Tecnica";
		}
		else if($_POST['tipoTrabajo']=='u')
		{
			$message_body = $message_body."Usuario";
		}
			
		//Intervencion
		$message_body = $message_body."<br>"."Intervención: ";
		
                if($_POST['intervencion']=='a')
		{
			$message_body = $message_body."Actualización";
		}
		else if($_POST['intervencion']=='c')
		{
			$message_body = $message_body."Cambio";
		}
		else if( $_POST['intervencion']=='r')
		{
			$message_body = $message_body."Reparación";
		} 
		else if($_POST['intervencion']=='b')
		{
			$message_body = $message_body."Baja";
		}
		else if($_POST['intervencion']=='co')
		{
			$message_body = $message_body."Correción";
		}
		else if($_POST['intervencion']=='is')
		{
			$message_body = $message_body."Instalación Software";
		}
		
		//Garantia
		$message_body = $message_body."<br>"."Garantia: ";
		if( $_POST['garantia']=='s')
		{
			$message_body = $message_body."Si";
		}
		else if($_POST['garantia']=='n')
		{
			$message_body = $message_body."No";
		}
		
		$message_body = $message_body ."<br>"."Observaciones: $_POST[observaciones]";
		
		if($_POST['estado']=='t')
		{
		$message_body = $message_body ."<br><br>"."Por favor, diligenciar este formulario de Calificaci&oacute;n del Servicio
                                                           de Soporte T&eacute;cnico en el siguiente enlace:<br>
							   http://fayol.univalle.edu.co/Comunidad/Soporte/formularioEvaluacion.php?id_peticion=$_POST[numpeticion]";
				if($_POST['remitir']='true'){
				$fecha23=date('m-d-Y');
				db_query("update solicitudpendexternos set		  	
					  fechaTerminada = '$fecha23'
                                          where solicitud = '$_POST[fichaAtencion]'");
				
				}
		}					
		
		if(!empty($_POST['email']))
		{
			//mail($_POST['email'].", nemunoz@univalle.edu.co, luispena@univalle.edu.co", 'Reporte Atenci�n Solicitud de Soporte No. '.$_POST['numpeticion'], $message_body);
			//mail($_POST['email'].", nemunoz@univalle.edu.co, luispena@univalle.edu.co", 'Reporte Atenci�n Solicitud de Soporte No. '.$_POST['numpeticion'], $message_body);
			//temporalmente cerrado /**********************mail($_POST['email'].", luispena@univalle.edu.co", 'Reporte Atenci�n Solicitud de Soporte No. '.$_POST['fichaAtencion'], $message_body);
			
			//mail($_POST['email'], 'Reporte Atenci�n Solicitud de Soporte No. '.$_POST['fichaAtencion'], $message_body);
			sendmail($message_body, 'Reporte Atenciòn Solicitud de Soporte No. '.$_POST['fichaAtencion'], $_POST['email'], "Soporte Sistemas FCA","");
			
		}
	
   }//Fin de "enviarCorreo"
	  
   if( isset($_POST['ActualizarPeticion']))
   {   
	   $hora = date('H:i:s');
	   $fecha = date('m-d-Y');
		
		//if($_POST[estado]== 'p' ){
		
			/*
			 * Cuando se solucione el problemas de salidas de correos electronicos(problemas con el servidor de la iotel)
			 * se activara de nuevo el sgte script q es para remitir peticiones de soporte tecnico a externis.
			 *
			  if($_POST['remitir']=='true'){
			
				$correo = $_POST[correoaremitir];
				$rsPendientes = db_query("select * from solicitudpendexternos where solicitud='$_POST[fichaAtencion]'");
	 			$obj1 = @pg_fetch_object($rsPendientes);
			
				  if( $obj1 ){$existePen='true';}else{$existePen='false';}
				  
				  if($existePen=='true'){		 
						db_query("UPDATE solicitudpendexternos SET  
								descripcionMensaje='$_POST[descripcionMensajeP]',		
								fechaEnvio='$fecha'  WHERE solicitud='$_POST[fichaAtencion]'");
				  }
				  if($existePen=='false'){	
						$cosultaPendientes = db_query("insert into  solicitudpendexternos 	
										VALUES (NEXTVAL('seq_solicitudpendexternos'),'$_POST[fichaAtencion]','$_POST[correoaremitir]','$_POST[descripcionMensajeP]'
										,'$fecha' ,'$fecha' )");  			
				  }
				  
				$mensajeAexternos=" Se�ores, favor atender la siguiente solicitud, que ya fue examinada previamente por nuestro personal.
									Asunto: $_POST[descripcionMensajeP]
									
									DESCRIPCION DE ESCALABILIDAD DE SOPORTE
									Descripcion de la falla dada por el usuario:$_POST[descripcion]
									Motivo: $_POST[motivoEstado]
									Tipo: $_POST[tipoTrabajo]
									Descripcion soporte realizado: $_POST[trabajoRealizado]
									Causa Falla: $_POST[causaFalla]
									Intervension: $_POST[intervension]
									Garantia: $_POST[garantia]
									Observaciones: $_POST[observaciones] 
									
									Una vez finalizada, favor comunicarlo por este medio";
				$mensaje2= " Su solicitud de soporte tecnico fue remitida a una dependencia de mayor competencia para resolver su caso.
							'DESCRIPCION DE ESCALABILIDAD DE SOPORTE'
							Remitido a :$_POST[correoaremitir]
							Mensaje : $mensajeAexternos";
							
				
				$mensaje=" Fue enviada una solicitud de soporte tecnico a $correo con el siguiente mensaje: $mensajeAexternos";
				
				mail($_POST['email'], 'Soporte Tecnico Facultad de Administracion ',$mensaje2);
				mail('webwoman@univalle.edu.co', 'Escalabilidad de Soporte Tecnico de la Facultad de Administracion ',$mensaje);
				mail('luispena@univalle.edu.co', 'Escalabilidad de Soporte Tecnico de la Facultad de Administracion ',$mensaje);
				mail($_POST['correoaremitir'], 'Solicitud Soporte Tecnico de la Facultad de Administracion ',$mensajeAexternos);
				//mail('luispena@univalle.edu.co', 'Escalabilidad de Soporte Tecnico de la Facultad de Administracion ',$mensaje);
				
				//mail($_POST['email'], 'Soporte Tecnico Facultad de Administracion ',$mensaje2);
		    }*/
	   //}
	   DBConnect('fayol');
	   
		$consultaActualizacion="UPDATE fichaatencionsoporte SET		  
							  trabajoRealizado='$_POST[trabajoRealizado]',
							  tipoTrabajo='$_POST[tipoTrabajo]',	
							  causaFalla='$_POST[causaFalla]',		
							  intervencion='$_POST[intervencion]',	
							  garantia='$_POST[garantia]',	
							  observaciones='$_POST[observaciones]'	,
							  estado= '$_POST[estado]',
							  motivoEstado='$_POST[motivoEstado]',
							  hora='$hora',
							  fecha='$fecha'
						      WHERE solicitud='$_POST[fichaAtencion]'";
	   		
       $rs = db_query($consultaActualizacion);
						
		if( !$rs)
		{
		   $_GET['numpeticion'] = $_POST['fichaAtencion'];
		   $error_in_query = true;
		   	echo "<center><br>";
		   Failed('
			   La petici&oacute;n de soporte no pudo ser actualizada, por favor intente nuevamente la solicitud fue.<br><br>
			   <a href="actualizar.php?mostrar=espera">De click aqui para ver las peticiones en espera</a><BR>
			   <a href="actualizar.php?mostrar=pendientes">De click aqui para ver las peticiones en atenci&oacute;n o pendientes</a><BR>
			   <a href="actualizar.php?mostrar=finalizadas">De click aqui para ver las peticiones finalizadas</a><br>
			   </center>');
		   PageEnd();
		   die();
		}
		else
		{
		   if($_POST['estado'] =='t')
		   {
				if(!empty($_POST['email']))
				{
					 enviarCorreo();
				}else{
					echo "<b>No fue posible enviar el correo informando sobre el estado de la petici�n de soporte.<br> Debido a que el usuario no tiene registrado el correo electr&oacute;nico en el sistema.</b>";
				}			
		   }
		  
		   echo "<center><br>";
		   Succeded('
	   	   La petici&oacute;n de soporte fue actualizada correctamente.<br><br>
		   <a href="actualizar.php?mostrar=espera">De click aqui para ver las peticiones en espera</a><BR>
		   <a href="actualizar.php?mostrar=pendientes">De click aqui para ver las peticiones en atenci&oacute;n o pendientes</a><BR>
		   <a href="actualizar.php?mostrar=finalizadas">De click aqui para ver las peticiones finalizadas</a><br>
		   </center>');
			   
			   PageEnd();
			   die();
	    }//Fin else
   }//Fin ActualizarPeticion
   
   if( !$_GET['numpeticion'] )
   {
		   echo "<h1>Revisar Solicitudes $descripcion_estado de Soporte T&eacute;cnico</h1>";		   	
		   $rs = db_query("select numFicha, numSolicitud,extension,espacio,responsable,vinculacion,inventario,elemento,SolicitudSoporte.fecha,SolicitudSoporte.hora from SolicitudSoporte,FichaAtencionSoporte where solicitud=numsolicitud and estado='$estado_mostrar' order by numSolicitud DESC");
		  
		   
		  // echo "select numSolicitud,extension,espacio,responsable,vinculacion,inventario,elemento,EstadoSoporte.fecha,EstadoSoporte.hora from SolicitudSoporte,EstadoSoporte where estado='$estado_mostrar' order by numSolicitud";
		   ?>
		   <BR>
		   <TABLE WIDTH="100%" BORDER="0">
		   <TR>
			   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>No. Petici&oacute;n</B></TD>		   
			   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>Espacio</B></TD>
			   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>Ext.</B></TD>
			   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>Responsable</B></TD>
			   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>No. Inventario</B></TD>
			   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>Elemento</B></TD>
			   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>Hora / Fecha <br>Petici&oacute;n</B></TD>
			   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER">&nbsp;</TD>
		   </TR>
		   <?
		   while( $obj = pg_fetch_object($rs) )
		   {
			  $color = ($color=='#FCFCFC')? '#D0DEE9' : '#FCFCFC';
			  $numFicha = $obj->numficha;
			  echo "
			  <TR BGCOLOR='$color'>
				  <TD><A HREF='actualizar.php?mostrar=$_GET[mostrar]&numpeticion=$obj->numsolicitud&numficha=$numFicha'>$obj->numsolicitud</A></TD>			 
				  <TD>$obj->espacio</TD>
				  <TD>$obj->extension</TD>
				  <TD>$obj->responsable</TD>
				  <TD>$obj->inventario</TD>
				  <TD>$obj->elemento</TD>
				  <TD>$obj->hora / $obj->fecha</TD>
				  <TD>
				  <a href='versionimprimible.php?numpeticion=$obj->numsolicitud&numficha=$numFicha' target='_blank'><IMG SRC='".$rootPath."/Images/imprimir.jpg' ALT='imprimir' height='20' width='20'></a>
				  </TD>
			  </TR>";
		   }
		   ?>
		   </TABLE> 
		   <BR>
		   <FORM METHOD="GET" action="">
		   <br><br>Deseo actualizar la solicitud No. 
			<input type="HIDDEN" NAME="mostrar" VALUE="<?=$_GET['mostrar']?>">
			<input type="HIDDEN" NAME="numficha" VALUE="<?=$numFicha ?>">
			<input TYPE="TEXT" name="numpeticion" SIZE="5">
		   <input TYPE="SUBMIT" NAME="Submit" VALUE="Ver">
		   </FORM>
	  	   <?
   }
   else
   {	?>
	 	<style type="text/css">
			#ocultoPendiente{
				display:none;
			}
			#oculto{
				display:none;
			}
			#oculto2{
				display:none;
			}
		</style>
		
		<?
	  $rs = @db_query("select numFicha, numSolicitud,espacio,extension,responsable,email,inventario,elemento,estado, descripcionFalla,SolicitudSoporte.fecha,SolicitudSoporte.hora, FichaAtencionSoporte.fecha as fechaAtencion,FichaAtencionSoporte.hora as horaAtencion,  motivoEstado, tipoTrabajo,trabajoRealizado,causaFalla,intervencion,garantia,observaciones 
	  					from SolicitudSoporte,FichaAtencionSoporte 
						where estado='$estado_mostrar' and numSolicitud='$_GET[numpeticion]' and solicitud = '$_GET[numpeticion]' and numFicha = '$_GET[numficha]'");
		
	  $rsPendientes = @db_query(" select * from SolicitudPendExternos where solicitud='$_GET[numpeticion]'");
	  $obj = @pg_fetch_object($rs);
	  $obj1 = @pg_fetch_object($rsPendientes);
	  

	  if( $obj1 ){
		  $existePen='true';
		  $existePendientes='true'; 	  
	  }else{	 
		  $existePendientes='false';
		  $existePen='false';
	  }
	  if( $obj )
	  {	  
	   	 $estado = $obj->estado;
		 if($estado=='e'){ $estado='A&uacute;n no atendida';}
	     else if($estado=='p') {$estado='Pendiente';}
	     else if($estado=='t') {$estado='Ya fue atendida';}
		?>				
		
		<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript">
		
		$(function(){
			$("#elestado").bind("change", function(){
				var value1 = $(this).val();
				if(value1=='p')
					$("#ocultoPendiente").fadeIn("slow");
					//$("#oculto2").fadeIn("slow");
				else
					$("#ocultoPendiente").fadeOut("slow");
					//$("#oculto2").fadeOut("slow");
			});
		});
		
		$(function(){
			$("#remitir").bind("change", function(){
				var value = $(this).val();
				if(value=='true')
					$("#oculto").fadeIn("slow");
					//$("#oculto2").fadeIn("slow");
				else
					$("#oculto").fadeOut("slow");
					//$("#oculto2").fadeOut("slow");
			});
		});
		$(function(){
			$("#remitir").bind("change", function(){
				var value = $(this).val();
				if(value=='true')
					$("#oculto2").fadeIn("slow");
					//$("#oculto2").fadeIn("slow");
				else
					$("#oculto2").fadeOut("slow");
					//$("#oculto2").fadeOut("slow");
			});
		});
				
		</script>
		
		
		
	  	
		  <form action='actualizar.php' method='post'>
		  
		  <h3>Datos de la Solicitud</h3>
		  <TABLE BORDER='0' BGCOLOR='#006699' WIDTH='70%'>		  
		  <TR>
		  		<TD BGCOLOR='#D0DEE9' WIDTH='40%'>No. Peticion:</TD>
				<TD BGCOLOR='#FCFCFC'><INPUT TYPE='HIDDEN'  NAME='numpeticion' VALUE= '<? echo  $obj->numsolicitud ?>'><? echo $obj->numsolicitud ?></TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9' WIDTH='40%'>Espacio:</TD>
				<TD BGCOLOR='#FCFCFC'><INPUT TYPE='HIDDEN' NAME='espacio' VALUE='<? echo  $obj->espacio?>' ><? echo $obj->espacio ?></TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9' WIDTH='40%'>Extensi&oacute;n:</TD>
				<TD BGCOLOR='#FCFCFC'><INPUT TYPE='HIDDEN' NAME='extension' VALUE= '<? echo $obj->extension ?> '>  <? echo $obj->extension ?> </TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9' WIDTH='40%'>Responsable:</TD>
				<TD BGCOLOR='#FCFCFC'><INPUT TYPE='HIDDEN' NAME='responsable' VALUE=' <? echo $obj->responsable ?>' > <? echo $obj->responsable ?> </TD>
		  </TR>
		   <TR>
		  		<TD BGCOLOR='#D0DEE9' WIDTH='40%'>Correo Electr&oacute;nico:</TD>
				<TD BGCOLOR='#FCFCFC'><INPUT TYPE='HIDDEN' NAME='email' VALUE=' <? echo $obj->email ?>' > <? echo $obj->email ?> </TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9' WIDTH='40%'>No. Inventario</TD>
				<TD BGCOLOR='#FCFCFC'><INPUT TYPE='HIDDEN' NAME='inventario' VALUE= ' <? echo $obj->inventario ?> '> <? echo $obj->inventario ?> </TD>
		  </TR>
		    <TR>
		  		<TD BGCOLOR='#D0DEE9' WIDTH='40%'>Elemento</TD>
				<TD BGCOLOR='#FCFCFC'><INPUT TYPE='HIDDEN' NAME='elemento' VALUE= '<? echo  $obj->elemento ?> '> <? echo $obj->elemento ?> </TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9' WIDTH='40%'>Estado solicitud:</TD>
				<TD BGCOLOR='#FCFCFC'> <INPUT TYPE='HIDDEN' NAME='estadoAnterior' VALUE= '<? echo $estado ?>' > <? echo $estado ?>  </TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9' VALIGN='top' WIDTH='40%'>Descripci&oacute;n Falla:</TD>
				<TD BGCOLOR='#FCFCFC'>
					<TEXTAREA readonly COLS='30' ROWS='10' NAME='descripcion'> <? echo $obj->descripcionfalla ?></TEXTAREA>
				</TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9'>Hora/Fecha Petici&oacute;n:</TD>
				<TD BGCOLOR='#FCFCFC'><? echo $obj->hora ."/". $obj->fecha ?></TD>
		  </TR>	
		  </TABLE>
		 <br><br>
		 <h3>Datos del Mantenimiento </h3>
		  <TABLE BORDER='0' BGCOLOR='#006699' WIDTH='70%'>
		 <TR>
		  		<TD BGCOLOR='#D0DEE9' WIDTH='40%'>No.Ficha:</TD>
				<TD BGCOLOR='#FCFCFC'><INPUT TYPE='HIDDEN'  NAME='numeroficha' VALUE= '<? echo $obj->numficha?>' > <? echo $obj->numficha ?></TD>
		  </TR>
		   <TR>
		  		<TD BGCOLOR='#D0DEE9'>Hora/Fecha Atenci&oacute;n:</TD>
				<TD BGCOLOR='#FCFCFC'><INPUT TYPE='HIDDEN' NAME='horaatencion' VALUE= '<? echo $obj->horaatencion.$obj->fechaatencion ?>' > <? echo $obj->horaatencion." / ".$obj->fechaatencion ?></TD>
		  </TR>			
		  <TR>
		  		<TD BGCOLOR='#D0DEE9'>Estado:</TD>
				<TD BGCOLOR='#FCFCFC'>
					<SELECT NAME='estado' id="elestado">
					  
					  <OPTION VALUE='t' <?PHP if($obj->estado=='t')echo 'SELECTED';?>>Ya fue atendida</OPTION>
					  <OPTION VALUE='e' <?PHP if($obj->estado=='e')echo 'SELECTED';?>>A&uacute;n no atendida</OPTION>
					  <OPTION VALUE='p' <?PHP if($obj->estado=='p')echo 'SELECTED';?>>Pendiente </OPTION>
					  
					  
				  </SELECT>
				</TD>
		  </TR>
		  <?
		  if($existePen=='true'){
		  
		  echo"<TR>
					  <TD BGCOLOR='#D0DEE9'>Remitir peticion a:</TD>
					  <TD BGCOLOR='#FCFCFC'>
							<SELECT NAME='correoaremitir'>
							  <OPTION VALUE='usuarios@univalle.edu.co' ".(($obj1->correoaremitir=='usuarios@univalle.edu.co')? 'SELECTED' : '').">usuarios@univalle.edu.co</OPTION>
							  <OPTION VALUE='administrador@correounivalle.edu.co' ".(($obj1->correoaremitir=='administrador@correounivalle.edu.co')? 'SELECTED' : '').">administrador@correounivalle.edu.co </OPTION>
							  <OPTION VALUE='nelson.vidales@correounivalle.edu.co' ".(($obj1->correoaremitir=='nelson.vidales@correounivalle.edu.co')? 'SELECTED' : '').">nelson.vidales@correounivalle.edu.co</OPTION>
							  <OPTION VALUE='andres.escobar@correounivalle.edu.co' ". (($obj1->correoaremitir=='andres.escobar@correounivalle.edu.co')? 'SELECTED' : '').">andres.escobar@correounivalle.edu.co</OPTION>
							  <OPTION VALUE='webwoman@univalle.edu.co' ".(($obj1->correoaremitir=='webwoman@univalle.edu.co')? 'SELECTED' : '').">webwoman@univalle.edu.co</OPTION>
							  
					    </SELECT>
					</TD>
		    </TR>
		  	 <TR >
					  <TD BGCOLOR='#D0DEE9'>Descripcion Mensaje:</TD>
					  <TD BGCOLOR='#FCFCFC'>
							<TEXTAREA COLS='30' ROWS='1' NAME='descripcionMensajeP'>$obj1->descripcionmensaje</TEXTAREA>
					  </TD>
				   </TR>";
					  
		  }else{
		  
		  ?>
		  <TR id="ocultoPendiente">
		  		<TD BGCOLOR='#D0DEE9'>Remitir peticion a externos? :</TD>
				<TD BGCOLOR='#FCFCFC'>
					<SELECT NAME='remitir' size="1" id='remitir'>
					 <OPTION VALUE='false' <?PHP if($existePendientes=='false')echo 'SELECTED';?>>NO </OPTION>
					<OPTION VALUE='true' <?PHP if($existePendientes=='true')echo 'SELECTED';?>>SI</OPTION>
				   
							  
				  </SELECT>
				</TD>
		  </TR>
		  
		  
		 <TR id='oculto'>
		   <TD BGCOLOR='#D0DEE9'>Remitir peticion a:</TD>
		   <TD BGCOLOR='#FCFCFC'>
							<SELECT NAME='correoaremitir'>
							  <OPTION VALUE='usuarios@univalle.edu.co' <?PHP if($obj1->correoAremitir=='usuarios@univalle.edu.co') echo 'SELECTED';?>>usuarios@univalle.edu.co</OPTION>
							  <OPTION VALUE='administrador@correounivalle.edu.co' <?PHP if($obj1->correoAremitir=='administrador@correounivalle.edu.co') echo 'SELECTED';?>>administrador@correounivalle.edu.co </OPTION>
							  <OPTION VALUE='nelson.vidales@correounivalle.edu.co' <?PHP if($obj1->correoAremitir=='nelson.vidales@correounivalle.edu.co') echo 'SELECTED';?>>nelson.vidales@correounivalle.edu.co</OPTION>
							  <OPTION VALUE='andres.escobar@correounivalle.edu.co' <?PHP if($obj1->correoAremitir=='andres.escobar@correounivalle.edu.co') echo 'SELECTED';?>>andres.escobar@correounivalle.edu.co</OPTION>
							  <OPTION VALUE='webwoman@univalle.edu.co' <?PHP if($obj1->correoAremitir=='webwoman@univalle.edu.co') echo 'SELECTED';?>>webwoman@univalle.edu.co</OPTION>
							  
					    </SELECT>
			 </TD>
		   </TR>
				   <TR id='oculto2'>
					  <TD BGCOLOR='#D0DEE9'>Descripcion Mensaje:</TD>
					  <TD BGCOLOR='#FCFCFC'>
							<TEXTAREA COLS='30' ROWS='10' NAME='descripcionMensajeP'><? echo $obj1->descripcionMensaje?> </TEXTAREA>
					  </TD>
				   </TR>
				  
		  
		  <TR>
		  <?
		  }
		  ?>
		  		<TD BGCOLOR='#D0DEE9' VALIGN='top'>Motivo <br>(Estado Pendiente):</TD>
				<TD BGCOLOR='#FCFCFC'>
					<TEXTAREA COLS='30' ROWS='10' NAME='motivoEstado'><? echo $obj->motivoestado ?></TEXTAREA>
				</TD>
		  </TR>

		  <TR>
		  		<TD BGCOLOR='#D0DEE9'>Tipo:</TD>
				<TD BGCOLOR='#FCFCFC'>
					<SELECT NAME='tipoTrabajo'>
					  <OPTION VALUE=''  <?PHP if($obj->tipotrabajo=='') echo 'SELECTED';?> >&nbsp;</OPTION>
					  <OPTION VALUE='s'  <?PHP if($obj->tipotrabajo=='s') echo 'SELECTED';?>  >Soporte</OPTION>
					  <OPTION VALUE='p'  <?PHP if($obj->tipotrabajo=='p') echo 'SELECTED';?> >Preventivo</OPTION>
					  <OPTION VALUE='f'  <?PHP if($obj->tipotrabajo=='f') echo 'SELECTED';?> >Falla (Correctivo)</OPTION>
				  </SELECT>
				</TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9' VALIGN='top'>Descripci&oacute;n Soporte Realizado:</TD>
				<TD BGCOLOR='#FCFCFC'>
					<TEXTAREA COLS='30' ROWS='10' NAME='trabajoRealizado'><? echo $obj->trabajorealizado ?></TEXTAREA>
				</TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9'>Causa Falla:</TD>
				<TD BGCOLOR='#FCFCFC'>
					<SELECT NAME='causaFalla'>
					  <OPTION VALUE='' <?PHP if($obj->causafalla=='') echo 'SELECTED';?>>&nbsp;</OPTION>
					  <OPTION VALUE='t' <?PHP if($obj->causafalla=='t') echo 'SELECTED';?>>Tecnica</OPTION>
					  <OPTION VALUE='u' <?PHP if($obj->causafalla=='u') echo 'SELECTED';?>>Usuario</OPTION>
				  </SELECT>
				</TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9'>Intervenci&oacute;n:</TD>
				<TD BGCOLOR='#FCFCFC'>
					<SELECT NAME='intervencion'>
					  <OPTION VALUE=''<?PHP if($obj->intervencion=='') echo 'SELECTED';?>>&nbsp;</OPTION>
					  <OPTION VALUE='r'<?PHP if($obj->intervencion=='r') echo 'SELECTED';?>>Reparaci&oacute;n</OPTION>
					  <OPTION VALUE='c' <?PHP if($obj->intervencion=='c') echo 'SELECTED';?>>Cambio</OPTION>
					  <OPTION VALUE='b' <?PHP if($obj->intervencion=='b') echo 'SELECTED';?>>Baja</OPTION>
					  <OPTION VALUE='a' <?PHP if($obj->intervencion=='a') echo 'SELECTED';?>>Actualizaci&oacute;n</OPTION>
					  <OPTION VALUE='co' <?PHP if($obj->intervencion=='co') echo 'SELECTED';?>>Correci&oacute;n</OPTION>
					  <OPTION VALUE='is' <?PHP if($obj->intervencion=='is') echo 'SELECTED';?>>Instalaci&oacute;n Software</OPTION>
				  </SELECT>
				</TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9'>Garantia:</TD>
				<TD BGCOLOR='#FCFCFC'>
					<SELECT NAME='garantia'>
					  <OPTION VALUE='' <?PHP if($obj->garantia=='') echo 'SELECTED';?>>&nbsp;</OPTION>
					  <OPTION VALUE='s'  <?PHP if($obj->garantia=='s') echo 'SELECTED';?>>Si</OPTION>
					  <OPTION VALUE='n'  <?PHP if($obj->garantia=='n') echo 'SELECTED';?>>No</OPTION>
				  </SELECT>
				</TD>
		  </TR>
		  <TR>
		  		<TD BGCOLOR='#D0DEE9' VALIGN='top'>Observaciones:</TD>
				<TD BGCOLOR='#FCFCFC'>
					<TEXTAREA COLS='30' ROWS='10' NAME='observaciones'><? echo $obj->observaciones ?></TEXTAREA>
				</TD>
		  </TR>
		  <TR>
		   		<TD COLSPAN=2 ALIGN='CENTER'>
					<INPUT TYPE='hidden' NAME='fichaAtencion' VALUE='<? echo $obj->numsolicitud ?>'>
					<INPUT TYPE='SUBMIT' NAME='ActualizarPeticion' VALUE='Actualizar'>       
					
				</TD>
		  </TR>
		  </TABLE>

		  </form>
		   
		  <BR><center><a href='revisar.php'>Volver a la lista de solicitudes</a></center>
     <?
	  
   }//if( $obj )
   else{?>
	      <BR>
	      No existe ninguna solicitud con ese n&uacute;mero.
		  <BR><center><a href='revisar.php'>Volver a la lista de solicitudes</a></center> <? }
} 
 PageEnd();
 ?>