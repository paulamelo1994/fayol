<?php if(isset($_SESSION["user_id"])):?>
<?php
$categories = CategoryData::getAll();
?>
<div class="row">
	<div class="col-md-9">

<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Nuevo Salón</h4>
  </div>
  <div class="card-content table-responsive">
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addsalon" role="form">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Edificio*</label>
    <div class="col-md-3">
    <select name="num_edificio" class="form-control" id="num_edificio">
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($categories as $cat):?>
    <option value="<?php echo $cat->name; ?>"><?php echo $cat->name." - ".$cat->division; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Número de aula*</label>
    <div class="col-md-3">
      <input type="text" name="num_aula" class="form-control" id="num_aula" placeholder="Número de aula">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Capacidad*</label>
    <div class="col-md-3">
      <input type="text" name="capacidad" required class="form-control" id="capacidad" placeholder="Capacidad">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Ayudas*</label>
    <div class="col-md-4">
      <input type="text" name="ayudas" class="form-control"  id="ayudas" placeholder="Ayudas">
    </div>
  </div>
  

  
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-8" align="center">
      <button type="submit" class="btn btn-info">Agregar Salon</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>
<?php endif;?>