<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Universidad del Valle -Reserva de Salones</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link rel="icon" type="image/png" href="core/app/layouts/Logo-Univalle.png" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <script src="assets/js/jquery.min.js" type="text/javascript"></script>

<?php if(isset($_GET["view"]) && $_GET["view"]=="home"):?>
<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='assets/fullcalendar/moment.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.min.js'></script>
<?php endif; ?>

</head>

<body>
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
      <style type="text/css">#config{
      display:none;
      }</style>
      
      <style type="text/css">#edif{
      display:none;
      }</style>
    <?php
  }
  ?>
  <div class="wrapper">

      <div class="sidebar" data-color="blue">
      <div class="logo">
       <img src="core/app/layouts/header-1.png">
      </div>

        <div class="sidebar-wrapper">
              <ul class="nav">
                  <li class="">
                      <a href="./">
                          <i class="fa fa-home"></i>
                          <p>Inicio</p>
                      </a>
                  </li>
                  <li>
                      <a href="./?view=reservations">
                          <i class="fa fa-calendar"></i>
                          <p>Reservas</p>
                      </a>
                  </li>
                  <li>
                      <a href="./?view=disponible">
                          <i class="fa fa-filter"></i>
                          <p>Disponibilidad</p>
                      </a>
                  </li>
                  <li>
                      <a href="./?view=salones">
                          <i class="fa fa-list-ul"></i>
                          <p>Salones</p>
                      </a>
                  </li>
                  <li id="edif">
                      <a href="./?view=categories">
                          <i class="fa fa-building-o"></i>
                          <p>Edificios</p>
                      </a>
                  </li>
                 
                  <li id="config">
                      <a href="./?view=users">
                          <i class="fa fa-cog"></i>
                          <p>Configuración</p>
                      </a>
                  </li>
              </ul>
        </div>
      </div>

      <div class="main-panel">
      <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./"><b>Sistema para Reserva de Salones</b></a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-sign-out"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="logout.php">Salir</a></li>
                </ul>
              </li>
            </ul>
<!--
            <form class="navbar-form navbar-right" role="search">
              <div class="form-group  is-empty">
                <input type="text" class="form-control" placeholder="Search">
                <span class="material-input"></span>
              </div>
              <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="fa fa-search"></i><div class="ripple-container"></div>
              </button>
            </form>
            -->
          </div>
        </div>
      </nav>

      <div class="content">
      <div class="container-fluid">
<?php 
  // puedo cargar otras funciones iniciales
  // dentro de la funcion donde cargo la vista actual
  // como por ejemplo cargar el corte actual
  View::load("login");

?>
</div>
      </div>

      <footer class="footer">
        <div class="container-fluid">
          <nav class="pull-left">
            <ul>
              <li>
                <a href="./?view=changelog" >
                  Ayuda
                </a>
              </li>
              <li>
                <a href="http://administracion.univalle.edu.co/" target="_blank">
                  Univalle
                </a>
              </li>
        <!--
              <li>
                <a href="#">
                  Company
                </a>
              </li>
              <li>
                <a href="#">
                  Portfolio
                </a>
              </li>
              <li>
                <a href="#">
                   Blog
                </a>
              </li>
          -->
            </ul>
          </nav>
         
        </div>
      </footer>
    </div>
  </div>
<?php else:?>
  <?php 
  View::load("login");

?>

<?php endif;?>
</body>

  <!--   Core JS Files   -->
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/material.min.js" type="text/javascript"></script>

  <!--  Charts Plugin -->
  <script src="assets/js/chartist.min.js"></script>

  <!--  Notifications Plugin    -->
  <script src="assets/js/bootstrap-notify.js"></script>

  <!--  Google Maps Plugin    -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

  <!-- Material Dashboard javascript methods -->
  <script src="assets/js/material-dashboard.js"></script>

  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/js/demo.js"></script>

  <script type="text/javascript">
      $(document).ready(function(){

      // Javascript method's body can be found in assets/js/demos.js
          demo.initDashboardPageCharts();

      });
  </script>

</html>
