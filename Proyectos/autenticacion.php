<?php

function listaProyecto ( $modificable )
{
	$conexion= @DBConnect('new_fayol');
	
	if(!empty($conexion)) //Si hay conexion
	{
		$result = db_query("SELECT noproyecto, nombre FROM proyecto ORDER BY noproyecto DESC");

		$num_rows = pg_num_rows($result);
		
		if ( $num_rows != 0 )
		{
			echo '<h1 class="shiny">Ver Proyectos</h1>';
			echo '<ul>';
			for( $i=0; $i<$num_rows; $i++)
			{
				$proy = pg_fetch_object($result, $i);
				
				?>
				<li><a href="<?=makeURL("verProyecto.php?id=$proy->noproyecto");?>"><?=$proy->nombre?></a></li>
                <?
			}
			echo '</ul>';
		}
		else
		{
			echo '<strong>No hay proyectos</strong>';
		}
	}
	else
		echo '<strong>Error en la conexion a la base de datos</strong>';
	
	if(getIP()==IP_ANGELA or getIP()==IP_GUILLERMO or getIP() == "127.0.0.1" )
	{
		?>
		<p>&nbsp;</p><p>&nbsp;</p>
		<h1 class="shiny">Administrar Proyectos</h1>
		<a href="administrar.php">Administrar Proyectos</a>
        <?
	}
}
?>