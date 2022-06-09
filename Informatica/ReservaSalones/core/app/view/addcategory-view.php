<?php
/**
* Reservas San Fernando
* @author Johan David Mera
**/

if(count($_POST)>0){
	$user = new CategoryData();
	$user->name = $_POST["name"];
	$user->division = $_POST["division"];
	$user->add();

print "<script>window.location='index.php?view=categories';</script>";


}


?>