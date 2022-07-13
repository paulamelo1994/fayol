<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: sesiones.php
	Objetivo: Lista las sesiones de una estudiante en un curso.
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
	
	if(isset($_GET['estudiante']))
		$codigo = $_GET['estudiante'];
	else
		$codigo = $_SESSION['usuario']['codigo'];
	
	$salas = DBConnect('controlsalas');
	
	if(!$salas)
		echo "No se logro la conexion con la BD de las salas.";
		
	$rs = db_query("select * from estudiantes where codigo = '$codigo'");
	$obj = pg_fetch_object($rs);
	
	$conexion = DBConnect('idiomas');
	$rs = db_query("SELECT distinct on (idioma) idioma from sesion where cod_estudiante = '$codigo'");
		
	PageInit("Sesiones de $obj->nombres $obj->apellidos", '../menu.php');
	
	if(!isset($_GET['idioma']))
	{
		?>
		<h1 class="shiny">Sesiones</h1>
		<form name="idioma" enctype="multipart/form-data" method="post" action="">
		<table border="0" width="60%" align="center">
		<?
		if(pg_num_rows($rs) == 0)
			echo "<tr><td><h2>El estudiante no tiene registrada hasta ahora ninguna sesi&oacute;n.</h2></td></tr>";
		else
		{
		?>
			<tr><td class="titulosContenidoInterno">El estudiante esta inscrito en los siguientes idiomas. Seleccione uno:</td></tr>
			<tr><td><input type="hidden" name="codigo" value="cosa"><br><br></td></tr>
			<tr>
				<td align="center"><select name="idioma">
				<option>&nbsp;</option>
				<?
				while($obj1 = pg_fetch_object($rs))
				{
					?>
					<option onClick="document.location.href='sesiones.php?estudiante=<?=$codigo?>&amp;idioma=<?=$obj1->idioma?>'"><?=$obj1->idioma?></option>
					<?
				}
				?>
				</select></td>
			</tr>
		<?
		}
		?>
		</table>
		</form>
<?
	}
	else
	{
		$idioma = $_GET['idioma'];
		
		$rs = db_query("select * from sesion where cod_estudiante = '$codigo' and idioma = '$idioma' order by fecha, nivel;");
		?>
		<h2 align="center">Reporte de sesiones del estudiante.</h2>
		<table border="0" align="center" width="250">
		<tr><td width="20%" class="titulosContenidoInterno">Estudiante:</td><td><?=$obj->nombres." ".$obj->apellidos?></td></tr>
		<tr><td width="20%" class="titulosContenidoInterno">Codigo:</td><td><?=$obj->codigo?></td></tr>
		<tr><td width="20%" class="titulosContenidoInterno">Plan:</td><td><?=$obj->codplan?></td></tr>
		<tr><td width="20%" class="titulosContenidoInterno">Idioma:</td><td><?=$idioma?></td></tr>
		</table>
		
		<br><br>
		<HR width="100%" align="center" size="3">
		<div align="center" class="tituloTablaInterna"><i>Actividades de la sesi&oacute;n</i></div>
		<br>
		<table border="1" width="750" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<th>Sesi&oacute;n</th>
			<th>Fecha</th>
			<th>Hora Registro</th>
			<th>Nivel</th>
			<th>Tipo Pr&aacute;ctica</th>
			<th>Profesor</th>
			<th>Autoevaluaci&oacute;n</th>
			<th>Actividad</th>
			<th width="50">Titulo</th>
			<th>Descripci&oacute;n</th>
			<th>Resultado</th>
		</tr>
		<?
		$i = 1;
		while($obj1 = pg_fetch_object($rs))
		{
			$rs1 = db_query("select * from actividad where sesion = $obj1->indice");
			
			while($obj2 = pg_fetch_object($rs1))
			{
				$rs2 = db_query("select * from material where indice = $obj2->actividad");
				$obj3 = pg_fetch_object($rs2);
				?>
				<tr>
					<td align="center"><?=$i?></td>
					<td align="center"><?=$obj1->fecha?></td>
					<td align="center"><?=$obj1->hora_registro?></td>
					<td align="center"><?=$obj1->nivel?></td>
					<td><?=$obj1->tipo_practica?></td>
					<td><?=$obj1->profesor?></td>
					<td><?=$obj1->autoevaluacion?></td>
					<td><?=$obj3->tipo?></td>
					<td><?=$obj3->nombre?></td>
					<td><?=$obj2->descripcion?></td>
					<td align="center"><?=$obj2->resultado?></td>
				</tr>
				<?
			}
			?>
			<?
			$i++;
		}
		?>
		</table>
		<br><br>
		<HR width="100%" align="center" size="3">
		<?
	}
	
	PageEnd();
?>