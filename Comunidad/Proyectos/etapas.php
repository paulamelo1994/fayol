<?php

session_start();

require "../../functions.php";
$rootPath = "../..";

PageInit("Proyectos 2010 - 2011", "../menu.php");

if(isset($_POST['save']))
{
	$conexion= @DBConnect('new_fayol');
	
	if(!empty($conexion)) //Si hay conexion
	{
		$result = db_query ("INSERT INTO etapa (nombre, descripcion, noproyecto) VALUES ('$_POST[nombre]', '$_POST[descripcion]', $_GET[id])");
	}
	else
		echo '<strong>Error en la conexion a la base de datos</strong>';
	
}

if(isset($_POST['next']))
{
	unset ($_SESSION['etapas']);
	
	$_SESSION['images'] = true;
	$_SESSION['id'] = $_GET['id'];

		?>
		<script language="JavaScript">
        location.href='./images.php';
        </script>		
        <?
	
}

if(isset($_POST['update']))
{
	
	if ( isset($_GET['tipo']) and $_GET['tipo'] == "mod" and isset($_GET['noetapa'] ) )
	{
		$conexion= @DBConnect('new_fayol');
		
		if(!empty($conexion)) //Si hay conexion
		{
			//echo ( )
			
			db_query ("UPDATE etapa SET nombre = '$_POST[nombreEta]', descripcion = '$_POST[descripcionEta]' where noetapa = $_GET[noetapa]" );
			
			unset ($_GET['tipo']);
			unset ($_GET['noetapa']);
		}
		else
			echo '<strong>Error en la conexion a la base de datos</strong>';
	}
	else
	{
	 echo "No eNtro";
	}
	
	
}



function eliminar ($noetapa)
{
	$conexion= @DBConnect('new_fayol');
	
	if(!empty($conexion)) //Si hay conexion
	{
	}
}


if(getIP()==IP_ANGELA or getIP()==IP_GUILLERMO or getIP() == "127.0.0.1" )
{
	$conexion= @DBConnect('new_fayol');

	if ( isset($_SESSION['proyectos']) and isset($_SESSION['etapas']) )
	{
		if ( isset($_GET['tipo']) and $_GET['tipo'] == "del" and isset($_GET['noetapa'] ))
		{
			db_query("DELETE FROM etapa WHERE noetapa = $_GET[noetapa]");
		}
	}
}



if ( isset($_SESSION['proyectos']) && isset($_SESSION['etapas']) &&  isset($_GET['id']) )
{
	$conexion= @DBConnect('new_fayol');
	
	if(!empty($conexion))
	{
		$result = db_query ("SELECT * FROM etapa WHERE noproyecto = $_GET[id]");
		
		$num_rows = pg_num_rows($result);
		
		if ( $num_rows != 0 )
		{
			?>
				<table width="100%">
				<tr>
					<th width="30%">Nombre</th>
					<th width="50%">Descripcion</th>
					<th width="20%">Opciones</th>
				</tr>

				
			<?
			for ( $i=0; $i < $num_rows; $i++ )
			{
				$etapa = pg_fetch_object($result, $i);
				
				?>
				<tr valign="top">
                <?
				
				if ( isset($_GET['tipo']) and $_GET['tipo'] == "mod" and isset($_GET['noetapa'] ) and $_GET['noetapa'] == $etapa->noetapa )
				{
					?>
                <form id="form2" name="form2" method="post" action="">
				  <td><input name="nombreEta" type="text" id="nombreEta" size="30" value="<?=$etapa->nombre?>" /></td>
					<td><textarea name="descripcionEta" id="descripcionEta" cols="30" rows="5"><?=$etapa->descripcion?></textarea></td>
					<td>
					  <input type="submit" name="update" id="update" value="Guardar" />
					</td>
				</form>
                    <?
				}
				else
				{
					?>
					<td><?=$etapa->nombre?></td>
					<td><?=$etapa->descripcion?></td>
					<td><a href="etapas.php?id=<?=$_GET[id]?>&tipo=mod&noetapa=<?=$etapa->noetapa?>">Modificar</a> / <a href="etapas.php?id=<?=$_GET[id]?>&tipo=del&noetapa=<?=$etapa->noetapa?>">Eliminar</a></td>
                    <?
					}
					?>
				</tr>
                
                
				<?
			}
			?>
				</table>
		<?
		}
	}
	//unset($_SESSION['etapas']);
	
	
	
	?>
	<H1>Agregrar Etapa</H1>
	<form name="form1" method="post" action="etapas.php?id=<?=$_GET['id']?>">
	<table width="267" border="0">
	  <tr>
		<td width="72">Nombre</td>
		<td width="185">
		  <input type="text" name="nombre">
		</td>
	  </tr>
	  <tr>
		<td>Descripci&oacute;n</td>
		<td><textarea name="descripcion" cols="30" rows="5"></textarea></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td><input name="save" type="submit" id="save" value="Guardar">
		<input name="next" type="submit" id="next" value="Siguiente"></td>
	  </tr>
	</table>
	</form>

    <?

}
else
{
	?>
           <strong>No tiene acceso a esta p&aacute;gina</strong>
            </p>
        <?
}

PageEnd();
?>