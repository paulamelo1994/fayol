<?
	session_start();

	require '../../functions.php';
	$root_path = "../..";
	$editar_id = 0;
	$_GET['submenu_coord_admin'] = true;
	

	if($item==5)
	{
		unset($_SESSION['coorAdmin']);
		header("Location: administrar.php");
		die();
	}
	
	$_GET['administrar'] = true;

  $valign = 'TOP';
  PageInit("Coordinaci&oacute;n Administrativa", "../menu.php", 8);
  
  

	if(isset ($_POST['editar']))
	{
		if( $_GET['id'] != 0 && $_POST['titulo'] !== "")
		{
			$conexion= @DBConnect('new_fayol');
			if( ($conexion)) //Si hay conexion
			{
				db_query('update archivo set nombre=\''.$_POST['titulo'].'\' where id='.$_GET['id']);
				
				$esconder=-1;
				
			}
			else
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible publicar la noticia solicitada, por favor intentelo m&aacute;s tarde.</p>";
			}	
			$editar_id = 0;
		}
		
	}


	if(isset($_POST['entrar']))
	{
		$conexion= @DBConnect('new_fayol');
		
		if(!empty($conexion)) //Si hay conexion
		{
			//$res = db_query("SELECT * FROM usuario where nick= '$_POST['nick']' and clave = '$_POST['nick']';");
			
			$res = db_query("SELECT * FROM usuario where nick= '$_POST[nick]' and clave = '$_POST[clave]'");
			$numrows = pg_num_rows($res);

			if ( $numrows == 1 )
				$_SESSION['coorAdmin'] = true;
			else
				echo "<strong>Aceeso no permitido.</strong>";
		}
	}

	if(isset($_SESSION['coorAdmin']))
	{
		if(isset($_FILES['archivo']))
		{

			$target_path = basename( $_FILES['archivo']['name']);
					
			if(move_uploaded_file($_FILES['archivo']['tmp_name'], '/usr/local/fayol/Comunidad/CoordinacionAdministrativa/'.$target_path))
			{
				chmod($target_path, 0755);
				chgrp($target_path, "nobody");
				DBConnect('new_fayol');
				//$rs=db_query('SELECT count(id) FROM archivo');
				//$id=intval(pg_fetch_object($rs));
				db_query("insert into archivo(nombre, descripcion, direccion, id_categoria, visible ) values('$_POST[titulo]', '$_POST[titulo]', '$target_path', 1, true)");
				printOK("El archivo ". basename( $_FILES['archivo']['name']). " se ha guardado.");
				?>

				<br><br><a href="administrar.php">Aceptar</a>
				<?
			}
			else
			{
				echo $_FILES['archivo']['tmp_name'];
				echo "Se ha presentado un error al cargar el archivo, int&eacute;ntelo de nuevo!"  .$_FILES['archivo']['name'];
				?>
				<br><br>
				<div align="center"><a href="index.php?item=2">Volver</a></div>
				<?
				unset($_FILES['archivo']);
			}
		}
		else
		{
				if ( $item == 1  && $esconder == 1 )
				{
					$conexion= @DBConnect('new_fayol');
					
					if(!empty ($conexion)) //si hay conexion
					{
						db_query('update archivo set visible=false where id='.$id);
					}
					else
					{
						echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible esconder la noticia solicitada, por favor intentelo m&aacute;s tarde.</p>";
					}
				}
				
				if( $item == 1 && $esconder == 0 )
				{
					$conexion= @DBConnect('new_fayol');
					
					if(!empty ($conexion)) //Si hay conexion
					{
						db_query('update archivo set visible=true where id='.$id);
					}
					else
					{
						echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible publicar la noticia solicitada, por favor intentelo m&aacute;s tarde.</p>";
					}
				}

					if($esconder==2)
					{
						$editar_id=$id;
					}
			?>
			<h1 class="shiny">Adicionar Noticia</h1>
			<div align="right">
			  <p><a href="index.php?item=5">Cerrar sesi&oacute;n</a></p>
			  <p align="left"><strong>Aseg&uacute;rese que el archivo a subir no contenga tildes ni e&ntilde;es (&ntilde;)</strong></p>
			</div>
			<FORM METHOD="POST" enctype="multipart/form-data" action="">
			  <table width="90%"  border="0">
				<tr>
				  <td width="22%">T&iacute;tulo de la noticia</td>
				  <td width="44%">Ruta del archivo </td>
				  <td width="34%">&nbsp;</td>
				</tr>
				<tr>
				  <td width="22%"><input type='text' name='titulo'></td>
				  <td width="44%"><input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
				  				<INPUT TYPE="file" NAME="archivo"/></td>
				  <td><div align="center">
					<input type="submit" value="Cargar archivo">
				  </div></td>
				</tr>
			  </table>
</FORM>
			<?
			
				$con = @DBConnect('new_fayol');
				
				if(!empty($con)) //Si hay conexion
				{
					$res = db_query("SELECT * FROM archivo where id_categoria = 1 order by fecha desc;");
					$numrows = pg_num_rows($res);
					
					if($numrows != 0)
					{
						?>
						<table width="100%" cellspacing="2" align="center">
						<tr bgcolor="#CC0000">
							<th width="50%">T&Iacute;TULO</th>
							<th width="30%">FECHA</th>
							<th width="20%">VISIBLE/OCULTO</th>
							
						</tr>
						<?
						for($i = ($numrows - 1); $i >=  0; $i--)
						{
							$obj = pg_fetch_object($res);
							echo "<tr bgcolor=".($i%2? '"#bcbcbc">' : '"#dfdfdf">');
							
							?> <td><?
								
								
								
								//if ( false )
								if ($editar_id == $obj->id && $esconder == 2 )
								{
									
									?>
									<FORM METHOD="POST" enctype="multipart/form-data" action="">
									<table width="99%" cellspacing="2" align="center" border="0">
									<tr>
										<td><textarea name="titulo" cols="50" rows="2" height="30"><?=$obj->nombre?>								
										</textarea></td>
										<td ><input name="editar" type="submit" value="Editar"></td>
									</tr>
									</table>
									</FORM>
									<?
									//$editar_id = 0;
								}
								else
								{
									?><?=$obj->nombre?><?
								}
								?>
							
							</td> 
							<td><center><?=$obj->fecha?></center></td>
							<?
							$visible=$obj->visible;
							
							if($visible=='f')
							{
								?>
								<td>Oculto, 
								<a href="administrar.php?item=1&amp;id=<?=$obj->id?>&amp;esconder=0">Publicar</a>
								
								<?
							}
							if($visible=='t')
							{
								?>
								<td>Visible, 
								<a href="administrar.php?item=1&amp;id=<?=$obj->id?>&amp;esconder=1">Esconder</a>
								
								<?
							}
							?>
								<br> 
								<a href="administrar.php?item=1&amp;id=<?=$obj->id?>&amp;esconder=2">Editar</a>
								</td>
								<?
							echo "</tr>";
						}
						?>
							
						</table>
						<?
					}
					else
					{
						echo "Aun no hay noticias publicadas.";
					}
				}
				else
				{
					echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible listar las noticias, por favor intentelo m&aacute;s tarde.</p>";
				}
		}
	}
	else
	{
		?>
		<h1 class="shiny">Autenticaci&oacute;n requerida</h1>
		<b>Para tener acceso al modulo de publicaci&oacute;n digite a 
		continuaci&oacute;n su login y password.</b>
		<br><br>
		<div align="center">
		<form method="post" action="">
		  <table width="50%"  border="0">
			<tr>
			  <td>Usuario</td>
			  <td><input name="nick" type="text" id="nick"></td>
			</tr>
			<tr>
			  <td>Contrase&ntilde;a</td>
			  <td><input name="clave" type="password" id="clave"></td>
			</tr>
		  </table>
		<input type="submit" value="Entrar" name="entrar">
		</form>
		</div>
			<?
	}

  PageEnd();
?>