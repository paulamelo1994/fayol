<? 
	ini_set("memory_limit",-1);
	ob_start();
	$root_path = "../../..";
	require '../../../functions.php';
		
	if(isset($_POST['exportar'])){
		$html=$_POST['html'];
		$formato=$_POST['formato'];
		if($formato=='1'){
			$display = "attachment";
			$attachment = ($display == "attachment");
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
		
	}
?>
