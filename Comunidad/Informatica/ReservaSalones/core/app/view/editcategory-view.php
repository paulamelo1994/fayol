<?php if(isset($_SESSION["user_id"])):?>
<?php $user = CategoryData::getById($_GET["id"]);?>
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Editar Detalle de Edificio</h4>
  </div>
  <div class="card-content table-responsive">


		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatecategory" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Número*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" required id="name" placeholder="Número">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">División</label>
    <div class="col-md-6">
      <input type="text" name="division" value="<?php echo $user->division;?>" class="form-control" id="division" placeholder="División">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Edificio</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>
<?php endif;?>