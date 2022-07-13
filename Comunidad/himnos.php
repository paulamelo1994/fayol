<?
	require '../functions.php';
	$rootPath = '..';
	
	PageInit('Himnos');

	
	?>
	<h1>HIMNOS</h1>
	<TABLE WIDTH="90%" ALIGN="CENTER">
	<TR>
		<TD WIDTH="50"><A HREF="Himnos/Univalle.mp3"><IMG SRC="/Images/MP3File.jpg" BORDER="0" alt=""></A></TD>
		<TD><a href="Himnos/04 - Himno de la Universidad del Valle.mp3"><B>Himno de la Universidad del Valle</B></A><div align="right"><a href="descarga.php?file=Himnos/04 - Himno de la Universidad del Valle.mp3" target="_blank" >Descargar</a></div>
		</TD>
	</TR>
	<tr><td></td><td><embed width="409" height="349"  src="mediaplayer.swf" bgcolor="#C0C0C0" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="file=Himnos/Himno Univalle v2.FLV"></embed></td></tr>
	</TABLE>

	<TABLE WIDTH="90%" ALIGN="CENTER">
	  <TR>
		  <TD><A HREF="Himnos/Colombia.mp3"><IMG SRC="/Images/MP3File.jpg" BORDER="0" alt=""></A></TD>
		  <TD><A HREF="Himnos/Colombia.mp3"><B>Himno Nacional de Colombia</B></A></TD>
	  </TR>
	  <TR>
		  <TD><A HREF="Himnos/ValleCaucaCoral.mp3"><IMG SRC="/Images/MP3File.jpg" BORDER="0" alt=""></A></TD>
		  <TD><A HREF="Himnos/ValleCaucaCoral.mp3"><B>Himno al Valle del Cauca (Coral)</B></A></TD>
	  </TR>
	  <TR>
		  <TD><A HREF="Himnos/ValleCaucaInstrumental.mp3"><IMG SRC="/Images/MP3File.jpg" BORDER="0" alt=""></A></TD>
		  <TD><A HREF="Himnos/ValleCaucaInstrumental.mp3"><B>Himno al Valle del Cauca (Instrumental)</B></A></TD>
	  </TR>
	  <TR>
		  <TD><A HREF="Himnos/Cali.mp3"><IMG SRC="/Images/MP3File.jpg" BORDER="0" alt=""></A></TD>
		  <TD><A HREF="Himnos/Cali.mp3"><B>Himno a Santiago de Cali</B></A></TD>
	  </TR>
</TABLE>
	<?
  PageEnd();
?>
