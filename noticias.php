<ul class="listaEventos">
<?PHP
	$conexion = @DBConnect('fayol');
	
	if($conexion)
	{
		$today = date('Y-m-d', time());
		$result = db_query("SELECT *, date('$today')-fecha<=5 as nuevo FROM noticias WHERE visible='t' order by fecha desc");
		$num_rows = pg_num_rows($result);
		for($i=0; $i<$num_rows; $i++)
		{
			$noticia = pg_fetch_object($result, $i);
			?>
			<li> <?
					if(substr($noticia->ubicacion,0,4)=='http'){
						echo '<strong>'.parseHtml(ucwords(strtolower($noticia->titulo))).'</strong><a href="'.$noticia->ubicacion.'" target="_blank" > Ver <img width="9" height="9" border="0" alt="" src="Images/imagen-mas.gif"></a>';
					}else{
						echo '<strong>'.parseHtml(ucwords(strtolower($noticia->titulo))).'</strong><a href="'.makeURL("Noticias/$noticia->ubicacion").'" target="_blank"> Ver <img width="9" height="9" border="0" alt="" src="Images/imagen-mas.gif"></a>';
					} 
					
			if ($noticia->nuevo=='t')
			{
				echo "<IMG SRC='/Images/plantilla/nuevo-mini.gif' ALT=''>";
			}
			echo "</li>";
		}
	}
	
	$conexion = @DBConnect('fayol');
	if($conexion)
	{
		$today = date('Y-m-d', time());
		$res = db_query( "SELECT *, date('$today')-fecha_publicacion <= 5 as nuevo FROM eventos where oculto='f' AND enlazado='t' order by fecha_publicacion DESC ;");
		$num_rows = pg_num_rows($res);
		
		for($i = ($num_rows - 1); $i >=  0; $i--) 
		{
			$obj = pg_fetch_object($res);
			?>
			<li>
				<strong><?=parseHtml(ucwords(strtolower($obj->nombre_evento)));?><a href="<?=makeURL("eventos/evento.php?id=$obj->id");?>">Ver <img width="9" height="9" border="0" alt="" src="Images/imagen-mas.gif"></a></strong><?
			
				if ($obj->nuevo=='t')
				{
					echo "<IMG SRC='/Images/plantilla/nuevo-mini.gif' ALT=''>";
				}
				echo "</li>";
		}
	}
	
	$conexion = @DBConnect('fayol');
	if($conexion)
	{
		$res2 = db_query( "SELECT * FROM eventocalendario where visible='t';");
		$num_rows2 = pg_num_rows($res2);
		$today = date('Y-m-d', time());
		for($i = ($num_rows2 - 1); $i >=  0; $i--) 
		{
			$obj = pg_fetch_object($res2);
			?>
			<li>
			    <strong><?=parseHtml(ucwords(strtolower($obj->nombre)));?></strong><a href="<?=makeURL("$obj->direccion");?>">Ver <img width="9" height="9" border="0" alt="" src="Images/imagen-mas.gif"></a><?
			/*echo "<TR>
				<TD VALIGN=TOP align='left'><img src='Images/plantilla/flecha-roja.gif' ALT=''></TD>
				<TD VALIGN=TOP align='left'><a href='eventos/evento.php?id=$obj->id'><B>".parseHtml(ucwords(strtolower($obj->nombre_evento)))."</B></a>";
				*/
				if ($obj->fecha==$today)
				{
					echo "<IMG SRC='/Images/plantilla/nuevo-mini.gif' ALT=''>";
				}
			echo "</li>";
		}
	}
?>
</ul>