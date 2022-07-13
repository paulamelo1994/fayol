<?
   require '../../functions.php';
   $rootPath = '../../';
   
   session_start();
   
   $_GET['submenu_solicitudes'] = true;
   
   DBConnect('fayol');

   PageInit('Solicitud de Soporte T&eacute;cnico', '../menu.php');
   
   ?> <h1 class="shiny">Revisar Solicitudes de Soporte T&eacute;cnico</h1> <?
   
   if( !$_GET['numpeticion'] )
   {
	  
	   ?>

	   <BR>
	   <TABLE WIDTH="90%" BORDER="0" align="center">
	   <TR>
		   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>No.</B></TD>
		   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>Ext.</B></TD>
		   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>Espacio</B></TD>
		   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>Responsable</B></TD>
		   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>No. Inventario</B></TD>
		   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>Estado</B></TD>
		   <TD STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><B>Hora/Fecha <br>Petici&oacute;n</B></TD>
	   </TR>
	   <?
	
		$rs = db_query("select numSolicitud,extension,espacio,responsable,inventario,SolicitudSoporte.fecha,SolicitudSoporte.hora,estado from SolicitudSoporte,FichaAtencionSoporte where solicitud=numsolicitud and estado<>'t' order by numSolicitud");
	   while( $obj = pg_fetch_object($rs) )
	   {
	   	 $estado = $obj->estado;
		 if($estado=='e'){ $estado='A&uacute;n no atendida';}
	     else if($estado=='p') {$estado='Pendiente';}
	     else if($estado=='t') {$estado='Ya fue atendida';}

		  $color = ($color=='#FCFCFC')? '#D0DEE9' : '#FCFCFC';
		  echo "
		  <TR BGCOLOR='$color'>
		  	<TD><A HREF='revisar.php?numpeticion=$obj->numsolicitud'>$obj->numsolicitud</A></TD>
			<TD>$obj->extension</TD>
			<TD>$obj->espacio</TD>
			<TD>$obj->responsable</TD>
			<TD>$obj->inventario</TD>
			<TD>$estado</TD>
	  		<TD>$obj->hora / $obj->fecha</TD>
		  </TR>";
	   }
	   ?>
	   </TABLE>
	   <BR>
	   <FORM METHOD="GET" action="">
	   <P ALIGN="CENTER">
	   Deseo ver el estado de la solicitud No. <input TYPE="TEXT" name="numpeticion" SIZE="5">
	   <input TYPE="SUBMIT" NAME="Submit" VALUE="Ver">
	   </P>
	   </FORM>
   <?
   }
   else
   {
      $rs = db_query("select numSolicitud,extension,espacio,responsable,vinculacion,inventario,elemento,descripcionFalla,SolicitudSoporte.fecha,SolicitudSoporte.hora, FichaAtencionSoporte.fecha as fechaAtencion ,FichaAtencionSoporte.hora as horaAtencion ,estado, motivoEstado from SolicitudSoporte, FichaAtencionSoporte where solicitud=numsolicitud and numSolicitud='$_GET[numpeticion]'");
	  $obj = @pg_fetch_object($rs);
	  if( $obj )
	  {
	  	$estado = $obj->estado;
		 if($estado=='e'){ $descripcionEstado='A&uacute;n no atendida';}
	     else if($estado=='p') {$descripcionEstado='Pendiente';}
	     else if($estado=='t') {$descripcionEstado='Ya fue atendida';}

		  echo "<BR>
		  <TABLE BORDER='0' BGCOLOR='#006699' align='center'>
		  <TR><TD BGCOLOR='#D0DEE9'>No. Peticion:</TD><TD BGCOLOR='#FCFCFC'>$obj->numsolicitud</TD></TR>		 
		  <TR><TD BGCOLOR='#D0DEE9'>Espacio:</TD><TD BGCOLOR='#FCFCFC'>$obj->espacio</TD></TR>
		  <TR><TD BGCOLOR='#D0DEE9'>Extensi&oacute;n:</TD><TD BGCOLOR='#FCFCFC'>$obj->extension</TD></TR>
		  <TR><TD BGCOLOR='#D0DEE9'>Solicitante:</TD><TD BGCOLOR='#FCFCFC'>$obj->responsable</TD></TR>
		  <TR><TD BGCOLOR='#D0DEE9'>Vinculaci&oacute;n:</TD><TD BGCOLOR='#FCFCFC'>$obj->vinculacion</TD></TR>
		  <TR><TD BGCOLOR='#D0DEE9'>No. Inventario</TD><TD BGCOLOR='#FCFCFC'>$obj->inventario</TD></TR>
		  <TR><TD BGCOLOR='#D0DEE9'>Estado solicitud:</TD><TD BGCOLOR='#FCFCFC'>".$descripcionEstado."</TD></TR>
		  ";
		  if($estado=='p')
		  {
		 	 echo "<TR><TD BGCOLOR='#D0DEE9'>Motivo:</TD><TD BGCOLOR='#FCFCFC'>$obj->motivoestado</TD></TR>";
		  }
		  echo "
		  <TR><TD BGCOLOR='#D0DEE9'>Hora/Fecha Petici&oacute;n:</TD><TD BGCOLOR='#FCFCFC'>$obj->hora / $obj->fecha</TD></TR>
		  ";
		  
		  if($estado!='e')
		  {
		 	 echo "<TR><TD BGCOLOR='#D0DEE9'>Hora/Fecha Atenci&oacute;n:</TD><TD BGCOLOR='#FCFCFC'>$obj->horaatencion / $obj->fechaatencion</TD></TR>";
		  }
		  echo "		  
		  <TR><TD BGCOLOR='#D0DEE9'>Elemento</TD><TD BGCOLOR='#FCFCFC'>$obj->elemento</TD></TR>
		  <TR><TD BGCOLOR='#D0DEE9' VALIGN='top'>Descripci&oacute;n:</TD><TD BGCOLOR='#FCFCFC'>$obj->descripcionfalla</TD></TR>
		  </TABLE>
		  <br><BR><center><a href='revisar.php'>Volver a la lista de solicitudes</a></center>";
	  }
	  else
	      echo "<BR>No existe ninguna solicitud con ese n&uacute;mero.
		  <BR><center><a href='revisar.php'>Volver a la lista de solicitudes</a></center>";
   }
   PageEnd();
?>
