<?
  function DBConnect($dbname)
  {
	$con = pg_connect("host=".DATABASE_HOST." user=".DATABASE_USER." password=".DATABASE_PASS." dbname=$dbname port=".DATABASE_PORT);
	
	if ($con===FALSE) {
		echo pg_last_error();
	}
	return $con;
  }
  
  function db_query()
  {
  	# Si la funcion fue llamada con 2 argumentos, es porque me pasan el identificador de conexion
	if (func_num_args()==2) {
		$conn = func_get_arg(0);
		$query = func_get_arg(1);
		$rs = pg_query($conn, $query);
	}
	else {
		$query = func_get_arg(0);
		$rs = pg_query($query);
	}
	
	if( $rs ) {
		return $rs;
	}

	
	$error = "<B>Unable to query postgres:</B><BR>".pg_last_error()."<BR><B>Query was:</B><BR>$query";
	echo "<P STYLE='color:red;'>$error</P>";
	
	WriteLog(__FILE__, __LINE__, "DB_QUERY SAID: $error");
	
	return false;
  }
?>