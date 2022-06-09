<?
	require "../../functions.php";
	$rootPath = "../..";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Bolsa de Empleos</title>
	<link rel="stylesheet" type="text/css" href="/estiloweb.css">
</head>
<body>
	<center>
	<BR>
	<?  
	$con = DBConnect('fayol');
	$rs = db_query("select * from bolsaempleos order by id desc");
	
	if(!pg_num_rows($rs))
	die("<CENTER><FONT COLOR=RED><B>No hay empleos disponibles</B></FONT></CENTER>");
	
	?>
	<BR>
	<TABLE BORDER="2">
	<TR>
		<TD ALIGN="CENTER" COLSPAN="3">
		<B><FONT color="#000080">BOLSA DE EMPLEOS</FONT><BR>
		FECHA ULTIMA ACTUALIZACION: </B>
		<? include "ultima_actualizacion.txt"; ?>
		</TD>
	</TR>
	<TR>
		<TD ALIGN="CENTER"><B>CARGO</B></TD>
		<TD ALIGN="CENTER"><B>REQUISITOS EXIGIDOS</B></TD>
		<TD ALIGN="CENTER"><B>CONTACTO</B></TD>
	</TR>
	<?
	
	while($obj = pg_fetch_object($rs))
	{
		?>
		<TR>
			<TD WIDTH="250"><B><?= $obj->cargo ?><BR><?= $obj->fecha ?></B></TD>
			<TD WIDTH="400"><?= makeHtml($obj->requisitos) ?></TD>
			<TD WIDTH="250"><?= makeHtml($obj->contacto) ?></TD>
		</TR>
		<?
	}
	?>
	</TABLE>
	<BR>
	<HR WIDTH="90%">
	<B>FECHA ULTIMA ACTUALIZACION: </B><? include "ultima_actualizacion.txt"?><BR>
	<A HREF="mailto:empleos@univalle.edu.co">empleos@univalle.edu.co</A><BR>
	Tel. 556 00 59<BR>
	</CENTER>
</body>
</html>