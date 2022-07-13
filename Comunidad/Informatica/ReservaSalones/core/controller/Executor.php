<?php

class Executor {

	public static function doit($sql){
		//$con = Database::getCon();
		$base = new Database();
		$con = $base->connect();
		if(Core::$debug_sql){
			print "<pre>".$sql."</pre>";
		}
		return array(pg_query($con,$sql),$con->insert_id);
	}
}
?>