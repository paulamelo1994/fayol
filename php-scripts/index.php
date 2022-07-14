<?
   require_once('functions.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
	<TITLE>Facultad de Ciencias de la Administraci&oacute;n</TITLE>
	<LINK HREF="estiloweb.css" TYPE="TEXT/CSS" REL="STYLESHEET">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	
	<!-- <script language="javascript" type="text/JavaScript">
	var nImage = 0;
	var imagenes = new Array 
	(
		"Images/SlideInicio/01.jpg"
		<?/*
		$dir = opendir('Images/SlideInicio/');
		while ($file = readdir($dir)) 
		{
			if ($file[0]!='.' && $file!='01.jpg' && (strstr($file, '.jpg')!==false||strstr($file, '.gif')!==false))
			{
				echo ", \"Images/SlideInicio/$file\"";
			}
		}*/
		?>
	);
	
	function imageCycle()
	{
		nImage = Math.floor(Math.random()*imagenes.length);
		document["laImagen"].src = imagenes[nImage];
	}
	
	
	setInterval("imageCycle()", 4000);
	</script>
	
	
	-->
	
	
	<script type='text/javascript' src="swfobject.js"></script>		
	<script type='text/javascript'>
		function createPlayer(src,preview,div)
		{					
			var s1 = new SWFObject("mediaplayer.swf","single","320","240","7");
			s1.addParam("allowfullscreen","true");
			s1.addVariable("file",src);
			s1.addVariable("image", preview);
			s1.addVariable("width","320");
			s1.addVariable("height","240");			
			s1.write(div);	
		};
	</script>
	
</HEAD>
<BODY bgcolor="#FFFFFF">
<map name="barrasuperior" id="barrasuperior">
	<area shape="rect" coords="548,3,618,18" href="http://biblioteca.univalle.edu.co/" TARGET="_blank" alt="Consultar en la Biblioteca" title="Consultar en la Biblioteca" >
	<area shape="rect" coords="478,3,543,18" href="Directorio/" alt="Tel&eacute;fonos de las Facultades" title="Tel&eacute;fonos de las Facultades">
	<area shape="rect" coords="426,3,473,18" href="http://www.univalle.edu.co/busquedas.html" TARGET="_blank" alt="Buscar en Univalle" title="Buscar en Univalle">
</map>
<map name="logo_univalle">
	<area shape="rect" coords="8,10,285,52" href="http://www.univalle.edu.co/" target="_top" alt="Portal de la Universidad del Valle">
</map>

<TABLE WIDTH="760" BORDER="0" CELLPADDING="0" CELLSPACING="0" >
<TR>
	<TD>
		<IMG SRC="Images/plantilla/logounivalle.jpg" ALT="Logo Univalle" WIDTH="348" HEIGHT="54" BORDER="0" USEMAP="#logo_univalle">
	</TD>
	<TD>
		 <img src="http://www.univalle.edu.co/cgi-bin/cabezote-aleatorio.pl" width="411" height="54" border="0" alt="Foto">
		 <!--<img src="Images/plantilla/lago.jpg" width="411" height="54" border="0" alt="Foto">-->
		</TD>
</TR>
<TR>
	<TD COLSPAN="2"><img src="Images/plantilla/barra-cabezote.gif" alt="Barra Cabezote" width="760 px" height="19" border="0" USEMAP="#barrasuperior"></TD>
</TR>
<TR>
	<TD COLSPAN="2">
	<table border="0" cellpadding="0" cellspacing="0" width="760">
	<tr>
		<td COLSPAN="3"><DIV CLASS="title">Facultad de Ciencias de la Administraci&oacute;n</DIV></td>
	</tr>
	<tr>
		<td WIDTH="10">&nbsp;</td>
		<td><? PutHeader(1) ?></td>
		<td WIDTH="10">&nbsp;</td>
	</tr>
	</table>
	</TD>
</TR>
<TR>
	<TD COLSPAN="2"><TABLE WIDTH="760" BORDER="0" CELLPADDING="0" CELLSPACING="0">
	<TR>
		<TD><br>
			<TABLE WIDTH="130" BORDER="0" CELLPADDING="0" CELLSPACING="0">
			<TR>
				<TD WIDTH="9"><IMG SRC="Images/plantilla/esquinaroja.jpg" WIDTH="9" HEIGHT="14" ALT=""></TD>
				<TD WIDTH="108" ALIGN="CENTER" BGCOLOR="#CC0000" CLASS="titulos">Correo Electronico</TD>
				<TD WIDTH="13" BGCOLOR="#CC0000"></TD>
			</TR>
			<TR>
				<TD COLSPAN="3" BGCOLOR="#f2f2f2">
				<TABLE WIDTH="130" BORDER="0" ALIGN="CENTER" BGCOLOR="#CC6666" CELLPADDING="2" CELLSPACING="1">
				<TR>
					<TD ALIGN="CENTER" BGCOLOR="#f2f2f2">
					<br>
					<A HREF="http://correo.univalle.edu.co/correo/index.html" target="_blank"><img src="Images/plantilla/correo.jpg" width="45" height="35"></A><br>
					
					</TD>
				</TR>
				
				</TABLE>
				</TD>
			</TR>
			</TABLE>
			<br>
							
			<TABLE WIDTH="130" BORDER="0" CELLPADDING="0" CELLSPACING="0">
			
			<TR>
				<TD WIDTH="9"><IMG SRC="Images/plantilla/esquinaroja.jpg" WIDTH="9" HEIGHT="14" ALT=""></TD>
				<TD WIDTH="108" ALIGN="CENTER" BGCOLOR="#CC0000" CLASS="titulos">Cont&aacute;ctenos</TD>
				<TD WIDTH="13" BGCOLOR="#CC0000"></TD>
			</TR>
			<TR>
				<TD COLSPAN="3" BGCOLOR="#f2f2f2">
				<TABLE WIDTH="130" BORDER="0" ALIGN="CENTER" BGCOLOR="#CC6666" CELLPADDING="2" CELLSPACING="1">
				<TR>
					<TD ALIGN="CENTER" BGCOLOR="#f2f2f2">
					<A HREF="comentarios.php?ComeFrom=/index.php">Contacte las dependencias de la Facultad</A>
					</TD>
				</TR>
				</TABLE>
				</TD>
			</TR>
			</TABLE>
			<BR>
			<TABLE WIDTH="130" BORDER="0" CELLPADDING="0" CELLSPACING="0">
			<TR>
				<TD WIDTH="9"><IMG SRC="Images/plantilla/esquinaroja.jpg" WIDTH="9" HEIGHT="14" ALT=""></TD>
				<TD WIDTH="104" ALIGN="CENTER" BGCOLOR="#CC0000" CLASS="titulos">Cr&eacute;ditos</TD>
				<TD WIDTH="17" BGCOLOR="#CC0000"></TD>
			</TR>
			<TR>
				<TD COLSPAN="3" BGCOLOR="#f2f2f2">
				<TABLE WIDTH="130" BORDER="0" ALIGN="CENTER" CELLPADDING="2" CELLSPACING="1" BGCOLOR="#CC6666">
				<TR>
					<TD ALIGN="CENTER" BGCOLOR="#f2f2f2"><A HREF="creditos.php"> Cr&eacute;ditos del desarrollo de este Portal Web </A></TD>
				</TR>
				</TABLE>
				</TD>
			</TR>
			</TABLE>
			<br>
			
			<TABLE WIDTH="130" BORDER="0" CELLPADDING="0" CELLSPACING="0">
			<TR>
				<TD WIDTH="9"><IMG SRC="Images/plantilla/esquinaroja.jpg" WIDTH="9" HEIGHT="14" ALT=""></TD>
				<TD WIDTH="104" ALIGN="CENTER" BGCOLOR="#CC0000" CLASS="titulos">Bit&aacute;cora</TD>
				<TD WIDTH="17" BGCOLOR="#CC0000"></TD>
			</TR>
			<TR>
				<TD COLSPAN="3" BGCOLOR="#f2f2f2">
				<TABLE WIDTH="130" BORDER="0" ALIGN="CENTER" CELLPADDING="2" CELLSPACING="1" BGCOLOR="#CC6666">
				<TR>
					<TD ALIGN="CENTER" BGCOLOR="#f2f2f2"><A HREF="Noticias/BITACORA/">Bolet&iacute;n Informativo de la Facultad</A></TD>
				</TR>
				</TABLE>
				</TD>
			</TR>
			</TABLE>
			<br>
			
			<TABLE WIDTH="130" BORDER="0" CELLPADDING="0" CELLSPACING="0">
			<TR>
				<TD WIDTH="9"><IMG SRC="Images/plantilla/esquinaroja.jpg" WIDTH="9" HEIGHT="14" ALT=""></TD>
				<TD WIDTH="104" ALIGN="CENTER" BGCOLOR="#CC0000" CLASS="titulos">Campus Virtual </TD>
				<TD WIDTH="17" BGCOLOR="#CC0000"></TD>
			</TR>
			<TR>
				<TD COLSPAN="3" BGCOLOR="#f2f2f2">
				<TABLE WIDTH="130" BORDER="0" ALIGN="CENTER" CELLPADDING="2" CELLSPACING="1" BGCOLOR="#CC6666">
				<TR>
					<TD ALIGN="CENTER" BGCOLOR="#f2f2f2"><A HREF="http://campusvirtual.univalle.edu.co/" target="_blank">Campus Virtual </A></TD>
				</TR>
				</TABLE>
				</TD>
			</TR>
			</TABLE>
			<p>&nbsp;</p>
			<p><a href="http://cuse.univalle.edu.co/" target="_blank"><center><img src="Images/logo_Cuse.png" alt="CUSE" border="0"></center></a></p>
			<p><a href="http://cuse.univalle.edu.co/evaluacionCursosV2/web/index.php" target="_blank"><center><img src="Images/evaluar1.jpg" width="130"></a><br>
			    </p></TD>
			<TD WIDTH="496" ALIGN="CENTER" VALIGN="TOP">
			<TABLE WIDTH="360" BORDER="0">
			<TR>
				<TD COLSPAN="3"  CLASS="titulos" align="center" style="background-image:url(Images/plantilla/slide_gris.png)">CALIDAD
					INSTITUCIONAL</TD>
			</TR>
			<TR align="center">
				<TD height="77" COLSPAN="3" align="center"  VALIGN="TOP" BGCOLOR="#f2f2f2">
				<? 
				$conexion = @DBConnect('fayol');
				if($conexion)
				{
					
					$rs = db_query("SELECT * FROM banners WHERE visible='t'");
					$numrows = pg_num_rows($rs);
					
					
					srand (time());
					$numero_aleatorio = rand(1,$numrows);
					
					//echo $numero_aleatorio;
					
					for($i = 0; $i < $numero_aleatorio; $i++ )
						$con = pg_fetch_object($rs);
					
					if ( false )
					{
				?>
				
					<object type="application/x-shockwave-flash" data="Banners1/<?= $con->ubicacion?>" width="320" height="60">
					<param name="movie" value="Banners1/<?= $con->ubicacion?>" />
					<param name="quality" value="high" />
					<img src="Images/plantilla/inscripciones.png" width="320" height="60" alt="<?=$con->titulo?>" />
					</object>
				
				<?
					}
					else
					{
						?>
							<object type="application/x-shockwave-flash" data="Banners1/<?= $con->ubicacion?>" width="360" height="120">
							<param name="movie" value="Banners1/<?= $con->ubicacion?>" />
							<param name="quality" value="high" />
							<img src="Images/plantilla/inscripciones.png" width="320" height="60" alt="<?=$con->titulo?>" />
							</object>
						<?
					}
				}
				
				// echo 'Descargar informaci&oacute;n en <a target="_blank" href="Banners/informacion/agenda.pdf">pdf</a>';
				
				if(getIP()==IP_ANGELA or getIP()==IP_GUILLERMO OR getIP() == '192.168.220.173' )
				{
					echo '<br><a href="Banners1/cambiar.php">cambiar</a>';
				}

				?>
				</TD>
			</TR>
			<tr><TD COLSPAN="3">&nbsp;</td></tr>
			
			<TR>
				<TD COLSPAN="3"  CLASS="titulos" align="center" style="background-image:url(Images/plantilla/slide_gris.png)" >Novedades<!--¡¡¡ BIENVENIDOS A NUESTRA FACULTAD!!!--></TD>
			</TR>
			<TR>				
				<TD HEIGHT="300" COLSPAN="3" ALIGN="CENTER" VALIGN="MIDDLE" BGCOLOR="#f2f2f2"><P CLASS="centered">
				
					<script language="javascript" type="text/JavaScript">
					var nImage = 0;
					var imagenes = ['/Images/NuevosEventos/convocatoria.jpg'];
				
					function imageCycle()
					{
						nImage = Math.floor(Math.random()*1);
						window.nImage = nImage;
						document["laImagen"].src = imagenes[nImage];
						
					}
															
					setInterval("imageCycle()", 2000);
					</script>
					
				<!--<A HREF="/Programas/doctorados/index.php" STYLE="color: #666666;"><IMG SRC="/Programas/doctorados/doct_administracion/afiche_final.jpg"  height="394" width="267" ALT="De click para mayor informaci&oacute;n" name="laImagen" border="0" title="De click para ver la galeria de imagenes"></a></P>
				<A HREF="Images/NuevosEventos/Explorarte.pdf" STYLE="color: #666666;"><IMG SRC="Images/NuevosEventos/explorarte.jpg" width="350" height="250" ALT="De click para ver la galeria de imagenes" title="De click para ver mas informacion"></a></P>
				<A HREF="/Comunidad/newgaleria.php?id=nImage" STYLE="color: #666666;"><IMG SRC="Images/NuevosEventos/explorarte.jpg" name="laImagen" ALT="De click para ver mas informacion" title="De click para ver mas informacion" width="300"></a></P>				
				<A HREF="http://ivsinpa.univalle.edu.co" TARGET="_blank" STYLE="color: #666666;"><IMG SRC="ivSemNuevoPensamiento/AficheIVSINPA.jpg" ALT="De click para ir a la pagina del evento" name="laImagen" width="290" height="410" title="De click para ver pagina del evento"></a></P>
				<A HREF="/Comunidad/galeria.php" STYLE="color: #666666;"><IMG SRC="Images/SlideInicio/01.jpg" name="laImagen" ALT="De click para ver la galeria de imagenes" title="De click para ver la galeria de imagenes"></a></P>-->

				
				<!-- <a onclick="document.location.href='/Comunidad/newgaleria.php?id='+nImage;return false;" href="" target="_blank"  STYLE="color: #666666; "><IMG SRC="Images/NuevosEventos/convocatoria.jpg" name="laImagen" width="350"  ALT="De click para ver mas informacion" title="De click para ver mas informacion"></a></P>-->
				<a href="Images/NuevosEventos/bitacoraAMA.pdf" target="_blank"><img src="Images/NuevosEventos/logoAMA.jpg" width="350"  ALT="De click para ver mas informacion" title="De click para ver mas informacion"></a>
				<a href="Images/NuevosEventos/bitacoraAMA.pdf" target="_blank">De click para mas información</a>
				<P CLASS="centered"><A HREF="video.php" STYLE="color: #CC3300;">Ver video de la Rese&ntilde;a<img src="Images/icon_video2.jpg" height="34" width="34"></A></P>
				
			<!--	<a href="Images/plantilla/banners/CARTEL-MEXICO-COLOMBIA ABRIL.jpg"><img src="Images/plantilla/banners/CARTEL-MEXICO-COLOMBIA ABRIL.jpg" height="300" width="360"></a>
				--></TD>
			</TR>
			</TABLE>
			</TD>
			<TD ROWSPAN="3" ALIGN="CENTER" VALIGN="TOP">
			<TABLE BORDER="0" WIDTH="230">
			<TR>
				<TD COLSPAN="2"  ALIGN="CENTER" BGCOLOR="#CC0000" CLASS="titulos" style="background-image:url(Images/plantilla/slide_rojo.png)">Noticias y Eventos</TD>
	    	</TR>
			<TR>
				<TD BGCOLOR="#f2f2f2">
				<TABLE WIDTH="100%">
				<? include "noticias.php" ?>
				<?
				if(getIP()==IP_DANIEL or getIP()==IP_GUILLERMO or getIP()==IP_MELENDEZ)
				{
				?>
					<tr>
						<td COLSPAN="2" bgcolor="#CC0000" align="center" style="background-image:url(Images/plantilla/slide_rojo.png)" > <A HREF="Noticias/divulgar.php" CLASS="shylink" STYLE="color:white;"><b>ADICIONAR NOTICIA</b></A></td>
					</tr>
				<?
				}
				if(getIP()==IP_DANIEL or getIP()==IP_GUILLERMO) //or getIP()=='192.168.220.105')
				{
				?>
					<tr>
						<td COLSPAN="2" bgcolor="#CC0000" align="center" style="background-image:url(Images/plantilla/slide_rojo.png)" > <A HREF="EventoCalendario/divulgar.php" CLASS="shylink" STYLE="color:white;"><b>ADICIONAR EVENTO/NOTICIA DEL CALENDARIO</b></A></td>
					</tr>
				<?
				}
				?>
				<tr>
					<td COLSPAN="2" bgcolor="#CC0000" align="center" style="background-image:url(Images/plantilla/slide_rojo.png)"><A HREF="eventos/divulgar.php" CLASS="shylink" STYLE="color:white;"><b>DIVULGUE SU EVENTO</b></A></td>
				</tr>
				<tr>
					<td COLSPAN="2" bgcolor="#CC0000" align="center" style="background-image:url(Images/plantilla/slide_rojo.png)" ><A HREF="Estadisticas/estadisticas.php" CLASS="shylink" STYLE="color:white;"><b>ESTAD&Iacute;STICAS</b></A></td>
				</tr>
				<tr>
					<td COLSPAN="2" bgcolor="#CC0000" align="center" style="background-image:url(Images/plantilla/slide_rojo.png)" ><A HREF="mapa.php" CLASS="shylink" STYLE="color:white;"><b>MAPA DE LA PAGINA</b></A></td>
				</tr>
                
				<? if( getIP()==IP_DANIEL): ?>
                <!--  de aqui en adelante es para sugerencias-->
				<tr>
					<td COLSPAN="2" bgcolor="#CC0000" align="center" style="background-image:url(Images/plantilla/slide_rojo.png)" ><A HREF="sugerencias/sugerencia.php" CLASS="shylink" STYLE="color:white;"><b>SUGERENCIAS</b></A></td>
				</tr>
				 <!-- hasta  aqui -->
				<? endif ?>
                
              
                
				<? if( getIP()==IP_DANIEL || getIP()==IP_GUILLERMO ): ?>
						<tr>
							<td colspan="2" bgcolor="#CC0000" align="center" style="background-image:url(Images/numeros_anteriores copy.jpg)" ><A HREF="Bitacora/Bitacora.php" CLASS="shylink" STYLE="color:white;"><b>BIT&Aacute;CORA</b></A></td>
						</tr>
				<? endif ?>
				</TABLE>
				</TD>
			</TR>
			</TABLE><BR>
            <img src="Images/plantilla/logo65anhos_univalle.jpg">			<br>
            <BR>
			<a href="http://procesos.univalle.edu.co/"><IMG SRC="Images/calidadInstitucional.png" ALT="Universidad del Valle, 60 a&ntilde;os" width="100" height="93"></a>
			<br>				  
			<p STYLE="text-align:center;"><a href="http://validator.w3.org/check?uri=referer">
			<img border="0" src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01!" height="31" width="88">
			</a></p>
			<p STYLE="text-align:center;">&nbsp;</p>
			</TD>
		</TR>
		<TR>
			<TD ALIGN="CENTER" VALIGN="TOP">&nbsp;</TD>
			<TD ALIGN="CENTER" VALIGN="TOP">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#999999">
			<tr>
				<td height="14" align="center" valign="top" bgcolor="#999999" style="background-image:url(Images/plantilla/slide_gris.png)">
				<font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>Mayor informaci&oacute;n</strong></font>
				</td>
			</tr>
			<tr>
				<td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
				<tr>
					<td>
					<table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#999999">
					<tr>
						<td>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
						<tr>
							<td height="168" >
							<div align="center">
							<font size="-2" face="Verdana, Arial, Helvetica, sans-serif">
							FACULTAD DE CIENCIAS DE LA ADMINISTRACI&Oacute;N<br>
							UNIVERSIDAD DEL VALLE<br>
							Sede San Fernando, Edificio 124<br>
							PBX +57 2 3212100 FAX 5542470 A.A. 25360<br>
							Calle 4B No 36-00, Cali - Colombia <br>
							<B>&Uacute;ltima actualizaci&oacute;n: </B>
							<?= ultima_actualizacion() ?>
							<BR>
							<A HREF="/creditos.php" STYLE="text-decoration:underline;">Cr&eacute;ditos de desarrollo</A><BR>
							</font>
							<font size="-2" face="Verdana, Arial, Helvetica, sans-serif">&copy;1994-2007</font>
							</div>
							</td>
						</tr>
						</table>
						</td>
					</tr>
					</table>
					</td>
				</tr>
				</TABLE>
				</TD>
			</TR>
			</TABLE>
			</TD>
			<TR>
				<TD ALIGN="CENTER" VALIGN="TOP" CLASS="footer">&nbsp;</TD>
				<TD width="377" ALIGN="CENTER" VALIGN="TOP" CLASS="footer">&nbsp;</TD>
			</TR>
			
			</TABLE>
			</TD>
		</TR>
		</TABLE>
		</TABLE>
		<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
		</script>
		<script type="text/javascript">
		_uacct = "UA-957230-1";
		urchinTracker();
		</script>
</BODY>
</HTML>
