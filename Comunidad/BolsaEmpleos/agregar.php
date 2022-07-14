<?
	session_start();
	require "../../functions.php";
	$rootPath = "../..";
  
	$_GET['submenu_empleos'] = true;
	
	if(isset($_POST['autenticar']))
	{
		$autenticado_empleos = autenticarUsuario("empleos", $_POST[password]);
		if(!$autenticado_empleos)
			$error = true;
		else
			$_SESSION['autenticado_empleos'] = true;
	}

	PageInit("Agregar Oferta de Empleo", "../menu.php");

	if($_SESSION['autenticado_empleos'])
	{
		?> <h1 class="shiny">Agregar Oferta de Empleo</h1> <?
  
		if($_POST[sub_button])
		{
			if(!$_POST['cargo'] || !$_POST['fecha'] || !$_POST['contacto'])
				$error = true;
			else
			{
				$con = DBConnect('fayol');
				$rs = @db_query("insert into bolsaempleos(cargo, requisitos, contacto, fecha) values('$_POST[cargo]', '$_POST[requisitos]', '$_POST[contacto]', '$_POST[fecha]')");
				// actualizo la fecha de ultima actualizacion
				if ($rs)
				{
					$ultima = FechaActual();
					$fp = fopen("ultima_actualizacion.txt", "w");
					fwrite($fp, $ultima, strlen($ultima));
					fclose($fp);
					// fin actualizacion
					$insertado = true;
					unset($_POST);
				}
				else
					$error = true;
			}
		}
	
		?>
		<BR>
		<?
		if($insertado)
		{
			?>
			<FONT color="#008000"><B>La oferta de empleo fue agregada</B></FONT><BR><BR>
			<?
		}
		if($error)
		{
			?>
			<FONT COLOR="#FF0000">
			<B>Olvidaste llenar alguno de los campos obligatorios del formulario o el formato de la fecha no es valido</B>
			</FONT><BR><BR>
			<?
		}
	
		?>
		<FORM METHOD="POST" action="">
		<B>FECHA DE LA OFERTA<FONT COLOR=RED><B> *</B></FONT>:</B><BR>
		<INPUT TYPE="TEXT" NAME="fecha" VALUE="<?= $_POST['fecha'] ?>"><BR>
		<BR><B>CARGO<FONT COLOR=RED><B> *</B></FONT>:</B><BR>
		<INPUT TYPE="TEXT" NAME="cargo" SIZE="50" VALUE="<?= $_POST['cargo'] ?>"><BR>
		<BR><B>REQUISITOS EXIGIDOS:</B><BR>
		<TEXTAREA ROWS="5" COLS="50" NAME="requisitos"><?= $_POST['requisitos'] ?></TEXTAREA><BR>
		<BR><B>CONTACTO<FONT COLOR=RED><B> *</B></FONT>:</B><BR>
		<TEXTAREA ROWS="5" COLS="50" NAME="contacto"><?= $_POST['contacto'] ?></TEXTAREA><BR>
		<BR>
		<INPUT TYPE="SUBMIT" VALUE="Agregar Empleo" NAME="sub_button">
		<P ALIGN="RIGHT"><A HREF="index.php?item=s"><B>Cerrar Sesi&oacute;n</B></A></P>
		</FORM>
		<?
	}
	else
	{
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