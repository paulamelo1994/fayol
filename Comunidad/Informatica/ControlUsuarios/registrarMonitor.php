<?
	/********************************************************
	Aplicacion: Control Salas
	Archivo: registrarMonitor.php
	Objetivo: Modulo mediante el cual se ingresa a un monitor que anteriormente ha sido registrado como usuario. 
				El acceso a este modulo se desplega solo para los administradores de la aplicacion:
				- Guillermo Pe&ntilde;a
				- Angela Benavides
				
				Para ingresar al monitor se requieren los siguientes datos:
				- Codigo: Codigo de estudiante
				- Login: Nombre de usuario
				- Password: Contrase&ntilde;a
				- Confirmacion de Password. Deben coincidir.
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
	
	if($_POST['buscar'])
	{
		if(!empty($_POST['codigo']))
		{
			
			if(!is_numeric($_POST['codigo']))
			{
				$_GET['codigo'] = false;
			}
			
			else
			{
				$conexion = DBConnect('controlsalas');
				
				if(!conexion)
						echo("<td>No se pudo lograr la conexi&oacute;n con la BD.</td>");
				else
				{
					$cod=pg_escape_string($_POST['codigo']);
					$rs = db_query("select * from estudiantes where codigo = '$cod'");
					
					if($obj = pg_fetch_object($rs))
					{
						$codigo = pg_escape_string($obj->codigo);
						$nombres = pg_escape_string($obj->nombres);
						$apellidos = pg_escape_string($obj->apellidos);
					}
					else
						$_GET['noEncontro'] = true;
				}
			}
		}
	}
	
	if(isset($_POST["aceptar"]))
	{
	
		if(empty($_POST['codigo']) || empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['login']) || empty($_POST['password']) || empty($_POST['password1']))
			$_GET['vacios'] = true;
		else if($_POST['password'] != $_POST['password1'])
			$_GET['password'] = true;
		else
		{
			$conexion = DBConnect('controlsalas');
			$cod=pg_escape_string($_POST['codigo']);
			$name=pg_escape_string($_POST['nombre']);
			$apellidos=pg_escape_string($_POST['apellidos']);
			$login=pg_escape_string($_POST['login']);
			$password=pg_escape_string($_POST['password']);
			
			$rs = db_query("insert into monitor (codigo, nombre, apellido, login, password, activo) values (
			'$cod', '$name', '$apellidos', '$login', '$password', 'true')");
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
				location.href="registrarMonitor.php?registrado=true";
				</script>
				<?
			}
			
		}
	}
	
	if(isset($_POST['limpiar']))
	{
		$codigo = "";
		$nombres = "";
		$apellidos = "";
	}
	
	$fechaGuardada = $_SESSION['ultimoAcceso'];
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
	
	 if($tiempo_transcurrido >= 900 and getIP() != IP_ANGELA)
	 {
		session_destroy();
		header("Location: control.php");
	}
	
	else
	{

		PageInit("Registrar Monitor", "menu.php");
		?>
		<h1 class="shiny">Registrar Monitor</h1>
		<form method="post"  name="registrarMonitor" action="registrarMonitor.php" enctype="multipart/form-data">
		<table width="90%" align="center">
		<tr>
				<td class="titulosContenidoInterno">Codigo Monitor:</td>
				<td>
				<input type="text" name="codigo" size="30" value="<?=$codigo?>">
				&nbsp;
				<input name="buscar" type="submit" value="..." title="Consultar Usuario!">
				</td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Nombre(s) Monitor:</td>
				<td><input type="text" name="nombre" size="30" readonly value="<?=$nombres?>"></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Apellidos Monitor:</td>
				<td><input type="text" name="apellidos" size="30" readonly value="<?=$apellidos?>"></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Login:</td>
			<td><input type="text" name="login" size="30"></td>		
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Password:</td>
				<td><input type="password" name="password" size="30"></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Confirmaci&oacute;n Password:</td>
				<td><input type="password" name="password1" size="30"></td>
		</tr>
		<tr><td><br></td></tr>
		<tr><td><br></td></tr>
		<tr valign="bottom" align="center">
			<td colspan="2" height="50" valign="top">
			<input type="submit" name="aceptar" value="Aceptar">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="limpiar" value="Limpiar">
			</td>
		</tr>
		</table>
		</form>
		<?
	}
	
	if(isset($_GET['codigo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El ingreso del Codigo debe ser un numero.");
		</script>
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
	
	if(isset($_GET['password']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Los passwords no coinciden.");
		</script>
		<?
	}
	
	if(isset($_GET['registrado']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se ha registrado al monitor.");
		</script>
		<?
	}
	
	if(isset($_GET['noEncontro']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("No se encontro usuario con el codigo ingresado.");
		</script>
		<?
	}
	
	PageEnd();
?>