<?
	session_start();
	
	require "../../functions.php";
	$rootPath = "../..";
	
	$_GET['submenu_empleos'] = true;
	
	if(isset($_GET['item']) && $_GET['item'] == 's')
		unset($_SESSION['autenticado_empleos']);
  
	PageInit("Bolsa de Empleos", "../menu.php");
	
	$con = DBConnect('fayol');
	$rs = db_query("select * from bolsaempleos order by id desc");
	?>
	<h1 class="shiny">Bolsa de Empleos</h1>
	<CENTER><B><I>Aqu&iacute; encontrar&aacute;s ofertas de empleos que pueden interesarte, no dudes<BR>en 
	comunicarte con la oficina sugerida cumpliendo los requisitos exigidos.</I></B><BR></CENTER><BR>
	<?
	if(!pg_num_rows($rs))
	{
		echo "<CENTER><FONT COLOR=RED><B>No hay empleos disponibles</B></FONT></CENTER>";
	}
	else
	{
		while($obj = pg_fetch_object($rs))
		{
			?>
			<hr width="90%">
			<TABLE width="90%" align="center">
			<TR>
				<TD width="50%"><FONT COLOR=NAVY><B><?=$obj->cargo?></B></FONT></TD>
				<TD width="50%" align="right">
				<FONT COLOR=NAVY><B>Fecha de publicaci&oacute;n:<br><?=($obj->fecha)? $obj->fecha : 'No establecida' ?></B></FONT>
				</TD>
			</TR>
			<TR>
				<TD colspan="2">
				<p><FONT COLOR=NAVY><B>REQUISITOS:<BR></B></FONT>
				<?=makeHtml($obj->requisitos)?>
				<br><br>
				<FONT COLOR=NAVY><B>CONTACTO:<BR></B></FONT>
				<?=makeHtml($obj->contacto)?>
				</p>
				</TD>
			</TR>
			</TABLE>
			<?
		}
	}
	?>
	<BR>
	<CENTER>
	<hr width="90%">
	<a href="mailto:empleos@univalle.edu.co">empleos@univalle.edu.co</a> <BR>
	Informaci&oacute;n adicional en la Coordinaci&oacute;n Administrativa de la Facultad<BR>
	Ana Perez tel. 554 24 16 
	</CENTER>
	<?
	PageEnd();
?>