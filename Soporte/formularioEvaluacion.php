<?
    require '../../functions.php';
    //$root_path = "../..";
	
    PageInit('Formulario Calificaci&oacute;n Soporte T&eacute;cnico', '../../correo.php');

    $con= @DBConnect('fayol');

    $id_peticion=$_GET['id_peticion'];

    $rs3=db_query("select count(numFicha) as n from fichaAtencionSoporte where estado='e'");
    $obj1 = pg_fetch_object($rs3);
    $cont_pendientes = $obj1->n;
	
	
    if(@$_POST['key_form']=="key_form"){
		
	if(!empty($con)){
									
            if (isset($_POST['Submit'])) {
                if ($_POST['amabilidad'] && $_POST['habilidad'] && $_POST['gradoInform'] && $_POST['proceso'] && $_POST['rapidez'] && $_POST['solucion_problema'] && $_POST['capacitacion'] && $_POST['rendimiento']) {	
				
                    $rs2 = db_query("select id from calificacionSoporte where numsolicitud=$id_peticion");
                    $obj = pg_fetch_object($rs2);
                    $id = $obj->id;

                    $consulta2=db_query("select * from solicitudsoporte where numsolicitud='$id_peticion'");
                    $rs1 =  pg_fetch_object($consulta2);
                    $emailConfirmacion=$rs1->email;

                    $date=date("Y-m-d");
                    
                    $rapidez = $_POST['rapidez'];
                    $capacitacion = $_POST['capacitacion'];
                    $solucion_problema = $_POST['solucion_problema'];
                    $proceso = $_POST['proceso'];
                    $mensaje = $_POST['mensaje'];
                    $rendimiento = $_POST['rendimiento'];
                    $amabilidad = $_POST['amabilidad'];
                    $habilidad = $_POST['amabilidad'];
                    $gradoInform = $_POST['gradoInform'];
                    
						
                    if($id==0){
					
                        db_query("INSERT INTO calificacionSoporte VALUES
                                        (NEXTVAL('seq_calificacionSoporte'),'$id_peticion','$rapidez','$capacitacion','$solucion_problema','$proceso','$mensaje','$date','$rendimiento','$amabilidad','$habilidad','$gradoInform');");

                        $mensajeConfirmacion="Gracias por hacer la evaluacion de Calificacion del Servicio De Soporte Tecnico de la facultad";
                        Succeded($mensajeConfirmacion);
                        if ( mail("$emailConfirmacion", "Calificacion Soporte Tecnico", "<br>$mensajeConfirmacion", "From: Soporte Tecnico Facultad Administracion")) {
                            $mensajeConfirmacion=$mensajeConfirmacion."
                            NUMERO PETICION=$id_peticion 
                            Calificacion Tiempo de Respuesta Solicitud: $rapidez
                            Recibio Capacitacion? : $capacitacion
                            Calificacion Solucion del Problema: $solucion_problema
                            Nivel de Rendimiento : $rendimiento
                            Amabilidad en atencion: $amabilidad
                            Grado de habilidad: $habilidad
                            Grado informacion de la falla: $gradoInform
                            Nivel Satisfaccion: $proceso
                            Comentarios: $mensaje";
															
                            mail("soporte.fca@correounivalle.edu.co", "Calificacion Soporte Tecnico", "<br>$mensajeConfirmacion", "From: Soporte Tecnico Facultad Administracion");
                            echo "<script type='text/javascript'> { alert ('Se ha enviado su evaluacion de calificacion satisfactoriamente') } </script>"; 
                            echo "<script>document.location.href='/index.php'</script>\n";
                        } else {
                            $error = 1;
                        }
										
                    }else{
                        db_query("UPDATE calificacionSoporte SET numsolicitud='$id_peticion', tiempo_respuesta='$rapidez', capacitacion='$capacitacion',
                                solucion_problema='$solucion_problema', 
                                nivel_satisfaccion='$proceso', 
                                comentarios='$mensaje', 
                                fechacalificacion='$date', 
                                rendimiento='$rendimiento', 
                                amabilidad='$amabilidad', 
                                habilidad='$habilidad', 
                                proceso='$gradoInform' 
                                where id='$id';");
							
		
                        $mensajeConfirmacion="Gracias por hacer la evaluacion de Calificacion del Servicio De Soporte Tecnico de la facultad";

                        if ( mail("$emailConfirmacion", "Calificacion Soporte Tecnico", "<br>$mensajeConfirmacion", "From: Soporte Tecnico Facultad Administracion")) {
                            $mensajeConfirmacion=$mensajeConfirmacion."	NUMERO PETICION=$id_peticion 
                            Calificacion Tiempo de Respuesta Solicitud: $rapidez
                            Recibio Capacitacion? : $capacitacion
                            Calificacion Solucion del Problema: $solucion_problema
                            Nivel de Rendimiento : $rendimiento
                            Amabilidad en atencion: $amabilidad
                            Grado de habilidad: $habilidad
                            Grado informacion de la falla: $gradoInform
                            Nivel Satisfaccion: $proceso
                            Comentarios: $mensaje";
															
															
                            mail("soporte.fca@correounivalle.edu.co", "Calificacion Soporte Tecnico", "<br>$mensajeConfirmacion", "From: Soporte Tecnico Facultad Administracion");
                            echo "<script type='text/javascript'> { alert ('Se ha enviado su evaluacion de calificacion satisfactoriamente') } </script>"; 
                            echo "<script>document.location.href='/index.php'</script>\n";
                        }else {
                            $error = 1;
                        }					

                        if (isset($error)){
                            if ($error==1) {
                                Failed("Ocurri&oacute; un error al mandar su mensaje, por favor intente de nuevo m&aacute;s tarde");
                            }
                        }
							
                    }
					
                }else{
                    Failed("Por favor llene todos los campos del formulario para poder enviar su correo");
                }
                    //faltan datos
            }
	
        }

    }
	
?>
<link href="../../estiloweb.css" rel="stylesheet" type="text/css">
<FORM METHOD="POST" ACTION="">
<TABLE>
    <h1 class="shiny">Formulario de Calificaci&oacute;n de Soporte T&egrave;cnico</h1>
    <TR>
        <TD width="12" VALIGN="TOP">&nbsp;</TD>
        <TD colspan="3">
            <p>
                <strong>Su opini&oacute;n es importante para el mejoramiento continuo de nuestro 
                    servicio,por favor diligencie el siguiente formulario.</strong>
            </p>
            <p>Su solicitud fue la numero: <? echo"$id_peticion" ?> de <? echo"$cont_pendientes"  ?> 
                pendientes.
            </p>
        </TD>
    </TR>
    <TR>
        <TD VALIGN="TOP">
            <p>
                <img src="../../Images/plantilla/triangulorojo.gif" width="10" height="14">
            </p>
        </TD>
        <TD colspan="3">
            <p> Teniendo en cuenta la anterior informacion califique el tiempo de respuesta 
                a su solicitud.
            </p>
            <p>
                <input name="rapidez" type="radio" value="rapido">
                R&aacute;pido
            </p>
            <p>
                <input name="rapidez" type="radio" value="normal"> 
                Normal 
            </p>
            <p>
                <input name="rapidez" type="radio" value="no_rapido"> 
                No muy rapido
            </p>
            <p>
                <input name="rapidez" type="radio" value="inoportuna"> 
                Inoportuna
            </p>
        </TD>
    </TR>
    <TR>
        <TD VALIGN="TOP">
            <img src="../../Images/plantilla/triangulorojo.gif" width="10" height="14">
        </TD>
        <TD colspan="3">
            Califique el nivel de rendimiento, teniendo en cuenta la realizaci&oacute;n 
            de las tareas, actividades y trabajos
        </TD>
    </TR>
    <TR>
        <TD VALIGN="TOP">&nbsp;
        </TD>
        <TD colspan="3">
            <p>
                <input name="rendimiento" type="radio" value="exelente">
                Excelente 
            </p>
            <p>
                <input name="rendimiento" type="radio" value="bueno">
                Bueno 
            </p>
            <p>
                <input name="rendimiento" type="radio" value="insatisfactorio"> 
                Insatisfactorio
            </p>
        </TD>
    </TR>
    <TR>
        <TD VALIGN="TOP">
            <p>
                <img src="../../Images/plantilla/triangulorojo.gif" width="10" height="14">
            </p>
        </TD>
        <TD colspan="3">
            <p>Usted recibio una explicacion detallada de la falla ?
            </p>
        </TD>
    </TR>
    <TR>
        <TD VALIGN="TOP">&nbsp;
        </TD>
        <TD width="257">
            <p>
                <input name="capacitacion" type="radio" value="si">	  
                Si
            </p>
        </TD>
        <TD width="193">
            <input name="capacitacion" type="radio" value="no">
            No
        </TD>
        <TD width="211">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </TD>
    </TR>
    <TR>
        <TD VALIGN="TOP">
            <p>
                <img src="../../Images/plantilla/triangulorojo.gif" width="10" height="14"></p>
        </TD>
        <TD colspan="3">
            <p>Califique la solucion del problema </p>
            <p>
                <input name="solucion_problema" type="radio" value="completo"> 
                Completo
            </p>
            <p>
                <input name="solucion_problema" type="radio" value="parcial">
                Parcial
            </p>
            <p>
                <input name="solucion_problema" type="radio" value="pendiente">
                Pendiente
            </p>
        </TD>
    </TR>
    <TR>
        <TD VALIGN="TOP">
            <img src="../../Images/plantilla/triangulorojo.gif" width="10" height="14">
        </TD>
        <TD colspan="3">
            <p>Por favor califique su grado de satisfacci&oacute;n en los siguientes puntos, teniendo en cuenta que</p>
            <p>
                <strong>1</strong> es insuficiente, 
                <strong>2</strong> deficiente, 
                <strong>3</strong> regular, 
                <strong>4</strong> buena y 
                <strong>5</strong> excelente satisfacci&oacute;n del usuario
            </p>
        </TD>
    </TR>
    <TR>
        <TD VALIGN="TOP">&nbsp;</TD>
        <TD colspan="3">
            <table width="615" border="0" cellpadding="1">
                <tr>
                    <td>&nbsp;
                        
                    </td>
                    <td>
                        <div align="center"><strong><em>1</em></strong></div>
                    </td>
                    <td>
                        <div align="center"><strong><em>2</em></strong></div>
                    </td>
                    <td>
                        <div align="center"><strong><em>3</em></strong></div>
                    </td>
                    <td>
                        <div align="center"><strong><em>4</em></strong></div>
                    </td>
                    <td>
                        <div align="center"><strong><em>5</em></strong></div>
                    </td>
                </tr>
                <tr>
                    <td width="432">
                        <p>
                            <strong>a.</strong> Respeto y amabilidad en la atenci&oacute;n :
                        </p>
                    </td>
                    <td width="33">
                        <div align="center">
                        <input name="amabilidad" type="radio" value="insuficiente">
                        </div>
                    </td>
                    <td width="32">
                        <div align="center">
                        <input name="amabilidad" type="radio" value="deficiente">
                        </div>
                    </td>
                    <td width="31">
                        <div align="center">
                        <input name="amabilidad" type="radio" value="regular">
                        </div>
                    </td>
                    <td width="31">
                        <div align="center">
                        <input name="amabilidad" type="radio" value="buena">
                        </div>
                    </td>
                    <td width="30">
                        <div align="center">
                        <input name="amabilidad" type="radio" value="excelente" checked>
                        </div>
                    </td>
              </tr>
              <tr>
                <td>
                    <p>
                        <strong>b.</strong> Indique el grado de habilidad del representante de la oficina de sistemas asignado a su caso 
                    </p>
                </td>
                <td>
                    <div align="center">
                    <input name="habilidad" type="radio" value="insuficiente">
                    </div>
                </td>
                <td>
                    <div align="center">
                    <input name="habilidad" type="radio" value="deficiente">
                    </div>
                </td>
                <td>
                    <div align="center">
                    <input name="habilidad" type="radio" value="regular">
                    </div>
                </td>
                <td>
                    <div align="center">
                    <input name="habilidad" type="radio" value="buena">
                    </div>
                </td>
                <td>
                    <div align="center">
                    <input name="habilidad" type="radio" value="excelente" checked>
                    </div>
                </td>
            </tr>
            <tr>
              <td>  <p><strong>c.</strong> Se&ntilde;ale el grado de informaci&oacute;n que recibe usted sobre la evoluci&oacute;n o finalizaci&oacute;n de su caso 
                          </p>
              </td>
              <td>              <div align="center">
                <input name="gradoInform" type="radio" value="insuficiente">
              </div></td>
              <td>              <div align="center">
                <input name="gradoInform" type="radio" value="deficiente">            
              </div></td>
              <td>              <div align="center">
                <input name="gradoInform" type="radio" value="regular">            
              </div></td>
              <td>              <div align="center">
                <input name="gradoInform" type="radio" value="buena">            
              </div></td>
              <td>              <div align="center">
                <input name="gradoInform" type="radio" value="excelente" checked>            
              </div></td>
            </tr>
              <tr>
                <td><span class="DescripcionPregunta"> <strong>d.</strong> En total, &iquest;c&oacute;mo calificar&iacute;a el proceso hasta que se resolvi&oacute; su incedencia?</span></td>
                <td><div align="center">
                  <input name="proceso" type="radio" value="insuficiente">
                  </div></td>
                <td><div align="center">
                  <input name="proceso" type="radio" value="deficiente">
                </div></td>
                <td><div align="center">
                  <input name="proceso" type="radio" value="regular">
                </div></td>
                <td><div align="center">
                  <input name="proceso" type="radio" value="buena">
                </div></td>
                <td><div align="center">
                  <input name="proceso" type="radio" value="excelente" checked>
                </div></td>
              </tr>
        </table>	    
	    <p>&nbsp;</p>
      </TD>
    </TR>
    <TR>
        <TD VALIGN="TOP"><img src="../../Images/plantilla/triangulorojo.gif" width="10" height="14"></TD>
        <TD colspan="3">Comentarios:<BR>
        <TEXTAREA NAME="mensaje" COLS="55" ROWS="6" ID="mensaje"><?= $_POST['mensaje'] ?></TEXTAREA></TD>
    </TR>
    <TR>
        <TD COLSPAN="2">&nbsp;</TD>
    </TR>
    <TR>
        <TD COLSPAN="3" ALIGN="CENTER">
            <INPUT TYPE="submit" NAME="Submit" VALUE="Enviar">
            <input name="Submit1" type="reset" id="Submit1" value="Limpiar">
        </TD>
        <input type="hidden" name="key_form" value="key_form">
    </TR>
</TABLE>
</FORM>
<?
	PageEnd();
?>