<?
	require 'functions.php';
	$rootPath = '.';
	
	session_start();
	
	PageInit('Envío de Comentarios y Sugerencias','correo.php');
	if (isset($_POST['Submit'])) {
		if ($_POST['keyform'] == "keyform"){
			if ($_SESSION['tmptxt'] == $_POST['tmptxt']) {
				if ($_POST['subject'] && $_POST['nombre'] && $_POST['mensaje'] && $_POST['correo']) {	
			
			$ip = getIP();
			
			$con= @DBConnect('fayol');
			
			if(!empty($con)){
				$date=date("Y-m-d");
				$hora = getdate(time());
				$time=$hora["hours"] . ":" . $hora["minutes"] . ":" . $hora["seconds"] ;
				//consulta de cantidad de sugerencias recibidas en el dia
				$consulta="select count(id) from sugerencias where fecha=$date";
				$rs = db_query($consulta);
					if($rs<=50){
					
						//inserccion de sugerencia
						//db_query("INSERT INTO sugerencias VALUES (NEXTVAL('seq_sugerencia'),'$nombre','$correo','$tipo_usuario','$tipo_sugerencia','$subject','$destinatario','$mensaje','pendiente','$date','$time');");
						# Aqui chequeo cual es el ultimo identificador
							//$rs2 = db_query("SELECT MAX(id) AS id FROM sugerencias");
							//$obj = pg_fetch_object($rs2);
							//$id = $obj->id;							
							
							if($destinatario=="webwoman@univalle.edu.co"){
							$cuerpo_mensaje = "		
													DESTINO: $destinatario
													NOMBRE: $nombre
													E-MAIL: $correo
													TIPO DE USUARIO: $tipo_usuario
													TIPO DE SUGERENCIA: $tipo_sugerencia
													TITULO: $subject
													DESCRIPCION DE LA SUGERENCIA: $mensaje
													FECHA: $date
													HORA: $time
													
												";
							}else{$cuerpo_mensaje = "
													 DESTINO: $destinatario	
													 NOMBRE: $nombre
													 E-MAIL: $correo
													 TIPO DE USUARIO: $tipo_usuario
													 TIPO DE SUGERENCIA: $tipo_sugerencia
													 TITULO: $subject
													 DESCRIPCION DE LA SUGERENCIA: $mensaje
													 FECHA: $date
													 HORA: $time
												";		
							}
							
							//Envio nuevo correo facultad
							mail("fayol.univalle@gmail.com", "SUGERENCIAS PAGINA WEB ADMINISTRACION-UNIVALLE", "\n$cuerpo_mensaje\n\n$ip", "From: $correo");
						//envio de sugerencia al correo
							if (mail($destinatario, "SUGERENCIAS PAGINA WEB ADMINISTRACION-UNIVALLE", "\n$cuerpo_mensaje\n\n$ip", "From: $correo")) {
								echo "<script type='text/javascript'> { alert ('Su sugerencia a sido enviada satisfactoriamente') } </script>"; 
								echo "<script>document.location.href='comentarios.php?ComeFrom=/index.php'</script>\n";
								//header("Location:comentarios.php?ComeFrom=/index.php");
								//die();
							}
							else {
								$error = 1;
								}// termina envio de sugerencia
								
								
						}//if # sugerencias del dia
					}// if de base de datos
			}else{$error = 2;}
			}
			
			if (isset($error)){
				if ($error==1) {
					Failed("Ocurrió un error al mandar su mensaje, por favor intente de nuevo más tarde");
				}
				elseif ($error==2) {
					Failed("Por favor llene todos los campos del formulario para poder enviar su correo");
				}
			}else{Failed("intentalo de nuevo ");}
			
		}
		
	}
	  	
	
	
	
	
	

?>
<style type="text/css">
<!--
.Estilo1 {color: #666666}
-->
</style>

<FORM METHOD="POST" ACTION="">
<TABLE>
	
	<TR>
		<TD width="10" VALIGN="TOP"><IMG SRC="Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" ALT=""></TD>
		<TD width="254">Nombre:<BR>
		<INPUT NAME="nombre" TYPE="text" ID="nombre" SIZE="30" MAXLENGTH="100" VALUE="<?= $_POST['nombre'] ?>"></TD>
		<TD width="10" VALIGN="TOP"><IMG SRC="Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" ALT=""></TD>
		<TD width="262">Correo electr&oacute;nico:<BR>
            <INPUT NAME="correo" TYPE="text" ID="correo" SIZE="33" MAXLENGTH="100" VALUE="<?= $_POST['correo'] ?>"></TD>
	</TR>
	
	<TR>
		<TD height="73" VALIGN="TOP"><IMG SRC="Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" ALT=""></TD>
		<TD><p>Tipo Usuario :	      <BR>
            <select name="tipo_usuario">
		      <option value="Estudiante Pregrado" selected>Estudiante Pregrado</option>
		      <option value="Estudiante Postgrado">Estudiante Postgrado</option>
		      <option value="Docente">Docente</option>
		      <option value="Funcionario">Funcionario</option>
		      <option value="Egresado">Egresado</option>
		      <option value="Pensionado">Pensionado</option>
	      </select>
		</p>
	     <p>&nbsp;	        </p></TD><BR>
			<TD VALIGN="TOP"><IMG SRC="Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" ALT=""></TD>
		<TD><p>Tipo de Sugerencia :	      <BR>
            <select name="tipo_sugerencia">
		      <option value="Sugerencia" selected>Sugerencia</option>
		      <option value="Queja">Queja</option>
		      <option value="Reclamo">Reclamo</option>
		      <option value="Reconocimiento">Reconocimiento</option>
	      </select>
		</p>
	     <p>&nbsp;	        </p></TD><BR>
	</TR>
	
	<TR>
		<TD VALIGN="TOP"><IMG SRC="Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" ALT=""></TD>
		<TD colspan="3"><p>T&iacute;tulo del mensaje (Subject): <BR>
            <INPUT NAME="subject" TYPE="text" ID="subject" SIZE="30" MAXLENGTH="100" VALUE="<?= $_POST['subject'] ?>">
		    </p>
		  </TD>
	</TR>
	<TR>
		<TD VALIGN="TOP"><IMG SRC="Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" ALT=""></TD>
		<TD colspan="3"><p>Destinatario de su correo :<BR>
            <select name="destinatario">
		      <option value="webwoman@univalle.edu.co" selected>WebMaster (Pagina Web)</option>
		      <option value="areadmisiones@admisiones.univalle.edu.co">Area de admisiones</option>
		      <option value="contadur@fayol.univalle.edu.co">Pregrado de Contaduria Publica</option>
		      <option value="admon@fayol.univalle.edu.co">Pregrado de Administracion de Empresas</option>
		      <option value="comercioexterior@fayol.univalle.edu.co">Pregrado de Comercio Exterior</option>
		      <option value="magisadm@fayol.univalle.edu.co">Maestria en Administracion de Empresas</option>
		      <option value="pmo@fayol.univalle.edu.co">Maestria en Ciencias de la Organizacion</option>
		      <option value="mpp@fayol.univalle.edu.co">Maestria en Politicas Publicas</option>
		      <option value="pef@fayol.univalle.edu.co">Especializacion en Finanzas</option>
		      <option value="market@fayol.univalle.edu.co">Especializacion en Marketing Estrategico</option>
		      <option value="calidad@fayol.univalle.edu.co">Especializacion en Admon Total de la Calidad</option>
		      <option value="mpp@fayol.univalle.edu.co">Especializacion en Administracion Publica</option>
		      <option value="mpp@fayol.univalle.edu.co">Especializacion en Politica y Gestion Publica</option>
		      <option value="seminari@univalle.edu.co">Diplomados</option>
	      </select>
		</p>
	  </TD>
    </TR>
	<TR>
		<TD VALIGN="TOP"><IMG SRC="Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" ALT=""></TD>
		<TD colspan="3">Mensaje:<BR>
		<TEXTAREA NAME="mensaje" COLS="55" ROWS="6" ID="mensaje"><?= $_POST['mensaje'] ?></TEXTAREA></TD>
	</TR>
		
	<TR>
		
		<TD COLSPAN="4" ALING="CENTER"><div align="center"><img src="captcha2.php" align="captcha"  width="100" height="30" /></div></TD>
	</TR>
	<TR>
	  <TD COLSPAN="4"><div align="center" class="Estilo1">*ingresar el texto mostrado en la imagen</div></TD>
    </TR>
	<TR>
	  <TD COLSPAN="4"><div align="center">
	    <INPUT NAME="tmptxt" TYPE="text" ID="tmptxt" SIZE="10" MAXLENGTH="6">
      </div></TD>
    </TR>
	<TR>
	  <TD COLSPAN="4">&nbsp;</TD>
    </TR>
	<TR>
		<TD COLSPAN="4" ALIGN="CENTER"> <INPUT TYPE="submit" NAME="Submit" VALUE="Enviar">
	    <input name="LIMPIAR" type="reset" id="LIMPIAR" value="Limpiar"></TD>
		<input type="hidden" name="keyform" value="keyform">
	</TR>
</TABLE>
</FORM>
<?
	PageEnd();
?>