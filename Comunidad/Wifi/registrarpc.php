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
	
	$rootPath = '..';
	require '../../functions.php';
	
	$_GET['submenu_wifi'] = true;
	date_default_timezone_set('GMT-4'); //Establece zona horaria, evita desfaces
	
	if(!isset($_SESSION['sesionValida']))
	{
		header("Location: /Comunidad/Wifi/autenticar.php");
		die();
	}
	
	
	
	
	$fecha = date(Y)."-".date(n)."-".date(d);
	
	if($_POST["aceptar"])
	{
	
		$conexion = DBConnect('fayol');
		$rs = db_query("select * from equiposwifi where numdoc = '$_POST[numdoc]'");
		
		if(pg_num_rows($rs) != 0 )
		{
			?>
				<script language="javascript" type="text/javascript">
				alert("El usuario ya tiene un equipo registrado");
				</script>
			<?
		}
		else
		{	
			
			$conexion = DBConnect('fayol');
			$propietario = $_POST[nombre]." ".$_POST[apellidos];
			
			{
				if ( check_form () )
				{
					if ( $_POST[mail]  == "" || check_email_address ( $_POST[mail] ) )
					{
						$rs = db_query("insert into equiposwifi (codigo, plan, propietario, numdoc, mac, fecha, telefono, mail) values (
							'$_POST[codigo]', '$_POST[codplan]', '$propietario', '$_POST[nodoc]', '$_POST[mac]', '$fecha', '$_POST[telefono]', '$_POST[mail]')");
						if(!$rs)
						{
							?>
							<script language="javascript">
							alert("Ha ocurrido un error al procesar el registro.");
							history.back(1)
							</script>
							<?
						}
						else if($rs)
						{
							?>
							<script language="javascript">
							alert("Se ha registrado los datos correctamente.");
							</script>
							
							<script language="javascript">
							location.href="registrarpc.php?";
							</script>
							<?
								
						}
					}
					else
					{
							?>
							<script language="javascript">
							alert("Direccion de Correo Electronico Invalida.");
							</script>
							<?
					}
				}
				else
				{
							?>
							<script language="javascript">
							alert("El formulario no se ha llenado de forma correcta.");
							</script>
							<?
				}
			}
		}
	}
	

		PageInit("Registrar Estudiante Sala $sala", "../menu.php");
		?>
		<ul>
		  <li><a href="index.php">Home</a></li>
		  <li><a href="listar.php">Listar</a></li>
		  </ul>
		<h2 class="shiny" align="center">Registrar Equipo Wifi </h2>
		<p class="shiny" align="center">&nbsp;</p>
		<form method="post"  name="registrarEstudiante" action="" enctype="multipart/form-data">
		<table width="90%" align="center">
		<tr>
				<td class="titulosContenidoInterno">Codigo Estudiante:</td>
				<td><input type="text" name="codigo" size="30" value="<?=$_POST['codigo']?>"></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Nombre(s) Estudiante:</td>
				<td><input type="text" name="nombre" size="30" value="<?=$_POST['nombre']?>"></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Apellidos Estudiante:</td>
				<td><input type="text" name="apellidos" size="30" value="<?=$_POST['apellidos']?>"></td>
		</tr>
		<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">No. Documento:</td>
				<td><input type="text" name="nodoc" size="30" value="<?=$_POST['nodoc']?>">
				</td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">Codigo Plan:</td>
				<td><input type="text" name="codplan" size="30" value="<?=$_POST['codplan']?>"></td>		
			</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Mac</td>
				<td><input type="text" name="mac" size="30" value="<?=$_POST['mac']?>"></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">T&eacute;leno</td>
				<td><input type="text" name="telenofo" size="30" value="<?=$_POST['telefono']?>"></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
				<td class="titulosContenidoInterno">Correo Electronico</td>
				<td><input type="text" name="mail" size="30" value="<?=$_POST['mail']?>"></td>
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
	
	
	PageEnd();
	
function check_email_address($email) 
{
	// Primero, checamos que solo haya un símbolo @, y que los largos sean correctos
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) 
	{
		// correo inválido por número incorrecto de caracteres en una parte, o número incorrecto de símbolos @
    return false;
  }
  // se divide en partes para hacerlo más sencillo
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) 
	{
    if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) 
		{
      return false;
    }
  } 
  // se revisa si el dominio es una IP. Si no, debe ser un nombre de dominio válido
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) 
	{ 
     $domain_array = explode(".", $email_array[1]);
     if (sizeof($domain_array) < 2) 
		 {
        return false; // No son suficientes partes o secciones para se un dominio
     }
     for ($i = 0; $i < sizeof($domain_array); $i++) 
		 {
        if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) 
				{
           return false;
        }
     }
  }
  return true;
};


function check_form ()
{
	if  ( $_POST[codigo] == "" )
		return false;
		
	return true;
}

?>