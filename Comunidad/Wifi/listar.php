<?
   require '../../functions.php';
   $rootPath = '../../';
   
   session_start();   
   if( !isset($_SESSION['sesionValida']) )
   {
      header('Location: /Error404.php');
	  die();
   }
   
   $_GET['submenu_wifi'] = true;

   
   DBConnect('fayol');

	if($_GET['borrar'])
	{

		$indice = $_GET['borrar'];
		$rs = db_query("select * from equiposwifi where indice='$indice' ");
		
		if(pg_num_rows($rs) == 0 )
		{
			?>
				<script language="javascript" type="text/javascript">
				alert("No se encuentra el equipo");
				</script>
			<?
		}
		else
		{	

			
			$rs = db_query("DELETE FROM equiposwifi WHERE indice = '$indice'");
			if(!$rs)
			{
				?>
				<script language="javascript">
				alert("Ha ocurrido un error al procesar el registro.");
				history.back(1)
				</script>
				<?
			}
			else if($rs)
			{
				echo '<script language="javascript">
				alert("Se ha eliminado correctamente.");
				</script>';
				
				?>
				
				
				<script language="javascript">
				location.href="listar.php";
				</script>
				<?
					
			}
			
		}
	}

	if($_POST["aceptar"])
	{
	
		$rs = db_query("select * from equiposwifi where indice='$_GET[indice]' ");
		
		if(pg_num_rows($rs) == 0 )
		{
			?>
				<script language="javascript" type="text/javascript">
				alert("No se encuentra el equipo");
				</script>
			<?
		}
		else
		{	
			$mac = $_POST['mac'];
			$indice = $_GET['indice'];
			$rs = db_query("UPDATE equiposwifi SET mac='$mac' where indice='$indice'");
			if(!$rs)
			{
				?>
				<script language="javascript">
				alert("Ha ocurrido un error al procesar el registro.");
				history.back(1)
				</script>
				<?
			}
			else if($rs)
			{
				echo '<script language="javascript">
				alert("Se ha registrado los datos correctamente.");
				</script>';
				
				?>
				
				
				<script language="javascript">
				location.href="listar.php";
				</script>
				<?
					
			}
		}
	}


   $valign = 'top';
   PageInit('Listado de Equipos Registrados ', '../menu.php');
     
    $rs = db_query("select * from equiposwifi order by indice asc");

?>
	<ul>
	  <li><a href="index.php">Home</a></li>
	  <li><a href="registrarpc.php">Registrar Pc </a></li>
	</ul>
	<table>
		<tr>
			<td  STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><strong>Codigo</strong></td>
		    <td  STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><strong>Plan</strong></td>
		    <td  STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><strong>Nombre</strong></td>
		    <td  STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><strong>Mac</strong></td>
		</tr>
	<?
	while( $obj = pg_fetch_object($rs) )
	{
		$color = ($color=='#FCFCFC')? '#D0DEE9' : '#FCFCFC';
		?><tr BGCOLOR='<?=$color?>'><td width="10%">
		<?= $obj->codigo; ?></td>
		 <td width="10%"><?= $obj->plan?></td>
		 <td width="40%" align="center"><?= $obj->propietario?></td>
		 <? if($_GET['indice'] == $obj->indice)
		 { ?>
			 <form method="post"  enctype="multipart/form-data">
			 <td width="40%" align="center"><input type="text" name="mac" value="<?= $obj->mac;?>"> 
			 <input type="submit" name="aceptar" value="Editar"></td>
			 </form>
		 <? }
		 else
		 { ?>
		 <td width="40%" align="center"><?= $obj->mac;?> 
		 <?='<a href="listar.php?indice='.$obj->indice.'">Editar</a>';?> <?='<a href="listar.php?borrar='.$obj->indice.'">Eliminar</a>';?></td>
		 <? } ?>
	</tr><?
	}
	?>
	
	</table>
	
	<?
   PageEnd();
?>