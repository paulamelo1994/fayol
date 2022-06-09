<?
   require '../../../functions.php';
   $rootPath = '../../../';
   
   $valign = 'top';
   $centrar_contenido = false;
   //$_GET['submenu_actas'] = true;
   DBConnect("new_fayol");
   
   //PageInit('Actas de Contaduria Pública', '../../menu.php', 'left', 'top');


	$query1 =db_query("select distinct extract (YEAR from fecha)as anno from actas_facultad where tipo_acta='5' order by anno desc");
	if(pg_num_rows($query1) != 0 ){
   	
		 while($obj1=pg_fetch_object($query1)){
		 $anio=$obj1->anno;
		 ?>
		
		 	<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?>
			A&ntilde;o <?= $anio ?>:</H2>
			<? $query2 = db_query("select * from actas_facultad where fecha >='$anio-01-01' and fecha<= '$anio-12-31' and  tipo_acta='5' order by n_acta ASC");
				if(pg_num_rows($query2) != 0 ){
				$aux=0;
					?>
					<table width="90%" align="center">
						<tr>
						 <? while($obj2=pg_fetch_object($query2)){
						 	$mes1=cambiarMes($obj2->fecha);
							?>
							<td width="25%"><a href="<?= $anio."/".$obj2->archivo ?>" target="_blank">Acta <?= $obj2->n_acta ?>. <?= $mes1 ?>  <?=substr($obj2->fecha,8,2) ?> </a></td>
								<? $aux++;
								if($aux==4){?> </tr><tr>  <? $aux=0;}
							} ?>
						</tr>
					</table>
					<br>
				 <?
			   }
		}
	}
?>
  
<H2 STYLE="color:black;">&nbsp;</H2>
<H2 STYLE="color:black;">
  <?= IMAGEN_ACTAS_MINI ?>
  A&ntilde;o 2009:</H2>
<table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%" border="0"><tr>
	<td width="25%"><a href="2009/Comite DCF Acta No.001.2009.pdf" target="_blank">Acta 01 Ene 14 </a></td>
	<td width="25%"><a href="2009/Comite DCF Acta No.002-2009.pdf" target="_blank">Acta 02 Feb 02</a></td>
	<td width="25%"><a href="2009/ComiteDCFActa 003-2009-02-09.pdf" target="_blank">Acta 03 Feb 09</a></td>
	<td width="25%"><a href="2009/ComiteDCF ActaNo.004-2009-02-16.pdf" target="_blank">Acta 04 Feb 16</a></td>
	</tr>
	<tr>
	<td width="25%"><a href="2009/ComiteDptoActa-005-2009.pdf" target="_blank">Acta 05 Mar 2</a></td>
	<td width="25%"><a href="2009/ComiteDptoActa-0062009.pdf" target="_blank">Acta 06 Mar 9</a></td>
	<td width="25%"><a href="2009/ComiteDptoActa-007-2009.pdf" target="_blank">Acta 07 Mar 16</a></td>
	<td width="25%"><a href="2009/ComiteDptoActa-008-2009.pdf" target="_blank">Acta 08 Mar 30 </a></td>
	</tr>
		<tr>
	<td width="25%"><a href="2009/ComiteDptoActa-009-2009.pdf" target="_blank">Acta 09 Abr 13</a></td>
	<td width="25%"><a href="2009/ComiteDptoActa-010-2009.pdf" target="_blank">Acta 10 Abr 20 </a></td>
	<td width="25%"><a href="2009/Comite%20DCF%20Acta%20No.011-2009.pdf" target="_blank">Acta 11. May 04 </a></td>
	<td width="25%"><a href="2009/Comite_DCF_Acta_No.012-2009.pdf" target="_blank">Acta 12. May 18 </a></td>
	</tr>
		<tr>
		  <td><a href="2009/Comite_DCF_Acta_No.013.2009.pdf" target="_blank">Acta 13. May 22 </a></td>
		  <td><a href="2009/Comite_DCF_Acta_No.014.2009.pdf" target="_blank">Acta 14. Jun 01 </a></td>
		  <td><a href="2009/Comite_DCF_Acta_No.015._2009.pdf" target="_blank">Acta 15. Jun 08</a> </td>
		  <td><a href="2009/Comite_DCF_Acta_No.016._2009.pdf" target="_blank">Acta 16. Jun 17 </a></td>
	    </tr>
		<tr>
		  <td><a href="2009/Comite_DCF_Acta_No.017._2009.pdf" target="_blank">Acta 17. Jun 26 </a></td>
		  <td><a href="2009/Comite_DCF_Acta_No.018._2009.pdf" target="_blank">Acta 18. Jul 01 </a></td>
		  <td><a href="2009/Comite_DCF_Acta_No.019._2009.pdf" target="_blank">Acta 19. Jul 10</a> </td>
		  <td><a href="2009/Comite_DCF_Acta_No.020._2009.pdf" target="_blank">Acta 20. Ago 19 </a></td>
	    </tr>
		<tr>
		  <td><a href="2009/Comite_DCF_Acta_No.021._2009.pdf" target="_blank">Acta 21. Ago 21</a> </td>
		  <td><a href="2009/Comite_DCF_Acta_No.022._2009.pdf" target="_blank">Acta 22. Ago 31 </a></td>
		  <td><a href="2009/Comite_DCF_Acta_No.023._2009.pdf" target="_blank">Acta 23. Sep 07 </a></td>
		  <td><a href="2009/Comite_DCF_Acta_No.024._2009.pdf" target="_blank">Acta 24. Sep 14 </a></td>
	    </tr>
		<tr>
		  <td><a href="2009/Comite_DCF_Acta_No.025._2009.pdf" target="_blank">Acta 25. Sep 28 </a></td>
		  <td><a href="2009/Comite_DCF_Acta_No.026._2009.pdf" target="_blank">Acta 26. Oct 16</a></td>
		  <td><a href="2009/Comite_DCF_Acta_No.027._2009.pdf" target="_blank">Acta 27. Oct 23</a></td>
		  <td><a href="2009/Comite_DCF_Acta_No.028._2009.pdf" target="_blank">Acta 28. Oct 29 </a></td>
	    </tr>
		<tr>
		  <td><a href="2009/Comite_DCF_Acta_No.029._2009.pdf" target="_blank">Acta 29. Nov 13 </a></td>
		  <td>&nbsp;</td>
		  <td></td>
		  <td></td>
	    </tr>
	</table>
	</td>
</tr>
</table>
<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2008:</H2>
<table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%" border="0"><tr>
	<td width="25%"><a href="2008/DCF Acta 09 08.pdf">Acta 09. Sep 1 </a></td>
	<td width="25%"><a href="2008/DCF Acta 10 08.pdf">Acta 10. Oct 3 </a></td>
	<td width="25%"><a href="2008/DCF Acta 11 08.pdf"> Acta 11. Oct 27 </a></td>
	<td width="25%"><a href="2008/DCF Acta 12 08.pdf"> Acta 12. Dic 11 </a></td>
	</tr>
	</table>
	</td>
</tr>
</table>
<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2005:</H2>
<table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%" border="0"><tr>
	<td width="25%"><A HREF='2005/DCF%20Acta%2003%2005.pdf' target="actas">Acta 3. Mar 15 </a></td>
	<td width="25%"><a href='2005/DCF%20Acta%2004%2005.pdf' target="actas">Acta 4. Mar 29 </a></td>
	<td width="25%"><a href='2005/DCF%20Acta%2005%2005.pdf' target="actas">Acta 5. Abr 12 </a></td>
	<td width="25%"><a href='2005/DCF%20Acta%2006%2005.pdf' target="actas">Acta 6. Abr 16 </a></td>
	</tr>
	<tr>
		<td><a href='2005/DCF%20Acta%2007%2005.pdf' target="actas">Acta 7. Abr 26 </a></td>
		<td><a href='2005/DCF%20Acta%2008%2005.pdf' target="actas">Acta 8. May 11 </a></td>
		<td><a href='2005/DCF%20Acta%2009%2005.pdf' target="actas">Acta 9. Jun 7 </a></td>
		<td><a href='2005/DCF%20Acta%2010%2005.pdf' target="actas">Acta 10. Ago 16 </a></td>
	</tr>
	<tr>
		<td><a href='2005/DCF%20Acta%2011%2005.pdf' target="actas">Acta 11. Ago 22 </a></td>
		<td><a href='2005/DCF%20Acta%2012%2005.pdf' target="actas">Acta 12. Ago 29 </a></td>
		<td><a href='2005/DCF%20Acta%2013%2005.pdf' target="actas">Acta 13. Sep 7 </a></td>
		<td><a href='2005/DCF%20Acta%2014%2005.pdf' target="actas">Acta 14. Sep 30 </a></td>
	</tr>
	</table>
	</td>
</tr>
</table>
<br><br><br>
<H1 class="shiny"><?= IMAGEN_ACTAS ?> Actas del Claustro de Profesores</H1>
<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2009:</H2>
<table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%" border="0"><tr>
	<td width="25%"><a href="2009/CLAUSTRO-FEBRERO-16-2009.pdf">Acta de Feb 16 </a></td>
	<td width="25%"><a href="2009/CLAUSTRO-FEBRERO-23-2009.pdf">Acta de Feb 23</a></td>
	<td width="25%"><a href="2009/CLAUSTRO-MARZO-16-2009.pdf">Acta de Mar 16</a></td>
	<td width="25%"><a href="2009/CLAUSTRO-ABRIL-27-2009.pdf">Acta de Abr 27</a></td>
	</tr>
	</table>
	</td>
</tr>
</table>
<br><br><br>

<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2008:</H2>
<table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%" border="0"><tr>
	<td width="25%"><a href="2008/CLAUSTROOCTUBRE-20-2008.pdf">Acta de Oct 20</a></td>
	<td width="25%"><a href="2008/CLAUSTRONOVIMBRE-12-08.pdf">Acta de Nov 12</a></td>
	<td width="25%"><a href="2008/CLAUSTRODICIEMMBRE-3-08.pdf">Acta de Dic 3</a></td>
	<td width="25%"><a href="2008/CLAUSTRODICIEMMBRE-17-08.pdf">Acta de Dic 17</a></td>
	</tr>
	</table>
	</td>
</tr>
</table>
<? 
   //PageEnd();
?>