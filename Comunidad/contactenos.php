<?
	require '../functions.php';
	$root_path = "../";
	
	if(isset($_POST['aceptar']))
	{
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['comentario']))
			$_POST['vacios'] = true;
		else
		{
			$ip = getIP();
			
			if(mail("webwoman@univalle.edu.co", "Evento", "De: $_POST[nombre]\n\n$ip", "From: $correo"))
				$_POST['enviado'] = true;
			else
				$_POST['error'] = true;
		}
	}
	
	if($_POST['cancelar'])
	{
		header("Location: /Comunidad");
		die();
	}
	
	PageInit("Contactenos", "menu.php");
?>
<h2>Para una mejor atenci&oacute;n para usted hemos dispuesto de este formulario desde el cual puede enviarnos
cualquier tipo de inquietud sobre el evento.</h2>
<br><br>
<form name="contactenos" method="post" enctype="multipart/form-data">
<table border="0" width="70%" align="center">
<tr>
	<td width="30%" class="titulosContenidoInterno" valign="top">Nombre Completo:</td>
	<td><input type="text" name="nombre" value="<?=$_POST['nombre']?>" size="40"></td>
</tr>
<tr><td colspan="2"><br><br></td></tr>
<tr>
	<td width="30%" class="titulosContenidoInterno" valign="top">Correo Electronico:</td>
	<td><input type="text" name="correo" value="<?=$_POST['correo']?>" size="40"></td>
</tr>
<tr><td colspan="2"><br><br></td></tr>
<tr>
	<td class="titulosContenidoInterno" valign="top">Comentario o Sugerencia:</td>
	<td><textarea name="comentario" cols="30" rows="10"><?=$_POST['comentario']?></textarea></td>
</tr>
<tr><td colspan="2"><br><br></td></tr>
<tr>
	<td colspan="2" align="center">
	<input type="submit" name="aceptar" value="Enviar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" name="cancelar" value="Cancelar">
	</td>
</tr>
</table>
</form>
<?
	PageEnd();
	
	if(isset($_POST['vacios']))
	{
		?>
		<script language="javascript">
		alert("Se requieren llenos todos los campos!");
		</script>
		<?
	}
	
	if(isset($_POST['enviado']))
	{
		?>
		<script language="javascript">
		alert("Se ha enviado su mensaje exitosamente.");
		location.href="/Comunidad";
		</script>
		<?
	}
	
	if(isset($_POST['error']))
	{
		?>
		<script language="javascript">
		alert("Ocurrio un error al enviar su mensaje. Intente Nuevamente.");
		</script>
		<?
	}
?>