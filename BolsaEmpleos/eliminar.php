<?
	session_start();
	require "../../functions.php";
	$rootPath = "../..";
  
	$_GET['submenu_empleos'] = true;
  
	if(isset($_POST[autenticar]))
	{
		$autenticado_empleos = autenticarUsuario("empleos", $_POST[password]);
		if(!$autenticado_empleos)
			$error = true;
		else
			$_SESSION[autenticado_empleos] = true;
  }
  
	if($_SESSION[autenticado_empleos])
	{
		if(isset($_GET[id]))
		{
			$con = DBConnect('fayol');
			$rs = db_query("delete from bolsaempleos where id=$_GET[id]");
			// actualizo la fecha de ultima actualizacion
			$ultima = FechaActual();
			$fp = fopen("ultima_actualizacion.txt", "w");
			fwrite($fp, $ultima, strlen($ultima));
			fclose($fp);
			// fin actualizacion
			header("Location: eliminar.php?item=3");
			die();
		}

		PageInit("Eliminar Oferta de Empleo", "../menu.php");	
		
		?>
		<BR><h1 class="shiny">Eliminar Oferta de Empleo</h1><BR>
		<?
		
		// si se hizo submit
		$con = DBConnect('fayol');
		$rs = db_query("select * from bolsaempleos order by id desc");
		
		?>
		<CENTER><B><I>Aqu&iacute; encontrar&aacute;s ofertas de empleos que pueden interesarte, no dudes<BR>
		en comunicarte con la oficina sugerida cumpliendo los requisitos exigidos.</I></B><BR></CENTER><BR>
		<hr width="90%">
		<?

		if(!pg_num_rows($rs))
		{
			?>
			<CENTER><FONT color="#FF0000"><B>No hay empleos disponibles</B></FONT></CENTER>
			<?
		}
		else
		{
			while($obj = pg_fetch_object($rs))
			{
				?>
				<BR>
				<FONT color="#000080"><B><A HREF="eliminar.php?id=<?= $obj->id ?>"><?= $obj->cargo ?></A></B></FONT>
				<p>
				<FONT color="#000080"><B>REQUISITOS:<BR></B></FONT>
				<?=makeHtml($obj->requisitos)?>
				<br><br>
				<FONT color="#000080"><B>CONTACTO:<BR></B></FONT>
				<?=makeHtml($obj->contacto)?>
				</p>
				<br>
				<hr width="90%">
				<?
			}
		}
		?>
		<BR>
		<P ALIGN="RIGHT"><A HREF="index.php?item=s"><B>Cerrar Sesi&oacute;n</B></A></P>
		<CENTER>
		<HR>
		<B>FECHA ULTIMA ACTUALIZACION: </B><? include "ultima_actualizacion.txt"?><BR>
		<A HREF="mailto:admcoord@fayol.univalle.edu.co">admcoord@fayol.univalle.edu.co</A><BR>
		Información adicional en la Coordinación Administrativa de la Facultad<BR>Monica Medina tel. 554 24 66 ext. 165
		</CENTER>
		<?
	}
	else
	{
		PageInit("Eliminar Oferta de Empleo", "../menu.php");
		?>
		<h1 class="shiny">Autenticar Usuario <I>Empleos</I></h1>
		<FORM METHOD="POST" action="">
		<TABLE WIDTH="50%" BORDER="0" align="center">
		<TR>
			<TD><B>Login:</B></TD>
			<TD><FONT COLOR=NAVY><B>Empleos</B></FONT></TD>
		</TR>
		<TR>
			<TD><B>Password:</B></TD>
			<TD><INPUT TYPE="PASSWORD" NAME="password" SIZE=12></TD>
		</TR>
		<TR>
			<TD COLSPAN="2"><CENTER><INPUT TYPE=SUBMIT NAME="autenticar" VALUE="Autenticar Usuario"></CENTER></td>
		</TR>
		</TABLE>
		</FORM>
		<? if(isset($error)) echo "<FONT COLOR=RED><B>Constrase&ntilde;a no valida</B></FONT>" ?>
		<?
	}
  PageEnd();
?>