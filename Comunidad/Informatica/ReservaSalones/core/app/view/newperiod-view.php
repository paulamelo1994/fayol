<?php if(isset($_SESSION["user_id"])):?>
<div class="row">
	<div class="col-md-9">
<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Nuevo periodo</h4>
  </div>
  <div class="card-content table-responsive">

		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addperiod" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-5">
      <input type="text" name="name" class="form-control" id="name" placeholder="Nombre del periodo">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Duración*</label>
    <div class="col-md-5">
      <input type="number" name="duracion" required class="form-control" id="lastname" placeholder="Duración en números">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo duración*</label>
    <div class="col-md-5">
    <select name="tipoduracion" class="form-control">
    <option value="dia">Día</option>
    <option value="semana">Semana</option>
    <option value="mes">Mes</option>
    </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-8" align="center">
      <button type="submit" class="btn btn-info">Crear periodo</button>
    </div>
  </div>
</form>
	</div>
</div>
</div>
</div>
<?php endif;?>