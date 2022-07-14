<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: bitacora.php
	Objetivo: Formulario de registro de bitacora despues de una sesion. Guarda las actividades y autoevaluacion
				del usuarios.
	Autor: Angela Benavides
	Año: 2007
	*********************************************************/
	
	session_start();
	
	if(!isset($_SESSION['usuario']))
	{
		header("Location: /Comunidad/Idiomas/index.php");
		die();
	}
	
	require "../../functions.php";
	$rootPath = "../..";
	
	if($_POST['cancelar'])
	{
		header("Location: /Comunidad/Idiomas/index.php");
		die();
	}
	
	$_GET['submenu_idiomas'] = true;
	
	$fecha = date('Y')."-".date('m')."-".date('d');
	
	PageInit("Bit&aacute;cora", "../menu.php", "left", "top", "ajax");
	
	if($_POST['aceptar'])
	{
		if(empty($_POST['idioma']) || empty($_POST['nivel']) || empty($_POST['practica']) || empty($_POST['autoevaluacion']))
		{
			$_POST['vacios'] = true;
		}
		else
		{
			if($_POST['practica'] == 'Guiada' && empty($_POST['profesor']))
			{
				$_POST['llenarProfesor'] = true;
			}
			else
			{
				$hora = date(G).":".date(i).":".date(s);
				
				$conexion = DBConnect('idiomas');
				
				if(!$conexion)
				{
					echo "No se pudo conectar con la BD.";
				}
				else
				{
					$fallo = false;
					
					db_query('begin');
					
					$rs = @db_query("insert into sesion (fecha, hora_registro, cod_estudiante, plan, idioma, nivel, tipo_practica, profesor, autoevaluacion) values('$fecha', '$hora', '{$_SESSION[usuario][codigo]}', '{$_SESSION[usuario][carrera]}', '$_POST[idioma]', '$_POST[nivel]', '$_POST[practica]', '$_POST[profesor]', '$_POST[autoevaluacion]')");
					if(!$rs)
						$fallo = true;
										
					$rs = @db_query("select last_value from sesion_seq");
					$obj = pg_fetch_object($rs);
					$sesion_id = $obj->last_value;
					
					for($i = 0; $i < $_GET['num_actividades']; $i++)
					{
						$actividad = $_POST[material.$i];
						
						$rs = @db_query("insert into actividad (sesion, actividad, descripcion, resultado) values($sesion_id, '$actividad', '{$_POST[descripcion][$i]}', '{$_POST[resultado][$i]}')");
						if(!$rs) $fallo = true;
					}
					
					if($fallo)
					{
						db_query('rollback');
						$_POST['noGuardo'] = true;
					}
					else
					{
						db_query('commit');
						$_POST['guardo'] = true;
					}
				}
			}
		}
	}

	if(!isset($_GET['num_actividades']))
	{
		?>
		<h1 class="shiny">Bit&aacute;cora</h1>
		<form name="actividades" enctype="multipart/form-data" method="post" action="">
		<table width="90%" border="0" align="center">
		<tr><td colspan="2"><h3>Antes de registrar su bit&aacute;cora usted debe ingresar el n&uacute;mero de 
		actividades que realiz&oacute; durante esta sesi&oacute;n.</h3></td></tr>
		<tr>
			<td align="center"><h3>Numero de Actividades:</h3>
				<select name="num_actividades">
				<option>Actividades</option>
				<?
				for($i = 1; $i < 10; $i++)
					echo "<option onClick=\"document.location.href='bitacora.php?num_actividades=$i'\">$i</option>";
				?>
				</select>
			</td>
		</tr>
		</table>
		</form>
		<?
	}
	else
	{
		$num_actividades = $_GET['num_actividades'];
		?>
		<form name="bitacora" enctype="multipart/form-data" method="post" action="">
		<table width="80%" border="0" align="center">
		<tr>
			<td colspan="2" class="titulosContenidoInternoCentrado"><?=makeDate($fecha)?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td colspan="2" class="titulosContenidoInterno">
			Idioma:&nbsp;
			<select name="idioma">
				<option>&nbsp;</option>
				<option <? if($_POST['idioma'] == 'Inglés') echo "selected"; ?>>Ingl&eacute;s</option>
				<option <? if($_POST['idioma'] == 'Francés') echo "selected"; ?>>Franc&eacute;s</option>
				<option <? if($_POST['idioma'] == 'Alemán') echo "selected"; ?>>Alem&aacute;n</option>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Nivel:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="nivel" size="20" value="<?=$_POST['nivel']?>">
			</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td width="20%" class="titulosContenidoInterno">C&oacute;digo</td>
			<td><input readonly type="text" name="codigo" size="20" value="<?=$_SESSION['usuario']['codigo']?>"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno" width="20%">Nombre:</td>
			<td><input readonly type="text" name="nombre" size="50" value="<?=$_SESSION['usuario']['nombre']?>"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Carrera:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td><input readonly type="text" name="carrera" size="50" value="<?=$_SESSION['usuario']['carrera']?>"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td colspan="2" class="titulosContenidoInterno">
			Tipo Pr&aacute;ctica:&nbsp;
			<select name="practica">
				<option>&nbsp;</option>
				<option <? if($_POST['practica'] == 'Libre') echo "selected"; ?>>Libre</option>
				<option <? if($_POST['practica'] == 'Guiada') echo "selected"; ?>>Guiada</option>
			</select>
			</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Profesor:&nbsp;&nbsp;&nbsp;</td>
			<td><input type="text" name="profesor" size="50" value="<?=$_POST['profesor']?>"></td>
		</tr>
		</table>
		<br>
		<table align="center" border="0" cellpadding="1" cellspacing="1">
		<tr>
			<td colspan="9"><h1>ACTIVIDADES</h1></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td colspan="6" align="center"></td>
			<td colspan="3" class="titulosContenidoInternoCentrado"><i>Impresos</i></td>
		</tr>
		<tr>
			<td align="center" width="70"><img src="<?=$rootPath?>/Images/software.png" title="Software" width="40" height="40" alt=""></td>
			<td align="center" width="70"><img src="<?=$rootPath?>/Images/internet.png" title="Internet" width="40" height="40" alt=""></td>
			<td align="center" width="70"><img src="<?=$rootPath?>/Images/tv.png" title="T.V." width="40" height="40" alt=""></td>
			<td align="center" width="70"><img src="<?=$rootPath?>/Images/video.png" title="Video" width="40" height="40" alt=""></td>
			<td align="center" width="70"><img src="<?=$rootPath?>/Images/fonorevista.png" title="Fonorevista" width="40" height="40" alt=""></td>
			<td align="center" width="70"><img src="<?=$rootPath?>/Images/casete.png" title="Audio" width="40" height="40" alt=""></td>
			<td align="center" width="70"><img src="<?=$rootPath?>/Images/diccionario.png" title="Diccionario" width="40" height="40" alt=""></td>
			<td align="center" width="70"><img src="<?=$rootPath?>/Images/metodos.png" title="Metodos" width="40" height="40" alt=""></td>
			<td align="center" width="70"><img src="<?=$rootPath?>/Images/fichas.png" title="Fichas Pedag&oacute;gicas" width="40" height="40" alt=""></td>
		</tr>
		<tr>
			<td align="center">1.<br>Software</td>
			<td align="center">2.<br>Internet</td>
			<td align="center">3.<br>TV</td>
			<td align="center">4.<br>Video</td>
			<td align="center">5.<br>Fonorevista</td>
			<td align="center">6.<br>Audio</td>
			<td align="center">7a.<br>Diccionario</td>
			<td align="center">7b.<br>M&eacute;todos</td>
			<td align="center">7c.<br>Fichas Pedag&oacute;gicas</td>
		</tr>
		</table>
		<br><br>
		<table border="1" cellpadding="1" cellspacing="0" width="100%" align="center">
		<tr>
			<td class="titulosContenidoInternoCentrado" width="30%" valign="top">Actividad</td>
			<td class="titulosContenidoInternoCentrado" width="30%" valign="top">Material</td>
			<td class="titulosContenidoInternoCentrado" width="30%" valign="top">Breve descripci&oacute;n del trabajo y observaciones</td>
			<td class="titulosContenidoInternoCentrado" width="10%" valign="top">Resultado
			</td>
		</tr>
		<?
			for($i = 0; $i < $num_actividades; $i++)
			{
				?>
				<tr>
					
					<td align="center" valign="top">
						<?
						#Aqui se consulta lo que deseamos que salga en el select siguiente
						$conexion = DBConnect('idiomas');
			
						if(!$conexion)
							echo "No se logro la conexi&oacute;n con la BD.";
						else
						{
							$rs = db_query(" SELECT distinct(tipo) as nombre, codigo from material");
							?>
							<div id="select<?=$i?>_1">
							<select id="actividad<?=$i?>" name="actividad<?=$i?>" onChange='createSelect("actividad<?=$i?>", "material", "codigo", "select<?=$i?>_2", "material<?=$i?>", "indice", "nombre", "<?=$rootPath?>");'>
								<option>&nbsp;</option>
								<?
								for($j = 0; $j < 6; $j++)
								{
									echo "<option>".($j+1)."</option>";
								}
								?>
								<option>7a</option>
								<option>7b</option>
								<option>7c</option>
							</select>
							</div>
							<?
						}
						?>
					</td>
					<td align="center" valign="top">
					<div id="select<?=$i?>_2">
					<select name="material[]">
					<?
					
					if(!isset($_POST[actividad][$i]))
						echo "<option>&nbsp;</option>";
					else
					{
						$conexion = DBConnect("idiomas");
					
						if($conexion)
						{
							$rs = db_query("select * from material where codigo = '{$_POST[actividad][$i]}'");
							
							echo "<option>&nbsp;</option>";
							while($obj = pg_fetch_object($rs))
							{
								echo "<option ";
								if($_POST[material][$i] == $obj->nombre) echo "selected";
								echo " >$obj->nombre</option>";
							}
						}
					}
					?>
					</select>
					</div>
					</td>
					<td align="center" valign="top"><textarea name="descripcion[]" rows="2" cols="16"></textarea></td>
					<td align="center" valign="top">
						<select name="resultado[]">
						<option>&nbsp;</option>
						<option>Completa</option>
						<option>Guiada</option>
						</select>
					</td>
				</tr>
				<?
			}
		?>
		</table>
		<br><br>
		<table width="100%" border="0">
		<tr><td colspan="3"><h3>Autoevaluaci&oacute;n</h3></td></tr>
		<tr>
			<td align="center"><img src="<?=$rootPath?>/Images/bien.png" title="Bueno" alt=""></td>
			<td align="center"><img src="<?=$rootPath?>/Images/masOMenos.png" title="Regular" alt=""></td>
			<td align="center"><img src="<?=$rootPath?>/Images/mal.png" title="Insuficiente" alt=""></td>
		</tr>
		<tr>
			<td align="center"><input <? if($_POST['autoevaluacion'] == 'Bueno') echo "checked"; ?> type="radio" name="autoevaluacion" value="Bueno"></td>
			<td align="center"><input <? if($_POST['autoevaluacion'] == 'Regular') echo "checked"; ?> type="radio" name="autoevaluacion" value="Regular"></td>
			<td align="center"><input <? if($_POST['autoevaluacion'] == 'Insuficiente') echo "checked"; ?> type="radio" name="autoevaluacion" value="Insuficiente"></td>
		</tr>
		</table>
		<br><br>
		<table width="90%" align="center">
			<tr>
				<td align="center">
					<input type="submit" name="aceptar" value="Aceptar">
					&nbsp;&nbsp;
					<input type="submit" name="cancelar" value="Cancelar">
				</td>
			</tr>
		</table>
		</form>
		<?
	}
	
	if(isset($_POST['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe llenar los campos obligatorios!");
		</script>
		<?
	}
	
	if(isset($_POST['llenarProfesor']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Si su práctica es guiada debe ingresar el nombre del profesor!");
		</script>
		<?
	}
	
	if(isset($_POST['noGuardo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("No se registraron los datos! Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_POST['guardo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se registraron sus datos exitosamente.");
		location.href="index.php";
		</script>
		<?
	}
	
	PageEnd();
?>