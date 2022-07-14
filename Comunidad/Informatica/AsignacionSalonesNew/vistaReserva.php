<?
	session_start();
	
	if(!isset($_SESSION['adminSalas']))
	{
		header("Location: /Comunidad/Informatica/AsignacionSalasNew/Formularios/ingresar.php");
		die();
	}
	
	$root_path = "../../..";
	require '../../../functions.php';
	
	PageInit("Vista previa reserva", "menu.php");
	 DBConnect('controlsalas');
	$id_head=pg_escape_string(@$_GET['id1']);
	$id_body=pg_escape_string(@$_GET['id2']);
	$aux=pg_escape_string(@$_GET['op']);
	
	if($id_body != "" ){
		$rs = db_query("select * from head_reserva natural join body_reserva where id_body='$id_body' ");
		$obj = pg_fetch_object($rs);
		$rs2 = db_query("select * from planes where codigo='$obj->plan' ");
		$obj2 = pg_fetch_object($rs2);
		DBConnect('profesores');
		$rsp = db_query("select * from profesores where cedula='$obj->docente' ");
		$objp = pg_fetch_object($rsp);
		?>
			<table border="0" align="center" width="60%">
		<tr>
			<td class="titulosContenidoInterno">Fecha petición:</td>
			<td><?=$obj->fecha?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Hora petición:</td>
			<td><?=$obj->hora?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Sala:</td>
			<td><?=$obj->sala?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Fecha reserva:</td>
			<td><?=$obj->fecha_reserva?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Hora Inicio:</td>
			<td><?=$obj->hora_inicio?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Hora Final:</td>
			<td><?=$obj->hora_final?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno" width="40%">Docente:</td>
			<td width="60%"><?=$objp->nombre?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Software:</td>
			<td><?=$obj->software?></td><br>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Tipo reserva:</td>
			<td><?=$obj->tipo_reserva?></td><br>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Plan:</td>
			<td><?=$obj->plan?> <?=$obj2->nombre ?></td><br>
		</tr>
		<tr>
			<td class="titulosContenidoInterno">Tipo programa:</td>
			<td><?=$obj->tipo_programa ?></td><br>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Asignatura:</td>
			<td><?=$obj->asignatura?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Grupo:</td>
			<td><?=$obj->grupo?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Cantidad estudiantes:</td>
			<td><?=$obj->estudiantes?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Contenido:</td>
			<td><textarea name="contenido" cols="" rows="5" readonly="readonly" ><?=$obj->contenido?></textarea></td>
		</tr>
		<tr>
			<td class="titulosContenidoInterno">Estado:</td>
			<td><?=$obj->estado?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr><td colspan="2"><br></td></tr>
		<tr><td colspan="2" align="center"><? if($aux==1){?><a href="cancelaciones.php">Volver a Cancelaciones</a><? } ?>
											<? if(isset($_GET['idh'])){?><a href="listaReservas.php?op=2&id=<? echo $_GET['idh'];?>">Regresar</a><? } ?>
		</td></tr>
		
	</table>
		<?
				

	}		
?>