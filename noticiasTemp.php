
<?PHP
	$conexion = @DBConnect('fayol');
	
	if($conexion)
	{
		$today = date('Y-m-d', time());
		$result = db_query("SELECT *, date('$today')-fecha<=5 as nuevo FROM noticias WHERE visible='t' order by fecha desc");
		$num_rows = pg_num_rows($result);
                if($num_rows > 3){
                    $num_rows = 3;
                }
		for($i=0; $i<$num_rows; $i++)
		{
			$noticia = pg_fetch_object($result, $i);
			?>
                        <div class="cajaContenido divNoticias" style="border: 0px;"> <!--li --> 
                        <?
                                        echo '<br>';
					if(substr($noticia->ubicacion,0,4)=='http'){
						echo ''.parseHtml(ucwords(strtolower($noticia->titulo))).'<br><a href="'.$noticia->ubicacion.'" target="_blank" > Ver +</a>';
					}else{
						echo ''.parseHtml(ucwords(strtolower($noticia->titulo))).'<br><a href="'.makeURL("Noticias/$noticia->ubicacion").'" target="_blank"> Ver +</a>';
					} 
					
			if ($noticia->nuevo=='t')
			{
				echo "<IMG SRC='/Images/plantilla/nuevo-mini.gif' ALT=''>";
			}
			echo "</div>";
		}
	}
	
	$conexion = @DBConnect('fayol');
        ?>
        <!-- ul class="listaEventos" -->
        <?
	if($conexion)
	{
		$today = date('Y-m-d', time());
		$res = db_query( "SELECT *, date('$today')-fecha_publicacion <= 5 as nuevo FROM eventos where oculto='f' AND enlazado='t' order by fecha_publicacion DESC ;");
		$num_rows = pg_num_rows($res);
                if($num_rows > 2){
                    $num_rows = 2;
                }
		
		for($i = ($num_rows - 1); $i >=  0; $i--) 
		{
			$obj = pg_fetch_object($res);
			?>
			<div class="cajaContenido divNoticias" style="border: 0px;" >
                                <br>
				<?=parseHtml(ucwords(strtolower($obj->nombre_evento)));?><br><a href="<?=makeURL("eventos/evento.php?id=$obj->id");?>">Ver +</a><?
			
				if ($obj->nuevo=='t')
				{
					echo "<IMG SRC='/Images/plantilla/nuevo-mini.gif' ALT=''>";
				}
				echo "</div>";
		}
	}
	
	$conexion = @DBConnect('fayol');
	if($conexion)
	{
		$res2 = db_query( "SELECT * FROM eventocalendario where visible='t';");
		$num_rows2 = pg_num_rows($res2);
                if($num_rows2 > 2){
                    $num_rows2 = 2;
                }
		$today = date('Y-m-d', time());
		for($i = ($num_rows2 - 1); $i >=  0; $i--) 
		{
			$obj = pg_fetch_object($res2);
			?>
			<div class="cajaContenido divNoticias" style="border: 0px;" >
                            <br>
			    <?=parseHtml(ucwords(strtolower($obj->nombre)));?><br><a href="<?=makeURL("$obj->direccion");?>">Ver +</a><?
			/*echo "<TR>
				<TD VALIGN=TOP align='left'><img src='Images/plantilla/flecha-roja.gif' ALT=''></TD>
				<TD VALIGN=TOP align='left'><a href='eventos/evento.php?id=$obj->id'><B>".parseHtml(ucwords(strtolower($obj->nombre_evento)))."</B></a>";
				*/
				if ($obj->fecha==$today)
				{
					echo "<IMG SRC='/Images/plantilla/nuevo-mini.gif' ALT=''>";
				}
			echo "</div>";
		}
	}
?>