<?
  require '../../functions.php';
  require 'functions.php';
  $rootPath = '..';
  
  session_start();
  
  $_GET['submenu_agenda'] = true;
  
  $_GET[item] = 0;
  
  DBConnect('agenda');
  

  
  if($_POST['editar'])
  {
  	$id = $_GET[id];
  	$nombre_evento = pg_escape_string( $_POST['nombre_evento'] );
	$organizador = pg_escape_string( $_POST['organizador'] );
    $fecha = pg_escape_string( $_POST['fecha'] );
    $hora_inicio = pg_escape_string( $_POST['hora_inicio'] );
    $hora_fin = pg_escape_string( ($_POST['hora_inicio'] + 3).':00' );
    $tipo_evento = pg_escape_string( $_POST['tipo_evento'] );
	$descripcion = pg_escape_string( $_POST['descripcion'] );
	$email = pg_escape_string( $_POST['email'] );
	$rs = @db_query("update auditorio set nombre_evento = '$nombre_evento',
	organizador = '$organizador', fecha = '$fecha', hora_inicio = '$hora_inicio', hora_fin = '$hora_fin',
	tipo_evento = '$tipo_evento', descripcion = '$descripcion', email = '$email' where id = $id");
	 
	if(!$rs) 
	{
		$fallo = true;
		echo("<td>No se logro grabar en la BD.</td>");
		echo ("update auditorio set nombre_evento = '$nombre_evento',
	organizador = '$organizador', fecha = '$fecha', hora_inicio = '$hora_inicio', hora_fin = '$hora_fin',
	tipo_evento = '$tipo_evento', descripcion = '$descripcion', email = '$email' where id = $id");
	}
	else
	{
	?>
		<script language="javascript" type="text/javascript">
		alert("Se actualizo correctamente.");
		location.href="VerMes.php?editar=true";
		</script>
		<?
	 }
  }
  
  if($_POST['eliminar'])
  {

		$rs = db_query("DELETE FROM auditorio WHERE id ='$_GET[id]'");
	 
	 if(!$rs) 
	{
		$fallo = true;
		echo("<td>No se logro grabar en la BD.</td>");
	}
	else
	{
	?>
		<script language="javascript" type="text/javascript">
		alert("Elimino correctamente la actividad.");
		</script>
		<?
		?>
		<script language="javascript">
		location.href="VerMes.php?editar=true";
		</script>
	<?
	 
	  }
  
  }

  
  $valign='TOP';

  	$_GET['administrar'] = true;

  	PageInit("Agenda", "../menu.php", 7);
  
  
  $rs = pg_exec("SELECT * FROM auditorio WHERE id=$_GET[id]");
  
  if( pg_numrows($rs)==0 )
    die("Error mientras se mostraba la noticia");

  $obj = pg_fetch_object($rs);
  
  echo Titulo("Descripcion del Evento<BR>&quot;$obj->nombre_evento&quot;")."<BR>";
  BorderInit('#CCD0E1', '450');
  
  
  if($_GET[editar] && $_SESSION['usuario']['permisos'] == 'total')
  {
  		?>
	<FORM name="noticia" method="post" enctype="multipart/form-data" action="">
	<table ALIGN="CENTER">
	 
	 <tr>
		 <td WIDTH="200" style="color: #000000;"><strong>Nombre Evento </strong></td>
	   	<td><INPUT TYPE="TEXT" NAME="nombre_evento" VALUE="<?= $_POST['nombre_evento']; echo $obj->nombre_evento; ?>" title="Nombre del Evento"></td>
		
	 </tr>
	
	<tr>
	   	<td WIDTH="200" style="color: #000000;"><strong>Tipo de Evento </strong></td>
	   	<td>
		<select name="tipo_evento" title="tipo" >
			<option value="conf" <? if ($obj->tipo_evento == 'conf') echo 'selected';  ?> >Conferencia
			<option value="vcon" <? if ($obj->tipo_evento == 'vcon') echo 'selected';  ?> >Video Conferencia
			<option value="chal" <? if ($obj->tipo_evento == 'chal') echo 'selected';  ?> >Charla
			<option value="foro" <? if ($obj->tipo_evento == 'foro') echo 'selected';  ?> >Foro
			<option value="cfor" <? if ($obj->tipo_evento == 'cfor') echo 'selected';  ?> >Cine Foro
			<option value="peli" <? if ($obj->tipo_evento == 'peli') echo 'selected';  ?> >Pelicula
			<option value="semi" <? if ($obj->tipo_evento == 'semi') echo 'selected';  ?> >Seminario
		  </select>
		</td>
	</tr>
	<tr><td></td></tr>
	<tr>
	     <td style="color: <?= ($_GET['error']!='fecha')? '#000000' : 'red'?>;" title="Fecha en la que se realizara el evento"><strong>Fecha</strong> (aaaa-mm-dd) </td>
	     <td><INPUT TYPE="TEXT" NAME="fecha"  VALUE="<?= $obj->fecha ?>"  readonly="true"></td>
	</tr>
	<tr><td></td></tr>
	<tr>
	     <td style="color: <?= ($_GET['error']!='hora_inicio')? '#000000' : 'red'?>;" title="Hora en la que se realizara el evento"><strong>Hora
	     		de Inicio </strong></td>
	     <td><INPUT TYPE="TEXT" NAME="hora_inicio" title="Hora de Inicio" VALUE="<?= substr($obj->hora_inicio, 0, 5); ?>" readonly="true"></td>
	</tr>
	<tr><td></td></tr>
	<tr>
	     <td ><FONT COLOR="#000000"><strong>Organizador</strong></td>
		 <td><INPUT TYPE="TEXT" NAME="organizador" VALUE="<?= $_POST['organizador']; echo $obj->organizador; ?>" title="Nombre del que anuncia el evento"></td>
	</tr>
	   
	<tr>
	     <td ><FONT COLOR="#000000"><strong>Email de Contacto</strong></td>
		 <td><INPUT TYPE="TEXT" NAME="email" VALUE="<?= $_POST['email']; echo $obj->email; ?>" title="Nombre del que anuncia el evento"></td>
	</tr>
	   
	<tr>
	     <td VALIGN="TOP" style="color: #000000;" ><strong>Descripci&oacute;n</strong></td>
	     <td><TEXTAREA COLS="30" ROWS="6" NAME="descripcion" title="Detalle del evento, informacion del evento como lugar, actividades y demas cosas referentes al mismo"><?=$_POST['descripcion']; echo $obj->descripcion;?></TEXTAREA></td>
	</tr>
	
	</table>
	   <BR>
	   <center>
	   <INPUT TYPE="SUBMIT" VALUE="Editar" NAME="editar">
	   <INPUT TYPE="SUBMIT" VALUE="Eliminar" NAME="eliminar" onClick="irAlIndice();">
	   </center>
    </form>

		<?
		
	  BorderEnd();
	  $mdia = getDia($obj->fecha);
	  echo "<BR><TABLE BORDER=0 WIDTH='80%'><TR>
		 <TD ALIGN=CENTER><A HREF='VerDia.php?dia=$mdia&editar=true'>Ver programaci&oacute;n del dia</A></TD>
		 <TD ALIGN=CENTER><A HREF='VerMes.php?editar=true'>Ver programaci&oacute;n del mes</A></TD>
		 </TR></TABLE>";

  }
  else
  {
		echo 
		"<TABLE BORDER=0 WIDTH='80%'>
		 <TR><TD BGCOLOR='#F0F0F0' WIDTH=150><B>Nombre Evento:</B></TD><TD>$obj->nombre_evento</TD></TR>
		 <TR><TD BGCOLOR='#F0F0F0' WIDTH=150><B>Tipo de Evento:</B></TD><TD>
		 ";
			
		 if ($obj->tipo_evento == 'conf') echo 'Conferencia';  
		 if ($obj->tipo_evento == 'vcon') echo 'Video Conferencia';  
		 if ($obj->tipo_evento == 'chal') echo 'Charla';
		 if ($obj->tipo_evento == 'foro') echo 'Foro';
		 if ($obj->tipo_evento == 'cfor') echo 'Cine Foro';
		 if ($obj->tipo_evento == 'peli') echo 'Pelicula';
		 if ($obj->tipo_evento == 'semi') echo 'Seminario';
		 
		 echo "</TD></TR>
		 <TR><TD BGCOLOR='#F0F0F0' WIDTH=150><B>Organiza:</B></TD><TD>$obj->organizador</TD></TR>
		 <TR><TD BGCOLOR='#F0F0F0'><B>Fecha:</B></TD><TD>$obj->fecha</TD></TR>
		 <TR><TD BGCOLOR='#F0F0F0'><B>Hora Inicio:</B></TD><TD>$obj->hora_inicio</TD></TR>
		 <TR><TD BGCOLOR='#F0F0F0'><B>Hora Fin:</B></TD><TD>$obj->hora_fin</TD></TR>
		 <TR><TD BGCOLOR='#F0F0F0' VALIGN='TOP'><B>Descripcion:</B></TD><TD>$obj->descripcion </TD></TR>
		 <TR><TD BGCOLOR='#F0F0F0' VALIGN='TOP'><B>Email de Contacto:</B></TD><TD>$obj->email </TD></TR>
		 </TABLE>";
	  BorderEnd();
	  $mdia = getDia($obj->fecha);
	  
	  if ($_GET[editar] )
	  {
	  	echo "<BR><TABLE BORDER=0 WIDTH='80%'><TR>
		 <TD ALIGN=CENTER><A HREF='VerDia.php?dia=$mdia&editar=true'>Ver programaci&oacute;n del dia</A></TD>
		 <TD ALIGN=CENTER><A HREF='VerMes.php?editar=true'>Ver programaci&oacute;n del mes</A></TD>
		 </TR></TABLE>";
	  }
	  else if ($_GET[agregar] )
	   {
	  	echo "<BR><TABLE BORDER=0 WIDTH='80%'><TR>
		 <TD ALIGN=CENTER><A HREF='VerDia.php?dia=$mdia&agregar=true'>Ver programaci&oacute;n del dia</A></TD>
		 <TD ALIGN=CENTER><A HREF='VerMes.php?agregar=true'>Ver programaci&oacute;n del mes</A></TD>
		 </TR></TABLE>";
	  }
	  
	  else
	  {
	  echo "<BR><TABLE BORDER=0 WIDTH='80%'><TR>
		 <TD ALIGN=CENTER><A HREF='VerDia.php?dia=$mdia'>Ver programaci&oacute;n del dia</A></TD>
		 <TD ALIGN=CENTER><A HREF='VerMes.php'>Ver programaci&oacute;n del mes</A></TD>
		 </TR></TABLE>";
		}
		
		
  }  
  PageEnd();
?>