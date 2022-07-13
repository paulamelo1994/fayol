<?
/*
 * Script para plan de estudios formulario reservaSalas
 */
 $root_path = "../../../..";
 require '../../../../functions.php';
 require_once '../../../../php-scripts/JSON.php';
 if(isset($_GET['term'])){
	 	$termino=strtoupper($_GET['term']);	
		DBConnect('controlsalas');
		$query=db_query("select * from planes where nombre like '$termino%' or codigo like '$termino%'");
		$resultados=array();		
		while($obj1=pg_fetch_object($query)){
			  //$label=$obj->codigo." ".$obj->nombre;
		 	  $resultados[]= array('id'=> "$obj1->codigo $obj1->nombre", 'label'=> "$obj1->codigo $obj1->nombre", 'value'=> "$obj1->codigo $obj1->nombre");
		}
		$value = new Services_JSON();
		$out = $value->encode($resultados);
		echo $out;
}

?>
