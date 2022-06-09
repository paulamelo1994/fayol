<? 
	ini_set("memory_limit",-1);
	ob_start();
	$root_path = "../../..";
	require '../../../functions.php';
	$fecha = date('Y')."-".date('m')."-".date('d');
		
	if(isset($_POST['generar'])){
		PageInit("Reporte : Salas 2","menu.php");
		DBConnect('controlsalas');
		$fecha1=pg_escape_string($_POST['fecha1']);
		$fecha2=pg_escape_string($_POST['fecha2']);
		$consulta="select asignatura,fecha_reserva,hora_inicio,hora_final,docente,sala,tipo_reserva,grupo from head_reserva natural join body_reserva
					 where estado='activo' and fecha_reserva >= '$fecha1' and fecha_reserva <= '$fecha2'";
		if($_POST['sala']!='5'){
			$sala=pg_escape_string($_POST['sala']);
			$consulta=$consulta." and sala='$sala' ";
		}
			$consulta=$consulta." order by fecha_reserva,hora_inicio,sala";
		$rs=db_query($consulta);
		DBConnect('profesores');
		$rsp=db_query("select cedula,nombre from profesores");
		$profesores=array();
		while($objp=pg_fetch_object($rsp)){
			$profesores[$objp->cedula]=$objp->nombre;
		}
		ob_end_clean();
		ob_start();
		?>
		<table align="center">
			<tr>
				<td><h2 style="color:#2D9FAC; " align="center">
					<strong>REPORTE DE RESERVAS <? if($_POST['sala']!='5'){
														echo 'DE LA SALA '.$_POST['sala'];
												    }else{ 
														echo 'DE TODAS LAS SALAS';
													}?></strong>
					</h2>
				</td>
			</tr>
			<tr>
				<td align="left"><strong><? echo '- Reporte elaborado el '.MakeDate($fecha); ?><br>
										 <? echo '- Reservas desde el '.MakeDate($fecha1).' hasta el '.MakeDate($fecha2); ?><br><br></strong></td>
			</tr>
		<? if(pg_num_rows($rs)==0){ ?>  
			<tr>
				<td style="padding-left:20px; color:#2D9FAC; ">
					<strong>" No hay registro de reservas en la base de datos, en el periodo señalado. "</strong>
				</td>
			</tr> 
		 <? }
		 
			while($obj=pg_fetch_object($rs)){
			$i++;
			?>
			<tr>
				<td><strong><? echo MakeDate($obj->fecha_reserva); ?></strong></td>
			</tr>
			<tr>
				<td style="padding-left:20px; color:#2D9FAC; ">
					<strong><? echo substr($obj->hora_inicio,0,5).' - '.substr($obj->hora_final,0,5).'   *  '.$obj->asignatura.'  , Gr '.$obj->grupo;?></strong>
				</td>
			</tr>
			<tr>
				<td style="padding-left:40px; padding-top:-1px;"><img src="../../../Images/plantilla/barra.bmp"><strong>Lugar:</strong> <? echo 'Sala '.$obj->sala;?><br>
											   <img src="../../../Images/plantilla/barra.bmp"><strong>Docente:</strong> <? echo $profesores[$obj->docente];?><br>
											   <img src="../../../Images/plantilla/barra.bmp"><strong>Tipo reserva:</strong> <? echo $obj->tipo_reserva; ?><br><br><br>
				</td>
			</tr>
			<?
		} 
					 
		?>
		</table>
		
		<?PHP
		$display = "attachment";
		$attachment = ($display == "attachment");
		$html = ob_get_contents();
		ob_end_clean();
		require_once("../../../php-scripts/dompdf/dompdf_config.inc.php");
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->add_info("Title","Reporte reserva de salas");
		$dompdf->render();
		//$dompdf->get_canvas()->get_cpdf()->setEncryption('','',array("print"));//Cannot copy, modify or add, only print
		
		$dompdf->stream("Reporte reserva de salas.pdf",array("Attachment" => $attachment));
		exit(0);
		
	}
?>