<?
	session_start();
	
	require "../../functions.php";
	$rootPath = "../..";
	
	$valign = 'top';
	$centrar_contenido = false;
	$_GET['submenu_actas'] = true;
	
	if(isset($_GET['item']) && $_GET['item'] == 's')
	{
		unset($_SESSION['actas']);
	}
  
	$authentication=true;
	/*
	if ($_POST['autenticar'])
	{
		if(AutenticarUsuario($login, $password))
		{
			$authentication=true;
			$_SESSION['actas'] = true;
		}
		else
			$authentication=false;
	}
	*/
  /*
	if(!$_SESSION['actas'])
	{
		PageInit('Autenticación requerida', '../mainmenu.php');
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
			<TD COLSPAN=2><CENTER><INPUT TYPE=SUBMIT NAME="autenticar" VALUE="Autenticar"></CENTER>
		</TR>
		</TABLE>
		</FORM>
		<?
	}
	else
	{		*/
		PageInit("Actas de la Facultad", "../menu.php");
		?>
		<H1 class="shiny"><IMG SRC="/Images/folder-actas.jpg" alt=""> Actas de la Facultad</H1>
		<p><BR>
        <br>
		    <IMG SRC="/Images/triangulorojo.gif" alt="">
		    <a href="comiteposgrados/">Comit&eacute; de Posgrados</a>
		    <br>
		    <br>
		    <IMG SRC="/Images/triangulorojo.gif" alt="">
		    <a href="Consejo%20Facultad/">Actas del Consejo de Facultad</a>
		    <br>
		    <br>
		    <IMG SRC="/Images/triangulorojo.gif" alt="">
		    <a href="Comite%20Curriculo/">Actas del Comit&eacute; de Curr&iacute;culo</a>
		    <br>
            <br>
		    <IMG SRC="/Images/triangulorojo.gif" alt="">
		    <a href="Claustro">Actas de Claustro</a>
		    <br>
		    <br>
		    <IMG SRC="/Images/triangulorojo.gif" alt="">
		    <a href="Contaduria/">Actas del Comit&eacute; de Contadur&iacute;a P&uacute;blica</a>
		    <br>
		    <br>
		    <IMG SRC="/Images/triangulorojo.gif" alt="">
		    <a href="MaAdmon/">Actas de la Maestr&iacute;a en Administraci&oacute;n de Empresas y Ciencias de la Organizaci&oacute;n</a>
		    <br>
		    <br>
		    <IMG SRC="/Images/triangulorojo.gif" alt="">
    <a href="Comite_contabilidad_finanzas/">Actas del Comit&eacute; del Departamento de Contabilidad y Finanzas</a></p>
		<p><IMG SRC="/Images/triangulorojo.gif" alt=""> <a href="Juridico/">Normas y Conceptos Jur&iacute;dicos de Inter&eacute;s </a></p>
		<p>
	        <?/*
	}
	*/
	PageEnd();
?>
                </p>
