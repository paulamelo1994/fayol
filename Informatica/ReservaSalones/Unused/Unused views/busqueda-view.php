<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
<!--<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div>
-->
</div>


<div class="card">
  <div class="card-header" data-background-color="red">
      <h4 class="title">Reservas</h4>
  </div>
  <div class="card-content table-responsive">

<br><br>
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="busqueda">
        <?php
//$salones = SalonData::getAll();
//$medics = MedicData::getAll();
        ?>

  <div class="form-group">
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-search"></i></span>
		  <input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control" placeholder="Palabra clave">
		</div>
    </div>
		  <!--
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-male"></i></span>
<select name="salon_id" class="form-control">
<option value="">Salón</option>
  <?php  /*foreach($salnes as $s):?>
    <option value="<?php echo $s->id; ?>" <?php if(isset($_GET["salon_id"]) && $_GET["salon_id"]==$s->id){ echo "selected"; } ?>><?php echo $s->id." - ".$p->num_aula; ?></option>
  <?php endforeach;*/ ?>
</select> 
		</div>
    </div>
  <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-support"></i></span>
<select name="medic_id" class="form-control">
<option value="">Salón</option>
  <?php /*foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["medic_id"]) && $_GET["medic_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; */ ?>
</select>
		</div>
    </div>
    <div class="col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  <input type="date" name="date_at" value="<?php/* if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){ echo $_GET["date_at"]; } */?>" class="form-control" placeholder="Palabra clave">
		</div>
    </div>-->

    <div class="col-lg-2">
    <button class="btn btn-primary btn-block">Buscar</button>
    </div>

  </div>
</form>

		<?php
$users= array();
/* if(isset($_GET["q"] || $_GET["q"]!="" /*&& isset($_GET["salon_id"]) && isset($_GET["date_at"])) && ($_GET["q"]!="" || $_GET["salon_id"]!="" || $_GET["date_at"]!="") ) {
$sql = "select * from reservacion where ";
if($_GET["q"]!=""){
	$sql .= " nom_asignatura like '%$_GET[q]%' and nom_docente like '%$_GET[q] %'";
}*/
/*
if($_GET["salon_id"]!=""){
if($_GET["q"]!=""){
	$sql .= " and ";
}
	$sql .= " salon_id = ".$_GET["salon_id"];
}


if($_GET["date_at"]!=""){
if($_GET["q"]!=""||$_GET["salon_id"]!=""){
	$sql .= " and ";
}

	$sql .= " (date_ini <= \"".$_GET["date_at"]."\" AND date_fin >= \"".$_GET["date_at"]."\")";
}
*/
if($_GET["q"]!=""){
	$sql= "select * from reservacion where nom_asignatura like '%$_GET[q]%' and nom_docente like '%$_GET[q] %'";
		$users = ReservacionData::getBySQL($sql);

}else{
		$users = ReservacionData::getAll();

}
		if(count($users)>0){
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Salón</th>
			<th>Docente</th>
			<th>Asignatura</th>
			<th>Descripción</th>
			<th>Hora Inicio</th>
			<th>Hora Finalización</th>
			</thead>
			<?php
			foreach($users as $user){
			/*	$pacient  = $user->getPacient();
				$medic = $user->getMedic(); */
				?>
				<tr>
				<td><?php echo $user->salon_id; ?></td>
				<td><?php echo $user->nom_docente;?></td>
				<td><?php echo $user->nom_asignatura; ?></td>
				<td><?php echo $user->descripcion; ?></td>
				<td><?php echo $user->time_ini; ?></td>
				<td><?php echo $user->time_fin; ?></td>
				<td style="width:180px;">
				<a href="index.php?view=editreservation&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
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