<?php if(isset($_SESSION["user_id"])):?>
<?php
$user = SalonData::getById($_GET["id"]);
$statuses = StatusData::getAll();
$periodos = PeriodoData::getAll();
?>

<div class="row">
<div class="col-md-9">
<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Nueva Reservación</h4>
  </div>
  <div class="card-content table-responsive">
<form class="form-horizontal" role="form" method="post" action="./?action=addreservacion">
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Codigo de signatura</label>
    <div class="col-lg-3">
    <input class="form-control" name="cod_asignatura" required placeholder="Codigo"></input>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre de asignatura</label>
    <div class="col-lg-3">
    <input class="form-control" name="nom_asignatura" required placeholder="Asignatura"></input>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Grupo de asignatura</label>
    <div class="col-lg-3">
    <input class="form-control" name="grupo" required placeholder="Grupo"></input>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre de docente</label>
    <div class="col-lg-3">
    <input class="form-control" name="nom_docente" required placeholder="Docente"></input>
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha</label>
    <div class="col-lg-3">
      <input type="date" name="date_ini" required class="form-control" id="inputEmail1" placeholder="Fecha">
    </div>
    </div>
  <div class="form-group">
  <label for="inputEmail1" class="col-lg-2 control-label">Hora inicio</label>
  <div class="col-lg-3">
  <input type="time" name="time_ini" required class="form-control" id="inputEmail1" placeholder="Hora">
    </div>
    </div>
    <div class="form-group">
  <label for="inputEmail1" class="col-lg-2 control-label">Hora Fin</label>
  <div class="col-lg-3">
  <input type="time" name="time_fin" required class="form-control" id="inputEmail1" placeholder="Hora">
    </div>
    </div>    
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo de Reserva</label>
    <div class="col-lg-3">
<select name="status_id" class="form-control" required>
  <?php foreach($periodos as $p):?>
    <option value="<?php echo $p->duracion."-".$p->tipo."-".$p->name; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Descripción</label>
    <div class="col-lg-5">
      <input type="text" name="descripcion" required class="form-control" id="inputEmail1" placeholder="Asunto">
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-8" aling="center">
    <input type="hidden" name="salon_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-info">Reservar</button>
    </div>
  </div>
</form>
</div>
</div>
</div>
<?php endif;?>