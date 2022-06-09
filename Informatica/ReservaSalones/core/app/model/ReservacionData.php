<?php
class ReservacionData {
	public static $tablename = "reservacion";


	public function ReservacionData(){
	$this->cod_asignatura="";
	$this->grupo="";
	$this->nom_asignatura="";
	$this->date_ini="";
	$this->time_ini="";
	$this->date_fin="";
	$this->time_fin="";
	$this->nom_docente="";
	$this->descripcion="";
	$this->salon_id="";
	$this->status_id="";
	$this->dia="";
	}

	public function getSalon(){ return SalonData::getById($this->salon_id); }
	public function getStatus(){ return StatusData::getById($this->status_id); }
	

	public function add(){
		$sql = "insert into reservacion (cod_asignatura,grupo,nom_asignatura,date_ini,time_ini,date_fin,time_fin,nom_docente,descripcion,salon_id, status_id, dia) ";
		$sql .= "values ('$this->cod_asignatura','$this->grupo','$this->nom_asignatura','$this->date_ini','$this->time_ini','$this->date_fin','$this->time_fin','$this->nom_docente','$this->descripcion','$this->salon_id','$this->status_id','$this->dia')";
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

// partiendo de que ya tenemos creado un objecto ReservationData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set cod_asignatura='$this->cod_asignatura',grupo='$this->grupo',nom_asignatura='$this->nom_asignatura',date_ini='$this->date_ini',time_ini='$this->time_ini',date_fin='$this->date_fin',time_fin='$this->time_fin',nom_docente='$this->nom_docente',descripcion='$this->descripcion',salon_id='$this->salon_id',status_id='$this->status_id',dia='$this->dia' where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($salon_id){
		$sql = "select * from public.reservacion where salon_id=$salon_id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservacionData());
	}
	public static function getByUnicId($id){
		$sql = "select * from public.reservacion where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservacionData());
	}

	public static function getRepeated($salon_id,$dia,$time_ini,$time_fin,$date_ini,$status_id){
		//$sql = "select * from public.".self::$tablename." where salon_id=$salon_id and date_ini='$date_ini' and time_ini='$time_ini'";
		$date_final = new DateTime($date_ini);
		$date_fin='';
		$per= explode('-', $status_id);
		if($per[1]=='dia'){
			$date_final->modify('+'.$per[0].' day');
			$date_fin = $date_final->format('Y-m-d');
		}
		if($per[1]=='semana'){
			$date_final->modify('+'.$per[0].' week');
			$date_fin = $date_final->format('Y-m-d');
		}
		if($per[1]=='mes'){
			$date_final->modify('+'.$per[0].' month');
			$date_fin = $date_final->format('Y-m-d');
		}
		$sql = "select * from public.".self::$tablename." where salon_id=$salon_id and dia='$dia' 
		and to_timestamp (time_ini,'HH24:MI') between to_timestamp ('$time_ini','HH24:MI') and to_timestamp ('$time_fin','HH24:MI') 
		and to_timestamp (time_fin,'HH24:MI') between to_timestamp ('$time_ini','HH24:MI') and to_timestamp ('$time_fin','HH24:MI') 
		and date(date_ini) <= date('$date_ini') and date(date_fin) >= date('$date_ini')";
		//die($sql); 
		/* Se debe corregir esta validación para evaluar reservas
		and to_timestamp (date_ini,'yyyy-mm-dd') between to_timestamp ('$date_ini','yyyy-mm-dd') and to_timestamp ('$date_fin','yyyy-mm-dd')
		or to_timestamp (date_fin,'yyyy-mm-dd') between to_timestamp ('$date_ini','yyyy-mm-dd') and to_timestamp ('$date_fin','yyyy-mm-dd')
		*/ 
		
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservacionData());
	}



	public static function getByMail($mail){
		$sql = "select * from public.".self::$tablename." where mail='$mail'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservacionData());
	}

	public static function getEvery(){
		$sql = "select * from public.reservacion";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservacionData());
	}


	public static function getAll(){
		$sql = "select * from public.".self::$tablename." where 1=1 order by date_ini";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservacionData());
	}

	public static function getAllPendings(){
		$sql = "select * from public.".self::$tablename." where date(date_at)>=date(NOW()) and status_id=1 and payment_id=1 order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservacionData());
	}


	public static function getAllBySalonId($id){
		$sql = "select * from public.".self::$tablename." where salon_id=$id order by date_ini";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservacionData());
	}

	public static function getAllByMedicId($id){
		$sql = "select * from public.".self::$tablename." where medic_id=$id order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservacionData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservacionData());
	}

	public static function getOld(){
		$sql = "select * from public.".self::$tablename." where date(date_at)<date(NOW()) order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservacionData());
	}
	
	public static function getLike($q){
		$sql = "select * from public.".self::$tablename." where nom_asignatura like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservacionData());
	}


}

?>