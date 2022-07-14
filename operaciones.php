<?
  require "../functions.php";
  
 $rootPath = "..";
 function conectarConRegistro()
{
	$conexion=DBConnect('controlsalas');
	return $conexion;
}

function registrar()
{
	
	
	$conexion=conectarConRegistro();
	$rs = pg_query($conexion, "INSERT INTO registro (codigo, cedula, nombre, plan, sala, equipo,fecha, horaing, horasal) VALUES (
		'$_POST[codigo]', 
		'$_POST[cedula]', 
		'$_POST[nombre]', 
		'$_POST[plan]',
		'$_POST[sala]', 
		'$_POST[equipo]', 
		'$_POST[fecha]', 
		'$_POST[horaing]', '$_POST[horasal]')") 
		or die("<h2>Error</h2><p>Ha habido un error al procesar la solicitud</p>");	
		
		if($rs)
			header ("Location: operaciones.php?what=1");
	
}




if ($_POST["s1pc01"])
{
	$conexion=conectarConRegistro();
	$rs = pg_query($conexion, "SELECT * FROM sesion WHERE sala = '1' and equipo = '1'");
	$filas = pg_numrows($rs);
	if($filas == 0)
	{
		PageInit("REGISTRO DE USUARIOS", 'menu1.php');
		echo "<h1>El equipo se encuentra libre</h1>";
		echo "<a href='javascript:history.back(1)'><h2>Regresar</h2></a>";

	}
	
	else
	{	

		mostrarDatosSala1(1, $rs);
		echo "prueba";
	}
}
if ($_POST["s1pc02"])
{
	$conexion=conectarConRegistro();
	$rs = pg_query($conexion, "SELECT * FROM sesion WHERE sala = '1' and equipo = '2'");
	$filas = pg_numrows($rs);
	if($filas == 0)
	{
		PageInit("REGISTRO DE USUARIOS", 'menu1.php');
		echo "<h1>El equipo se encuentra libre</h1>";
		echo "<a href='javascript:history.back(1)'><h2>Regresar</h2></a>";

	}
	
	else
	{	

		mostrarDatosSala1(1, $rs);
		echo "prueba";
	}
}
if ($_POST["s1pc03"])
{
	$conexion=conectarConRegistro();
	$rs = pg_query($conexion, "SELECT * FROM sesion WHERE sala = '1' and equipo = '3'");
	$filas = pg_numrows($rs);
	if($filas == 0)
	{
		PageInit("REGISTRO DE USUARIOS", 'menu1.php');
		echo "<h1>El equipo se encuentra libre</h1>";
		echo "<a href='javascript:history.back(1)'><h2>Regresar</h2></a>";

	}
	
	else
	{	

		mostrarDatosSala1(1, $rs);
		echo "prueba";
	}
}

function validar()
{
	if(($_POST['nombre']=="") or ($_POST['codigo']=="") or ($_POST['cedula']=="") or ($_POST['plan']=="") or ($_POST['sala']=="") 
	or 	($_POST['equipo']=="") or ($_POST['fecha']=="") or ($_POST['horaing']==""))
	{
		PageInit("REGISTRO DE USUARIOS", 'menu1.php');
		echo "<h2>tiene que llenar todos los datos</h2><br><br>";
		echo "<a href='javascript:history.back(1)'><h2>Regresar</h2></a>";
		
	}
}




function activar()
{
	if (validar())
	{
		$conexion=conectarConRegistro();
		$estado = "true";
		$rs = pg_query($conexion, "INSERT INTO sesion (estado, codigo, cedula, nombre, plan, sala, equipo,fecha, horaing) VALUES (
		'$estado',
		'$_POST[codigo]', 
		'$_POST[cedula]', 
		'$_POST[nombre]', 
		'$_POST[plan]',
		'$_POST[sala]', 
		'$_POST[equipo]', 
		'$_POST[fecha]', 
		'$_POST[horaing]')") 
		or die("<h2>Error</h2><p>Ha habido un error al procesar la solicitud</p>");	
		
		header ("Location: operaciones.php?what=1");
	}
}
	

	
	
	
if($_POST["registrar"])
{
	registrar();
}
	
if($_POST["activar"])
{
	activar();
}
 

?>

<? if( $_GET['what']==1 ) 
   { 
		PageInit("REGISTRO DE USUARIOS SALA1", 'menu1.php');
		$sala = 1;
?>

<form method="post"  action="operaciones.php">
<TABLE width="578"   height="300" border="1" bgcolor="#F0F0F0"  bordercolor="#666666" >
<TR valign="top">
	
	<TD width="300">
	<table width="300" border="0" cellpadding="2" cellspacing="5"  >
	<tr>
		<TD width="150"  valign="top"> NOMBRE COMPLETO</TD>
		<TD width="150" colspan="4" valign="top" size=40><input name="nombre" id="nombre"  size="40" maxlength="40" value="<? $_POST['nombre'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">CEDULA</TD>
		<TD width="15" valign="top"><input name="cedula" id="cedula"  size="15" maxlength="15" value="<? $_POST['cedula'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">CODIGO</TD>
		<TD width="15" valign="top"><input name="codigo" id="codigo"  size="15" maxlength="10" value="<? $_POST['codigo'] ?>"></TD>
		<TD valign="top">PLAN</TD>
		<TD  valign="top" ><input name="plan" id="plan"  SIZE="6" maxlength="5" value="<? $_POST['plan'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">SALA</TD>
		<TD valign="top"><input name="sala" id="sala"  size="15"  maxlength="10" value="<? $_POST['sala'] ?>"></TD>
		<TD valign="top">EQUIPO</TD>
		<TD valign="top" ><input name="equipo" id="equipo"  SIZE="6" maxlength="5" value="<? $_POST['equipo'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">FECHA INGRESO</TD>
		<TD valign="top"><input name="fecha" id="fecha"  size="15" maxlength="10" value="<? $_POST['fecha'] ?>"></TD>		
	</tr>
	<tr>
		<TD height="28">HORA INGRESO</TD>
		<TD valign="top"><input name="horaing" id="horaing"  size="15" maxlength="15" value="<? $_POST['horaing'] ?>"></TD>		
	</tr>
	<tr>
		<TD height="28">HORA SALIDA</TD>
		<TD valign="top"><input name="horasal" id="horasal"  size="15" maxlength="15" value="<? $_POST['horasal'] ?>"></TD>		
	</tr>
	</table>
	<div align="center">
	<table>
	<tr>
	<td width="150"></td>
	<td><input name="activar" type="submit" value="activar"></td>
	<td><input name="desactivar"  type="reset" value="Desactivar"></td>
	<td><input name="registrar" type="submit" value="registrar" ></td>
	<td><input name="limpiar"  type="reset" value="Limpiar"></td>
	<td width="150"></td>
	</tr>
	</table>	
	 </div>
	</TD>

	<!--inicio de los botones-->
	<TD width="120">
	<div align="center">
	<table height="300" width="120" cellpadding="3" cellspacing="2" border = "0">
	<tr> 
		<td><input name=s1pc01 type="submit" value="pc01" ></td>
		<td><input name=s1pc02 type="submit" value="pc02" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc03" type="submit" value="pc03" ></td>
		<td><input name "s1pc04" type="submit" value="pc04" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc05" type="submit" value="pc05" ></td>
		<td><input name "s1pc06" type="submit" value="pc06" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc07" type="submit" value="pc07" ></td>
		<td><input name "s1pc08" type="submit" value="pc08" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc09" type="submit" value="pc09" ></td>
		<td><input name "s1pc10" type="submit" value="pc10" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc11" type="submit" value="pc11" ></td>
		<td><input name "s1pc12" type="submit" value="pc12" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc13" type="submit" value="pc13" ></td>
		<td><input name "s1pc14" type="submit" value="pc14" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc15" type="submit" value="pc15" ></td>
		<td><input name "s1pc16" type="submit" value="pc16" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc17" type="submit" value="pc17" ></td>
		<td><input name "s1pc18" type="submit" value="pc18" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc19" type="submit" value="pc19" ></td>
		<td><input name "s1pc20" type="submit" value="pc20" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc21" type="submit" value="pc21" ></td>
		<td><input name "s1pc22" type="submit" value="pc22" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc23" type="submit" value="pc23" ></td>
		<td><input name "s1pc24" type="submit" value="pc24" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc25" type="submit" value="pc25" ></td>
		<td><input name "s1pc26" type="submit" value="pc26" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc27" type="submit" value="pc27" ></td>
		<td><input name "s1pc28" type="submit" value="pc28" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc29" type="submit" value="pc29" ></td>
		<td><input name "s1pc30" type="submit" value="pc30" ></td>
	</tr>
	</table>
	</div>
	</TD>
</TR>
<tr></tr>
</TABLE>
</form>
        <br>
<? } if($_GET['what']==2) { 
PageInit("REGISTRO DE USUARIOS SALA2", 'menu1.php');
$sala = 2;
?>
<form method="post"  action="operaciones.php">
<TABLE width="581"   height="300" border="1" bgcolor="#F0F0F0"  bordercolor="#666666" >
<TR valign="top">
	
	<TD width="300">
	<table width="300" border="0" cellpadding="2" cellspacing="5"  >
	<tr>
		<TD width="150"  valign="top"> NOMBRE COMPLETO</TD>
		<TD width="150" colspan="4" valign="top" size=40><input name="nombre" id="nombre"  size="40" maxlength="40" value="<? $_POST['nombre'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">CEDULA</TD>
		<TD width="15" valign="top"><input name="cedula" id="codigo"  size="15" maxlength="15" value="<? $_POST['cedula'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">CODIGO</TD>
		<TD width="15" valign="top"><input name="codigo" id="codigo"  size="15" maxlength="10" value="<? $_POST['codigo'] ?>"></TD>
		<TD valign="top">PLAN</TD>
		<TD  valign="top" ><input name="plan" id="plan"  SIZE="6" maxlength="5" value="<? $_POST['plan'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">SALA</TD>
		<TD valign="top"><input name="sala" id="sala"  size="15" maxlength="10" value="<? $_POST['sala'] ?>"></TD>
		<TD valign="top">EQUIPO</TD>
		<TD valign="top" ><input name="equipo" id="equipo"  SIZE="6" maxlength="5" value="<? $_POST['equipo'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">FECHA INGRESO</TD>
		<TD valign="top"><input name="fecha" id="fecha"  size="15" maxlength="10" value="<? $_POST['fecha'] ?>"></TD>		
	</tr>
	<tr>
		<TD height="28">HORA INGRESO</TD>
		<TD valign="top"><input name="horaingreso" id="horaingreso"  size="15" maxlength="10" value="<? $_POST['horaingreso'] ?>"></TD>		
	</tr>
	<tr>
		<TD height="28">HORA SALIDA</TD>
		<TD valign="top"><input name="horasalida" id="horasalida"  size="15" maxlength="10" value="<? $_POST['horasalida'] ?>"></TD>		
	</tr>
	</table>
	<div align="center">
	<table>
	<tr>
	<td width="150"></td>
	<td><input name="activar" type="submit" value="activar"></td>
	<td><input name="desactivar"  type="reset" value="Desactivar"></td>
	<td><input name="registrar" type="submit" value="registrar" ></td>
	<td><input name="limpiar"  type="reset" value="Limpiar"></td>
	<td width="150"></td>
	</tr>
	</table>	
	 </div>
	</TD>

	<!--inicio de los botones-->
	<TD width="120">
	<div align="center">
	<table height="300" width="120" cellpadding="3" cellspacing="2" border = "0">
	<tr> 
		<td><input name "s2pc01" type="submit"  value="pc01" ></td>
		<td><input name "s2pc02" type="submit" value="pc02" ></td>
	</tr>
	<tr> 
		<td><input name "s2pc03" type="submit" value="pc03" ></td>
		<td><input name "s2pc04" type="submit" value="pc04"></td>
	</tr>
	<tr> 
		<td><input name "s2pc05" type="submit" value="pc05" ></td>
		<td><input name "s2pc06" type="submit" value="pc06" ></td>
	</tr>
	<tr> 
		<td><input name "s2pc07" type="submit" value="pc07" ></td>
		<td><input name "s2pc08" type="submit" value="pc08" ></td>
	</tr>
	<tr> 
		<td><input name "s2pc09" type="submit" value="pc09" ></td>
		<td><input name "s2pc10" type="submit" value="pc10" ></td>
	</tr>
	<tr> 
		<td><input name "s2pc11" type="submit" value="pc11" ></td>
		<td><input name "s2pc12" type="submit" value="pc12" ></td>
	</tr>
	<tr> 
		<td><input name "s2pc13" type="submit" value="pc13" ></td>
		<td><input name "s2pc14" type="submit" value="pc14" ></td>
	</tr>
	<tr> 
		<td><input name "s2pc15" type="submit" value="pc15" ></td>
		<td><input name "s2pc16" type="submit" value="pc16" ></td>
	</tr>
	<tr> 
		<td><input name "s2pc17" type="submit" value="pc17" ></td>
		<td><input name "s2pc18" type="submit" value="pc18" ></td>
	</tr>
	<tr> 
		<td><input name "s2pc19" type="submit" value="pc19" ></td>
		<td><input name "s2pc20" type="submit" value="pc20" ></td>
	</tr>
	
	</table>
	</div>
	</TD>
</TR>
<tr></tr>
</TABLE>


</form>
<BR>
</P>
<? } if($_GET['what']==3) 
{
 
PageInit("REGISTRO DE USUARIOS SALA3", 'menu1.php');
$sala = 3;
?>
<form method="post"  action="operaciones.php">
<TABLE width="581"   height="300" border="1" bgcolor="#F0F0F0"  bordercolor="#666666" >
<TR valign="top">
	
	<TD width="300">
	<table width="300" border="0" cellpadding="2" cellspacing="5"  >
	<tr>
		<TD width="150"  valign="top"> NOMBRE COMPLETO</TD>
		<TD width="150" colspan="4" valign="top" size=40><input name="nombre" id="nombre"  size="40" maxlength="40" value="<? $_POST['nombre'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">CEDULA</TD>
		<TD width="15" valign="top"><input name="cedula" id="codigo"  size="15" maxlength="15" value="<? $_POST['cedula'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">CODIGO</TD>
		<TD width="15" valign="top"><input name="codigo" id="codigo"  size="15" maxlength="10" value="<? $_POST['codigo'] ?>"></TD>
		<TD valign="top">PLAN</TD>
		<TD  valign="top" ><input name="plan" id="plan"  SIZE="6" maxlength="5" value="<? $_POST['plan'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">SALA</TD>
		<TD valign="top"><input name="sala" id="sala"  size="15" maxlength="10" value="<? $_POST['sala'] ?>"></TD>
		<TD valign="top">EQUIPO</TD>
		<TD valign="top" ><input name="equipo" id="equipo"  SIZE="6" maxlength="5" value="<? $_POST['equipo'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">FECHA INGRESO</TD>
		<TD valign="top"><input name="fecha" id="fecha"  size="15" maxlength="10" value="<? $_POST['fecha'] ?>"></TD>		
	</tr>
	<tr>
		<TD height="28">HORA INGRESO</TD>
		<TD valign="top"><input name="horaingreso" id="horaingreso"  size="15" maxlength="10" value="<? $_POST['horaingreso'] ?>"></TD>		
	</tr>
	<tr>
		<TD height="28">HORA SALIDA</TD>
		<TD valign="top"><input name="horasalida" id="horasalida"  size="15" maxlength="10" value="<? $_POST['horasalida'] ?>"></TD>		
	</tr>
	</table>
	<div align="center">
	<table>
	<tr>
	<td width="150"></td>
	<td><input name="activar" type="submit" value="activar"></td>
	<td><input name="desactivar"  type="reset" value="Desactivar"></td>
	<td><input name="registrar" type="submit" value="registrar" ></td>
	<td><input name="limpiar"  type="reset" value="Limpiar"></td>
	<td width="150"></td>
	</tr>
	</table>	
	 </div>
	</TD>

	<!--inicio de los botones-->
	<TD width="120">
	<div align="center">
	<table height="300" width="120" cellpadding="3" cellspacing="2" border = "0">
	<tr> 
		<td><input name "s3pc01" type="submit"  value="pc01" ></td>
		<td><input name "s3pc02" type="submit" value="pc02" ></td>
	</tr>
	<tr> 
		<td><input name "s3pc03" type="submit" value="pc03" ></td>
		<td><input name "s3pc04" type="submit" value="pc04"></td>
	</tr>
	<tr> 
		<td><input name "s3pc05" type="submit" value="pc05" ></td>
		<td><input name "s3pc06" type="submit" value="pc06" ></td>
	</tr>
	<tr> 
		<td><input name "s3pc07" type="submit" value="pc07" ></td>
		<td><input name "s3pc08" type="submit" value="pc08" ></td>
	</tr>
	<tr> 
		<td><input name "s3pc09" type="submit" value="pc09" ></td>
		<td><input name "s3pc10" type="submit" value="pc10" ></td>
	</tr>
	<tr> 
		<td><input name "s3pc11" type="submit" value="pc11" ></td>
		<td><input name "s3pc12" type="submit" value="pc12" ></td>
	</tr>
	<tr> 
		<td><input name "s3pc13" type="submit" value="pc13" ></td>
		<td><input name "s3pc14" type="submit" value="pc14" ></td>
	</tr>
	<tr> 
		<td><input name "s3pc15" type="submit" value="pc15" ></td>
		<td><input name "s3pc16" type="submit" value="pc16" ></td>
	</tr>
	<tr> 
		<td><input name "s3pc17" type="submit" value="pc17" ></td>
		<td><input name "s3pc18" type="submit" value="pc18" ></td>
	</tr>
	<tr> 
		<td><input name "s3pc19" type="submit" value="pc19" ></td>
		<td><input name "s3pc20" type="submit" value="pc20" ></td>
	</tr>
	
	</table>
	</div>
	</TD>
</TR>
<tr></tr>
</TABLE>


</form>
<br>
<? } if($_GET['what']==4) { 

PageInit("REGISTRO DE USUARIOS SALA4", 'menu1.php');
$sala = 4;
?>
<form method="post"  action="operaciones.php">
<TABLE width="582"   height="300" border="1" bgcolor="#F0F0F0"  bordercolor="#666666" >
<TR valign="top">
	
	<TD width="300">
	<table width="300" border="0" cellpadding="2" cellspacing="5"  >
	<tr>
		<TD width="150"  valign="top"> NOMBRE COMPLETO</TD>
		<TD width="150" colspan="4" valign="top" size=40><input name="nombre" id="nombre"  size="40" maxlength="40" value="<? $_POST['nombre'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">CEDULA</TD>
		<TD width="15" valign="top"><input name="cedula" id="codigo"  size="15" maxlength="15" value="<? $_POST['cedula'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">CODIGO</TD>
		<TD width="15" valign="top"><input name="codigo" id="codigo"  size="15" maxlength="10" value="<? $_POST['codigo'] ?>"></TD>
		<TD valign="top">PLAN</TD>
		<TD  valign="top" ><input name="plan" id="plan"  SIZE="6" maxlength="5" value="<? $_POST['plan'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">SALA</TD>
		<TD valign="top"><input name="sala" id="sala"  size="15" maxlength="10" value="<? $_POST['sala'] ?>"></TD>
		<TD valign="top">EQUIPO</TD>
		<TD valign="top" ><input name="equipo" id="equipo"  SIZE="6" maxlength="5" value="<? $_POST['equipo'] ?>"></TD>
	</tr>
	<tr>
		<TD height="28">FECHA INGRESO</TD>
		<TD valign="top"><input name="fecha" id="fecha"  size="15" maxlength="10" value="<? $_POST['fecha'] ?>"></TD>		
	</tr>
	<tr>
		<TD height="28">HORA INGRESO</TD>
		<TD valign="top"><input name="horaingreso" id="horaingreso"  size="15" maxlength="10" value="<? $_POST['horaingreso'] ?>"></TD>		
	</tr>
	<tr>
		<TD height="28">HORA SALIDA</TD>
		<TD valign="top"><input name="horasalida" id="horasalida"  size="15" maxlength="10" value="<? $_POST['horasalida'] ?>"></TD>		
	</tr>
	</table>
	<div align="center">
	<table>
	<tr>
	<td width="150"></td>
	<td><input name="activar" type="submit" value="activar"></td>
	<td><input name="desactivar"  type="reset" value="Desactivar"></td>
	<td><input name="registrar" type="submit" value="registrar" ></td>
	<td><input name="limpiar"  type="reset" value="Limpiar"></td>
	<td width="150"></td>
	</tr>
	</table>	
	 </div>
	</TD>

	<!--inicio de los botones-->
	<TD width="120">
	<div align="center">
	<table height="300" width="120" cellpadding="3" cellspacing="2" border = "0">
	<tr> 
		<td><input name "s4pc01" type="submit"  value="pc01" ></td>
		<td><input name "s4pc02" type="submit" value="pc02" ></td>
	</tr>
	<tr> 
		<td><input name "s4pc03" type="submit" value="pc03" ></td>
		<td><input name "s4pc04" type="submit" value="pc04"></td>
	</tr>
	<tr> 
		<td><input name "s4pc05" type="submit" value="pc05" ></td>
		<td><input name "s4pc06" type="submit" value="pc06" ></td>
	</tr>
	<tr> 
		<td><input name "s4pc07" type="submit" value="pc07" ></td>
		<td><input name "s4pc08" type="submit" value="pc08" ></td>
	</tr>
	<tr> 
		<td><input name "s4pc09" type="submit" value="pc09" ></td>
		<td><input name "s4pc10" type="submit" value="pc10" ></td>
	</tr>
	<tr> 
		<td><input name "s4pc11" type="submit" value="pc11" ></td>
		<td><input name "s4pc12" type="submit" value="pc12" ></td>
	</tr>
	<tr> 
		<td><input name "s4pc13" type="submit" value="pc13" ></td>
		<td><input name "s4pc14" type="submit" value="pc14" ></td>
	</tr>
	<tr> 
		<td><input name "s4pc15" type="submit" value="pc15" ></td>

	</tr>
	
	</table>
	</div>
	</TD>
</TR>
<tr></tr>
</TABLE>


</form>
<br>
<? } 
function mostrarDatosSala1($sala, $rs)
{ 

	PageInit("REGISTRO DE USUARIOS SALA".$sala , 'menu1.php');
?>


<form method="post"  action="operaciones.php">
<TABLE width="582"   height="300" border="1" bgcolor="#F0F0F0"  bordercolor="#666666" >
<TR valign="top">
	
	<TD width="300">
	<table width="300" border="0" cellpadding="2" cellspacing="5"  >
	<tr>
		<TD width="150"  valign="top"> NOMBRE COMPLETO</TD>
		<TD width="150" colspan="4" valign="top" size=40><input name="nombre" id="nombre"  size="40" maxlength="40" value="<? $campo=pg_result($rs,0,6); echo "$campo";?>"></TD>
	</tr>
	<tr>
		<TD height="28">CEDULA</TD>
		<TD width="15" valign="top"><input name="cedula" id="cedula"  size="15" maxlength="15" value="<? $campo=pg_result($rs,0,7); echo "$campo";?>"></TD>
	</tr>
	<tr>
		<TD height="28">CODIGO</TD>
		<TD width="15" valign="top"><input name="codigo" id="codigo"  size="15" maxlength="10" value="<? $campo=pg_result($rs,0,8); echo "$campo";?>"></TD>
		<TD valign="top">PLAN</TD>
		<TD  valign="top" ><input name="plan" id="plan"  SIZE="6" maxlength="5" value="<? $campo=pg_result($rs,0,5); echo "$campo";?>"></TD>
	</tr>
	<tr>
		<TD height="28">SALA</TD>
		<TD valign="top"><input name="sala" id="sala"  size="15" maxlength="10" value="<? $campo=pg_result($rs,0,4); echo "$campo";?>"></TD>
		<TD valign="top">EQUIPO</TD>
		<TD valign="top" ><input name="equipo" id="equipo"  SIZE="6" maxlength="5" value="<? $campo=pg_result($rs,0,3); echo "$campo";?>"></TD>
	</tr>
	<tr>
		<TD height="28">FECHA INGRESO</TD>
		<TD valign="top"><input name="fecha" id="fecha"  size="15" maxlength="10" value="<? $campo=pg_result($rs,0,0); echo "$campo";?>"></TD>		
	</tr>
	<tr>
		<TD height="28">HORA INGRESO</TD>
		<TD valign="top"><input name="horaingreso" id="horaingreso"  size="15" maxlength="10" value="<? $campo=pg_result($rs,0,1); echo "$campo";?>"></TD>		
	</tr>
	<tr>
		<TD height="28">HORA SALIDA</TD>
		<TD valign="top"><input name="horasalida" id="horasalida"  size="15" maxlength="10" value="<? $campo=pg_result($rs,0,2); echo "$campo";?>"></TD>		
	</tr>
	</table>
	<div align="center">
	<table>
	<tr>
	<td width="150"></td>
	<td><input name="activar" type="submit" value="activar"></td>
	<td><input name="desactivar"  type="reset" value="Desactivar"></td>
	<td><input name="registrar" type="submit" value="registrar" ></td>
	<td><input name="limpiar"  type="reset" value="Limpiar"></td>
	<td width="150"></td>
	</tr>
	</table>	
	 </div>
	</TD>

	<!--inicio de los botones-->
	<TD width="120">
	<div align="center">
	<table height="300" width="120" cellpadding="3" cellspacing="2" border = "0">
	<tr> 
		<td><input name=s1pc01 type="submit" value="pc01" ></td>
		<td><input name=s1pc02 type="submit" value="pc02" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc03" type="submit" value="pc03" ></td>
		<td><input name "s1pc04" type="submit" value="pc04" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc05" type="submit" value="pc05" ></td>
		<td><input name "s1pc06" type="submit" value="pc06" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc07" type="submit" value="pc07" ></td>
		<td><input name "s1pc08" type="submit" value="pc08" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc09" type="submit" value="pc09" ></td>
		<td><input name "s1pc10" type="submit" value="pc10" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc11" type="submit" value="pc11" ></td>
		<td><input name "s1pc12" type="submit" value="pc12" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc13" type="submit" value="pc13" ></td>
		<td><input name "s1pc14" type="submit" value="pc14" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc15" type="submit" value="pc15" ></td>
		<td><input name "s1pc16" type="submit" value="pc16" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc17" type="submit" value="pc17" ></td>
		<td><input name "s1pc18" type="submit" value="pc18" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc19" type="submit" value="pc19" ></td>
		<td><input name "s1pc20" type="submit" value="pc20" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc21" type="submit" value="pc21" ></td>
		<td><input name "s1pc22" type="submit" value="pc22" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc23" type="submit" value="pc23" ></td>
		<td><input name "s1pc24" type="submit" value="pc24" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc25" type="submit" value="pc25" ></td>
		<td><input name "s1pc26" type="submit" value="pc26" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc27" type="submit" value="pc27" ></td>
		<td><input name "s1pc28" type="submit" value="pc28" ></td>
	</tr>
	<tr> 
		<td><input name "s1pc29" type="submit" value="pc29" ></td>
		<td><input name "s1pc30" type="submit" value="pc30" ></td>
	</tr>
	
	</table>
	</div>
	</TD>
</TR>
<tr></tr>
</TABLE>


</form>
<br>

<?
}
  PageEnd();
?>
