<?php
class SalonData {
	public static $tablename = "salon";

	public function SalonData(){
		$this->num_edificio = "";
		$this->capacidad = "";
		$this->num_aula = "";
		$this->ayudas = "";
		$this->id="";
	}
	public function getCategory(){ return CategoryData::getById($this->num_edificio); }
	public function getReservacion(){ return ReservacionData::getById($this->id); }

	public function add(){
		$sql = "insert into salon (num_edificio,capacidad,num_aula,ayudas) ";
		$sql .= "values ('$this->num_edificio','$this->capacidad','$this->num_aula','$this->ayudas')";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set num_edificio='$this->num_edificio',capacidad='$this->capacidad',num_aula='$this->num_aula',ayudas='$this->ayudas' where id=$this->id";
		Executor::doit($sql);
	}
	public static function getEvery(){
		$sql = "select * from salon";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservacionData());
	}



	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SalonData());
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by num_edificio, num_aula asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SalonData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or content like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SalonData());
	}

	public static function getBySQL($sql){
		//die($sql);
		$query = Executor::doit($sql);
		return Model::many($query[0],new SalonData());
	}


}

?>