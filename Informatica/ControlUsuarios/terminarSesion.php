<?
/* * ******************************************************
  Aplicacion: Control Salas
  Archivo: terminarSesion.php
  Objetivo: Modulo en el cual se listan las sesiones actuales de una sala y a partir de la seleccion hecha por
  el monitor se termina una sesion en un computador. Este modulo se encarga de actualizar la BD para
  que el computador este libre para futuras sesiones.
  Autor: Angela Benavides
  A&ntilde;o: 2006
 * ******************************************************* */

session_start();

if (!isset($_SESSION['monitor'])) {
    header("Location: /Comunidad/Informatica/ControlUsuarios/control.php");
    die();
}

$rootPath = '../../..';
require '../../../functions.php';
require 'varfunctions.php';
date_default_timezone_set('GMT-4'); //Establece zona horaria, evita desfaces

$_GET['submenu_control'] = true;

$sala = $_SESSION['idsala'];
if ($sala == 'auditorio') {
    header("Location: /Comunidad/Informatica/ControlUsuarios/salir.php");
}

if ($_POST['terminar']) {
    if (empty($_POST['seleccion']))
	$_GET['vacios'] = true;
    else {
	$fallo = false;
	$conexion = DBConnect('controlsalas');

	if (!$conexion)
	    echo("<td>No se pudo lograr la conexi&oacute;n con la BD.</td>");
	else {
	    db_query('begin');
	    $horaactual = date(G) . ":" . date(i) . ":" . date(s);
	    $sel = pg_escape_string($_POST['seleccion']);
	    $rs = db_query("select * from registro where indice = $sel");
	    $obj = pg_fetch_object($rs);
	    $equipo = pg_escape_string($obj->equipo);
	    $fechasalida = date(Y) . "-" . date(n) . "-" . date(d);

	    if (datebigger($fechasalida, $obj->fecha)) {
		if (actual_tomorrow($obj->horaing)) {
		    $horaactual = '13:00:00';
		} else if (actual_afternoon($obj->horaing)) {
		    $horaactual = '18:00:00';
		} else {
		    $horaactual = '21:00:00';
		}
		$fechasalida = $obj->fecha;
	    }

	    if (actual_tomorrow($obj->horaing) && !actual_tomorrow($horaactual)) {
		$horaactual = '13:00:00';
	    }

	    $fecha_sal = pg_escape_string($fechasalida);
	    $sel = pg_escape_string($_POST['seleccion']);
	    $rs = db_query("update registro set horarealsal = '$horaactual', 
						sesion = 'Terminada', 
						fechasalida='$fecha_sal' 
						where indice = $sel");
	    if (!$rs)
		$fallo = true;

	    $rs = db_query("update computador set disponible = 'true' where codigosala = '$sala' and codigopc = '$equipo'");
	    if (!$rs)
		$fallo = true;

	    if ($fallo) {
		db_query('rollback');
		?>
		<script language="javascript">
		    alert("Ha ocurrido un error al procesar el registro.");
		    history.back(1)
		</script>
		<?
	    } else {
		db_query('commit');
	    }
	}
    }
}

$fechaGuardada = $_SESSION['ultimoAcceso'];
$ahora = date("Y-n-j H:i:s");
$tiempo_transcurrido = (strtotime($ahora) - strtotime($fechaGuardada));


if ($tiempo_transcurrido >= 900 and getIP() != '192.168.221.63') {
    session_destroy();
    header("Location: control.php");
} else {
    PageInit("Terminar Sesi&oacute;n Usuario Sala $sala", "menu.php");
    //print_r($_SESSION);
    ?>

		
    <h1 class="shiny">Terminar Sesi&oacute;n</h1>
    <h4 align="right">Monitor: <?= $_SESSION['nombrem'] ?> <?= $_SESSION['apellidom'] ?><br>
        Hora Actual: 
    <?= date(G) . ":" . date(i) . ":" . date(s) ?> 
    </h4>
    <form method="post" id="TerminarFormID" name="terminarFormulario" action="terminarSesion.php" enctype="multipart/form-data">
        <table width="700" align="center" border="1" cellspacing="0" cellpadding="2">
    	<tr>
    	    <th width="5%"></th>
    	    <th width="10%">No. Equipo</th>
    	    <th width="15%">Codigo Estudiante</th>
    	    <th width="50%">Usuario</th>
    	    <th width="10%">Hora Inicio</th>
    	    <th width="10%">Hora Salida</th>
    <?
    if ($_SESSION['idsala'] == 'idiomas') {
	?>
		    <th width="10%">Diadema</th>
		    <th width="10%">No. Inventario</th>
	    <?
	}
	?>
    	</tr>
    <?
    $conexion = DBConnect('controlsalas');

    if (!$conexion)
	echo("<td colspan=\"2\">ha ocurrido un error al cargar desde la BD.</td>");
    else {
	$rs = db_query("select * from registro where sala = '$sala' and sesion = 'En proceso' order by equipo");
	while ($obj = pg_fetch_object($rs)) {
	    $codigoestudiante = pg_escape_string($obj->codigoestudiante);
	    $indice = $obj->indice;
	    $rs1 = db_query("select * from estudiantes where codigo = '$codigoestudiante'");
	    $obj1 = pg_fetch_object($rs1);
	    $usuario = $obj1->nombres . " " . $obj1->apellidos;
	    $equipo = $obj->equipo;
	    $horaing = $obj->horaing;
	    $horasal = $obj->horasal;
	    ?>
	    	<tr>
		    <?
		    $horaactual = date(G) . ":" . date(i) . ":" . date(s);

		    //Si la sesion del usuario a superado dos horas, se indica resaltando en gris oscuro
		    
		    //MEMO: marcar el boton como checked cuando se cumplan las dos horas
		    //y llamar la funcion TerminarSecAuto() para que se termine la seccion automaticamente. AUN SIN PROBAR
		    if (strtotime($horaactual) > strtotime($horasal)) {
			?>
			    <td align="center" ><input type="radio" checked name="seleccion" value="<?= $indice ?>"></td>
			    <td class="normal" align="center" valign="middle" bgcolor="#D3D3D3"><?= $equipo ?></td>
			    <td class="normal" align="center" valign="middle" bgcolor="#D3D3D3"><?= $codigoestudiante ?></td>
			    <td class="normal" align="center" valign="middle" bgcolor="#D3D3D3"><?= $usuario ?></td>
			    <td class="normal" align="center" valign="middle" bgcolor="#D3D3D3"><?= $horaing ?></td>
			    <td class="normal" align="center" valign="middle" bgcolor="#D3D3D3"><?= $horasal ?></td>
			    <? //terminar(); ?>
			    
			<?
		    } else {
			?>
			    <td align="center"><input type="radio" name="seleccion" value="<?= $indice ?>"></td>
			    <td class="normal" align="center" valign="middle"><?= $equipo ?></td>
			    <td class="normal" align="center" valign="middle"><?= $codigoestudiante ?></td>
			    <td class="normal" align="center" valign="middle"><?= $usuario ?></td>
			    <td class="normal" align="center" valign="middle"><?= $horaing ?></td>
			    <td class="normal" align="center" valign="middle" ><?= $horasal ?></td>
			    <?
			}

			if ($_SESSION['idsala'] == 'idiomas') {
			    if (strtotime($horaactual) > strtotime($horasal)) {
				?>
		    	    <td class="normal" align="center" valign="middle" bgcolor="#D3D3D3"><?= $obj->diadema ?></td>
		    	    <td class="normal" align="center" valign="middle" bgcolor="#D3D3D3"><?= $obj->diadema_noinv ?></td>
		    <?
		} else {
		    ?>
		    	    <td class="normal" align="center" valign="middle"><?= $obj->diadema ?></td>
		    	    <td class="normal" align="center" valign="middle"><?= $obj->diadema_noinv ?></td>
				<?
			    }
			}
			?>
	    	</tr>
		
	    <?
	}
    }
    ?>
        </table>
        <table width="95%" align="center" border="0">
    	<tr><td><br><br></td></tr>
    	<tr>
    	    <td align="center">
    		<input type="submit" id="BTerminar" name="terminar" value="Terminar Sesi&oacute;n de Usuario">
    	    </td>
    	</tr>
        </table>
    </form>
		<?
	    }

	    if (isset($_GET['vacios'])) {
		?>
    <script language="javascript" type="text/javascript">
        alert("Debe seleccionar una opci&oacute;n valida.");
    </script>
		<?
	    }
	    ?>
	    
	    <?
	    function terminar (){
		?>
		<script type="text/javascript">
		    
		    var submitBtn = document.getElementById("BTerminar");
		    alert("Alert"+submitBtn);
		    if(submitBtn){
			submitBtn.click();
		    }
		   alert("Alert prueba terminado Seccion");
		</script>
		<?
		
	    }
	    
	    ?>
    
    
    
    
    <script language="javascript" type="text/javascript">
	/*function TerminarSecAuto(){
	    var submitBtn = document.getElementById("BTerminar");
	    if(submitBtn){
		submitBtn.click();
	    }
	    alert("Alert prueba terminado Seccion");
	}*/
    </script>
    
    <?

	    PageEnd();
	    ?>
