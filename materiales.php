<?
  die();

	function LinkearMail($mail, $idprof)
	{
		if( $mail )
			return "<A HREF=# onClick=window.open(\"/SendMailAuth.php?iddocente=$idprof\",\"\",\"toolbar=no,directories=no,menubar=no,status=no,width=410,height=310\")><IMG SRC='/Images/icono_email.gif' BORDER='0'></A>";
	}

	session_start();
	require "../functions.php";
	$rootPath = '..';

  # Inicio Materiales Cursos
	if( isset($_GET['docente']) )
		$_SESSION['serial_doc'] = $_GET['docente'];

  	$docente = getDocenteSerial( $_SESSION['serial_doc'] );
  	$docente->nombre = ucwords(strtolower($docente->nombre));
  
  if(!isset($_SESSION['CWD']) || isset($_GET['CarpetaPrincipal']))
     $_SESSION['CWD'] = "Material/$docente->login";
  
  if(isset($_GET['OpenDirectory']))
  {
     if($_SESSION['entradas'][$EntryClicked][0] == '..')
	    $_SESSION['CWD'] = dirname($_SESSION['CWD']);
	 else
        $_SESSION['CWD'] .= "/".$_SESSION['entradas'][$EntryClicked][0];
	 header("Location: materiales.php");
	 //var_export($_SESSION);
	 die();
  }
  # Fin Materiales Cursos
	
	
	$_GET['item'] = 8;
	
	$valign = 'top';
	$centrar_contenido = false;
	$width = '100%';
	PageInit("Nuestra Comunidad", "menu.php", 0);
	echo "<br><table width='90%' align='center'><tr><td>";

		   Cell("Materiales de Apoyo");
			
			if($_SESSION['CWD'] == "Material/$docente->login")
				 $CarpetaActual = "principal";
			else
      		 $CarpetaActual = str_replace("Material/$docente->login/", "", $_SESSION['CWD']);
			
			if( isset($_GET['Lista']) )
			{
			?>
	 <P>
		Desde est&aacute; p&aacute;gina puede acceder a los materiales 
      de apoyo, P&aacute;ginas Web y direcciones de correo de los docentes registrados.
	 </P>
    <UL>
      <LI>Pulse sobre el &iacute;cono <IMG SRC="/Images/Web.jpg" ALIGN="ABSMIDDLE"> para ir directamente a la P&aacute;gina Web 
      de cada docente.<BR>
      <LI>Pulse sobre el &iacute;cono <IMG SRC="/Images/Apoyo.jpg" ALIGN="ABSMIDDLE"> para ver los materiales de apoyo que el docente 
      a puesto a su disposici&oacute;n.<BR>
      <LI>Pulse sobre el &iacute;cono <IMG SRC="/Images/icono_email.gif" ALIGN="ABSMIDDLE"> 
        para mandar un correo al docente desde esta misma p&aacute;gina, no necesita 
        tener configurado un cliente de correo. Si el &iacute;cono no aparece 
        frente a alguno de los docentes, es porque ese docente no ha reportado 
        una cuenta de correo.<BR>
	</UL>
	<HR COLOR="navy">
      <?
				DBConnect('profesores');
				$rs = db_query("SELECT nombre, login, mail, serial FROM profesores ORDER BY nombre");
				
				echo "<P><TABLE WIDTH='100%'>";
				while( $obj = pg_fetch_object($rs) )
				{
					echo "<TR><TD>$obj->nombre</TD>".
						  "<TD><A HREF='/Docentes/WebPages/www.php?docente=$obj->serial'><IMG SRC='/Images/Web.jpg'></A></TD>".
						  "<TD>".LinkearMail($obj->mail, $obj->serial)."</TD>".
						  "<TD><A HREF='materiales.php?CarpetaPrincipal=1&docente=$obj->serial'><IMG SRC='/Images/Apoyo.jpg' BORDER='0'></A></TD></TR>";
				}
				echo "</TABLE></P>";
			}
			else
			{
				if($_SESSION['CWD'] == "Material/$docente->login")
				{
					$CarpetaActual = "principal";
					echo '<BR><CENTER><A HREF="materiales.php?Lista=1" STYLE="color: #104a7b; font-weight:bold; text-decoration:none;">&lt; &lt; Volver a la lista de docentes</A></CENTER>';
				}
				else
					$CarpetaActual = str_replace("Material/$docente->login/", "", $_SESSION['CWD']);
				
				$someFile = GraphicLS($_SESSION['CWD'], 'materiales.php?', $CarpetaActual != 'principal');
				
				if( !$someFile )
					echo "<CENTER><P><FONT COLOR='RED'><B>
					El docente $docente->nombre a&uacute;n no ha reportado materiales de apoyo
					</B></FONT></P>
					</CENTER>";

			}
				
	echo "</td></tr></table>";
	
	PageEnd();
?>