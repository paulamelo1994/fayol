<?
	require '../../functions.php';
	$root_path = "../..";
	
	$_GET['submenu_simulacro_ecaes'] = true;
	
	PageInit("Registrados Simulacro ECAES", "../menu.php");
	
	$conexion = DBConnect('fayol');
	
	if(!$conexion)
		echo "<h2>No se logro la conexi&oacute;n con la BD.</h2>";
	else
	{
		$rs = db_query("select * from simulacro_ecaes order by nombre");
		$i = 1;
		?>
		<table width="500" align="center" border="10" cellpadding="2" cellspacing="0">
		<th width="10%"></th>
		<th width="30%" align="center">Codigo</th>
		<th width="60%" align="center">Nombre</th>
		<?
		while($obj = pg_fetch_object($rs))
		{
			?>
			<tr>
				<td align="center"><?=$obj->indice?></td>
				<td align="center"><?=$obj->codigo?></td>
				<td><?=$obj->nombre?></td>
			</tr>
			<?
			$i++;
		}
		?>
		</table>
		<?
	}
	PageEnd();
?>