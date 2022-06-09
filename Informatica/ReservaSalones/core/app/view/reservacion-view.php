<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='assets/fullcalendar/moment.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.min.js'></script>
<?php
$thejson = null;
$events = ReservacionData::getById($_GET["id"]);
$salon = SalonData::getById($_GET["id"]);
$tituloSalon=$salon->num_aula;
$tituloEdificio=$salon->num_edificio;
foreach($events as $event){
	$salon  = $event->getSalon();

	if($event->status_id == "Pregrado" ){
		$color = '#33ccff';
	}
	elseif ($event->status_id == "Posgrado") {
		$color = '#ff9900';
	}
	elseif ($event->status_id == "Curso de verano") {
		$color = '#33ccff';
	}
	elseif ($event->status_id == "Unico dia") {
		$color = '#99cc00';
	}

	$thejson[] = array("title"=>$event->nom_asignatura,"url"=>"./?view=editreservation&id=".$event->id,"start"=>$event->date_ini."T".$event->time_ini,"end"=>$event->date_ini."T".$event->time_fin,"backgroundColor"=>$color);
	
	$intermedias =fechasIntermedias($event->date_ini,$event->date_fin,'7');
	foreach($intermedias as $res){
		$thejson[] = array("title"=>$event->nom_asignatura,"url"=>"./?view=editreservation&id=".$event->id,"start"=>$res."T".$event->time_ini,"end"=>$res."T".$event->time_fin,"backgroundColor"=>$color);
	}
	
}



function fechasIntermedias($fechaIni,$fechaFin,$dia){
	$ini		=true;
	$a_fecha	=array();
	$fechatemp	=$fechaIni;

	while($ini){
		$fechatemp	=date('Y-m-d',strtotime("+$dia days",strtotime($fechatemp)));

		if($fechatemp>$fechaFin){
			$ini	=false;
		}else{
			$a_fecha[]	=$fechatemp;
		}		
	}
	
	return $a_fecha;
}
?>
<script>
	$(document).ready(function() {

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			allday: false,
			minTime: "07:00",
            maxTime: "23:00",
			defaultDate: '<?php echo date('Y-m-d');?>',
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: <?php echo json_encode($thejson)?>
		});
		
	});

</script>

<head><h2><?php echo "Edificio ".$tituloEdificio." - "."Salon ".$tituloSalon;?></h2></head>
<div class="row">
<div class="col-md-12">
<div class="card">
  <div class="card-header" data-background-color="red">
      <h4 class="title">Calendario de Semestre</h4>
  </div>
  <div class="card-content table-responsive">
<div id="calendar"></div>
</div>
</div>
</div>
</div>

