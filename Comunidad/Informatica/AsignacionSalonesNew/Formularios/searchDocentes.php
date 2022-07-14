<?
/*
 * Script para docentes formulario reservaSalas
 */
 $root_path = "../../../..";
 require '../../../../functions.php';
 require_once '../../../../php-scripts/JSON.php';
 if(isset($_GET['term'])){
	 	$termino=strtoupper($_GET['term']);	
		DBConnect('profesores');
		$query=db_query("select cedula,nombre from profesores where nombre like '$termino%' or cedula like '$termino%'");
		$resultados=array();		
		while($obj1=pg_fetch_object($query)){
			  //$label=$obj->codigo." ".$obj->nombre;
		 	  $resultados[]= array('id'=> "$obj1->cedula $obj1->nombre", 'label'=> "$obj1->cedula $obj1->nombre", 'value'=> "$obj1->cedula $obj1->nombre");
		}
		$value = new Services_JSON();
		$out = $value->encode($resultados);
		echo $out;
}

?>
