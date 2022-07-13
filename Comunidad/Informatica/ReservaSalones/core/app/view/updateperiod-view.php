<?php

if(count($_POST)>0){
	//die($_POST["name"]." ".$_POST["duracion"]." ".$_POST["tipoduracion"]);
	$user = PeriodoData::getById($_POST["id"]);
	$user->name = $_POST["name"];
	$user->duracion = $_POST["duracion"];
	$user->tipo = $_POST["tipoduracion"];
	$user->update();


	print "<script>window.location='index.php?view=users';</script>";


}


?>