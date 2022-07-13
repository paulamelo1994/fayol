<?
   require '../../../functions.php';
   $rootPath = '../../../';
   
   $valign = 'top';
   $centrar_contenido = false;
   //$_GET['submenu_actas'] = true;
   $_GET['conceptos_juridicos'] = true;
   
   //PageInit('Normas y Conceptos Jurídicos de Interes', '../../menu.php', 'left', 'top');

	$con = @DBConnect('new_fayol');
	
	if(!empty($con)) //Si hay conexion
	{
		$res = db_query("SELECT * FROM concepto_juridico order by fecha desc;");
		$numrows = pg_num_rows($res);
		
		
		if($numrows != 0)
		{
			for($i = ($numrows - 1); $i >=  0; $i--)
			{
				$obj = pg_fetch_object($res);
				
				?><strong>Asunto: </strong><?=$obj->asunto?><br>
				<strong>Fecha: </strong><?=$obj->fecha?><br>
				<strong>Origen: </strong><?=$obj->origen?><br>
				<a target="_blank" href="<?=$obj->direccion?>">Ver</a><br><hr>
			
			<?
			}
		}
	}

   //PageEnd();
?>
		