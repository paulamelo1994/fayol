<?

	session_start();
	
	require "../functions.php";
	$rootPath = "..";
	$editar_id = 0;
	
	if(isset($_GET['item']))
		$item = $_GET['item'];
	else
		$item=1;

	if(isset($_POST['entrar']))
	{
		if($_POST['passwd'] == 'guille' || $_POST['passwd'] == 'luisxx')
			$_SESSION['banners'] = true;
	}
	
	if($item==5)
	{
		unset($_SESSION['banners']);
		header("Location: cambiar.php");
		die();
	}
   	$hoy = date("Y-n-j H:i:s");

	PageInit("Banners Publicadas", 'menu.php');
	
	

	if(isset($_SESSION['banners']))
	{
		switch($item)
		{
			case 1:
				if(isset($_GET['id']) && isset($_GET['esconder']))
				{
					$idNoticia=$_GET['id'];
					if($_GET['esconder']==0)
					{
						$conexion= @DBConnect('fayol');
						
						if(!empty ($conexion)) //Si hay conexion
						{
							db_query("update banners set visible='false'");
							db_query("update banners set visible='true' where id='".$idNoticia."'");
						}
						else
						{
							echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible publicar la noticia solicitada, por favor intentelo m&aacute;s tarde.</p>";
						}
					}
					if($_GET['esconder']==1)
					{
						$conexion= @DBConnect('fayol');
						
						if(!empty ($conexion)) //si hay conexion
						{
							db_query("update banners set visible='false'");
						}
						else
						{
							echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible esconder la noticia solicitada, por favor intentelo m&aacute;s tarde.</p>";
						}
						
					}
				}
				?>
				<h1 class="shiny">Lista de Banners</h1>
				<div align="right"><a href="cambiar.php?item=5">Cerrar sesión</a></div>
				<br>
				Por favor, tenga presente que solo se publica un banner a la
				vez, por esto solo estara visible un banner a la vez.<br>
				<br>
				<?
				$con = @DBConnect('fayol');
				
				$c = db_query("SELECT * FROM banners where visible=true;");
				$n = pg_num_rows($c);
				if($n == 0)
				{
					?>
					<script language="javascript" type="text/javascript">
					alert("No ha ningun banner activo. Por favor ACTIVE UN BANNER.");
					</script>
					<?
				}
				
				if(!empty($con)) //Si hay conexion
				{
					$res = db_query("SELECT * FROM banners order by visible desc;");
					$numrows = pg_num_rows($res);
					
					if($numrows != 0)
					{
						?>
						<table width="100%" cellspacing="2" align="center">
						<tr bgcolor="#CC0000">
							<th>TÍTULO</th>
							<th>FECHA</th>
							<th>ESTADO</th>
							
						</tr>
						<?
						for($i = ($numrows - 1); $i >=  0; $i--)
						{
							$obj = pg_fetch_object($res);
							echo "<tr bgcolor=".($i%2? '"#bcbcbc">' : '"#dfdfdf">');
							
							?> 
							<td>
							
							<a href="<?=makeURL($obj->ubicacion)?>"><?=$obj->titulo?></a>
							
							</td> 
							<td><center><?=$obj->fecha?></center></td>
							<?
							$visible=$obj->visible;
							
							if($visible=='f')
							{
								?>
								<td>Oculto, 
								<a href="cambiar.php?item=1&amp;id=<?=$obj->id?>&amp;esconder=0">Publicar</a>
								
								<?
							}
							if($visible=='t')
							{
								?>
								<td>Visible, 
								<a href="cambiar.php?item=1&amp;id=<?=$obj->id?>&amp;esconder=1">Esconder</a>
								
								<?
							}
							echo "</tr>";
						}
						?>
							
						</table>
						<?
					}
					else
					{
						echo "Aun no hay banners.";
					}
				}
				else
				{
					echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible listar las noticias, por favor intentelo m&aacute;s tarde.</p>";
				}
				break;
			case 3:
				if(isset($_FILES['archivo']))
				{
					$target_path = basename( $_FILES['archivo']['name']);			
					if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path))
					{
						chmod($target_path, 0770);
						chgrp($target_path, "nobody");
						DBConnect('fayol');
						$rs=db_query('SELECT count(id) FROM banners');
						$id=intval(pg_fetch_object($rs));
						db_query("update banners set visible='false'");
						db_query("insert into banners(titulo, ubicacion, fecha, visible) values('$_POST[titulo]', '$target_path', '$hoy', 'true')");
						echo "El archivo ". basename( $_FILES['archivo']['name']). " se ha guardado.";
						?>
						<br><? echo $target_path;?><br><a href="cambiar.php">Aceptar</a>
						<?
					}
					else
					{
						echo $_FILES['archivo']['tmp_name'];
						echo "Se ha presentado un error al cargar el archivo, inténtelo de nuevo!"  .$_FILES['archivo']['name'];
						?>
						<br><br>
						<div align="center"><a href="cambiar.php?item=3">Volver</a></div>
						<?
						unset($_FILES['archivo']);
					}
				}
				else
				{
					?>
					<h1 class="shiny">Adicionar Banner </h1>
					<div align="right"><a href="cambiar.php?item=5">Cerrar sesión</a></div>
					<br>
					Recuerde que los banners son de extensi&oacute;n SWF.
					<br><br>
					
					<FORM METHOD="POST" enctype="multipart/form-data" action="">
					<table width="70%" cellspacing="2" align="center" border="0">
					<tr>
						<td><div align="left">T&iacute;tulo del Banner </div></td>
						<td><div align="left"><input type='text' name='titulo'></div></td>
					</tr>
					<tr>
						<td>Ruta del archivo </td>
						<td><div align="left"><input type="hidden" name="MAX_FILE_SIZE" value="100000000000000" >
						<INPUT TYPE="file" NAME="archivo" accept="swf"></div>
						</td>
					</tr>
					<tr><td colspan="2"><br><br></td></tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" value="Cargar archivo"></td>
					</tr>
					</table>
					</FORM>
					<?
				}
				break;
		}
	}
	else
	{
		?>
		<h1 class="shiny">Autenticaci&oacute;n requerida</h1>
		<b>Para tener acceso al modulo de publicaci&oacute;n de banners en nuestra
		p&aacute;gina
		digite a  continuaci&oacute;n su password.</b>
		<br>
		<br>
		<div align="center">
		<form method="post" action="">
		<input type="password" name="passwd" size="8">
		<br><br>
		<input type="submit" value="Entrar" name="entrar">
		</form>
		</div>
		<?
	}
	
	PageEnd();
?>