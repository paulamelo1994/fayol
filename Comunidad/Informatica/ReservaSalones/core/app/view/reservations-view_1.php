<?php if(isset($_SESSION["user_id"])):
	  $base = new Database();
		$con = $base->connect();
		$sql = "select is_admin from public.user where id=".$_SESSION["user_id"]."";
		$user_admin = null;
		$query = pg_query($con, $sql);
		while($r = pg_fetch_array($query)){
			$user_admin = $r['is_admin'];
		}
		if($user_admin!=0){
			?>
				<style type="text/css">#acciones{
				display:none;
				}</style>
				
				<style type="text/css">#edit_del{
				display:none;
				}</style>
			<?php
		}
	?>
<div class="card">
  <div class="card-header" data-background-color="red">
      <h4 class="title">Reservas</h4>
  </div>
  <div class="card-content table-responsive">

<br><br>
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="reservations">
        <?php
$salones = SalonData::getAll();

        ?>

  <div class="form-group">
    <div class="col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-search"></i></span>
		  <input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control" placeholder="Nombre de docente, tipo de reserva o asignatura">
		</div>
    </div>
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-university"></i></span>
<select name="salon_id" class="form-control">
<option value="">Salón</option>
  <?php foreach($salones as $s):?>
    <option value="<?php echo $s->id; ?>" <?php if(isset($_GET["salon_id"]) && $_GET["salon_id"]==$s->id){ echo "selected"; } ?>><?php echo $s->id." - ".$s->num_aula." Edificio ".$s->num_edificio; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  <input type="date" name="date_at" value="<?php if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){ echo $_GET["date_at"]; } ?>" class="form-control">
		</div>
    </div>

    <div class="col-lg-2">
    <button class="btn btn-secondary btn-block">Buscar</button>
    </div>

  </div>
</form>

		<?php

$users= array();
if((isset($_GET["q"]) && isset($_GET["salon_id"]) && isset($_GET["date_at"])) && ($_GET["q"]!="" || $_GET["salon_id"]!="" || $_GET["date_at"]!="") ) {

$sql = "select * from public.reservacion where ";
if($_GET["q"]!=""){
	$sql .= " nom_docente like '%$_GET[q]%' or nom_asignatura like '%$_GET[q]%' or cod_asignatura like '%$_GET[q]%'or status_id like '%$_GET[q]%'";
}

if($_GET["salon_id"]!=""){
if($_GET["q"]!=""){
	$sql .= " and ";
}
	$sql .= " salon_id = ".$_GET["salon_id"];
}

if($_GET["date_at"]!=""){
if($_GET["q"]!=""||$_GET["salon_id"]!="" ){
	$sql .= " and ";
}
$array_dias['Sunday'] = "Domingo";
$array_dias['Monday'] = "Lunes";
$array_dias['Tuesday'] = "Martes";
$array_dias['Wednesday'] = "Miercoles";
$array_dias['Thursday'] = "Jueves";
$array_dias['Friday'] = "Viernes";
$array_dias['Saturday'] = "Sabado";	
$sql .= " date(reservacion.date_ini) <= date('".$_GET["date_at"]."') and date(reservacion.date_fin) >= date('".$_GET["date_at"]."') and dia = '".$array_dias[date('l', strtotime($_GET["date_at"]))]."'";
}


	
//die($sql);
		$users = ReservacionData::getBySQL($sql);

}else{
		$users = ReservacionData::getAll();
}
		if(count($users)>0){
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover"> 
			<thead>
			<th><b>Salón</b></th>
			<th><b>Asignatura</b></th>
			<th><b>Código</b></th>
			<th><b>Docente</b></th>
			<th><b>Día</b></th>
			<th><b>Horario</b></th>
			<th><b>Tipo Reserva</b></th>
			<th id="acciones"><b>Acciones</b></th>
			</thead>
			<?php
	
			foreach($users as $user){
				$salon  = $user->getSalon();
				
				?>
				<tr>
				<td><?php echo $salon->num_aula." Edificio ".$salon->num_edificio; ?></td>
				<td><?php echo $user->nom_asignatura; ?></td>
				<td><?php echo $user->cod_asignatura; ?></td>
				<td><?php echo $user->nom_docente; ?></td>
				<td><?php echo $user->dia; ?></td>
				<td><?php echo $user->time_ini." - ".$user->time_fin; ?></td>
				<td><?php echo $user->status_id; ?></td>
				<td id="edit_del" style="width:180px;">
				<a href="index.php?view=editreservation&id=<?php echo $user->id;?>" class="btn btn-success btn-xs">Editar</a>
				<a href="index.php?action=delreservation&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
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
			echo "<p class='alert alert-danger'>No hay reservas</p>";
		}


		?>


	</div>
</div>
<?php endif;?>