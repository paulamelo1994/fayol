
<div class="row">
	<div class="col-md-12">
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
			
			<style type="text/css">#new_salon{
			display:none;
			}</style>
		  <?php
		}
		?>
<div class="card">
  <div class="card-header" data-background-color="red">
      <h4 class="title">Salones</h4>
  </div>
  <div class="card-content table-responsive">

<div class="btn-group" id="new_salon">
	<a href="index.php?view=newsalon" class="btn btn-default"><i class='fa fa-plus-circle'></i> Nuevo Salón</a>

</div>
		<?php

		$users = SalonData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th><b>Edificio</b></th>
			<th><b>Capacidad</b></th>
			<th><b>Número de aula</b></th>
			<th><b>Ayudas</b></th>
			<th><b>Acciones</b></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->num_edificio; ?></td>
				<td><?php echo $user->capacidad; ?></td>
				<td><?php echo $user->num_aula; ?></td>
				<td><?php echo $user->ayudas; ?></td>
			  <td style="width:220px;">
				<a href="index.php?view=reservacion&id=<?php echo $user->id;?>" class="btn btn-info btn-xs">Ver Reservas</a>
				<a href="index.php?view=newreservacion&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs" id="reserv">Reservar</a> 
				</td>
				</tr>
				<?php
				}
?>
</table>
<?php
			



		}else{
			echo "<p class='alert alert-danger'>No hay Salones</p>";
		}


		?>

</div>
</div>
	</div>
</div>
<?php endif;?>