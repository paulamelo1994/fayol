<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: index.php
	Objetivo: Archivo que autentica la entrada al modulo de inventario, y permite seleccionar la ubicaci&oacute;n
	Autor: Angela Benavides
	Modificado por: Deisy Chaves
	A&ntilde;o: 2008
	*********************************************************/
	
	session_start();
	require '../../functions.php';
	$root_path = "../..";
	
	$_GET['submenu_inventario'] = true;
	
	//Se autentica al usuario
	if($_POST['autenticar'])
	{
		$conexion = @DBConnect('inventario');

		if(empty($conexion)) // Si no hay conexion
		{
			$error_conexion = true;
		}
		else
		{		
			$rs = db_query("SELECT * FROM usuario WHERE login= '$_POST[Login]' and password = '$_POST[Password]'");
			
			$filas = pg_num_rows($rs);
			if($filas)
			{
				$obj = pg_fetch_object($rs);
				
				$_SESSION['inventario'] = array();
				$_SESSION['inventario']['login'] = $obj->login;
				$_SESSION['inventario']['nombre'] = $obj->nombre;
				$_SESSION['inventario']['permisos'] = $obj->permisos;
								
				$idUbicacion= null;	
				$ubicacion ="";	
				
				if ($_SESSION['inventario']['permisos'] == 'administrador' ||$_SESSION['inventario']['permisos'] == 'responsable')
				{
					$idUbicacion = 'pendiente';
					$_SESSION['idUbicacion'] =$idUbicacion;	
					$_GET['item_login'] = true;		
				}
				else if ($_SESSION['inventario']['permisos'] == 'operador')
				{
					$idUbicacion = '2';
					$ubicacion = "Libreria";
					$_SESSION['idUbicacion'] =$idUbicacion;	
					$_SESSION['ubicacion'] =$ubicacion;	
							
				}		

				$_GET['submenu_inventario'] = true;
			}
			else
			{
				echo "<script language=\"Javascript\" >
					alert(\"Nombre de usuario o contrase&ntilde;a incorrectos.\");
					</script>";
			}
		}
	}
	
	if($_GET['idUbicacion'])
	{
		$idUbicacion = $_GET['idUbicacion'];
		$_GET['submenu_inventario'] = true;
		$_SESSION['idUbicacion'] =$idUbicacion;	
		$_GET['item_login'] = false;
		
		
		if($idUbicacion == '1')
		{
			$ubicacion ="Bodega";
		}
		else if($idUbicacion == '2')
		{
			$ubicacion ="Libreria";
		}
		else if($idUbicacion == '3')
		{
			$ubicacion ="Oficina";
		}
		
		$_SESSION['ubicacion'] =$ubicacion;	
	}
	
	//Se muestra la pagina de logueo
	if(!isset($_SESSION['inventario']))
	{
		PageInit("Inventario", '../menu.php');
		
		if($error_conexion == true)
		{
			echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible acceder al inventario, por favor intentelo m&aacute;s tarde.</p>";
			$error_conexion = false;
		}
		
?>
		<H1 CLASS="shiny">Autenticaci&oacute;n Requerida</H1>
		<P>Esta area de nuestra p&aacute;gina esta restringida solo para el uso de los usuarios del modulo de inventario, no hay raz&oacute;n para que un usuario com&uacute;n necesite acceder a estas p&aacute;ginas, es m&aacute;s, ni siquiera deber&iacute;a estar viendo este mensaje.</P>
		<P>Para ingresar al modulo de inventario por favor ingrese abajo su clave de autenticaci&oacute;n.</P>
		<center>
		<form method="post" action="index.php" name="autenticacion" enctype="multipart/form-data">
		<table cellpadding="2" cellspacing="2">
		<tr>
			<td width="50">LOGIN:</td><td width="50"><INPUT TYPE=TEXT NAME="Login" value=""></td>
		</tr>
		<tr>
			<td>PASSWORD:</td><td><INPUT type= password  NAME="Password" value=""></td>
		</tr>
		<tr>
			<td colspan="2">
			<div align="center"><input name="autenticar" type="submit" value="Autenticar Usuario"></div>
			</td>
		</tr>
		</table>
		</form>
		</center>
<?
		PageEnd();
		die();
	}
	
	//Se Selecciona la ubicaci&oacute;n (libreria, oficina o bodega) del inventario a manejar
	if(isset($_SESSION['inventario']))
	{
		$_GET['submenu_inventario'] = true;
		
		PageInit("Inventario", '../menu.php');
	?>
		
		<form method="get" name="inventario" action="inventario.php" enctype="multipart/form-data">
		<h1 class="shiny">Inventario 
		<?
			$conexion = @DBConnect('inventario');				
		
			if(empty($conexion)) // Si no hay conexion
			{
				echo" </h1> <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible acceder al inventario, por favor intentelo m&aacute;s tarde.</p> <h1>";
			}
			else
			{				
				if($_SESSION['idUbicacion'] != "pendiente")
				{		
					$_SESSION['idUbicacion'] =$idUbicacion;	
					$_SESSION['ubicacion'] =$ubicacion;	

					echo $ubicacion;
					echo "<br><br><font  size=2 color=black>Cambiar</font>";
				}
				//else
				//{
					//echo " ubicacion SELECT nombre as ubicacion from ubicacion where codigo = $idUbicacion";
				$rs1 = db_query("SELECT codUbicacion , nombre as ubicacion from ubicacion");
					
					?>
					<select name="opUbicacion">
					<option>Seleccione...</option>
					<?
					while($obj = pg_fetch_object($rs1))
					{
					?>
						<option onClick="document.location.href='index.php?idUbicacion=<?=$obj->codubicacion?>'"><?=$obj->ubicacion?></option>
					<?	
					}
					?>
					</select>
					<?
					
				//}
			}
		
		?>		
		</h1>
		
		<center>
		<IMG SRC="<?=$rootPath?>/Images/biblioteca.png" ALT="foto">
		<H2>Facultad de Ciencias de la Administraci&oacute;n<BR>Universidad del Valle</H2>
		</center>
		</form>
	<?
		PageEnd();
	}
?>