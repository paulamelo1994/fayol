<? 
	session_start();
	$root_path = "../../..";
	require '../../../functions.php';
	$fecha = date('Y')."-".date('m')."-".date('d');
	
	PageInit("Reporte : Salas 2","menu.php");
	include '../../../php-scripts/validadorFormularios/formReserva.php';
    include "../../../php-scripts/selectorFechas.php";
?>
	<br />
	<h2 align="center"> Reporte uso de salas</h2><br />
    <form action="crearpdf.php" method="post" name="estadisticas" id="estaadisticas">
    <table align="center">
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
                </select>
			</td>
        </tr>
        <tr><td colspan="4"><br /></td></tr>
        <tr>
        	<td >
            	<strong>Desde:</strong>
			</td>
            <td width="7" >
           	  <input name="fecha1" type="text" class="dateform" size="7" />
			</td>
      		<td >
            	<strong>Hasta:</strong>
			</td>
            <td >
            	<input name="fecha2" type="text"  class="dateform" size="7" />
			</td>
		</tr>
        <tr><td colspan="4"><br /></td></tr>
        <tr><td colspan="4" align="center"><input name="generar" type="submit" value="Generar PDF" /></td></tr>
    </table>
    </form>
	<? 
	die();
	?>