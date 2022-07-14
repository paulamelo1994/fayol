<?php

session_start();

require "../../functions.php";
$rootPath = "../..";

PageInit("Proyectos 2010 - 2011", "../menu.php");

if ( isset($_SESSION['proyectos']) && isset($_SESSION['images']) &&  isset($_SESSION['id']) and isset ( $_GET['noimagen'] ) and isset ( $_GET['tipo'] ) and $_GET['tipo'] == "del" and isset ( $_GET['modo'] ) and isset ( $_GET['nombre'] )  )
{
	$conexion= @DBConnect('new_fayol');
	
	if(!empty($conexion)) //Si hay conexion
	{
		$result = db_query ("DELETE FROM imagen WHERE noimagen = $_GET[noimagen]");
		
		
		if ( $_GET['modo'] == "inicial" )
			unlink("files/$_SESSION[id]/inicial/$_GET[nombre]");
		else
		{
			if ( $_GET['modo'] == "final" )
			{
				echo "entro";
				echo "files/$_SESSION[id]/final/$_GET[nombre]";
				unlink("files/$_SESSION[id]/final/$_GET[nombre]");
				echo "entro";
			}
		}
		
		unset( $_GET['noimagen']);
		unset( $_GET['tipo']);
		unset( $_GET['modo']);
		unset( $_GET['nombre']);
	}
	else
		echo '<strong>Error en la conexion a la base de datos</strong>';
	
}


if(isset($_POST['inicio']))
{
	if(isset($_FILES['archivo']))
	{
		 
		if ( !is_dir ( "files/"."$_SESSION[id]") )
		{
			$folder = "files/"."$_SESSION[id]";
			$ok = mkdir( $folder, 0775 );
			
			if ( $ok )
			{
				chmod($folder, 0775);
				chgrp($folder, "nobody");
			}
		}
		 
		if ( !is_dir ( "files/"."$_SESSION[id]"."/inicial") )
			mkdir( "files/"."$_SESSION[id]"."/inicial", 0775);
		 
		 
		$archivo = basename( $_FILES['archivo']['name']);
		$target_path = "files/"."$_SESSION[id]"."/inicial/".$archivo;
		
		if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path))
		{
			chmod($target_path, 0777);
			chgrp($target_path, "nobody");
		}
		else
		{
			/*
			echo $_FILES['archivo']['tmp_name'];
			echo "Se ha presentado un error al cargar el archivo, inténtelo de nuevo!"  .$_FILES['archivo']['name'];
			?>
			<br><br>
			<div align="center"><a href="cambiar.php?item=3">Volver</a></div>
			<?
			unset($_FILES['archivo']);
			*/
		}
		
		$conexion= @DBConnect('new_fayol');
		
		if(!empty($conexion)) //Si hay conexion
		{
			$result = db_query ("INSERT INTO imagen(nombre_archivo, descripcion, tipo, noproyecto) VALUES ('$archivo', '$_POST[descripcion]', 'inicial', $_SESSION[id])");
		}
		else
			echo '<strong>Error en la conexion a la base de datos</strong>';
	}
}

if(isset($_POST['final']))
{
	if(isset($_FILES['archivo']))
	{
		 
		if ( !is_dir ( "files/"."$_SESSION[id]") )
			mkdir( "files/"."$_SESSION[id]", 0775);
		 
		if ( !is_dir ( "files/"."$_SESSION[id]"."/final") )
			mkdir( "files/"."$_SESSION[id]"."/final", 0775);
		 
		 
		$archivo = basename( $_FILES['archivo']['name']);
		$target_path = "files/"."$_SESSION[id]"."/final/".$archivo;
		
		if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path))
		{
			chmod($target_path, 0770);
			chgrp($target_path, "nobody");
		}
		
		$conexion= @DBConnect('new_fayol');
		
		if(!empty($conexion)) //Si hay conexion
		{
			$result = db_query ("INSERT INTO imagen(nombre_archivo, descripcion, tipo, noproyecto) VALUES ('$archivo', '$_POST[descripcion]', 'final', $_SESSION[id])");
		}
		else
			echo '<strong>Error en la conexion a la base de datos</strong>';
	}
}


if(isset($_POST['terminar']))
{
	unset ($_SESSION['images']);
	unset ($_SESSION['id']);
	
	?>
	<script language="JavaScript">
	location.href='./index.php';
	</script>		
	<?
	
}

if ( isset($_SESSION['proyectos']) && isset($_SESSION['images']) &&  isset($_SESSION['id']) )
{
	?><H1>Inicio del Proyecto</H1><?


	$conexion= @DBConnect('new_fayol');
	
	if(!empty($conexion))
	{
		$result = db_query ("SELECT * FROM imagen WHERE noproyecto = $_SESSION[id] AND tipo = 'inicial'");
		
		$num_rows = pg_num_rows($result);
		
		if ( $num_rows != 0 )
		{
			?>
	
				<table width="100%">

				
			<?
			for ( $i=0; $i < $num_rows; $i++ )
			{
				$img = pg_fetch_object($result, $i);
				
				?>
				<tr>
					<td width="20%"><img src="./files/<?=$_SESSION[id]?>/inicial/<?=$img->nombre_archivo?>" width="160" height="120">
					<td width="80%"><p><a href="images.php?noimagen=<?=$img->noimagen?>&tipo=del&modo=<?=$img->tipo?>&nombre=<?=$img->nombre_archivo?>">Eliminar</a></p><p><strong>Descripci&oacute;n: </strong><?=$img->descripcion?></p></td>
				  </tr>
				<?
			}
			?>
				</table>
			<?
		}
	}
	
	
	?>
	<form name="form1" method="post" enctype="multipart/form-data" action="images.php">
	<table width="267" border="0">
	  <tr>
		<td width="72">Archivo</td>
		<td width="185">
		  <INPUT TYPE="file" NAME="archivo" accept="image/jpeg">
		</td>
	  </tr>
	  <tr>
		<td>Descripci&oacute;n</td>
		<td><textarea name="descripcion"></textarea></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td><input name="inicio" type="submit" id="inicio" value="Guardar">
	  </tr>
	</table>
	</form>


	<H1>Final del Proyecto</H1><?


	$conexion= @DBConnect('new_fayol');
	
	if(!empty($conexion))
	{
		$result = db_query ("SELECT * FROM imagen WHERE noproyecto = $_SESSION[id] AND tipo = 'final'");
		
		$num_rows = pg_num_rows($result);
		
		if ( $num_rows != 0 )
		{
			?>
	
				<table width="100%">

				
			<?
			for ( $i=0; $i < $num_rows; $i++ )
			{
				$img = pg_fetch_object($result, $i);
				
				?>
				<tr>
					<td width="20%"><img src="./files/<?=$_SESSION[id]?>/final/<?=$img->nombre_archivo?>" width="160" height="120">
					<td width="80%"><p><a href="images.php?noimagen=<?=$img->noimagen?>&tipo=del&modo=<?=$img->tipo?>&nombre=<?=$img->nombre_archivo?>">Eliminar</a></p><p><strong>Descripci&oacute;n: </strong><?=$img->descripcion?></p></td>
				  </tr>
				<?
			}
			?>
				</table>
			<?
		}
	}
	
	
	?>
	<form name="form1" method="post" enctype="multipart/form-data" action="images.php">
	<table width="267" border="0">
	  <tr>
		<td width="72">Archivo</td>
		<td width="185">
		  <INPUT TYPE="file" NAME="archivo" accept="image/jpeg">
		</td>
	  </tr>
	  <tr>
		<td>Descripci&oacute;n</td>
		<td><textarea name="descripcion"></textarea></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td><input name="final" type="submit" id="inicio" value="Guardar">
	  </tr>
	</table>
	<p>
	  <input type="submit" name="terminar" value="Finalizar">
	</p>
	</form>

    <?

}
else
{
	?>
           <strong>No tiene acceso a esta p&aacute;gina</strong>
     <?
}

	PageEnd();
?>