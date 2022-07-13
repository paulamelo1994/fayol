<?
require "../../functions.php";
$rootPath = "../..";


$valign = 'top';
$centrar_contenido = false;
$_GET['submenu_proyectos'] = true;

PageInit("Proyectos 2010 - 2011", "../menu.php");




?>
<a href="index.php">&lt;&lt; Volver</a>
<?

$conexion= @DBConnect('new_fayol');

if(!empty($conexion)) //Si hay conexion
{
	
	$result = db_query("SELECT * FROM proyecto WHERE noproyecto = $_GET[id]");

	$num_rows = pg_num_rows($result);
	
	if ( $num_rows != 0 )
	{
		$proy = pg_fetch_object($result, 0);
		
		?>
        <h1 class="shiny"><?=$proy->nombre?></h1>
        <p><?=$proy->descripcion?></p>
        
        <?
		if ($proy->asunto_estrategico != "" )
		{
			?>
			<h2>Asunto Estrategico</h2>
			<p><?=$proy->asunto_estrategico?></p>
            <?
		}

		if ($proy->programa_estrategico != "" )
		{
			?>
            <h2>Programa Estrategico</h2>
            <p><?=$proy->programa_estrategico?></p>
            <?
		}
		
		if ($proy->acciones != "" )
		{
			?>
            <h2>Acciones</h2>
            <p><?=$proy->acciones?></p>
        <?
		}
		
		$resultEta = db_query("SELECT * FROM etapa WHERE noproyecto = $_GET[id]");
		
		$num_rows_etapa = pg_num_rows($resultEta);
	
		if ( $num_rows_etapa != 0 )
		{
			?><H2>Etapas</H2><?
			
			for ( $n=0; $n < $num_rows_etapa; $n++ )
			{
				$etapa = pg_fetch_object($resultEta, $n);
				
				?><H3><?=$etapa->nombre?></H3>
				<p><?=$etapa->descripcion?></p>
				
				<?
			}
		}
		
		
		$resultIni = db_query("SELECT * FROM imagen WHERE noproyecto = $_GET[id] AND tipo='inicial'");
		
		$num_rows_inicial = pg_num_rows($resultIni);
	
		if ( $num_rows_inicial != 0 )
		{
			?>
			<script language="javascript" type="text/JavaScript">
			var nImage = 0;
			var imagenes = new Array();
			var descrip = new Array();
			
			<?
			for ( $n=0; $n < $num_rows_inicial; $n++ )
			{
				$entrada = pg_fetch_object($resultIni, $n);
				
				echo "imagenes.push ( \"./files/$_GET[id]/inicial/$entrada->nombre_archivo\");";
				echo "descrip.push ( \"$entrada->descripcion\");";
			}
			
			
			$entrada = pg_fetch_object($resultIni, 0);
			?>
				

			function next()
			{
				nImage++;
				
				
				if ( nImage == imagenes.length )
					nImage = 0;
					
				document["laImagen"].src = imagenes[nImage];
				document.getElementById("descrip").innerHTML = descrip[nImage];
				
				
			}

			function after()
			{
				nImage--;
				
				if ( nImage < 0 )
					nImage = imagenes.length-1;
					
				document["laImagen"].src = imagenes[nImage];
				document.getElementById("descrip").innerHTML = descrip[nImage];
			}

			function descripcion() 
			{
				document.getElementById("descrip").innerHTML = descrip[nImage];
			}
			</script>
            

			<H2 name="ImagenesIniciales">Imagenes Iniciales</H2>
				<table width="100%" border="0">
                  <tr>
                    <td width="15%"><a href="#ImagenesIniciales" onclick="after()">&lt;&lt; Anterior</a></td>
                    <td width="70%">&nbsp;</td>
                    <td width="15%"><div align="right"><a href="#ImagenesIniciales" onclick="next()">Siguiente &gt;&gt;</a></div></td>
                  </tr>
                  <tr>
                    <td colspan="3"><center><IMG SRC="./files/<?=$_GET[id]?>/inicial/<?=$entrada->nombre_archivo?>" name="laImagen" width="400" height="300"></center></td>
                  </tr>
                  <tr>
                    <td colspan="3"><h3>Descripcion:</h3><div id="descrip"><?=$entrada->descripcion?></div></td>
                  </tr>
                </table>
			
			<?
		}
		
		
		$resultFinal = db_query("SELECT * FROM imagen WHERE noproyecto = $_GET[id] AND tipo='final'");
		
		$num_rows_final = pg_num_rows($resultFinal);
	
		if ( $num_rows_final != 0 )
		{
			?>
			<script language="javascript" type="text/JavaScript">
			var nImageF = 0;
			var imagenesF = new Array();
			var descripF = new Array();
			
			<?
			for ( $nF=0; $nF < $num_rows_final; $nF++ )
			{
				$final = pg_fetch_object($resultFinal, $nF);
				
				echo "imagenesF.push ( \"./files/$_GET[id]/final/$final->nombre_archivo\");";
				echo "descripF.push ( \"$final->descripcion\");";
			}
			
			
			$final = pg_fetch_object($resultFinal, 0);
			?>
				
			function nextF()
			{
				nImageF++;
				
				
				if ( nImageF == imagenesF.length )
					nImageF = 0;
					
				document["laImagenF"].src = imagenesF[nImageF];
				document.getElementById("descripF").innerHTML = descripF[nImageF];
				
				
			}

			function afterF()
			{
				nImageF--;
				
				if ( nImageF < 0 )
					nImageF = imagenesF.length-1;
					
				document["laImagenF"].src = imagenesF[nImageF];
				document.getElementById("descripF").innerHTML = descripF[nImageF];
			}

			function descripcionF() 
			{
				document.getElementById("descripF").innerHTML = descripF[nImageF];
			}
			</script>
            

			<H2 name="ImagenesFinales">Imagenes Finales</H2>
				<table width="100%" border="0">
                  <tr>
                    <td width="15%"><a href="#ImagenesFinales" onclick="afterF()">&lt;&lt; Anterior</a></td>
                    <td width="70%">&nbsp;</td>
                    <td width="15%"><div align="right"><a href="#ImagenesFinales" onclick="nextF()">Siguiente &gt;&gt;</a></div></td>
                  </tr>
                  <tr>
                    <td colspan="3"><center><IMG SRC="./files/<?=$_GET[id]?>/final/<?=$final->nombre_archivo?>" name="laImagenF" width="400" height="300"></center></td>
                  </tr>
                  <tr>
                    <td colspan="3"><h3>Descripcion:</h3><div id="descripF"><?=$final->descripcion?></div></td>
                  </tr>
                </table>
			
			<?
		}

	}
}
else
	echo '<strong>Error en la conexion a la base de datos</strong>';

PageEnd();
?>
