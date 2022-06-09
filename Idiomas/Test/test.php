<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: test.php
	Objetivo: Formulario mediante el cual se hace una evaluación de conocimientos a los estudiantes.
		Carga una archivo de texto en el cual se encuentran los siguientes datos:
		- Pregunta.
		- 5 opciones de respuesta.
		- Respuesta correcta.
		Carga en el formulario el número de preguntas ingresado anteriormente de manera aleatoria.
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
	$root_path = "../../../";
	
	$conexion = DBConnect('idiomas');
	$fecha = date('Y-m-d');
	
	if(!$conexion)
	{
		echo "<h2>No se logro la conexión con la BD.</h2>";
	}
	
	$documento = "tmp/archivo_tmp.txt";
	$total_preguntas = 0;
		
	$file = fopen($documento, "r");	
	while(!feof($file))
	{
		$leida = trim(fgets($file));
				
		if($leida != "")
			$total_preguntas += 1;
	}

	$total_preguntas = $total_preguntas - 1;
	fclose($file);
	
	$file = file($documento);
	$lineas = count($file) - 1;
	$infoQuiz = split('[|]',$file[$lineas]);
	
	$preguntas = substr(trim($infoQuiz[0]), -1, 1);
	$quiz = substr(trim(trim($infoQuiz[1])), -1, 1);
	
	//Se verifica que el usurio no haya realizado el test 
	$rs = db_query("select * from notas where fecha = '$fecha' and cod_estudiante = '{$_SESSION[usuario][codigo]}' and num_test ='$quiz'");
	$filas = pg_num_rows($rs);
	
	if($filas == 1)
	{
		$_SESSION['usuario']['test'.$quiz] = true;
	}
	
		
	if(isset($_SESSION['usuario']['seleccion']) && $_SESSION['usuario']['seleccion'] != "")
		$seleccion = $_SESSION['usuario']['seleccion'];
	else
	{
		$seleccion = "";
		while(strlen($seleccion) < $preguntas)
		{
			$random = "".rand(1, $total_preguntas);
			if(!existe($seleccion, $random))
				$seleccion .= $random;
		}
		
		$_SESSION['usuario']['seleccion'] = $seleccion;
	}
	
	if(isset($_POST['salir']))
	{
		unset($_SESSION['usuario']['seleccion']);
		unset($_SESSION['usuario']['acceso']);
		header("Location: /Comunidad/Idiomas/");
		die();
	}
	
	if($_POST['aceptar'])
	{
		for($i = 0; $i < $preguntas; $i++)
		{
			if(empty($_POST['respuesta'.($i+1)]))
				$vacios = true;
		}
		
		if($vacios)
			$_GET['campos_vacios'] = true;
		else
		{
			$formuladas = $_SESSION['usuario']['seleccion'];
			
			$asignado = 5 / strlen($formuladas);			
			$nota = 0;
			
			for($i = 0; $i < strlen($formuladas); $i++)
			{
				$sacar = $formuladas{$i} - 1;
				$ubicacion = ($formuladas{$i} + $sacar) - 1;
				$tmp = split('[|]', $file[$ubicacion]);
				$respuesta = trim($tmp[6]);
				
				$sel = $_POST['respuesta'.($i + 1)];
				if($sel == $respuesta)
					$nota += $asignado;
			}
			
			$nota = number_format($nota, 2); 
			$hora = date('G:i:s');
			
			$conexion = DBConnect("idiomas");
			db_query('begin');
			//echo "otra quiz No. " . $quiz;
			//$rs = db_query("insert into notas (fecha, hora, num_test, cod_estudiante, nota) values('$fecha', '$hora', '1','{$_SESSION[usuario][codigo]}', $nota)");
			$rs = db_query("insert into notas (fecha, hora, num_test, cod_estudiante, nota) values('$fecha', '$hora', '$quiz','{$_SESSION[usuario][codigo]}', $nota)");
			if(!$rs) $fallo = true;
			
			if($fallo)
			{
				db_query('rollback');
				$_GET['noGuardo'] = true;
			}
			else
			{
				db_query('commit');
				$_GET['guardo'] = true;
			}
			
			$_SESSION['usuario']['test'.$quiz] = true;
			
			?>
			<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
			<html>
				<head>
					<title>Laboratorio de Idiomas. Quiz</title>
					<LINK HREF="/estiloweb.css" TYPE="TEXT/CSS" REL="STYLESHEET">
					<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
				</head>
				<body>
				<? SectionInit("Quiz Terminado"); ?>
				<h1>Su nota obtenida fue: <?=$nota?></h1>
				<form name="salir" enctype="multipart/form-data" method="post" action="">
				<div align="center">
				<input type="submit" value="Salir" name="salir">
				</div>
				</form>
				</td></tr></table>
				</td></tr></table>
				</td></tr></table>
				</body>
			</html>
			<?
			die();
		}
	}
	
	if(!isset($_SESSION['usuario']['test'.$quiz]))
	{
		?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
			<head>
				<title>Laboratorio de Idiomas. Quiz</title>
				<LINK HREF="/estiloweb.css" TYPE="TEXT/CSS" REL="STYLESHEET">
				<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
			</head>
			<body>
			<? SectionInit("Laboratorio de Idiomas. Quiz"); ?>
			<form name="quiz" enctype="multipart/form-data" method="post" action="">
			<table width="70%" align="center" cellpadding="1" cellspacing="1" border="0">
			<tr><td><h2>Seleccione la respuesta correcta para cada pregunta:</h2></td></tr>
			<?
			for($i = 0; $i < $preguntas; $i++)
			{
				$pregunta = $seleccion{$i} -1;
				$ubicacion = ($seleccion{$i} + $pregunta) - 1;
				
				$linea_leida = split('[|]', $file[$ubicacion]);
				
				$pregunta = trim($linea_leida[0]);
				$opcion1 = trim($linea_leida[1]);
				$opcion2 = trim($linea_leida[2]);
				$opcion3 = trim($linea_leida[3]);
				$opcion4 = trim($linea_leida[4]);
				$opcion5 = trim($linea_leida[5]);
				?>
				<tr>
					<td><b><? echo ($i + 1).".&nbsp;&nbsp;&nbsp;".$pregunta ?></b><br><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="respuesta<? echo ($i + 1) ?>" value="<?=$opcion1?>" <? if($_POST['respuesta'.($i+1)] == $opcion1) echo "checked"; ?>><?=$opcion1?><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="respuesta<? echo ($i + 1) ?>" value="<?=$opcion2?>" <? if($_POST['respuesta'.($i+1)] == $opcion2) echo "checked"; ?>><?=$opcion2?><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="respuesta<? echo ($i + 1) ?>" value="<?=$opcion3?>" <? if($_POST['respuesta'.($i+1)] == $opcion3) echo "checked"; ?>><?=$opcion3?><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="respuesta<? echo ($i + 1) ?>" value="<?=$opcion4?>" <? if($_POST['respuesta'.($i+1)] == $opcion4) echo "checked"; ?>><?=$opcion4?><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="respuesta<? echo ($i + 1) ?>" value="<?=$opcion5?>" <? if($_POST['respuesta'.($i+1)] == $opcion5) echo "checked"; ?>><?=$opcion5?><br><br>
					</td>
				</tr>
				<?
			}
			?>
			<tr>
				<td align="center">
				<input type="submit" name="aceptar" value="Aceptar">
				</td>
			</tr>
			</table>
		<?
	}
	else
	{
		?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
			<head>
				<title>Laboratorio de Idiomas. Quiz</title>
				<LINK HREF="/estiloweb.css" TYPE="TEXT/CSS" REL="STYLESHEET">
				<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
			</head>
			<body>
			<? SectionInit("Quiz Terminado"); ?>
			<h2 align="center">Usted no esta autorizado para ingresar a este modulo.</h2>
			<form name="salir" enctype="multipart/form-data" method="post" action="">
			<div align="center">
			<input type="submit" value="Salir" name="salir">
			</div>
		<?
	}
	
	?>
	</form>
	</table>
	</table>
	</table>
	<?
	
	if(isset($_GET['campos_vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe seleccionar una respuesta para cada pregunta. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['noGuardo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("No se registraron los datos! Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['guardo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Ha finalizado el registro de su nota exitosamente.");
		location.href="index.php";
		</script>
		<?
	}
?>

</body>
</html>