<?php
/**
 * Reservas San Fernando
 * @author Johan David Mera
 **/
$dia['Sunday'] = "Domingo";
$dia['Monday'] = "Lunes";
$dia['Tuesday'] = "Martes";
$dia['Wednesday'] = "Miercoles";
$dia['Thursday'] = "Jueves";
$dia['Friday'] = "Viernes";
$dia['Saturday'] = "Sabado";
$rx = ReservacionData::getRepeated($_POST["salon_id"],$dia[date('l', strtotime($_POST["date_ini"]))], $_POST["time_ini"],  $_POST["time_fin"],$_POST["date_ini"], $_POST["status_id"]);
if ($rx == null) {
    $r = new ReservacionData();
    $r->cod_asignatura = $_POST["cod_asignatura"];
    $r->grupo = $_POST["grupo"];
    $r->nom_asignatura = $_POST["nom_asignatura"];
    $r->date_ini = $_POST["date_ini"];
    $r->time_ini = $_POST["time_ini"];
    $r->time_fin = $_POST["time_fin"];
    $r->nom_docente = $_POST["nom_docente"];
    $r->descripcion = $_POST["descripcion"];
    $r->salon_id = $_POST["salon_id"];
    $status_per = $_POST["status_id"];
    $r->dia = $dia[date('l', strtotime($_POST["date_ini"]))];
    $date_final = new DateTime($_POST["date_ini"]);
    $per= explode('-', $status_per);
    if($per[1]=='dia'){
        $date_final->modify('+'.$per[0].' day');
        $r->date_fin = $date_final->format('Y-m-d');
    }
    if($per[1]=='semana'){
        $date_final->modify('+'.$per[0].' week');
        $r->date_fin = $date_final->format('Y-m-d');
    }
    if($per[1]=='mes'){
        $date_final->modify('+'.$per[0].' month');
        $r->date_fin = $date_final->format('Y-m-d');
    }

    $r->status_id = $per[2];
/*
    if ($_POST["status_id"] == "Pregrado") {
        $date_final->modify('+14 week');
        $r->date_fin = $date_final->format('Y-m-d');
    } else if ($_POST["status_id"] == "Posgrado") {
        $date_final->modify('+3 week');
        $r->date_fin = $date_final->format('Y-m-d');
    } else if ($_POST["status_id"] == "Curso de verano") {
        $date_final->modify('+1 moth');
        $r->date_fin = $date_final->format('Y-m-d');
    } else if ($_POST["status_id"] == "Unico dia") {
        $date_final->modify('+0 day');
        $r->date_fin = $date_final->format('Y-m-d');
    }*/

    $r->add();

    Core::alert("¡Reservacion guardada exitosamente!");
} else {
    Core::alert("No se ha podido agregar. Reservacion repetida u horario cruzado con otra reservacion.");
}
Core::redir("./index.php?view=reservations");
