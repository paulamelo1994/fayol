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
	
	require '../../../functions.php';
	$root_path = "../../..";
	
	$_GET['submenu_idiomas'] = true;
	PageInit("Notas", "../../menu.php");
	
	$conexion = DBConnect("idiomas");
	$rs = db_query("select * from notas order by fecha, hora");
	?>
	<table width="600" align="center" border="1" cellspacing="0" cellpadding="2">
	<tr>
		<th>Fecha</th>
		<th>Hora</th>
		<th>Quiz</th>
		<th>Codigo</th>
		<th>Nota</th>
	</tr>
	<tr>
	<?
	
	while($obj = pg_fetch_object($rs))
	{
		?>
			<td class="normal" align="center"><?=$obj->fecha?></td>
			<td class="normal" align="center"><?=$obj->hora?></td>
			<td class="normal" align="center"><?=$obj->num_test?></td>
			<td class="normal" align="center"><?=$obj->cod_estudiante?></td>
			<td class="normal" align="center"><?= number_format($obj->nota, 2)?></td>
		</tr>
		<?
	}
	?>
	</table>
	<?
	
	PageEnd();
?>