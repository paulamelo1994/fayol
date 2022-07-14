<?
   require '../../functions.php';
   $rootPath = '../../';
   
   session_start();   
   if( !isset($_SESSION['sesionValida']) )
   {
      header('Location: /Error404.php');
	  die();
   }
   
   $_GET['submenu_solicitudes'] = true;

   
   DBConnect('fayol');

   $valign = 'top';
   PageInit('Reporte de Fallas ', '../menu.php');
     
    $rs = db_query("select causafalla, elemento, motivoestado, observaciones from solicitudsoporte, fichaatencionsoporte  where 
	solicitud=numsolicitud ");

	?>
<div align="center" ><h2>Reporte de Fallas</h2></div><?
	
	$obj1 = pg_fetch_object(db_query("select count(causafalla) from fichaatencionsoporte"));
	$obj2 = pg_fetch_object(db_query("select count(causafalla) from fichaatencionsoporte where causafalla ='u'" ));
	$obj3 = pg_fetch_object(db_query("select count(causafalla) from fichaatencionsoporte where causafalla ='t'"));
	
	
	?>
	<strong>Total de Solicitudes atendidas:</strong>
	<?=$obj1->count;?><br>
	<strong>N&uacute;mero de Fallos causdos por Usuarios:</strong>
	<?=$obj2->count;?><br>
	<strong>N&uacute;mero de Fallas T&eacute;cnicas:</strong>
	<?=$obj3->count;?><br>
	<strong>Sin Especificar:</strong><?=$obj1->count -($obj3->count + $obj2->count)?>
	<br><br>
	<table>
		<tr>
			<td  STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><strong>Causa de Falla </strong></td>
		    <td  STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><strong>Elemento</strong></td>
		    <td  STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><strong>Motivo</strong></td>
		    <td  STYLE="color:white; background-color:#CC0000;" ALIGN="CENTER"><strong>Observaciones</strong></td>
		</tr>
	<?
	while( $obj = pg_fetch_object($rs) )
	{
		$color = ($color=='#FCFCFC')? '#D0DEE9' : '#FCFCFC';
		?><tr BGCOLOR='<?=$color?>'><td width="10%"><? 
		if ($obj->causafalla == 'u')
			echo 'Usuario';
		else
			echo 'T&eacute;cnica';
		 ?></td>
		 <td width="10%"><?= $obj->elemento?></td>
		 <td width="40%" align="center"><textarea cols="25" rows="3" readonly><?= $obj->motivoestado?></textarea></td>
		 <td width="40%" align="center"><textarea cols="25" rows="3" readonly><?= $obj->observaciones?></textarea></td>
		 </tr><?
	}
	?>
	
	</table>
	
	<?
   PageEnd();
?>