<script type="text/javascript" src="jquery.blockUI.js"></script>

<?
	require("mail.php");
	require '../../functions.php';
	$rootPath = '../../';
	
	session_start();
	
	$_GET['submenu_solicitudes'] = true;
   
	DBConnect('fayol');
	
	function enviarCorreo($solicitud)
	{
		$message_body = "Coordial Saludo <br>Su solicitud para soporte técnico ha sido recibida.<br><br>";
			
		$message_body = $message_body."<br>Detalle de la Solicitud";
		$message_body = $message_body."<br>Solicitud Número: $solicitud";
		$message_body = $message_body."<br>"."Elemento para Soporte: $_POST[elemento]";
		$message_body = $message_body."<br>"."Espacio: $_POST[espacio]";
		$message_body = $message_body."<br>"."Número de Inventario: $_POST[inventario]"; 
		$message_body = $message_body."<br>"."Descripción de la Falla: $_POST[descripcion]"; 	
		$message_body = $message_body."<br>"."Responsable: $_POST[nombre] $_POST[apellidos]";
		$message_body = $message_body."<br><br><br>"."Atentamente,<br><br>Oficina de Sistemas.";
				
		//mail("luis.pena@correounivalle.edu.co", "Solicitud de Soporte", $message_body);
		//mail("nelson.a.munoz@correounivalle.edu.co", "Solicitud de Soporte", $message_body);
		mail($_POST[email], "Solicitud de Soporte", $message_body);
		
		sendmail($message_body, "Solicitud de Soporte", "luis.pena@correounivalle.edu.co", "Soporte Sistemas FCA","");
		sendmail($message_body, "Solicitud de Soporte", "nelson.a.munoz@correounivalle.edu.co", "Soporte Sistemas FCA","");
		sendmail($message_body, "Solicitud de Soporte", "luis.gallardo@correounivalle.edu.co", "Soporte Sistemas FCA","");
		
		sendmail($message_body, "Solicitud de Soporte", $_POST[email], "Soporte Sistemas FCA","");
		sendmail($message_body, "Solicitud de Soporte", "oscar.beltran@correounivalle.edu.co", "Soporte Sistemas FCA","");
	}
	
	if( isset($_POST['Submit']) )
	{
            /**echo "<script type='text/javascript'>";
            echo"$(document).ready(function() { $.blockUI({message: '<h1>Auto-Unblock!</h1>',timeout: 2000}); });";
            echo "</script> ";*/
                    
		if( $_POST[extension] && $_POST[espacio] && $_POST[nombre] && $_POST[apellidos] && $_POST[vinculacion] && $_POST[elemento] && $_POST[inventario] && $_POST[descripcion] && $_POST[email])
		{
			$ip = getIP();
			$hora = date('H:i:s');
			$fecha = date('m-d-Y');
			$responsable = $_POST[nombre]." ".$_POST[apellidos];
			
			$res = db_query("
			INSERT INTO SolicitudSoporte(elemento,inventario,responsable,ip,espacio,extension,vinculacion,descripcionFalla,hora,fecha,email)
			VALUES('$_POST[elemento]','$_POST[inventario]','$responsable','$ip','$_POST[espacio]','$_POST[extension]', '$_POST[vinculacion]','$_POST[descripcion]', '$hora', '$fecha', '$_POST[email]')
			");
			
			$res = db_query("SELECT last_value from SolicitudSoporte_seq");
			$obj = pg_fetch_object($res);
			$solicitud = $obj->last_value;
				
			$res1 = db_query("INSERT INTO FichaAtencionSoporte(solicitud,estado,hora,fecha)VALUES('$solicitud','e','$hora', '$fecha')");
			
			if(!empty($_POST['email']))
			{
		
				enviarCorreo($solicitud);
			}
                        
                        echo "<script type='text/javascript'>";
                        echo "desbloquear()"; 
                        echo "</script> ";
                        			
			header("Location: realizar.php?Succeded=$solicitud");
			die();
		}
		else $campos_en_blanco = true;
	}
   
	$valign = 'top';
	PageInit('Solicitud de Soporte Técnico', '../menu.php');
   
	?> <H1 class="shiny">Formato de Solicitud de Soporte T&eacute;cnico</H1> <?
   
	if( isset($_GET['Succeded']) )
	{
		echo '<center><br>';
		Succeded("<div align=\"justify\">Su petici&oacute;n de soporte ha sido recibida y en este momento se encuentra en cola de espera.<BR><br>
		Su petici&oacute;n es la n&uacute;mero $_GET[Succeded], si desea ver el estado de su petici&oacute;n d&eacute;
		click <a href='revisar.php'>aqu&iacute;</a></div></center>");
		PageEnd();
		die();
	}
	if( $campos_en_blanco )
		echo '<br><font size="2" color="red">Por favor llene todos los campos para que su petici&oacute;n pueda ser procesada.</font>';
   
	?>
        <div name='Bloquear' id='bloquea' class='cargando' style='display:none;'>
            <img style="margin-left: 5%;margin-top: 15%" alt="Espere..." src="/../Images/nelson.jpg" />
        </div>
        
        
	<P>La oficina de Soporte en Sistemas est&aacute; ubicada en el espacio 2065 del edificio de la Facultad de 
	Ciencias de la Administraci&oacute;n. Este m&oacute;dulo le permite hacer una solicitud de soporte 
	t&eacute;cnico al personal encargado, sin necesidad de desplazarse hasta la Oficina de Sistemas ni esperar a 
	que entre la llamada a nuestra extensi&oacute;n.</P>
	
<form action="" method="post">
  <fieldset>
    <legend><B CLASS="shiny">Informaci&oacute;n del Solicitante</B></legend>
    <TABLE WIDTH="100%">
	<TR>
		<TD><B>Espacio</B></TD>
		<TD><INPUT VALUE="<?= $_POST['espacio'] ?>" NAME="espacio" TYPE="TEXT" ID="espacio" SIZE="20" MAXLENGTH="4"></TD>
		<TD><B>Extensi&oacute;n </B></TD>
		<TD><INPUT VALUE="<?= $_POST['extension'] ?>" NAME="extension" TYPE="TEXT" SIZE="20" MAXLENGTH="4"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD><B>Nombre </B></TD>
		<TD><INPUT VALUE="<?= $_POST['nombre'] ?>" NAME="nombre" TYPE="TEXT" SIZE="20" MAXLENGTH="49"></TD>
		<TD><B>Apellidos </B></TD>
		<TD><INPUT VALUE="<?= $_POST['apellidos'] ?>" NAME="apellidos" TYPE="TEXT" SIZE="20" MAXLENGTH="49"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD colspan="2"><B>Vinculaci&oacute;n (Por ejemplo: Docente)</B></TD>
		<TD colspan="2"><select name="vinculacion">
				<option>&nbsp;</option>				
				<option<? if($datos_salida['vinculacion'] == 'Monitor') echo " selected "; ?>>Monitor</option>
				<option<? if($datos_salida['vinculacion'] == 'Docente') echo " selected "; ?>>Docente</option>
				<option<? if($datos_salida['vinculacion'] == 'Empleado') echo " selected "; ?>>Empleado</option>
				<option<? if($datos_salida['vinculacion'] == 'Personal Externo') echo " selected "; ?>>Personal Externo</option>				
			</select>
		</TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>
	<TR>
		<TD colspan="2"><B>Correo Electr&oacute;nico</B></TD>
		<TD colspan="2"><INPUT VALUE="<?= $_POST['email'] ?>" NAME="email" TYPE="TEXT" ID="email" SIZE="60" MAXLENGTH="60"></TD>
	</TR>
	</table>
  </fieldset>
<br>
  <fieldset>
    <legend><B CLASS="shiny">Informaci&oacute;n del Elemento</b></legend>
     <TABLE WIDTH="100%">
	<TR>
		<TD><B>N&uacute;mero del inventario del equipo</B></TD>
		<TD><INPUT VALUE="<?= $_POST['inventario'] ?>" TYPE="TEXT" NAME="inventario" SIZE="10" MAXLENGTH="8"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD><B>Elemento para soporte</B></TD>
		<TD><INPUT VALUE="<?= $_POST['elemento'] ?>" TYPE="TEXT" NAME="elemento" SIZE="30" MAXLENGTH="100"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD COLSPAN="2"><P><B>Descripci&oacute;n del problema</B><BR><br>
		<FONT SIZE="-1">Por favor detalle los aspectos relevantes que puedan ayudarnos a diagnosticar las causas 
		de su problema. Si su solicitud es con respecto a problemas en el funcionamiento del equipo por favor 
		indique lo que se encontraba haceindo antes en el momento previo a que apareciera el problema.</FONT>
		</P>
		<CENTER><TEXTAREA COLS="60" ROWS="8" NAME="descripcion"><?= $_POST['descripcion'] ?></TEXTAREA></CENTER>
		</TD>
	</TR>
   </TABLE>
  </fieldset>
  <p style="text-align: center; font-size: 22px; color: #8C0002;">Presione s&oacute;lo una  vez por favor</p>
  <div id="enviar" align="center">
    <INPUT TYPE="SUBMIT" NAME="Submit" VALUE="Enviar Peticion">
  </div>
  <p style="text-align: center; font-size: 10px;><span style="font-size: 10px; text-align: center;">Si su solicitud no registra inconvenientes en el env&iacute;o, espere hasta el mensaje de solicitud satisfactoria.</span>
  </p>
</form>
   <?
	PageEnd();
?>
