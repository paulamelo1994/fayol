<?
	session_start();
	
	require '../../functions.php';
	$root_path = "../..";
	
	function chequearBD($codigo)
	{
		$tmp = split('[.]', $codigo);
		$codigo = $tmp[0];
		$conexion = DBConnect('fayol');
		if(!$conexion)
			echo "<h2>No se logro la conexi&oacute;n con la BD.</h2>";
		else
		{
			$rs = db_query("select * from simulacro_ecaes where codigo = '$codigo'");
			
			if(pg_num_rows($rs) == 0)
				return false;
			else
				return true;
		}
	}
	
	$_GET['submenu_simulacro_ecaes'] = true;
	
	if(isset($_POST['autenticar']))
	{
		if($_POST['password'] == PASS_ECAES)
			$_SESSION['ecaes'] = true;
		else
		{
			echo "<h2>Autenticaci&oacute;n fallida. Intente nuevamente.</h2>";
		}
	}
	
	if(isset($_POST['aceptar']))
	{
		$nombre_archivo = $_FILES['archivo']['name'];
		if(empty($_FILES['archivo']['name']))
			$_GET['campos_vacios'] = true;
		else if($_FILES['archivo']['type'] != 'application/vnd.ms-excel')
			$_GET['error_formato'] = true;
		else if(!chequearBD($nombre_archivo) && $nombre_archivo[0] != 'R')
		{
			$_GET['no_existe'] = true;
		}
		else
		{
			$nombre = $_FILES['archivo']['name'];
			$documento = "archivos/".$nombre;
			
			if(@file($documento))
			{
				echo "<h2>El documento ya ha sido guardado previamente. Intente nuevamente.</h2>";
			}
			else
			{			
				move_uploaded_file($_FILES['archivo'][tmp_name], $documento);
				chmod($documento, 0770);
				chgrp($documento, "nobody");
				
				echo "<h2>El documento se ha almacenado exitosamente.</h2>";
			}
		}
	}
	
	PageInit("Subir respuestas ECAES", "../menu.php");
	
	if(!isset($_SESSION['ecaes']))
	{
		?>
		<H1 CLASS="shiny">Autenticaci&oacute;n Requerida</H1>
		<P>Esta area de nuestra p&aacute;gina esta restringida solo para el acceso de los monitores responsables 
		del simulacro del ECAES. Para tener acceso por favor ingrese su clave.</p>
		<center>
		<form method="post" action="respuestas.php" enctype="multipart/form-data">
		<table cellpadding="2" cellspacing="2">
		<tr>
			<td width="50" class="titulosContenidoInterno">PASSWORD:</td>
			<td width="50"><input type="password" name="password"></td>
		</tr>
		<tr>
			<td colspan="2">
			<div align="center">
			<input name="autenticar" type="submit" value="Aceptar">
			</div>
			</td>
		</tr>
		</table>
		</form>
		</center>
		<?
	}
	else
	{
		?>
		<h2>Respuestas ECAES</h2>
		<form name="subir_respuestas" enctype="multipart/form-data" method="post">
		<table border="0" align="center">
		<tr>
			<td class="titulosContenidoInterno">Seleccione el archivo donde se encuentra <br>la lista de respuestas</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td><input type="file" name="archivo"></td>
		</tr>
		<tr><td colspan="2"><br><br><br></td></tr>
		<tr>
			<td colspan="2" align="center">
			<input type="submit" name="aceptar" value="Aceptar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		</table>
		</form>
		<?
	}
	
	PageEnd();
	
	if(isset($_GET['campos_vacios']))
	{
		?>
		<script language="javascript">
		alert("Debe ingresar el archivo de respuestas. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['error_formato']))
	{
		?>
		<script language="javascript">
		alert("El formato del archivo no es del tipo solicitado. Recuerde que debe ser una hoja de calculo (Extensión SXC). Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['no_existe']))
	{
		?>
		<script language="javascript">
		alert("El codigo de estudiante que identifica el archivo ingresado no esta registrado en la base de datos. Intente nuevamente.");
		</script>
		<?
	}
?>