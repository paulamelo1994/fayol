<?php if(isset($_SESSION["user_id"])):?>
<div class="row">
	<div class="col-md-12">

<div class="card">
  <div class="card-header" data-background-color="red">
      <h4 class="title">Usuarios</h4>
  </div>
  <div class="card-content table-responsive">


	<a href="index.php?view=newuser" class="btn btn-default"><i class='fa fa-plus-circle'></i> Nuevo Usuario</a>
<br>
		<?php
		/*
		$u = new UserData();
		print_r($u);
		$u->name = "Agustin";
		$u->lastname = "Ramos";
		$u->email = "evilnapsis@gmail.com";
		$u->password = sha1(md5("l00lapal00za"));
		$u->add();


		$f = $u->createForm();
		print_r($f);
		echo $f->label("name")." ".$f->render("name");
		*/
		?>
		<?php

		$users = UserData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover">
			<thead>
			<th><b>Nombre completo</b></th>
			<th><b>Usuario</b></th>
			<th><b>Email</b></th>
			<th><b>Activo</b></th>
			<th><b>Admin</b></th>
			<th><b>Acción</b></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->name." ".$user->lastname; ?></td>
				<td><?php echo $user->username; ?></td>
				<td><?php echo $user->email; ?></td>
				<td>
					<?php if($user->is_active):?>
						<i class="fa fa-check-square-o"></i>
					<?php endif; ?>
				</td>
				<td>
					<?php if($user->is_admin):?>
						<i class="fa fa-check-square-o"></i>
					<?php endif; ?>
				</td>
				<td style="width:30px;"><a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a></td>
				</tr>
				<?php

			}
			?>
			</table>
			<?php



		}else{
			// no hay usuarios
		}


		?>

</div>
</div>

<div class="card">
  <div class="card-header" data-background-color="red">
      <h4 class="title">Periodos</h4>
  </div>
  <div class="card-content table-responsive">


<!--	 
AQUIIII MODIFICAR MÉTODOS PARA AGREGAR Y EDITAR PERIODOS
--> 
<a href="index.php?view=newperiod" class="btn btn-default"><i class='fa fa-plus-circle'></i> Nuevo Periodo</a>
<br>
		<?php
		/*
		$u = new UserData();
		print_r($u);
		$u->name = "Agustin";
		$u->lastname = "Ramos";
		$u->email = "evilnapsis@gmail.com";
		$u->password = sha1(md5("l00lapal00za"));
		$u->add();


		$f = $u->createForm();
		print_r($f);
		echo $f->label("name")." ".$f->render("name");
		*/
		?>
		<?php

		$usersp = PeriodoData::getAll();
		if(count($usersp)>0){
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover">
			<thead>
			<th><b>Nombre</b></th>
			<th><b>Duración</b></th>
			<th><b>Tipo de duración</b></th>
			<th><b>Acción</b></th> 
			</thead>
			<?php
			foreach($usersp as $userp){
				?>
				<tr>
				<td><?php echo $userp->name; ?></td>
				<td><?php echo $userp->duracion; ?></td>
				<td><?php echo $userp->tipo; ?></td>
				<td style="width:30px;"><a href="index.php?view=editperiod&id=<?php echo $userp->id;?>" class="btn btn-warning btn-xs">Editar</a></td>
				<!--
				<td style="width:30px;"><a href="index.php?view=edituser&id=<?php// echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a></td>
				-->
				</tr>
				<?php

			}
			?>
			</table>
			<?php



		}else{
			// no hay periodos
		}


		?>

</div>
</div>


	</div>
</div>
<?php endif;?>