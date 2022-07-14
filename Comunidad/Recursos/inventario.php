<?
	require '../../functions.php';
	$rootPath = '../../';
	
	session_start();
	
	$_GET['submenu_recursos'] = true;
   
	DBConnect('fayol');
	

	
	if( isset($_POST['Submit']) )
	{
		$fecha = date('m-d-Y');
		db_query("
			INSERT INTO inventario( fecha, espacio, responsable, inventario, elemento, modelo, marca, comentario, observaciones, serie, ip, mac )
			VALUES('$fecha','$_POST[espacio]','$_POST[responsable]','$_POST[inventario]','$_POST[elemento]',
			 '$_POST[modelo]','$_POST[marca]','$_POST[comentario]','$_POST[observaciones]','$_POST[serie]','$_POST[ip]','$_POST[mac]')
			");

			header("Location: inventario.php?Succeded=$solicitud");
			die();
		
	}

   
	$valign = 'top';
	PageInit('Formato de Ingreso de Inventario', '../menu.php');
   
	?> <H1 class="shiny">Formato de Ingreso de Inventario </H1> 
<?
   
	if( isset($_GET['Succeded']) )
	{
		echo '<center><br>';
		Succeded("<div align=\"justify\">El inventario ha sido ingresado correctamente</a></div></center>");
		?><meta http-equiv="refresh" content="3; url= ../Recursos/inventario.php"> <?
		die();
	}
//	if( $campos_en_blanco )
//		echo '<br><font size="2" color="red">Por favor llene todos los campos para que su petici&oacute;n pueda ser procesada.</font>';
   
	?>
<p>&nbsp;</p>
<form action="" method="post">
  <fieldset>
    <TABLE WIDTH="100%">
	<TR>
		<TD width="31%"><B>Espacio</B></TD>
		<TD width="38%"><INPUT VALUE="<?= $_POST['espacio'] ?>" NAME="espacio" TYPE="TEXT" ID="espacio" SIZE="20" MAXLENGTH="4"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD><B>Responsable </B></TD>
		<TD><INPUT VALUE="<?= $_POST['responsable'] ?>" NAME="responsable" TYPE="TEXT" SIZE="20" MAXLENGTH="49"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD><B>N&uacute;mero del inventario del equipo</B></TD>
		<TD><INPUT VALUE="<?= $_POST['inventario'] ?>" TYPE="TEXT" NAME="inventario" SIZE="10" MAXLENGTH="8"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD><B>Elemento</B></TD>
		<TD><INPUT VALUE="<?= $_POST['elemento'] ?>" TYPE="TEXT" NAME="elemento" SIZE="30" MAXLENGTH="50"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD><B>Modelo</B></TD>
		<TD><INPUT VALUE="<?= $_POST['modelo'] ?>" TYPE="TEXT" NAME="modelo" SIZE="10" MAXLENGTH="50"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD><B>Marca</B></TD>
		<TD><INPUT VALUE="<?= $_POST['marca'] ?>" TYPE="TEXT" NAME="marca" SIZE="10" MAXLENGTH="50"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD><B>Serie</B></TD>
		<TD><INPUT VALUE="<?= $_POST['serie'] ?>" TYPE="TEXT" NAME="serie" SIZE="10" MAXLENGTH="50"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD><B>IP</B></TD>
		<TD><INPUT VALUE="<?= $_POST['ip'] ?>" TYPE="TEXT" NAME="ip" SIZE="10" MAXLENGTH="50"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD><B>MAC</B></TD>
		<TD><INPUT VALUE="<?= $_POST['mac'] ?>" TYPE="TEXT" NAME="mac" SIZE="10" MAXLENGTH="50"></TD>
	</TR>
	<tr><td colspan="4">&nbsp;</td></tr>	
	<TR>
		<TD COLSPAN="2"><P><B>Observaciones</B><BR><br>
		<CENTER><TEXTAREA COLS="60" ROWS="8" NAME="observaciones"><?= $_POST['observaciones'] ?></TEXTAREA></CENTER>
		</TD>
	</TR>
	<TR>
		<TD COLSPAN="2"><P><B>Comentarios</B><BR><br>
		<CENTER><TEXTAREA COLS="60" ROWS="8" NAME="comentario"><?= $_POST['comentario'] ?></TEXTAREA></CENTER>
		</TD>
	</TR>
   </TABLE>
  </fieldset>
  <br><br>
  <div id="enviar" align="center">
  <INPUT TYPE="SUBMIT" NAME="Submit" VALUE="Enviar Peticion">
  </div>
</form>
   <?
	PageEnd();
?>
