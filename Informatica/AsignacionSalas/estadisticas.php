<?
ini_set("memory_limit", -1);
session_start();

if (!isset($_SESSION['adminSalas'])) {
    header("Location: /Comunidad/Informatica/AsignacionSalasNew/Formularios/ingresar.php");
    die();
}
$root_path = "../../..";
require '../../../functions.php';
date_default_timezone_set('GMT-4'); //Establece zona horaria, evita desfaces
$fecha = date('Y') . "-" . date('m') . "-" . date('d');
if (isset($_POST['est'])) {
    PageInit("Reporte Salas", "menu.php");
    ?>
    <script language="javascript">
        $(document).ready(function() {
    	$("#botonExcel").click(function(event) {
    	    $("#datos_a_enviar").val($("<div>").append($("#Exportar_a_Excel").eq(0).clone()).html());
    	    $("#FormularioExportacion").submit();
    	});
        });
    </script>
    <?
    DBConnect('controlsalas');
    $tipo = pg_escape_string($_POST['tipo']);
    $sala = pg_escape_string($_POST['sala']);
    $desde = pg_escape_string($_POST['desde']);
    $hasta = pg_escape_string($_POST['hasta']);
    echo "tipo: " . $tipo . "<br/>";
    if ($tipo == '1') {
	// la estadistica es por tipo reserva
	$title = 'Tipo reserva';
	$query = "select tipo_reserva as tipo,sala,count(tipo_reserva)as cantidad from head_reserva natural join body_reserva where";
	if ($sala != '5') {
	    $query = $query . " sala ='$sala' and ";
	}
	$query = $query . " fecha_reserva >= '" . $desde . "' and fecha_reserva<= '" . $hasta . "' group by sala,tipo_reserva";
	$rs = db_query($query);
	echo $query;
    } else {
	//estadisticas por usuarios(docentes)
	$title = 'Docentes';
	$query = "select docente as tipo,sala,count(docente) as cantidad from head_reserva natural join body_reserva where";
	if ($sala != '5') {
	    $query = $query . " sala ='$sala' and ";
	}
	$query = $query . " fecha_reserva >= '" . $desde . "' and fecha_reserva<= '" . $hasta . "' group by sala,docente";
	$rs = db_query($query);
	echo $query;
    }
    ?> <form action="ficheroExcel.php" method="post" id="FormularioExportacion">
        <div align="right" >
    	<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
    	<img src="../../../Images/iconosSalas/export.JPG"  id="botonExcel" />


        </div >
    </form>
    <table><tr><td><a href="estadisticas.php">Regresar</a><br /></td></tr></table>
    <table align="center"  id="Exportar_a_Excel">
        <tr>
    	<td align="center"><strong><h2>Reporte por:  <? echo $title;
    if ($sala == '5') {
	echo ' -  Todas las salas';
    } else {
	echo ' -  Sala ' . $sala;
    }
    ?></h2></strong><br /></td>
        </tr>
        <tr>
    	<td><strong>Fecha reporte: </strong><? echo MakeDate($fecha); ?></td>
        </tr>
        <tr>
    	<td><strong>Elaborado por:</strong> Luis Guillermo Pe�a</td>
        </tr>
        <tr>
    	<td><strong>Periodo estadistica:</strong> Desde el <? echo MakeDate($desde); ?> hasta el <? echo MakeDate($hasta); ?></td>
        </tr>
        <tr><td><br /><br /></td></tr>
        <tr>
    	<td >
    	    <table align="center" width="350">
    		<tr>
    		    <td align="left" style=" background-color:#999999;"><strong> <? echo $title; ?></strong></td>
    		    <td align="center" style="background-color:#999999;"><strong>Sala</strong></td>
    		    <td align="center" style="background-color:#999999;"><strong>Cantidad Reservas</strong></td>
    		</tr>
		    <? if (pg_num_rows($rs) == 0) { ?>
			<tr>
			    <td colspan="3"> <br><br> No hay registros en la base de datos</td>
			</tr>
		    <?
		    }
		    $i = 0;
		    while ($obj1 = pg_fetch_object($rs)) {
			if ($i == 0) {
			    $color = '#DBDBDB';
			    $i = 1;
			} else {
			    $color = 'CCCCCC';
			    $i = 0;
			}
			?>
			<tr>

			    <td align="left" style="background-color:<? echo $color; ?>;">
	<?
	if ($tipo == 1) {
	    echo $obj1->tipo;
	} else {
	    DBConnect('profesores');
	    $rs2 = db_query("select nombre from profesores where cedula='$obj1->tipo'");
	    $obj2 = pg_fetch_object($rs2);
	    echo $obj2->nombre;
	}
	?>
			    </td>
			    <td align="center" style="background-color:<? echo $color; ?>;"><? echo $obj1->sala; ?></td>
			    <td align="center" style="background-color:<? echo $color; ?>;"><? echo $obj1->cantidad; ?></td>
			</tr>
    <? } ?>
    	    </table>
    	</td>
        </tr>
    </table>

    <?
    die();
}

PageInit("Horario : Salas", "menu.php");
include '../../../php-scripts/validadorFormularios/formReserva.php';
include "../../../php-scripts/selectorFechas.php";
?>
<br />
<h2 align="center"> Informe de uso de salas</h2><br /><br />
<form action="" method="post" name="estadisticas2" id="estaadisticas2">
    <table align="center">
	<tr>
	    <td colspan="4" align="left">
		<strong>Reporte por:</strong>
       	        <select name="tipo" id="tipo" >
		    <option value=""></option>
                    <option value="1"> Tipo reserva</option>
                    <option value="2"> Usuarios</option>
                </select>            </td>
	</tr>
        <tr><td colspan="4"><br /></td></tr>
        <tr>
	    <td colspan="4" align="left">
		<strong>Sala:</strong>            
		<select name="sala" id="sala" >
		    <option value=""></option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2</option>
                    <option value="3"> 3</option>
                    <option value="4"> 4</option>
                    <option value="Idiomas"> Idiomas</option>
                    <option value="Cuse"> Cuse</option>
                    <option value="5"> Todas las salas</option>
                </select>            </td>
        </tr>
        <tr><td colspan="4"><br /></td></tr>
        <tr>
	    <td >
		<strong>Desde:</strong>            </td>
            <td width="7" >
		<input name="desde" type="text"  class="dateform" size="7" />            </td>
	    <td >
		<strong>Hasta:</strong>            </td>
            <td >
		<input name="hasta" type="text"  class="dateform" size="7" />            </td>
	</tr>
        <tr><td colspan="4"><br /></td></tr>
        <tr><td colspan="4" align="center"><input name="est" type="submit" value="Generar" /></td></tr>
    </table>
</form>
