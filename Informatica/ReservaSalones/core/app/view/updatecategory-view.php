<?php

if(count($_POST)>0){
	$user = CategoryData::getById($_POST["id"]);
	$user->name = $_POST["name"];
	$user->division = $_POST["division"];
	$user->update();
print "<script>window.location='index.php?view=categories';</script>";


}


?>