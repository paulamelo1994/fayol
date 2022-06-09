<?php
session_start();

require "../../functions.php";
$rootPath = "../..";

PageInit("Proyectos 2010 - 2011", "../menu.php");

if(isset($_POST['enviar']))
{
	$conexion= @DBConnect('new_fayol');
	
	if(!empty($conexion)) //Si hay conexion
	{	
		$log=pg_escape_string($_POST['login']);
		$clave=pg_escape_string($_POST['clave']);
		$res = db_query("SELECT * FROM usuario where nick= '$log' and clave = '$clave'");
		$numrows = pg_num_rows($res);

		if ( $numrows == 1 )
			$_SESSION['proyectos'] = true;
		else
			echo '<strong>Aceeso no permitido.</strong>';
	}
	else
		echo '<strong>Error en la conexion a la base de datos</strong>';
}


function deldir($dir){

    $current_dir = opendir($dir);

    while($entryname = readdir($current_dir)){
        if(is_dir("$dir/$entryname") and ($entryname != "." and $entryname!="..")){
            deldir("${dir}/${entryname}");  
        }elseif($entryname != "." and $entryname!=".."){
            unlink("${dir}/${entryname}");
        }
    }
    closedir($current_dir);
    rmdir(${'dir'});
}  
function eliminar ($proyecto)
{	$noproyecto=pg_escape_string($proyecto);
	$conexion= @DBConnect('new_fayol');
	
	if(!empty($conexion)) //Si hay conexion
	{
		db_query("DELETE FROM etapa WHERE noproyecto = $noproyecto");
		db_query("DELETE FROM imagen WHERE noproyecto = $noproyecto");
		db_query("DELETE FROM proyecto WHERE noproyecto = $noproyecto");
		
		
		if ( is_dir( "files/$proyecto/" ) )
			deldir( "files/$proyecto/" );
	}
}


if(getIP()==IP_ANGELA or getIP()==IP_GUILLERMO or getIP() == "127.0.0.1" )
{
	if ( isset($_SESSION['proyectos']) )
	{
		if ( isset($_GET['tipo']) and $_GET['tipo'] == "del" and isset($_GET['noproyecto'] ))
		{
			eliminar ($_GET['noproyecto']);
			
			?>
			<script language="JavaScript">
            location.href='./administrar.php';
            </script>		
			<?
		}
	}
}





if(getIP()==IP_ANGELA or getIP()==IP_GUILLERMO or getIP() == "127.0.0.1" )
{
	if ( !isset($_SESSION['proyectos']) )
	{
		?>
		<center>
		<h1 class="shiny">Autenticaci&oacute;n Requerida </h1>
		<form name="form1" method="post" action="">
		<table width="200" border="0">
		  <tr>
			<td>Usuario</td>
			<td>
			  <input type="textfield" name="login">
		  </tr>
		  <tr>
			<td>Contrase&ntilde;a</td>
			<td><input type="password" name="clave"></td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><div align="right">
			  <input type="submit" name="enviar" value="entrar">
			</div></td>
		  </tr>
		</table>
		</form>
		</center>
		<?
	}
	else
	{
		listaProyecto();
	}
}
else
{
	?>
    <strong>No tiene permisos de acceso a esta p&aacute;gina</strong>
    <?
}

PageEnd();



function listaProyecto ()
{
	$conexion= @DBConnect('new_fayol');
	
	if(!empty($conexion)) //Si hay conexion
	{
		$result = db_query("SELECT noproyecto, nombre FROM proyecto ORDER BY noproyecto DESC");

		$num_rows = pg_num_rows($result);
		
		if ( $num_rows != 0 )
		{
			echo '<ul>';
			for( $i=0; $i<$num_rows; $i++)
			{
				$proy = pg_fetch_object($result, $i);
				
				?>
				<li><a href="<?=makeURL("modProyecto.php?id=$proy->noproyecto");?>"><?=$proy->nombre?></a> (<a href="administrar.php?tipo=del&noproyecto=<?=$proy->noproyecto?>">Eliminar</a>)</li>
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
	
	?>
	<p>&nbsp;</p><p>&nbsp;</p>
	<a href="addProyecto.php">Crear Proyectos</a><br>
    <a href="index.php?close=true">Cerrar Seccion</a>
	<?
}
?>
