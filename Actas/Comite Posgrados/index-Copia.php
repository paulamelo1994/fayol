<?
   require '../../../functions.php';
   $rootPath = '../../../';
   
   $valign = 'top';
   $centrar_contenido = false;
   //$_GET['submenu_actas'] = true;
   $_GET['actas_claustro'] = true;
   DBConnect("new_fayol");
   
   //PageInit('Actas de comit&eacute; de posgrados', '../../menu.php', 'left', 'top');

	if($_GET['agno']>2004){
		$anio=$_GET['agno'];	
		$query1 = db_query("select * from actas_facultad where fecha >='$anio-01-01' and fecha<= '$anio-12-31' and  tipo_acta='9' order by n_acta ASC");
		if(pg_num_rows($query1) != 0 ){
	   	$aux=0;
			?>
			 
			 	<a href="index-Copia.php">Volver</a>
				<br/>
				<H2 STYLE="color:black;">
		  		<?= IMAGEN_ACTAS_MINI ?>
 				 A&ntilde;o <?= $anio ?>:</H2>
				<table width="80%" align="center">
         			<tr>
					 <? while($obj1=pg_fetch_object($query1)){ ?>
                  		<td width="25%"><a href="<?= $anio."/".$obj1->archivo ?>" target="_blank">Acta <?= $obj1->n_acta ?>. <?= cambiarMesCompleto($obj1->fecha)." ".substr($obj1->fecha,8,2) ?> </a><img src="../../../Images/plantilla/pdf_button.png"></td>
							<? $aux++;
							if($aux==2){?> </tr><tr>  <? $aux=0;}
							} ?>
					</tr>
				</table>
				<br>
			 <?
			
		}
		BorderEnd();
	}
	else if($_GET['agno']=='2004')
	{
	?>
		<a href="index-Copia.php">Volver</a><!--
		<br/>
			<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2004:</H2>
			<table width="100%">
			<tr>
				<td width="30">&nbsp;</td>
				<td>
				<table width="100%" border="0">
				<tr>
					<td width="25%"><A HREF="<?=makeURL("Acta No 01-04.pdf")?>" target="actas">Acta 1. Ene 29</a><img src="../../../Images/plantilla/pdf_button.png"></td>
					<td width="25%"><a href="<?=makeURL("Acta No 02-04.pdf")?>" target="actas">Acta 2. Mar 9</a><img src="../../../Images/plantilla/pdf_button.png"></td>
					<td width="25%"><a href="<?=makeURL("Acta No 03-04.pdf")?>" target="actas">Acta 3. Mar 31</a><img src="../../../Images/plantilla/pdf_button.png"></td>
					<td width="25%"><a href="<?=makeURL("Acta No 04-04.pdf")?>" target="actas">Acta 4. Jun 8</a><img src="../../../Images/plantilla/pdf_button.png"></td>
				</tr>
				<tr>
					<td><a href="<?=makeURL("Acta No 05-04.pdf")?>" target="actas">Acta 5. Jun 28</a><img src="../../../Images/plantilla/pdf_button.png"></td>
					<td><a href="<?=makeURL("Acta No 06-04.pdf")?>" target="actas">Acta 6. Sep 1</a><img src="../../../Images/plantilla/pdf_button.png"></td>
					<td><a href="<?=makeURL("Acta No 07-04.pdf")?>" target="actas">Acta 7. Sep 23</a><img src="../../../Images/plantilla/pdf_button.png"></td>
					<td>&nbsp;</td>
				</tr>
				</table>
				</td>
			</tr>
			</table>-->
	<?
		BorderEnd();
		}
		else
		{		
			$query1 = db_query("select distinct extract (YEAR from fecha)as anno from actas_facultad where tipo_acta='9' order by anno desc");
			if(pg_num_rows($query1) != 0 )
			{		   
				 while($obj1=pg_fetch_object($query1))
				 {?>
					<A HREF="index-Copia.php?agno=<? echo $obj1->anno; ?>" TARGET="_self"> <?= IMAGEN_ACTAS_MINI ?> A&ntilde;o <? echo $obj1->anno; ?> </A><br><br>
				 <?
				 }
			}?>
<!--			<A HREF="index.php?agno=2004" TARGET="_self"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2004</A><br>-->
	<? 
		}
   		//PageEnd();
?>