
<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="AnchorPosition.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="date.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="PopupWindow.js"></SCRIPT>

<?
  require "../../functions.php";
  require "functions.php";
  $rootPath = "..";
  session_start();
  
 $_GET['submenu_agenda'] = true;
  
  DBConnect('fayol');
  
  
  if( $_GET['item']==6 ):// Cerrar Sesion
	   session_destroy();
	   header("Location: index.php");
	   die();
  endif;
  
  $valign = 'TOP';
  PageInit("Agenda", "../menu.php");
  switch($_GET['item'])
  {
     case 0:
        echo '<BR>'.Titulo("Bienvenido $_SESSION[NombreUsuarioAgenda]");
  ?>
  <BR>
  <TABLE WIDTH="90%"><TR><TD>
  <? if( $_SESSION['usuario']['permisos'] == total)
  {
  ?>
  <P>Para agregar un evento de click en el men&uacute; de la izquierda en el enlace
  &quot;Agregar Evento&quot;. Puede restringir la noticia para que solo pueda ser vista por estudiantes
  y docentes de la Universidad, o puede permitir que cualquier persona que ingrese a la Agenda pueda
  enterarse del evento o noticia. Podr&aacute; hacerle modificaciones a la informaci&oacute;n
  despu&eacute;s de haberlo creado el evento.</P>
  <P>Para modificar o eliminar uno de los eventos que usted public&oacute; previamente puede dar
   click en el enlace &quot;Modificar o Eliminar Evento&quot; del men&uacute; de la izquierda, toda la 
   informaci&oacute;n ingresada es modificable. </P>
  <P>Recuerde cerrar la sesi&oacute;n por medio del men&uacute; siempre que termine
  de usar su cuenta para administrar la Agenda, si no lo hace, cualquiera que use este computador
  despu&eacute;s de usted podr&iacute;a agregar eventos a su nombre, modificar o eliminar los eventos
  que usted ha creado.</P>
  </TD></TR></TABLE>
    <?
	}
	else
	{
	  ?>
  <P>Esta aplicacion se brinda con el fin de darle a los usuarios de la pagina de la Facultad de Ciencias de la Administraci&oacute;n
  una herramienta informativa sobre las actividades o eventos que se realizen dentro de esta.<br><br>
  Para consultar eventos de diferente indole en la facultad acceda por el vinculo que figura "Consultar Agenda".<br><br>
  Recuerde cerrar su cuenta cuando termine su consulta
  </P>
  </TD></TR></TABLE>
    
    <?
	}
	 break;

	 case 3: // Agregar Evento
       $_POST = $_SESSION['PostAgregar'];
	   ?>
	   <BR>
	   <?
	      if( $_SESSION['SuccededAgregar'] )
		  {
		     unset( $_SESSION['SuccededAgregar'] );
			 Succeded('El evento fue agregada con exito!!');
		  }
	   ?>
	   <BR>
	   
	   <center><? echo Titulo("Agregar Nuevo Evento")?></center>
	   <form METHOD="POST" ACTION="manipPrivado.php">
	   <BR>Llene el siguiente formulario para registrar su nuevo evento:<BR><BR>
	   <table ALIGN="CENTER">
	   <tr>
	   	<td WIDTH="200" style="color: #000000;"><strong>Tema</strong></td>
	   	<td width="276"><INPUT NAME="tema"   TYPE="text" title="Nombre del Evento a realizarce" VALUE="<?= $_POST['tema'] ?>" size="40"></td>
		</tr>
		
		<tr>
	   	<td WIDTH="200" style="color: #000000;"><strong>Tipo</strong></td>
	   	<td><input type="radio"  name="tipo_vid_conf"  value="na" >Nacional
		<input type="radio"  name="tipo_vid_conf"  value="in" >Internacional

		</td>
 		</tr>
		
	   <tr>
	     <td ><strong>Fecha</strong> (aaaa-mm-dd) </td>
	     <td>
		  <INPUT TYPE="TEXT" NAME="fecha" title="Fecha en la que se realizara el evento" 
		  VALUE="<?
		 	$fecha = $_GET['ano'].'-'.$_GET['mes'].'-'.$_GET['dia'];
			echo $fecha;
		  ?>" title="<?= "Fecha  ".$fecha?>" readonly="true">
	        
		</td>
	   
	   <tr>
	     <td  ><strong>Hora  Inicio</strong> (hh:mm) </td>
	     <td><select name="hora_inicio" title="Hora de Inicio" >
		<?
		$consulta = "SELECT * FROM auditorio WHERE fecha='$fecha' order by hora_inicio";
		$rs = db_query($consulta);
		$tmp = 0;
		$n = pg_num_rows($rs);
		$horarios = true;
		
		for($i =7 ; $i <= 21; $i++)
		{
			echo '<option value="'.$i.':00">'.$i.':00' ;
		}
			
		?>
		
		</select> 
	     	<strong>Duraci&oacute;n</strong> 
	     	<select name="duracion" title="Duracion" >
            	<option value="1">1
				<option value="2">2
				<option value="3">3
	    	</select> Hora(s)</td>
	   </tr>
		  <tr>
	   	<td WIDTH="200" style="color: #000000;"><strong>Espacio</strong></td>
	   	<td><INPUT NAME="espacio"   TYPE="text" title="Espacio" VALUE="<?= $_POST['espacio'] ?>" size="40"></td>
		</tr>
		 
	   <td ><FONT COLOR="#000000"><strong>Organizador</strong></td>
	   
			<td><INPUT NAME="solicitante" TYPE="TEXT" title="Nombre del que anuncia el evento" VALUE="<?= $_POST['solicitante']; echo $_SESSION['usuario']['nombre'] ; ?>" size="40"></td></tr>
	   <tr>
	   
	   <td ><FONT COLOR="#000000"><strong>Email de Contacto</strong></td>
	   
			<td><INPUT NAME="correo_sol" TYPE="TEXT" title="Email del que anuncia el evento" VALUE="<?= $_POST['correo_sol']?>" size="40"></td>
		</tr>
	   	    <td ><FONT COLOR="#000000"><strong>Numero de Participantes </strong></td>
	   
			    <td><INPUT NAME="num_participantes" TYPE="TEXT" title="Numero de Participates" VALUE="<?= $_POST['num_participantes']?>" size="40"></td>
		</tr>
	   <tr>
	     <td VALIGN="TOP" style="color: #000000;" ><strong>Protocolos</strong></td>
	     <td><TEXTAREA COLS="30" ROWS="6" NAME="protocolo" ><?= $_POST['protocolo'];?></TEXTAREA></td></tr>
	   <tr>
	     <td VALIGN="TOP" style="color: #000000;" ><strong>Observaciones</strong></td>
	     <td><TEXTAREA COLS="30" ROWS="6" NAME="contenido"><?= $_POST['contenido'];?></TEXTAREA></td></tr>
	   
	   </table>
	   <BR>
	   <center>
	   <INPUT TYPE="SUBMIT" VALUE="Cancelar" NAME="Cancelar">
	   <INPUT TYPE="SUBMIT" VALUE="agregar" NAME="Agregar">
	   </center>
	   </form>
	   <? MarcoEnd() ?>
	   <BR>
	   <?

	 break;
  }
  PageEnd();
?>
