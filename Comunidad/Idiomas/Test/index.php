<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: index.php
	Objetivo: Formulario mediante el cual se hace una evaluación de conocimientos a los estudiantes.
		Carga una archivo de texto en el cual se encuentran los siguientes datos:
		- Numero del Quiz a realizar, esto porque en un mismo dia se pueden realizar  varios quices.
		- Pregunta.
		- 5 opciones de respuesta.
		- Respuesta correcta.
	Autor: Angela Benavides
	Año: 2007
	*********************************************************/
	
	session_start();
	
	if(!isset($_SESSION['usuario']))
	{
		header("Location: /Comunidad/Idiomas/index.php");
		die();
	}
	
	require '../../../functions.php';
	$root_path = '../..';
	
	if($_POST['autenticar'])
	{
		$conexion = DBConnect('controlsalas');
		
		if(!conexion)
		{
			header("Location: /Comunidad");
			die();
		}
		
		$rs = db_query("SELECT * FROM monitor WHERE login= '$_POST[Login]' and password = '$_POST[Password]'");
		
		$filas = pg_num_rows($rs);
		if($filas != 0)
			$_SESSION['usuario']['acceso'] = true;
		else
		{
			echo "<h2>Datos erroneos!!!</h2>";
		}
	}
	
	if(isset($_GET['salir']))
	{
		unset($_SESSION['usuario']['acceso']);
		header("Location: /Comunidad/Idiomas/index.php");
		die();
	}
	
	if(isset($_POST['aceptar']))
	{
		if(empty($_FILES['archivo']['name']) || empty($_POST['preguntas']))
			$_GET['campos_vacios'] = true;
		else if($_FILES['archivo']['type'] != 'text/plain')
			$_GET['error_formato'] = true;
		else if(!is_numeric($_POST['preguntas']))
			$_GET['numero'] = false;
		else if(!is_numeric($_POST['num_test']))
			$_GET['numero_test'] = false;
		else
		{
			$documento = "tmp/archivo_tmp.txt";
			move_uploaded_file($_FILES['archivo'][tmp_name], $documento);
			chmod($documento, 0770);
			chgrp($documento, "nobody");
			
			$file = fopen($documento, "a");
			fwrite($file, "\npreguntas: ".$_POST['preguntas']. " | quiz: ".$_POST['num_test']);
			fclose($file);
			
			$_GET['subido'] = true;
		}
	}
	
	if($_POST['cancelar'])
	{
		header("Location: /Comunidad/Idiomas/index.php");
		die();
	}
	
	$_GET['submenu_idiomas'] = true;
	
	PageInit("Laboratorio de Idiomas. Quiz", "../../menu.php");
	
	?>
		
	<h2>Configuraci&oacute;n del Quiz:</h2>
	<form name="configuracion_test" enctype="multipart/form-data" method="post" action="">
	<table border="0" align="center">
	<tr>
		<td class="titulosContenidoInterno">Quiz N&uacute;mero</td>
		<td><input type="text" name="num_test"></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td class="titulosContenidoInterno">Seleccione el archivo donde se encuentra <br>la lista de preguntas del Quiz</td>
		<td><input type="file" name="archivo"></td>
	</tr>
	<tr><td colspan="2"><br></td></tr>
	<tr>
		<td class="titulosContenidoInterno">N&uacute;mero deseado de preguntas para el Quiz</td>
		<td><input type="text" name="preguntas"></td>
	</tr>
	<tr><td colspan="2"><br><br><br></td></tr>
	<tr>
		<td colspan="2" align="center">
		<input type="submit" name="aceptar" value="Aceptar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="cancelar" value="cancelar">
		</td>
	</tr>
	</table>
	</form>
	<?
	
	
	
	if(isset($_GET['campos_vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe llenar los campos obligatorios. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['numero_test']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El campo ingresado para número de quiz no es valido. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['error_formato']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El formato del archivo no es del tipo solicitado. Recuerde que debe ser un archivo de text (Extensión txt). Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['numero']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El campo ingresado para número de preguntas no es valido. Intente nuevamente.");
		</script>
		<?
	}

	if(isset($_GET['subido']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se ha actualizado el archivo exitosamente.");
		</script>
		<?
	}
	
	PageEnd();
?>