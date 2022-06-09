<?php
class PeriodoData {
	public static $tablename = "periodo";


	public function PeriodoData(){
		$this->name = "";
		$this->duracion = "";
		$this->tipo = "";
	}

	public function add(){
		$sql = "insert into public.periodo (name, duracion, tipo) ";
		$sql .= "values ('$this->name', $this->duracion, '$this->tipo')";
		//die($sql);
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update public.periodo set name='$this->name', duracion=$this->duracion , tipo='$this->tipo' where id=$this->id";
		//die($sql);
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from public.".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PeriodoData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PeriodoData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PeriodoData());
	}


}

?>