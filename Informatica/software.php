<?
	session_start();
	
	require '../../functions.php';
	$rootPath = '../..';
	$_GET['submenu_informatica'] = true;
	
	$authentication=false;
	if ($_POST['autenticar'])
	{
		if(AutenticarUsuario($login, $password))
		{
			$_SESSION['descarga_software'] = true;
			$authentication=true;
		}
		else
			$authentication=false;
	}
  
	if(!isset($_SESSION['descarga_software']))
	{
		PageInit('Autenticación requerida', '../menu.php');
		?>
		<H1 CLASS="shiny">Autenticación requerida</H1>
		Para acceder a los documentos a disposici&oacute;n de los estudiantes debe
		primero ser autenticado. Por favor escriba abajo su login y password del correo de dominio 
		<FONT COLOR="#FF0000"><B>univalle.edu.co. </B></FONT>
		<FORM METHOD="POST" action="">
		<TABLE WIDTH="50%" BORDER="0" align="center">
		<TR>
			<TD><B>Login:</B></TD>
			<TD><INPUT TYPE="TEXT" NAME="login" SIZE=12></TD>
		</TR>
		<TR>
			<TD><B>Password:</B></TD>
			<TD><INPUT TYPE="PASSWORD" NAME="password" SIZE=12></TD>
		</TR>
		<TR>
			<TD COLSPAN=2><CENTER><INPUT TYPE=SUBMIT NAME="autenticar" VALUE="Autenticar"></CENTER></td>
		</TR>
		</TABLE>
		</FORM>
		<?
	}
	else
	{
		PageInit('Descarga de Software', '../menu.php');
		?>
		<h1 class="shiny"><IMG SRC="/Images/descarga.gif" alt=""> Descarga de Software</h1>
		<br><br>
		<P>Si desea descargar m&aacute;s programas de utilidad, puede ir a nuestro sitio FTP: 
		<A HREF="ftp://192.168.220.165/">ftp://192.168.220.165/</A> accesible solo desde dentro de la Universidad. 
		Si hay alg&uacute;n programa que considere de utilidad y que no est&eacute; en esta p&aacute;gina ni en 
		nuestro sitio FTP, puede mandarme un correo dando click aqui: <a href="/comentarios.php">
		<IMG BORDER=0 SRC="/Images/icono_email.gif" align=middle alt=""></a>
		</P>
		<TABLE align="center">
	    <TR>
			<TD COLSPAN="2"><B CLASS="shiny">Mozilla 1.7</B></TD>
		</TR>
		<TR>
			<TD WIDTH="30">&nbsp;</TD>
			<TD><B>P&aacute;gina web: </B>
			<A TARGET="_BLANK" HREF="http://www.mozilla.org/products">http://www.mozilla.org/products</A>
			<BR>Navegador web open-source<BR> 
			<IMG SRC="/Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" alt="">
			<A HREF="/Comunidad/Software/mozilla-win32-1.7.13-installer.exe">Descargar</A></B>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN="2"><B CLASS="shiny">Acrobat Reader 5.1</B></TD>
		</TR>
		<TR>
			<TD WIDTH="30">&nbsp;</TD>
			<TD><B>P&aacute;gina web: </B>
			<A TARGET="_BLANK" HREF="http://www.adobe.es/products/acrobat/">http://www.adobe.es/products/acrobat/</A>
			<BR>Visor de archivos <B>PDF<BR>
			<IMG SRC="/Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" alt="">
			<A HREF="/Comunidad/Software/AcroReader51_ESP.exe">Descargar</A></B>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN="2"><B CLASS="shiny">PowerArchiver 2003 v8.70</B></TD>
		</TR>
		<TR>
			<TD WIDTH="30">&nbsp;</TD>
			<TD><B>P&aacute;gina web: </B>
			<A TARGET="_BLANK" HREF="http://www.powerarchiver.com/">http://www.powerarchiver.com/</A><BR>
			Programa para comprimir y descomprimir archivos en varios formatos, 
			entre ellos el <B>ZIP</B>.<B><BR>
			<IMG SRC="/Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" alt="">
			<A HREF="/Comunidad/Software/PowerArchiver%202003%208.70.exe">Descargar</A></B>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN="2"><B CLASS="shiny">PDF995</B></TD>
		</TR>
		<TR>
			<TD WIDTH="30">&nbsp;</TD>
			<TD><B>P&aacute;gina web: </B>
			<A TARGET="_BLANK" HREF="http://www.pdf995.com/">http://www.pdf995.com/</A>
			<BR>Este programa permite crear archivos PDF a partir de cualquier tipo de 
			archivos, para poderlo utilizar necesita descargar
			<A HREF="/Intranet/Software/ps2pdf995.exe"><B>este otro programa</B></A> e instalarlo junto con el 
			PDF995.<B><BR>
			<IMG SRC="/Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" alt=""> 
			<A HREF="/Comunidad/Software/pdf995s.exe">Descargar</A></B>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN="2"><B CLASS="shiny">WS_FTP LE</B></TD>
		</TR>
		<TR> 
			<TD WIDTH="30">&nbsp;</TD>
			<TD><B>P&aacute;gina web: </B>
			<A TARGET="_BLANK" HREF="http://www.ipswitch.com/">http://www.ipswitch.com/</A><BR>
			Cliente de FTP. Permite conectarse a sitios FTP de los cuales se pueden 
			descargar archivos.<B><BR>
			<IMG SRC="/Images/plantilla/triangulorojo.gif" WIDTH="10" HEIGHT="14" alt=""> 
			<A HREF="/Comunidad/Software/ws_ftple.exe">Descargar</A></B>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN="2"><B CLASS="shiny">Microsotf Viewers</B></TD>
		</TR>
		<TR> 
			<TD WIDTH="30">&nbsp;</TD>
			<TD>
			<B>P&aacute;gina web: </B>
			<A TARGET="_BLANK" HREF="http://www.microsoft.com/office/000/viewers.asp">http://www.microsoft.com/office/000/viewers.asp</A><BR>
			Estos programas le permiten visualizar, m&aacute;s no modificar, los documentos 
			producidos por Microsof Office<BR>
			<IMG SRC="/Images/plantilla/triangulorojo.gif" alt=""> 
			<A HREF="/Comunidad/Software/Word%20Viewer.exe">Word Viewer</A><BR>
			<IMG SRC="/Images/plantilla/triangulorojo.gif" alt=""> 
			<A HREF="/Comunidad/Software/PowerPoint%20Viewer.exe">PowerPoint Viewer</A><BR>
			<IMG SRC="/Images/plantilla/triangulorojo.gif" alt=""> 
			<A HREF="/Comunidad/Software/Excel%20Viewer.exe">Excel Viewer</A><BR>
			<IMG SRC="/Images/plantilla/triangulorojo.gif" alt=""> 
			<A HREF="/Comunidad/Software/Visio%20Viewer.exe">Visio Viewer</A>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN="2"><B CLASS="shiny">Otros</B></TD>
		</TR>
		<TR> 
			<TD WIDTH="30">&nbsp;</TD>
			<TD>
			<IMG SRC="/Images/plantilla/triangulorojo.gif" alt=""> 
			<A HREF="/Comunidad/Software/manualaccess.pdf">Manual Access</A><BR>
			<IMG SRC="/Images/plantilla/triangulorojo.gif" alt=""> 
			<A HREF="/Comunidad/Software/ConceptDrawProDemoES.zip">ConceptDrawProDemo</A><BR>
			<IMG SRC="/Images/plantilla/triangulorojo.gif" alt=""> 
			<A HREF="/Comunidad/Software/PROYEKTA 2k8.xls">Plantilla para leer los archivos de BPR</A></TD>
			
		</TR>
		</TABLE>
		<?
	}
	
	PageEnd();
?>
	