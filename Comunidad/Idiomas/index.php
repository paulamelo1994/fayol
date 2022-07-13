<?
	/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: index.php
	Objetivo: Este archivo permite la autenticacion de los usuarios para que ingresen al sistema. Determina 
				usuario regular y administrador.
	Autor: Angela Benavides
	Año: 2007
	*********************************************************/
	
	session_start();
		
	$root_path = "../..";
	require '../../functions.php';
	
	$_GET['submenu_idiomas'] = true;
	
	if(isset($_POST['autenticar']))
	{
		$conexion = DBConnect('controlsalas');
		
		if(!conexion)
		{
			header("Location: /Comunidad");
			die();
		}
		
		$rs = db_query("SELECT * FROM monitor WHERE login= '$_POST[Login]' and password = '$_POST[Password]'");
		
		$filas = pg_num_rows($rs);
		if($filas)
		{
			$obj = pg_fetch_object($rs);
			
			$_SESSION['usuario'] = array();
			$_SESSION['usuario']['login'] = $obj->login;
			$_SESSION['usuario']['codigo'] = $obj->codigo;
			$_SESSION['usuario']['nombre'] = $obj->nombre." ".$obj->apellido;
			
			$rs = db_query("SELECT * FROM estudiantes where codigo = '".$_SESSION['usuario']['codigo']."'");
			$obj = pg_fetch_object($rs);
			$_SESSION['usuario']['carrera'] = $obj->codplan;
			
			if($_SESSION['usuario']['login'] == 'langela' || $_SESSION['usuario']['login'] == 'luispena' || $_SESSION['usuario']['login'] == 'mijobol' || $_SESSION['usuario']['login'] == 'andresbl')
				$_SESSION['usuario']['permisos'] = "total";
			else
				$_SESSION['usuario']['permisos'] = "limitado";
			
			$_GET['submenu_idiomas'] = true;
		}
		else
		{
			echo "<h2>Datos erroneos!!!</h2>";
		}
	}
	
	if(isset($_POST['aceptar']))
	{
		$conexion = DBConnect('controlsalas');
		
		if(!conexion)
		{
			header("Location: /Comunidad");
			die();
		}
		
		$rs = db_query("SELECT * FROM estudiantes where codigo = '".$_POST['codigo']."'");
		
		$filas = pg_num_rows($rs);
		if($filas)
		{
			$obj = pg_fetch_object($rs);
			
			$_SESSION['usuario'] = array();
			$_SESSION['usuario']['login'] = $obj->codigo;
			$_SESSION['usuario']['codigo'] = $obj->codigo;
			$_SESSION['usuario']['nombre'] = $obj->nombres." ".$obj->apellidos;
			$_SESSION['usuario']['carrera'] = $obj->codplan;
			$_SESSION['usuario']['permisos'] = "limitado";
			
			$_GET['submenu_idiomas'] = true;
		}
		else
		{
			echo "<h2>Datos erroneos!!!</h2>";
		}
	}
	
	if(!isset($_SESSION['usuario']))
	{
		PageInit("Sala de Idiomas", '../menu.php');
		if(getIP() >= '192.168.221.122' && getIP() <= '192.168.221.147' && getIP() != '192.168.221.121'  || getIP() == IP_ANGELA || getIP() == "192.168.220.176" )
		{
		?>
			<H1 CLASS="shiny">Autenticaci&oacute;n Requerida</H1>
			<P>Esta area de nuestra p&aacute;gina esta restringida solo para el uso la sala de Idiomas.</P>
			<P>Para ingresar al area de idiomas por favor ingrese abajo su c&oacute;digo de estudiante.</P>
			<center>
			<form method="post" action="index.php" enctype="multipart/form-data">
			<table cellpadding="2" cellspacing="2">
			<tr>
				<td width="50" class="titulosContenidoInterno">CODIGO:</td>
				<td width="50"><input type="text" name="codigo"></td>
			</tr>
			<tr>
				<td colspan="2">
				<div align="center">
				<input name="aceptar" type="submit" value="Aceptar">
				</div>
				</td>
			</tr>
			</table>
			</form>
			</center>
		<?
		}
		//else if(getIP() == '192.168.221.121' || getIp() == "192.168.221.145")
		else if(getIP() == '192.168.221.121')
		{
			?>
			<H1 CLASS="shiny">Autenticaci&oacute;n Requerida</H1>
			<P>Esta area de nuestra p&aacute;gina esta restringida solo para el uso la sala de Idiomas.</P>
			<P>Para ingresar al area de idiomas por favor ingrese abajo su clave de autenticaci&oacute;n.</P>
			<center>
			<form method="post" action="index.php" enctype="multipart/form-data">
			<table cellpadding="2" cellspacing="2">
			<tr>
				<td width="50">LOGIN:</td>
				<td width="50"><INPUT TYPE=TEXT NAME="Login" value=""></td>
			</tr>
			<tr>
				<td>PASSWORD:</td>
				<td><INPUT type= password  NAME="Password" value=""></td>
			</tr>
			<tr>
				<td colspan="2">
				<div align="center">
				<input name="autenticar" type="submit" value="Autenticar Usuario">
				</div>
				</td>
			</tr>
			</table>
			</form>
			</center>
		<?
		}
		else
		{
			?>
				<object type="application/x-shockwave-flash" data="../../Images/plantilla/banners/labidiomas.swf" width="603" height="421">
					<param name="movie" value="../../Images/plantilla/banners/labidiomas.swf" />
					<param name="quality" value="high" />
					<img src="../Images/plantilla/inscripciones.png" width="603" height="421" alt="Laboratorio de Idiomas" />
</object>	
			<?
		}
	}
	else
	{
		$_GET['submenu_idiomas'] = true;
			
		PageInit("Sala de Idiomas", '../menu.php');
		?>
		<form method="get" name="salaIdiomas" action="index.php">
		<center>
		<H1 class="shiny">Sala de Idiomas</H1>
		<IMG SRC="<?=$rootPath?>/Images/idiomas.png" ALT="foto">
		<H2>Facultad de Ciencias de la Administraci&oacute;n<BR>Universidad del Valle</H2>
		</center>

		</form>
		<?
	}
	
	PageEnd();
?>
