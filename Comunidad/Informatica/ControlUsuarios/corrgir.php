<?
	
	$rootPath = '../../..';
	require '../../../functions.php';
	
	$_GET['submenu_control'] = true;
	
	$conexion = DBConnect('controlsalas');
					
	if(!conexion)
		echo("<td>No se pudo lograr la conexi&oacute;n con la BD.</td>");
	else
	{
		$rs = db_query("select * from registro where sala='idiomas' and fecha='2009-03-31'");
		?><table border="1">
		<tr><td>Hora ing</td><td>Hora ing</td><td>Hora real sal</td><td>indice</td></tr><?
		while($obj = pg_fetch_object($rs))
		{
			$indice = $obj->indice;
			$hora1 = substr($obj->horaing, 0, 2);
			$resto1 = substr($obj->horaing, 2);
			$numero1 = (int)$hora1 - 1;
			$fin1;
			if ( $numero1 < 10)
				$fin1 = "0".$numero1.$resto1;
			else
				$fin1 = $numero1.$resto1;
				
			$hora2 = substr($obj->horarealsal, 0, 2);
			$resto2 = substr($obj->horarealsal, 2);
			$numero2 = (int)$hora2;
			$fin2 = ($numero2 - 1).$resto2;
			if($hora2 =='12')
				$fin2='12:00:00';
			
			if($fin2 == -1)
				db_query("update registro set horaing = '$fin1' where indice = $indice");
			else
				db_query("update registro set horaing = '$fin1', horarealsal = '$fin2' where indice=$indice");
			
			echo "<tr><td>".$fin1."</td><td>".$fin2."</td><td>".$obj->horarealsal."</td><td>".$obj->indice."</td></tr>";
		}
		?></table><?
	}
							
	

	
?>