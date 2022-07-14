<?php
header("Content-type: text/xml");

require '../functions.php';

$table = $_GET['table'];
$row = $_GET['row'];
$key = $_GET['key'];

$conexion = DBConnect('idiomas');

if(!$conexion)
	echo "No se logro la conexi&oacute;n con la BD.";
else
{
	$sql = "select * from $table";
	
	$rs = db_query($sql);
	
	$total_rows = pg_num_rows($rs);
	
	$obj = pg_fetch_object($rs);
	$vars = get_object_vars($obj);
	
	$sql = "select * from $table where $row = '$key'";
	$rs = db_query($sql);
	
	$num_id_rows = 0;
	
	foreach($vars as $key => $var)
	{
		$id_rows[] .= $key; 
		$num_id_rows += 1;
	}
	
	echo '<?xml version="1.0"?>';
	echo '<'.$table.'>';
		while($obj = pg_fetch_object($rs))
		{
			$element = '<element ';
			for($i = 0; $i < $num_id_rows; $i++)
			{
				$element .= $id_rows[$i].' = "'.$obj->$id_rows[$i].'" ';
			}
			$element .= '/>';
			echo $element;
		}
	echo '</'.$table.'>';
}
?>
