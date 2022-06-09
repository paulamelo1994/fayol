<?
	session_start();

	require '../../functions.php';
	$root_path = "../..";
	$_GET['egresados'] = true;
	$_GET['archivos'] = true;

	if($item==5)
	{
		unset($_SESSION['egresados']);
		header("Location: administrar.php");
		die();
	}


	  $valign = 'TOP';
	  PageInit("Egresados", "../menu.php", 8);


?>
<h1>Lista de Archivos</h1>
<?
$conexion= @DBConnect('new_fayol');

if(!empty($conexion)) //Si hay conexion
{
	// 2 Para egresados
	$res = db_query("SELECT * FROM archivo where id_categoria=2 and visible = true order by id desc;");
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