<?PHP
// content="text/plain; charset=utf-8"
// $Id: barintex1.php,v 1.3 2002/07/11 23:27:28 aditus Exp $
require_once '../../../functions.php';
include "../../../php-scripts/jpgraph/jpgraph.php";
include "../../../php-scripts/jpgraph/jpgraph_bar.php";
$rootPath = '../../../';
$mes=date('m');
$ano=date('Y');
$date=date("Y-m-d");
	
   $con = @DBConnect("fayol");
      if(!empty($con))//si no hay conexion
   {   		
	  $consulta1=db_query("select count (id)as cantidad,nivel_satisfaccion from calificacionsoporte where fechacalificacion>='$ano-01-01' and fechacalificacion<='$date'  group  by nivel_satisfaccion;");
	      
	   $array1 =array(0,0,0,0,0);
	   $array2=array('Insuficiente','Deficiente','Regular','Buena','Excelente');
	   	   
	   $insuficiente=0;
	   $deficiente=0;
	   $regular=0;
	   $buena=0;
	   $excelente=0;		
	   
		while($obj1 = pg_fetch_object($consulta1)){
				$key = $obj1->nivel_satisfaccion;
				$valor=$obj1->cantidad;
				if($key=='insuficiente'){$insuficiente=$valor;}	
				if($key=='deficiente'){$deficiente=$valor;}
				if($key=='regular'){$regular=$valor;}	
				if($key=='buena'){$buena=$valor;}	
				if($key=='excelente'){$excelente=$valor;}		
						
		}		
		$array1[0]=$insuficiente;
		$array1[1]=$deficiente;
		$array1[2]=$regular;
		$array1[3]=$buena;
		$array1[4]=$excelente;
		
		
		// Create the graph and setup the basic parameters 
		$graph = new Graph(600,200,'auto');	
		$graph->img->SetMargin(40,30,30,40);
		$graph->SetScale("textint");
		$graph->SetShadow();
		$graph->SetFrame(false); // No border around the graph
		
		// Add some grace to the top so that the scale doesn't
		// end exactly at the max value. 
		$graph->yaxis->scale->SetGrace(300);
		
		// Setup X-axis labels
		$graph->xaxis->SetTickLabels($array2);
		$graph->xaxis->SetFont(FF_FONT2);
		
		// Setup graph title ands fonts
		//$graph->title->Set("Nivel Atencion - Nivel Satisfaccion");
		$graph->title->SetFont(FF_FONT2,FS_BOLD);
		$graph->xaxis->title->SetFont(FF_FONT2,FS_BOLD);
		$graph->yaxis->title->Set("Votos");
		$graph->yaxis->title->SetFont(FF_FONT2,FS_BOLD);
									 
		// Create a bar pot
		$bplot = new BarPlot($array1);
		$bplot->SetFillColor("orange");
		$bplot->SetWidth(0.5);
		$bplot->SetShadow();
		
		// Setup the values that are displayed on top of each bar
		$bplot->value->Show();
		// Must use TTF fonts if we want text at an arbitrary angle
		$bplot->value->SetFont(FF_ARIAL,FS_BOLD);
		$bplot->value->SetAngle(45);
		// Black color for positive values and darkred for negative values
		$bplot->value->SetColor("black","darkred");
		$graph->Add($bplot);
		
		// Finally stroke the graph
		$graph->Stroke();
		
}
?>