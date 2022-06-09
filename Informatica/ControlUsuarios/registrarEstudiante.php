<?
	/********************************************************
	Aplicacion: Control Salas
	Archivo: registrarEstudiante.php
	Objetivo: Modulo mediante el cual se ingresa a un estudiante usuario de las salas al sistema. El monitor debe
				ingresar los datos del estudiante:
				- Codigo
				- Nombre(s)
				- Apellido(s)
				- Tipo de Documento:
					* Cedula de Ciudadania
					* Contrase&ntilde;a
					* Tarjeta de Identidad
				- Codigo del plan que estudia
	Autor: Angela Benavides
	A&ntilde;o: 2006
	*********************************************************/

	session_start();
	
	if(!isset($_SESSION['monitor']))
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/control.php");
		die();
	}
	
	$rootPath = '../../..';
	require '../../../functions.php';
	date_default_timezone_set('GMT-4'); //Establece zona horaria, evita desfaces
	$_GET['submenu_control'] = true;
	
	$sala = $_SESSION['idsala'];
	if( $sala == 'auditorio')
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/salir.php");
	}
	
	if($_POST["aceptar"])
	{
	
		if(empty($_POST['codigo']) || empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['apellidos']) || empty($_POST['tipodoc']) || empty($_POST['nodoc']) || empty($_POST['codplan']))
			$_GET['vacios'] = true;
		else if(!is_numeric($_POST['codigo']) || !is_numeric($_POST['nodoc']) || !is_numeric($_POST['codplan']))
			$_GET['no_numero'] = true;
		else
		{
			$conexion = DBConnect('controlsalas');
			
			$rs = db_query("select * from estudiantes where codigo = '$_POST[codigo]'");
			
			
			if(pg_num_rows($rs) != 0 )
			{
				?>
					<script language="javascript" type="text/javascript">
					alert("El codigo del estudiante ya esta registrado en la base de datos");
					</script>
				<?
			}
			else
			{	
				$plan = db_query("select * from planes where codigo='$_POST[codplan]'");
				$cc = db_query("select * from estudiantes where nodoc='$_POST[nodoc]'");
				if(pg_num_rows($plan) == 0 )
				{
					?>
					<script language="javascript" type="text/javascript">
					alert("El plan del estudiante no existe.");
					</script>
					<?
				}
				else /*if(pg_num_rows($cc) != 0 )*/ if( false )
				{
					?>
					<script language="javascript" type="text/javascript">
					alert("Ya existe un estudiante con el n&uacute;mero de documento que se ingreso.");
					</script>
					<?
				}
				else
				{
					$quer2 = db_query("select * from planes where codigo='$plan'");
					if(quer2)
					{
						$cod=pg_escape_string($_POST['codigo']);
						$cod2=pg_escape_string($_POST['codplan']);
						$login=$cod."-".$cod2;
						$nom=pg_escape_string($_POST['nombre']);
						$ape=pg_escape_string($_POST['apellidos']);
						$pass=strtoupper($nom[0].$_POST['nodoc'].$ape[0]);
						
						$rs = db_query("insert into estudiantes (codigo, nombres, apellidos, correo_electronico, tipodoc, nodoc, codplan,login,password) values (
						'$_POST[codigo]', '$_POST[nombre]', '$_POST[apellidos]', '$_POST[email]','$_POST[tipodoc]', '$_POST[nodoc]', '$_POST[codplan]','$login','$pass')
						");
						if(!$rs)
						{
							?>
							<script language="javascript">
							alert("Ha ocurrido un error al procesar el registro.");
							history.back(1)
							</script>");
							<?
						}
						else if($rs)
						{
							?>
							<script language="javascript">
							alert("Se ha registrado al estudiante.");
							</script>
							
							<script language="javascript">
							location.href="registrarEstudiante.php?registrado=true";
							</script>
							<?
							
							
						}
					}
					else
					{
						?>
						<script language="javascript">
						alert("El codigo de plan que ha ingresado no se encuentra registrado. Comuniquese con el webmanager.");
						history.back(1)
						</script>");
						<?
					}
					
					
					
					/*if(!$rs)
					{
						?>
						<script language="javascript">
						alert("Ha ocurrido un error al procesar el registro.");
						history.back(1)
						</script>");
						<?
					}
					else if($rs)
					{
						?>
						<script language="javascript">
						location.href="registrarEstudiante.php?registrado=true";
						</script>
						<?
					}*/
				}
			}
		}
	}
	
	if($_POST["limpiar"])
	{
		PageInit("Registrar Estudiante Sala $sala", "menu.php");
		?>
		<h2 class="shiny" align="center">Registrar Visitante</h2>
		<form method="post"  name="registrarEstudiante" action="" enctype="multipart/form-data">
		<table width="90%" align="center">
		<tr>
				<td class="titulosContenidoInterno">Codigo Visitante:</td>
				<td><input type="text" name="codigo" size="15"  maxlength="15" value="<?=$_POST['codigo']?>"></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Nombre(s) Visitante:</td>
				<td><input type="text" name="nombre" size="30" value="<?=$_POST['nombre']?>"></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Apellidos Visitante:</td>
				<td><input type="text" name="apellidos" size="30" value="<?=$_POST['apellidos']?>"></td>
		</tr>
                <tr>
				<td class="titulosContenidoInterno">Email:</td>
				<td><input type="text" name="email" size="30" value="<?=$_POST['email']?>" ></td>
		</tr>
		<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">Tipo Doc:</td>
				<td>
				<select name="tipodoc" title="Tipo Documento">
				<option selected>&nbsp;</option>
				<option <? if($_POST['tipodoc'] == 'C.C') echo "selected"; ?>>C.C</option>
				<option <? if($_POST['tipodoc'] == 'C.R') echo "selected"; ?>>C.R</option>
				<option <? if($_POST['tipodoc'] == 'T.I') echo "selected"; ?>>T.I</option>
				</select>
				</td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">No. Documento:</td>
				<td><input type="text" name="nodoc" size="30" value="<?=$_POST['nodoc']?>"></td>		
			</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Codigo Plan:</td>
				<td><input type="text" name="codplan" size="30" value="<?=$_POST['codplan']?>"> *poner 1111 si es profesor</td>
                                
		</tr>
		<tr><td><br></td></tr>
		<tr valign="bottom" align="center">
			<td colspan="2" height="50" valign="top">
			<input type="submit" name="aceptar" value="Aceptar">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="reset" name="limpiar" value="Limpiar">
			</td>
		</tr>
		</table>
		</form>
		<?
	}
	$fechaGuardada = $_SESSION['ultimoAcceso'];
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
	
	 if($tiempo_transcurrido >= 900 and getIP() != '192.168.221.63')
	 {
		session_destroy();
		header("Location: control.php");
	}
	
	else
	{
		PageInit("Registrar Estudiante Sala $sala", "menu.php");
		?>
		<h2 class="shiny" align="center">Registrar Visitante</h2>
		<form method="post"  name="registrarEstudiante" action="" enctype="multipart/form-data">
		<table width="90%" align="center">
		<tr>
				<td class="titulosContenidoInterno">Codigo Visitante:</td>
				<td><input type="text" name="codigo"  size="15"  maxlength="15" value="<?=$_POST['codigo']?>">* Cedula o codigo de estudiante</td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Nombre(s) Visitante:</td>
				<td><input type="text" name="nombre" size="30" value="<?=$_POST['nombre']?>" ></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Apellidos Visitante:</td>
				<td><input type="text" name="apellidos" size="30" value="<?=$_POST['apellidos']?>" ></td>
		</tr>
                <tr><td><br></td></tr>
                <tr>
				<td class="titulosContenidoInterno">Email:</td>
				<td><input type="text" name="email" size="30" value="<?=$_POST['email']?>" ></td>
		</tr>
		<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">Tipo Doc:</td>
				<td>
				<select name="tipodoc" title="Tipo Documento">
				<option selected>&nbsp;</option>
				<option <? if($_POST['tipodoc'] == 'C.C') echo "selected"; ?>>C.C</option>
				<option <? if($_POST['tipodoc'] == 'C.R') echo "selected"; ?>>C.R</option>
				<option <? if($_POST['tipodoc'] == 'T.I') echo "selected"; ?>>T.I</option>
				</select>
				</td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">No. Documento:</td>
				<td><input type="text" name="nodoc" size="30" value="<?=$_POST['nodoc']?>"></td>		
			</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Codigo Plan:</td>
				<td><input type="text" name="codplan" size="30" value="<?=$_POST['codplan']?>"> *poner 1111 si es profesor</td>
		</tr>
		<tr><td><br></td></tr>
		<tr valign="bottom" align="center">
			<td colspan="2" height="50" valign="top">
			<input type="submit" name="aceptar" value="Aceptar">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="reset" name="limpiar" value="Limpiar">
			</td>
		</tr>
		</table>
		</form>
		<?
	}
	
	if(isset($_GET['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe ingresar los campos completos al formulario.");
		</script>
		<?
	}
	
	if(isset($_GET['no_numero']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El ingreso del Codigo, No. documento y Codigo Plan debe ser un numero.");
		</script>
		<?
	}
	
/*	if(isset($_GET['registrado']))
	{
		
	}
	*/
	PageEnd();
?>