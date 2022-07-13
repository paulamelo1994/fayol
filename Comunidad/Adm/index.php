<?
	session_start();

   require '../../functions.php';
   $rootPath = '../../';
   
   $valign = 'top';
   $centrar_contenido = false;
   /*
   $_GET['submenu_actas'] = true;
   $_GET['conceptos_juridicos'] = true;
   */
   
   if(@$_GET['item']==5)
	{	
	  unset($_SESSION['concepJuridos']);
	  session_destroy();
      header("Location: /Comunidad/Adm/index.php");
	  die();
	}
   
   $_GET['conceptos_juridicos'] = false;
   
   PageInit('Administraci&oacute;n', '../menu.php', 'left', 'top');
   
   
   
   
	if(isset($_POST['entrar']))
	{
		$conexion= @DBConnect('new_fayol');
		
		if(!empty($conexion)) //Si hay conexion
		{
			$res = db_query("SELECT * FROM usuario where nick= '$_POST[nick]' and clave = '$_POST[clave]'");
			$numrows = pg_num_rows($res);

			if ( $numrows == 1 )
				$_SESSION['concepJuridos'] = true;
			else
				echo "<strong>Aceeso no permitido.</strong>";
		}
	}
	
	
	if(isset($_SESSION['concepJuridos']))
	{
		if(isset($_FILES['archivo']))
		{
			$target_path = basename( $_FILES['archivo']['name']);

			// echo "alert ( $target_path );";
			
			$ruta = "/usr/local/fayol/Comunidad/Actas/Juridico/";
					
			if(move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta.$target_path)) 
			{
			
				chmod($ruta.$target_path, 0770);
				chgrp($ruta.$target_path, "nobody");
				DBConnect('new_fayol');

				
				db_query("insert into concepto_juridico(asunto, fecha, origen, visible, direccion ) values('$_POST[asunto]', '$_POST[fecha]', '$_POST[origen]' , true, '$target_path')");
				
				echo "El archivo ". basename( $_FILES['archivo']['name']). " se ha guardado.";
				?>
<style type="text/css">
<!--
.Estilo2 {font-size: 24px}
-->
</style>

				<br><br><a href="index.php">Aceptar</a>
				<?
			}
			else
			{
				echo $_FILES['archivo']['tmp_name'];
				echo "Se ha presentado un error al cargar el archivo, inténtelo de nuevo!"  .$_FILES['archivo']['name'];
				?>
				<br><br>
				<div align="center"><a href="index.php?item=2">Volver</a></div>
				<?
				unset($_FILES['archivo']);
			}
		}
		else
		{
			?>
			<br>
			<div align="center" style="color: #CC3300; font-size:22px; font-weight:bold;" >
			Administracion Documentos Jurídicos
			</div>
			<br>
			<p><a href="/Comunidad/Adm/index.php?item=5">Cerrar sesión</a></p>
			<br>
			<div align="center">
			<form action="" method="post" enctype="multipart/form-data" name="form1">
				
					<center>
					  <table width="38%"  border="0">
						<tr>
						  <td width="20%"><strong>Asunto</strong></td>
						  <td width="80%">
							<textarea name="asunto" cols="50" id="asunto"></textarea>
										  <span class="Estilo2"></span></td>
						</tr>
						<tr>
						  <td><strong>Fecha</strong></td>
						  <td><span class="Estilo2">
							<input name="fecha" type="text" id="fecha">
						  </span></td>
						</tr>
						<tr>
						  <td><strong>Origen</strong></td>
						  <td><span class="Estilo2">
							<input name="origen" type="text" id="origen" size="50">
						  </span></td>
						</tr>
						<tr>
						  <td><strong>Archivo</strong></td>
						  <td><input name="archivo" type="file" id="archivo" size="50"></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td><input type="submit" name="Submit" value="Publicar"></td>
						</tr>
					  </table>
			  </center>
			</form>
			</div>
			
			<h1 class="shiny">Lista de Archivos</h1>
		
			<?
			$con = @DBConnect('new_fayol');
			
			if(!empty($con)) //Si hay conexion
			{
				$res = db_query("SELECT * FROM concepto_juridico order by fecha desc;");
				$numrows = pg_num_rows($res);
				
				if($numrows != 0)
				{
					?>
					<table width="100%" cellspacing="2" align="center">
					<tr bgcolor="#CC0000">
						<th width="40%">Asunto</th>
						<th width="20%">Fecha</th>
						<th width="30%">Origen</th>
						<th width="10%">Visible</th>
						
					</tr>
					<?
					for($i = ($numrows - 1); $i >=  0; $i--)
					{
						$obj = pg_fetch_object($res);
						echo "<tr bgcolor=".($i%2? '"#bcbcbc">' : '"#dfdfdf">');
						
						?> <td><?=$obj->asunto?>
						<td><?=$obj->fecha?></td>
							<td><?=$obj->origen?></td>
							<td></td></tr>
							
						<?
						/*
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
					*/
						
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
		if ( getIP()==IP_ANGELA or getIP()==IP_GUILLERMO or getIP()=='192.168.220.213')
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
		else
		{
			?>
			<p>Sistema de Administraci&oacute;n de Fayol</p>
			<?
		}
	}
	
   
   PageEnd();
?>