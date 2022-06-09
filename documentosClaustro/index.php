<?
	//session_start();
	require "../../functions.php";
	$rootPath = "../..";
	
	session_start();
	
	if(!isset($_SESSION['sesionClaustro'])){
		header('Location: /Comunidad/documentosClaustro/autenticar.php');
	  die();
	}
	
	$editar_id = 0;
	if(isset($_GET['item']))
		$item = $_GET['item'];
	else
		$item=2;

	
	
	if(isset($_POST['editar']))
	{
		if( $_GET['id'] != 0 && $_POST['titulo'] !== "")
		{
			$conexion= @DBConnect('fayol');
			if( ($conexion)) //Si hay conexion
			{
				db_query('update documentoclaustro set titulo=\''.$_POST['titulo'].'\' where id='.$_GET['id']);
				$_GET['esconder']=1;
				
			}
			else
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible publicar el documento solicitado, por favor intentelo m&aacute;s tarde.</p>";
			}	
			$editar_id = 0;
		}
		
   	}
	
	
	switch($item)
	{
		case 1:
				PageInit("Documentos Claustro", "../menu.php");
				if(isset($_FILES['archivo']))
				{
					$target_path= basename($_FILES['archivo']['name']);			
					$direccion = 'documentos2/';
					if(move_uploaded_file($_FILES['archivo']['tmp_name'],$direccion.$_FILES['archivo']['name']))
					{
						chmod($direccion.$target_path, 0770);
						chgrp($direccion.$target_path, "nobody");
						//conexion a base de datos 
						$conexion= DBConnect('fayol');
						$date=date("Y-m-d");
						
						$rs=db_query("SELECT max(id) as ultimo FROM documentoclaustro");
						$id=intval(pg_fetch_object($rs));
						db_query("insert into documentoclaustro(titulo, ubicacion,fecha,visible) values('$_POST[titulo]', '$direccion$target_path','$date','false')");
						echo "El archivo ". basename( $_FILES['archivo']['name']). " se ha guardado.";
						?>
						<br><br><a href="index.php?item=1">Aceptar</a>
						<?
					}
					else
					{
						//echo $_FILES['archivo']['tmp_name'];
						echo "Se ha presentado un error al cargar el archivo, inténtelo de nuevo!"  
						//.$_FILES['archivo']['name'];
						?>
						<br><br>
						<div align="center"><a href="index.php?item=1">Volver</a></div>
						<?
						unset($_FILES['archivo']);
					}
				}
				else
				{
					?>
					<h1 class="shiny">Adicionar Documento</h1>
					<FORM METHOD="POST" enctype="multipart/form-data" action="">
					<table width="70%" cellspacing="2" align="center" border="0">
					<tr>
						<td><div align="left">T&iacute;tulo del documento</div></td>
						<td><div align="left"><input type='text' name='titulo'></div></td>
					</tr>
					<tr>
						<td>Ruta del archivo </td>
						<td><div align="left"><input type="hidden" name="MAX_FILE_SIZE" value="100000000000000">
						<INPUT TYPE="file" NAME="archivo"></div>
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
				
		case 2:
				PageInit("Documentos Claustro", "../menu.php");
				if(isset($_GET['id']) && isset($_GET['esconder']))
				{
					$idDocumento=$_GET['id'];
					$editar_id=0;
					$guardar = false;
					$editardoc = 0;
					if($_GET['esconder']==0)
					{
						$conexion= @DBConnect('fayol');
						
						if(!empty ($conexion)) //Si hay conexion
						{
							db_query('update documentoclaustro set visible=true where id='.$idDocumento);
						}
						else
						{
							echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible publicar el documento solicitado, por favor intentelo m&aacute;s tarde.</p>";
						}
					}
					if($_GET['esconder']==1)
					{
						$conexion= @DBConnect('fayol');
						
						if(!empty ($conexion)) //si hay conexion
						{
							db_query('update documentoclaustro set visible=false where id='.$idDocumento);
						}
						else
						{
							echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible esconder el documento solicitado por favor intentelo m&aacute;s tarde.</p>";
						}
						
					}
					
					
					if($_GET['esconder']==2)
					{
						$editar_id=$idDocumento;
					}
					
				}
				?>
				<h1 class="shiny">Lista de Documentos Claustro</h1>
				<br>
				<?
				$con = @DBConnect('fayol');
				
				if(!empty($con)) //Si hay conexion
				{
					$res = db_query("SELECT * FROM documentoclaustro order by fecha desc;");
					$numrows = pg_num_rows($res);
					
					if($numrows != 0)
					{
						?>
						<table width="100%" cellspacing="2" align="center">
						<tr bgcolor="#CC0000">
							<th>TÍTULO</th>
							<th>FECHA</th>
							<th>VISIBLE/OCULTO</th> 
							
						</tr>
						<?
						for($i = ($numrows - 1); $i >=  0; $i--)
						{
							$obj = pg_fetch_object($res);
							echo "<tr bgcolor=".($i%2? '"#bcbcbc">' : '"#dfdfdf">');
							
							?> <td><?
								
								
								if ($editar_id == $obj->id )
								{
									
									?>
									<FORM METHOD="POST" enctype="multipart/form-data" action="">
									<table width="99%" cellspacing="2" align="center" border="0">
									<tr>
										<td><textarea name="titulo" cols="50" rows="2" height="30"><?=$obj->titulo?>								
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
									?><a href="<?=makeURL($obj->ubicacion)?>" target="_blank"><?=$obj->titulo?></a><?
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
								<a href="index.php?item=2&amp;id=<?=$obj->id?>&amp;esconder=0">Publicar</a>
								
								<?
							}
							if($visible=='t')
							{
								?>
								<td>Visible, 
								<a href="index.php?item=2&amp;id=<?=$obj->id?>&amp;esconder=1">Esconder</a>
								
								<?
							}
							?>
								<br> 
								<a href="index.php?item=2&amp;id=<?=$obj->id?>&amp;esconder=2">Editar</a>
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
						echo "Aun no hay Documentos de Claustro publicados.";
					}
				}
				else
				{
					echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible listar las noticias, por favor intentelo m&aacute;s tarde.</p>";
				}
			break;
			
			
		}


?>