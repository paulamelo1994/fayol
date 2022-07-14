<?php
/**
* Reservas San Fernando
* @author Johan David Mera
**/
if(count($_POST)>0){
	$period = new PeriodoData();
	$period->name = $_POST["name"];
	$period->duracion = $_POST["duracion"];
	$period->tipo = $_POST["tipoduracion"];
	$period->add();
print "<script>window.location='index.php?view=users';</script>";


}


?>