<?php
class Database {
	public static $db;
	public static $con;
	function Database(){
		$this->user="reservas";$this->pass="reservasfayol";$this->host="localhost";$this->ddbb="reservas_salones";$this->port="5432";
	}

	function connect(){

		$con = pg_connect("host=".$this->host." user=".$this->user." password=".$this->pass." dbname=".$this->ddbb);
		if($con) {
			//echo 'connected';
		 } else {
			echo pg_last_error();
		 }
		 $stat = pg_connection_status($con);
		 
		 if ($stat === PGSQL_CONNECTION_OK) {
			//echo 'Connection status ok';
		} else {
			echo 'Connection status bad';
		}   
	
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
