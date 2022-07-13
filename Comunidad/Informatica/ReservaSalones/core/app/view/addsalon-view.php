<?php

if(count($_POST)>0){
	$user = new SalonData();
	$num_edificio = "NULL";
	if($_POST["num_edificio"]!=""){ $num_edificio = $_POST["num_edificio"]; }
	$user->num_edificio = $num_edificio;
	$user->capacidad = $_POST["capacidad"];
	$user->num_aula = $_POST["num_aula"];
	$user->ayudas = $_POST["ayudas"];
	$user->add();	

print "<script>window.location='index.php?view=salones';</script>";


}


?>