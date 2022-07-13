
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="Author" content="agenda">
	<meta name="GENERATOR" content="Mozilla/4.77 [en] (Win98; U) [Netscape]">
	<title>Sugerencias/ Universidad del Valle / Cali, Colombia</title>
	<style type="text/css">
	p {text-align:justify;};
	</style>
</head>
<body text="#000000" bgcolor="#FFFFFF" link="#0000EE" vlink="#551A8B" alink="#FF0000">
<?
	include "../functions.php";

// Aqui me conecto a la base de datos
$con = @DBConnect('');// organizar base de datos para sugerencias

if(!empty($con)) //Si hay conexion
{
if(@$_POST['hjh']=="hjh"){
	$nombres= $_POST['nombres_usuario'];
	$codigo= $_POST['codigo_usuario'];
	$email=$_POST['email_usuario'];
	$t_usuario=$_POST['tipo_usuario'];
	$ciudad=$_POST['ciudad'];
	$departamento=$_POST['departamento'];
	$pais=$_POST['pais'];
	$tipoSugerencia=$_POST['tipo_sugerencia'];
	$descripcionSugerencia=$_POST['descripcion_sugerencia'];
	
	$query = "insert into contactos (nombre,telefono, email,foto) values ('".$nombre."','".$telefono."','".$email."','".$ext."')";
	mysql_query($query,$conexion) or die ("error en la base de datos");
	
	$id = mysql_insert_id($conexion);
	
} 

}	

?>
<h1 class="shiny">&nbsp;</h1>
<h1 class="shiny">SUGERENCIA, QUEJA, RECLAMO O RECONOCIMENTO (SQRR)</h1>
<table WIDTH="100%">
<tr valign="top">
	<td>
	  <p class="style67" align="justify">Gracias por sus aportes, ellos nos permiten mejorar los servicios que ofrecemos.</p>
	  <p class="style67" align="justify">Su opini&oacute;n es muy importante para nosotros, por favor llene este formato con sus datos personales para poder responder a sus inquietudes.</p>
	  <ul><li><font color="#CC0000"><b>Los campos marcados con asterisco (*) deben ser obligatoriamente llenados.</b></font></li>
	</ul>
	<BR><BR>
	<h3>Datos del SQRR </h3>
	<br>
	<form method="post" action="index.php?item=4">
	<input type="hidden" name="segundavez" value="1">
	<table BORDER="0" WIDTH="100%">
	<tr valign="top">
		<td><b>Nombres y Apellidos : </b></td>
		<td><FONT color="#FF0000"><B>* </B></FONT>
		<input NAME="nombres_usuario" TYPE="text" id="nombres_usuario" SIZE="35">
		</td>
	</tr>
	<tr valign="top">
		<td><b>Codigo o C&eacute;dula:</b></td>
		<td><FONT color="red"><B>* </B></FONT><input NAME="codigo_usuario" TYPE="text" id="codigo_usuario" size="35"></td>
	</tr>
	<tr valign="top">
		<td><b>E-mail:</b></td>
		<td><FONT color="white"><B>* </B></FONT><input NAME="email_usuario" TYPE="text" id="email_usuario" size="35"></td>
	</tr>
	<tr valign="top">
		<td><b>Telefono:</b></td>
		<td><FONT color="red"><B>* </B></FONT><input NAME="telefono_usuario" TYPE="text" id="telefono_usuario" size="35"></td>
	</tr>
	<tr valign="top">
		<td><strong>Usuario (Elija) : </strong></td>
		<td valign="middle"><FONT color="red"><B>* </B></FONT><select name="tipo_usuario" size="1" id="tipo_usuario">
		      <option selected>Estudiantes Pregrado</option>
		      <option>Estudiantes Postgrado</option>
		      <option>Docente</option>
		      <option>Funcionario</option>
		      <option>Egresado</option>
		      <option>Pensionado</option>
	        </select>
        </td>
	</tr>
	<tr valign="top">
		<td><b>Ciudad:</b></td>
		<td><FONT color="red"><B>* </B></FONT><input TYPE="text" NAME="ciudad" value="Cali" size="35"></td>
	</tr>
	<tr valign="top">
		<td><b>Departamento:</b></td>
		<td><FONT color="red"><B>* </B></FONT><input TYPE="text" NAME="departamento" value="Valle del Cauca" size="35"></td>
	</tr>
	<tr valign="top">
		<td><b>Pa&iacute;s:</b></td>
		<td><FONT color="red"><B>* </B></FONT><input TYPE="text" NAME="pais" value="Colombia" size="35"></td>
	</tr>
	<tr valign="top">
	  <td><b>Tipo de Sugerencia :</b></td>
	  <td><FONT color="red"><B>*</B></FONT>
<select name="tipo_sugerencia" size="1" id="tipo_sugerencia">
  <option selected>Sugerencia</option>
  <option>Queja</option>
  <option>Reclamo</option>
  <option>Reconocimiento</option>
          </select>
        </td>
	  </tr>
	<tr valign="top">
	  <td><b>Descripcion</b></td>
	  <td><FONT color="red"><B>*</B></FONT> <textarea name="descripcion_sugerencia" cols="50" rows="6" id="descripcion_sugerencia"></textarea></td>
	  </tr>
	<tr valign="top">
	  <td colspan="2"><form name="form1" method="post" action="">
        <input name="enviar_formulario" type="submit" id="enviar_formulario" value="Enviar">
        <input name="Restablecer" type="reset" value="Limpiar">
      </form></td>
	  </tr>
	</table>
</body>
</html>