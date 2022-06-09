<?
	session_start();
	
	if(!isset($_SESSION['inventario']))
	{
		header ("Location: /Comunidad/Inventario/index.php");
		die();
	}
	
	require '../../functions.php';
	$root_path = "../..";
	
	$_GET['submenu_inventario'] = true;
	
	
	PageInit("Consultas", "../menu.php");
	
?>
<table border="1" bordercolor="#FF0000">
<tr bgcolor="#cc6666"><td height="28" align="center" ><span class="Estilo2">Nombre de Los Planes</span></td>
</tr>
<tr><td>
<table>
	<?

	$buscar= "%".$_GET['buscar']."%";
		
	DBConnect('controlsalas');
	$consulta = "SELECT * from planes where codigo like '$buscar';";
	
	$rs = db_query($consulta);
	if(pg_num_rows($rs) != 0)
	{
		while($obj = pg_fetch_object($rs))
		{
		?>

		<tr><td> <span class="Estilo3"><?= $obj->codigo?> - <?= $obj->nombre?></span></td>
		</tr>

		<?		
		}
	}

?>
</td></tr>
</table>
<tr><td height="39" align="center">
<button onClick="window.close()" >Aceptar</button></td></tr>
</table>
<?
	PageEnd();
?>