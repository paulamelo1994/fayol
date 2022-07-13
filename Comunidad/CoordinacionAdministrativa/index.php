<?
	session_start();

	require '../../functions.php';
	$root_path = "../..";
	$_GET['submenu_coord_admin'] = true;
	
	$_GET['inicio'] = true;


	  $valign = 'TOP';
	  PageInit("Coordinaci&oacute;n Administrativa", "../menu.php", 8);


?>
<h1>Lista de Archivos</h1>
<?
$conexion= @DBConnect('new_fayol');

if(!empty($conexion)) //Si hay conexion
{
	$res = db_query("SELECT * FROM archivo where id_categoria=1 and visible = true order by id desc;");
	$numrows = pg_num_rows($res);
	
	if ( $numrows == 0 )
	{
		echo "Aun no hay noticias publicadas.";
	}
	else
	{
		for($i = 0; $i < $numrows ; $i++)
		{
			$obj = pg_fetch_object($res);
			?>
			<a href="<?=$obj->direccion;?>" target="_blank"><?=$obj->nombre?></a><br><?
		}
	}
}
else
{
	echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos. En el momento no se pueden ver los archivos, por favor intentelo m&aacute;s tarde.</p>";
}
$editar_id = 0;


PageEnd();
?>