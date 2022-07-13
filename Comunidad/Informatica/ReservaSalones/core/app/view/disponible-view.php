
<?php if(isset($_SESSION["user_id"])):
  $base = new Database();
  $con = $base->connect();
  $sql = "select is_admin from public.user where id=".$_SESSION["user_id"]."";
  $user_admin = null;
  $query = pg_query($con, $sql);
  while($r = pg_fetch_array($query)){
	  $user_admin = $r['is_admin'];
  }
  if($user_admin==0){
    ?>
      <style type="text/css">#reserv{
      display:none;
      }</style>
      
      <style type="text/css">#accion{
      display:none;
      }</style>
    <?php
  }
?>

<div class="card">
  <div class="card-header" data-background-color="red">
      <h4 class="title">Disponibilidad de Salones</h4>
  </div>
  <div class="card-content table-responsive">

<br><br>
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="disponible">
        <?php
$salones = SalonData::getAll();
$reservas = ReservacionData::getAll();
        ?>

  <div class="form-group">
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-clock-o"></i> Hora Inicio:</span>
		  <input type="time" name="q" required value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control" placeholder="Inicio">
		</div>
    </div>
		<div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-clock-o"></i> Hora Final:</span>
		  <input type="time" name="q2" required value="<?php if(isset($_GET["q2"]) && $_GET["q2"]!=""){ echo $_GET["q2"]; } ?>" class="form-control" placeholder="Fin">
		</div>
    </div>

    
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  <input type="date" name="date_at" required value="<?php if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){ echo $_GET["date_at"]; } ?>" class="form-control">
		</div>
    </div>

    <div class="col-lg-2">
    <button class="btn btn-secondary btn-block">Buscar</button>
    </div>

  </div>
</form>

		<?php

$users= array();
if((isset($_GET["q"]) && isset($_GET["q2"]) && isset($_GET["date_at"])) && ($_GET["q"]!="" || $_GET["q2"]!="" || $_GET["date_at"]!="") ) {

$sql = "select * from public.salon where id NOT IN (select salon_id from public.reservacion where ";
if($_GET["q"]!=""){
	$sql .= "to_timestamp (time_ini,'HH24:MI') between to_timestamp ('".$_GET["q"]."','HH24:MI') and to_timestamp ('".$_GET["q2"]."','HH24:MI') ";
}

if($_GET["q2"]!=""){
if($_GET["q"]!=""){
	$sql .= " and ";
}
	$sql .= "to_timestamp (time_fin,'HH24:MI') between to_timestamp ('".$_GET["q"]."','HH24:MI') and to_timestamp ('".$_GET["q2"]."','HH24:MI')";
}

if($_GET["date_at"]!=""){
if($_GET["q"]!=""||$_GET["q2"]!="" ){
	$sql .= " and ";
}
$array_dias['Sunday'] = "Domingo";
$array_dias['Monday'] = "Lunes";
$array_dias['Tuesday'] = "Martes";
$array_dias['Wednesday'] = "Miercoles";
$array_dias['Thursday'] = "Jueves";
$array_dias['Friday'] = "Viernes";
$array_dias['Saturday'] = "Sabado";	
$sql .= "date(reservacion.date_ini) <= date('".$_GET["date_at"]."') and date(reservacion.date_fin)>= date('".$_GET["date_at"]."') and reservacion.dia = '".$array_dias[date('l', strtotime($_GET["date_at"]))]."')";
}


	

		$users = SalonData::getBySQL($sql);

}else{
	
}
		if(count($users)>0){
			// si hay disponibilidad
			?>
			<table class="table table-bordered table-hover"> 
			<thead>
			<th><b>Edificio</b></th>
			<th><b>Capacidad</b></th>
			<th><b>Número de aula</b></th>
			<th><b>Ayudas</b></th>
			<th><b>Día</b></th>
			<th id="accion"><b>Acción</b></th>
			</thead>
			<?php
	
			foreach($users as $user){
				$reserva  = $user->getReservacion();
				
				?>
				<tr>
				<td><?php echo $user->num_edificio; ?></td>
				<td><?php echo $user->capacidad; ?></td>
				<td><?php echo $user->num_aula; ?></td>
				<td><?php echo $user->ayudas; ?></td>
				<td><?php echo $array_dias[date('l', strtotime($_GET["date_at"]))]; ?></td>
				<td style="width:120px;" id="reserv">
				<a href="index.php?view=newreservacion&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Reservar</a> 
				</td>
				</tr>
				<?php

			}
			?>
			</table>
			</div>
			</div>
			<?php



		}else{
			echo "<p class='alert alert-danger'>No hay Salones Disponibles</p>";
		}


		?>


	</div>
</div>

<?php endif;?>