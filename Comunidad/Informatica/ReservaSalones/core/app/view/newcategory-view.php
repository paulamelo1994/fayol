<?php if(isset($_SESSION["user_id"])):?>
<div class="row">
	<div class="col-md-9">
<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Nuevo Edificio</h4>
  </div>
  <div class="card-content table-responsive">

		<form class="form-horizontal" method="post" id="addcategory" action="index.php?view=addcategory" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Número*</label>
    <div class="col-md-2">
      <input type="text" name="name" required class="form-control" id="name" placeholder="Número">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">División</label>
    <div class="col-md-4">
      <input type="text" name="division" required class="form-control" id="name" placeholder="División">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-8" align="center">
      <button type="submit" class="btn btn-info">Agregar Edificio</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>
<?php endif;?>