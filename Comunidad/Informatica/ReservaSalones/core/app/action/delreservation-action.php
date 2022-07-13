<?php
/**
* Reservas San Fernando
* @author Johan David Mera
**/
$user = ReservacionData::getByUnicId($_GET["id"]);
$user->del();
print "<script>window.location='index.php?view=reservations';</script>";

?>