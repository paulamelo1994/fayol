<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: revisar.php
	Objetivo: Lista las bitacoras de los usuarios para el usuario administrador.
	Autor: Angela Benavides
	Año: 2007
	*********************************************************/
	
	session_start();
	
	if(!isset($_SESSION['usuario']))
	{
		header("Location: /Comunidad/Idiomas/index.php");
		die();
	}
	
	$root_path = "../..";
	require '../../functions.php';
	
	$_GET['submenu_idiomas'] = true;
	
	if($_POST['cancelar'])
	{
		header("Location: /Comunidad/Idiomas/index.php");
		die();
	}
	
	if($_POST['aceptar'])
	{
		if(empty($_POST['estudiante']))
			$_POST['vacios'] = true;
		else
		{
			header("Location: /Comunidad/Idiomas/sesiones.php?estudiante=$_POST[estudiante]");
			die();
		}
	}
	
	PageInit("Revisar Bit&aacute;coras", '../menu.php');
	
	$conexion = DBConnect('idiomas');
		
	if(!$conexion)
	{
		echo "No se logro la conexion con la BD.";
	}
	else
	{
		$idioma = $_GET['idioma'];
		$rs = db_query("SELECT distinct on (cod_estudiante) * from sesion");
		
		?>
		<form name="revisar" enctype="multipart/form-data" method="post" action="">
		<h2 align="center">Seleccione el estudiante:</h2><br>
		<table border="1" align="center" width="600" cellpadding="0" cellspacing="0">
		<tr>
			<th width="5%"></th>
			<th width="30%">Codigo</th>
			<th width="40%">Nombre Estudiante</th>
			<th width="10%">Plan</th>
			<th width="10%">Nivel</th>
		</tr>
		<?
		while($obj = pg_fetch_object($rs))
		{
			$salas = DBConnect('controlsalas');
			
			if(!$salas)
			{
				echo "No se logro la conexion con la BD controlsalas.";
			}
			else
			{
				$rs1 = db_query($salas, "select nombres, apellidos from estudiantes where codigo = '$obj->cod_estudiante'");
				$obj1 = pg_fetch_object($rs1);
				
				?>
				<tr>
					<td><input type="radio" name="estudiante" value="<?=$obj->cod_estudiante?>"></td>
					<td align="center" class="normal"><?=$obj->cod_estudiante?></td>
					<td align="center" class="normal"><?=$obj1->nombres." ".$obj1->apellidos?></td>
					<td align="center" class="normal"><?=$obj->plan?></td>
					<td align="center" class="normal"><?=$obj->nivel?></td>
				</tr>
				<?
			}
		}
		?>
		</table>
		<br><br>
		<table border="0" align="center" width="80%" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center">
			<input type="submit" name="aceptar" value="Aceptar">
			&nbsp;&nbsp;&nbsp;
			<input type="submit" name="cancelar" value="Cancelar">
			</td>
		</tr>
		</table>
		</form>
		<?
	}
	
	PageEnd();
	
	if(isset($_POST['vacios']))
	{
		?>
		<script language="javascript">
		alert("Seleccione una opción.");
		</script>
		<?
	}
?>