
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
  
  DBConnect('agenda');
  
  
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
  <P>Esta aplicacion se brinda con el fin de darle a los usuarios de la pagina de la Facultad de Ciencias de la Administración
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
	   	<td><INPUT NAME="nombre_evento"   TYPE="text" title="Nombre del Evento a realizarce" VALUE="<?= $_POST['nombre'] ?>" size="40"></td>
		</tr>
		
		<tr>
	   	<td WIDTH="200" style="color: #000000;"><strong>Tipo de Evento </strong></td>
	   	<td><select name="tipo_evento" title="tipo" >
			<option value="conf">Conferencia
			<option value="vcon">Video Conferencia
			<option value="chal">Charla
			<option value="foro">Foro
			<option value="cfor">Cine Foro
			<option value="peli">Pelicula
			<option value="semi">Seminario
		  </select>
		
		</td>
 		</tr>
		
	   <tr>
	     <td style="color: <?= ($_GET['error']!='fecha')? '#000000' : 'red'?>;" title="Fecha en la que se realizara el evento"><strong>Fecha</strong> (aaaa-mm-dd) </td>
	     <td>
		  
		  <INPUT TYPE="TEXT" NAME="fecha"  VALUE="<?
		 	$fecha = $_GET['ano'].'-'.$_GET['mes'].'-'.$_GET['dia'];
			
			echo $fecha;
		  ?>"  title="<?= "Fecha  ".$fecha?>" readonly="true">
	        
		</td>
	   
	   <tr>
	     <td style="color: <?= ($_GET['error']!='hora_inicio')? '#000000' : 'red'?>;" ><strong>Hora  Inicio</strong> (hh:mm) </td>
	     <td><select name="hora_inicio" title="Hora de Inicio" >
		<?
		$consulta = "SELECT * FROM auditorio WHERE fecha='$fecha' order by hora_inicio";
		$rs = db_query($consulta);
		$tmp = 0;
		$n = pg_num_rows($rs);
		$horarios = true;
		
		if($n = pg_num_rows($rs) < 4)
		{
			$rs1 = pg_num_rows(db_query("SELECT * FROM auditorio WHERE fecha='$fecha' and hora_inicio='07:00:00'"));
			$rs2 = pg_num_rows(db_query("SELECT * FROM auditorio WHERE fecha='$fecha' and hora_inicio='10:00:00'"));
			$rs3 = pg_num_rows(db_query("SELECT * FROM auditorio WHERE fecha='$fecha' and hora_inicio='14:00:00'"));
			$rs4 = pg_num_rows(db_query("SELECT * FROM auditorio WHERE fecha='$fecha' and hora_inicio='18:00:00'"));
			
			if( $rs1  != 1)
				echo '<option value="07:00"> 7 a.m';
			if(  $rs2 != 1)
				echo '<option value="10:00"> 10 a.m';
			if(  $rs3 != 1)
				echo '<option value="14:00"> 2 p.m';
			if(  $rs4 != 1)
				echo '<option value="18:00"> 6 p.m';
				
				
				
				
		}
		else
		{
			?><option value="false" >No hay horario disponible</font> <? 
			$horarios =false;
		}
			
		?>
		
		</select></td></tr>
	   <tr>
	   <td ><FONT COLOR="#000000"><strong>Organizador</strong></td>
	   
			<td><INPUT NAME="organizador" TYPE="TEXT" title="Nombre del que anuncia el evento" VALUE="<?= $_POST['organizador']; echo $_SESSION['usuario']['nombre'] ; ?>" size="40"></td></tr>
	   <tr>
	   <td ><FONT COLOR="#000000"><strong>Email de Contacto</strong></td>
	   
			<td><INPUT NAME="email" TYPE="TEXT" title="Nombre del que anuncia el evento" VALUE="<?= $_POST['email']?>" size="40"></td></tr>
	   <tr>
	     <td VALIGN="TOP" style="color: #000000;" ><strong>Descripci&oacute;n</strong></td>
	     <td><TEXTAREA COLS="30" ROWS="6" NAME="descripcion" title="Detalle del evento, informacion del evento como lugar, actividades y demas cosas referentes al mismo"><?= $_POST['descripcion'];?></TEXTAREA></td></tr>
	   </table>
	   <BR>
	   <center>
	   <INPUT TYPE="SUBMIT" VALUE="Cancelar" NAME="Cancelar">
	   <INPUT TYPE="SUBMIT" VALUE="Agregar" NAME="Agregar"  <? if (!$horarios) {echo "disabled";}?>>
	   </center>
	   </form>
	   <? MarcoEnd() ?>
	   <BR>
	   <?

	 break;
  }
  PageEnd();
?>
