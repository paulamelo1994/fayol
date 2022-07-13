<?
	require '../../../functions.php';
	$rootPath = '../../../';
	
	$valign = 'top';
	$centrar_contenido = false;
	$_GET['submenu_actas'] = true;
	$_GET['actas_curriculo'] = true;
	 DBConnect("new_fayol");
	
	PageInit('Actas del Comit&eacute; de curr&iacute;culo', '../../menu.php', 'left', 'top');
?>
<H1 class="shiny"><?= IMAGEN_ACTAS ?> Actas del Comit&eacute; de curr&iacute;culo </H1>

<?

	$query1 =db_query("select distinct extract (YEAR from fecha)as anno from actas_facultad where tipo_acta='2' order by anno desc");
	if(pg_num_rows($query1) != 0 ){
   	
		 while($obj1=pg_fetch_object($query1)){
		 $anio=$obj1->anno;
		 ?>
		
		 	<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?>
			A&ntilde;o <?= $anio ?>:</H2>
			<? $query2 = db_query("select * from actas_facultad where fecha >='$anio-01-01' and fecha<= '$anio-12-31' and  tipo_acta='2' order by n_acta ASC");
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

<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2010:</H2>
<table width="100%" border="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td><table width="100%" border="0">
	   <tr>
          <td width="25%"><a href="2010/Acta_No_01-10_Comite_Curriculo.pdf" target="_blank">Acta 1. Ene 21</a></td>
          <td width="25%"><a href="2010/Acta_No_02-10_Comite_Curriculo.pdf" target="_blank">Acta 2.  Mar 18 </a></td>
          <td width="25%"><a href="2010/Acta_No_03-10%20_Comite_Curriculo.pdf" target="_blank">Acta 3. Abr 8 </a></td>
		  <td width="25%"><a href="./2010/Acta_No_04-10_Comite_Curriculo.pdf" target="_blank">Acta 4. Abr 22</a></td>
        </tr>
        <tr>
          
          <td width="25%"><a href="./2010/Acta_N_05-10_Comite_Curriculo.pdf" target="_blank">Acta 5.  May 6 </a></td>
          <td width="25%"><a href="2010/Acta_No_06-10_Comite_Curriculo.pdf" target="_blank">Acta 6. May 20 </a></td>
		  <td width="25%"><a href="2010/Acta_No.7-10_Comite_Curriculo.pdf" target="_blank">Acta 7. Jun 03 </a></td>
        </tr>
    </table></td>
  </tr>
</table>
<H1 class="shiny">&nbsp;</H1>
<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2009:</H2>
<table width="100%" border="0">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%" border="0">
	<tr>
		<td width="25%"><a href="2009/Acta.%20No.1%20Comite%20Curriculo.pdf" target="_blank">Acta 1. Ene 29</a></td>
		<td width="25%"><a href="2009/Acta. No.2 Comite Curriculo.pdf" target="_blank">Acta 2. Feb 12</a></td>
		<td width="25%"><a href="2009/Acta. No.3 Comite Curriculo.pdf" target="_blank">Acta 3. Feb 26</a></td>
		<td width="25%"><a href="2009/Acta.%20No.4%20Comite%20Curriculo.pdf" target="_blank">Acta 4. Mar 25</a></td>
	</tr>
	<tr>
	  <td><a href="2009/Acta.%20No.5%20Comite%20Curriculo.pdf" target="_blank">Acta 5. Abr 02</a></td>
	  <td><a href="2009/Acta.%20No.6%20Comite%20Curriculo.pdf" target="_blank">Acta 6. Abr 30</a></td>
	  <td><a href="2009/Acta.%20No.7%20Comite%20Curriculo.pdf" target="_blank">Acta 7. May 14</a></td>
	  <td><a href="2009/Acta.%20No.8%20Comite%20Curriculo.pdf" target="_blank">Acta 8. May 21</a></td>
	  </tr>
	<tr>
	  <td><a href="2009/Acta.%20No.9%20Comite%20Curriculo.pdf" target="_blank">Acta 9. May 27</a></td>
	  <td><a href="2009/Acta.%20No.10%20Comite%20Curriculo.pdf" target="_blank">Acta 10. Jun 04</a></td>
	  <td><a href="2009/Acta.%20No.11%20Comite%20Curriculo.pdf" target="_blank">Acta 11. Jun 11</a></td>
	  <td><a href="2009/Acta.%20No.12%20Comite%20Curriculo.pdf" target="_blank">Acta 12. Jun 18</a></td>
	  </tr>
	<tr>
	  <td><a href="2009/Acta.%20No.13%20Comite%20Curriculo.pdf" target="_blank">Acta 13. Jul 02</a></td>
	  <td><a href="2009/Acta.%20No.14%20Comite%20Curriculo.pdf" target="_blank">Acta 14. Jul 04 </a></td>
	  <td><a href="2009/Acta.%20No.15%20Comite%20Curriculo.pdf" target="_blank">Acta 15. Jul 21 </a></td>
	  <td><a href="2009/Acta.%20No.16%20Comite%20Curriculo.pdf" target="_blank">Acta 16. Ago 27 </a></td>
	  </tr>
	<tr>
	  <td><a href="2009/Acta.%20No.17%20Comite%20Curriculo.pdf" target="_blank">Acta 17. Sep 10 </a></td>
	  <td><a href="2009/Acta.%20No.18%20Comite%20Curriculo.pdf" target="_blank">Acta 18. Sep 17 </a></td>
	  <td><a href="2009/Acta.%20No.19%20Comite%20Curriculo.pdf" target="_blank">Acta 19. Sep 24 </a></td>
	  <td><a href="2009/Acta.%20No.20%20Comite%20Curriculo.pdf" target="_blank">Acta 20. Oct 02 </a></td>
	  </tr>
	<tr>
	  <td><a href="2009/Acta.%20No.21%20Comite%20Curriculo.pdf" target="_blank">Acta 21. Oct 08 </a></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	</table>
	</td>
</tr>
</table>

<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2008:</H2>
<table width="100%" border="0">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%" border="0">
	<tr>
		<td width="25%"><a href="<?=makeURL("2008/Acta No 01-08.pdf")?>" target="actas"> Acta 1. Ene 17</a></td>
		<td width="25%"><a href="<?=makeURL("2008/Acta No 02-08.pdf")?>" target="actas"> Acta 2. Feb 07</a></td>
		<td width="25%"><a href="<?=makeURL("2008/Acta No 03-08.pdf")?>" target="actas"> Acta 3. Feb 21</a></td>
		<td width="25%"><a href="<?=makeURL("2008/Acta No 04-08.pdf")?>" target="actas"> Acta 4. Feb 28</a></td>
	</tr>
		<tr>
		<td><a href="<?=makeURL("2008/Acta No 05-08.pdf")?>" target="actas"> Acta 5. Mar 13</a></td>
		<td><a href="<?=makeURL("2008/Acta No 06-08.pdf")?>" target="actas"> Acta 6. Abr 02</a></td>
		<td><a href="<?=makeURL("2008/Acta No 07-08.pdf")?>" target="actas"> Acta 7. Abr 24 </a></td>
		<td><a href="<?=makeURL("2008/Acta No 08-08.pdf")?>" target="actas"> Acta 8. May 02</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2008/Acta No 09-08.pdf")?>" target="actas"> Acta 9. Jun 05 </a></td>
		<td><a href="<?=makeURL("2008/Acta No 10-08.pdf")?>" target="actas"> Acta 10. Jun 26</a></td>
		<td><a href="<?=makeURL("2008/Acta No 11-08.pdf")?>" target="actas"> Acta 11. Ago 20</a></td>
		<td><a href="<?=makeURL("2008/Acta No 12-08.pdf")?>" target="actas"> Acta 12. Sep 23</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2008/Acta No 13-08.pdf")?>" target="actas"> Acta 13. Sep 26 </a></td>
		<td><a href="<?=makeURL("2008/Acta No 10-08.pdf")?>" target="actas"> </a></td>
		<td><a href="<?=makeURL("2008/Acta No 11-08.pdf")?>" target="actas"> </a></td>
		<td><a href="<?=makeURL("2008/Acta No 12-08.pdf")?>" target="actas"> </a></td>
	</tr>
	</table>
	</td>
</tr>
</table>

<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2007:</H2>
<table width="100%" border="0">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%" border="0">
	<tr>
		<td width="25%"><a href="<?=makeURL("2007/Acta No 01-07.pdf")?>" target="actas"> Acta 1. Ene 11</a></td>
		<td width="25%"><a href="<?=makeURL("2007/Acta No 02-07.pdf")?>" target="actas"> Acta 2. Feb 08</a></td>
		<td width="25%"><a href="<?=makeURL("2007/Acta No 03-07.pdf")?>" target="actas"> Acta 3. Feb 22</a></td>
		<td width="25%"><a href="<?=makeURL("2007/Acta No 04-07.pdf")?>" target="actas"> Acta 4. Mar 08</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2007/Acta No 05-07.pdf")?>" target="actas"> Acta 5. Mar 22</a></td>
		<td><a href="<?=makeURL("2007/Acta No 06-07.pdf")?>" target="actas"> Acta 6. Abr 19</a></td>
		<td><a href="<?=makeURL("2007/Acta No 07-07.pdf")?>" target="actas"> Acta 7. May 03</a></td>
		<td><a href="<?=makeURL("2007/Acta No 08-07.pdf")?>" target="actas"> Acta 8. May 17</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2007/Acta No 09-07.pdf")?>" target="actas"> Acta 9. Jun 07</a></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2006:</H2>
<table width="100%" border="0">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%" border="0">
	<tr>
		<td width="25%"><a href="<?=makeURL("2006/Acta No 01-06.pdf")?>" target="actas"> Acta 1. Feb 2 </a></td>
		<td width="25%"><a href="<?=makeURL("2006/Acta No 02-06.pdf")?>" target="actas"> Acta 2. Feb 8 </a></td>
		<td width="25%"><a href="<?=makeURL("2006/Acta No 03-06.pdf")?>" target="actas"> Acta 3. Mar 2</a></td>
		<td width="25%"><a href="<?=makeURL("2006/Acta No 04-06.pdf")?>" target="actas"> Acta 4. Mar 03</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2006/Acta No 05-06.pdf")?>" target="actas"> Acta 5. Abr 6</a></td>
		<td><a href="<?=makeURL("2006/Acta No 06-06.pdf")?>" target="actas"> Acta 6. May 4</a></td>
		<td><a href="<?=makeURL("2006/Acta No 07-06.pdf")?>" target="actas"> Acta 7. Jun 1</a></td>
		<td><a href="<?=makeURL("2006/Acta No 08-06.pdf")?>" target="actas"> Acta 8. Jun 9</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2006/Acta No 09-06.pdf")?>" target="actas"> Acta 9. Jun 15</a></td>
		<td><a href="<?=makeURL("2006/Acta No 10-06.pdf")?>" target="actas"> Acta 10. Ago 31</a></td>
		<td><a href="<?=makeURL("2006/Acta No 11-06.pdf")?>" target="actas"> Acta 11. Sep 21</a></td>
		<td><a href="<?=makeURL("2006/Acta No 12-06.pdf")?>" target="actas"> Acta 12. Oct 26</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2006/Acta No 13-06.pdf")?>" target="actas"> Acta 13. Nov 2</a></td>
		<td><a href="<?=makeURL("2006/Acta No 14-06.pdf")?>" target="actas"> Acta 14. Nov 9</a></td>
		<td><a href="<?=makeURL("2006/Acta No 15-06.pdf")?>" target="actas"> Acta 15. Nov 23</a></td>
		<td><a href="<?=makeURL("2006/Acta No 16-06.pdf")?>" target="actas"> Acta 16. Dic 7</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2006/Acta No 17-06.pdf")?>" target="actas"> Acta 17. Dic 20</a></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
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
	<table width="100%">
	<tr>
		<td width="25%"><A href="<?=makeURL("2004/Acta No 01-04.pdf")?>" target="actas"> Acta 1. Ene 13 </a></td>
		<td width="25%"><a href="<?=makeURL("2004/Acta No 02-04.pdf")?>" target="actas"> Acta 2. Ene 25 </a></td>
		<td width="25%"><a href="<?=makeURL("2004/Acta No 03-04.pdf")?>" target="actas"> Acta 2. Feb 19</a></td>
		<td width="25%"><a href="<?=makeURL("2005/Acta No 03-05.pdf")?>" target="actas"> Acta 3. Mar 2</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2005/Acta No 04-05.pdf")?>" target="actas"> Acta 4. Mar 31</a></td>
		<td><a href="<?=makeURL("2005/Acta No 05-05.pdf")?>" target="actas"> Acta 5. Abr 21</a></td>
		<td><a href="<?=makeURL("2005/Acta No 06-05.pdf")?>" target="actas"> Acta 6. May 5</a></td>
		<td><a href="<?=makeURL("2005/Acta No 07-05.pdf")?>" target="actas"> Acta 7. May 19</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2005/Acta No 08-05.pdf")?>" target="actas"> Acta 8. Jun 2</a></td>
		<td><a href="<?=makeURL("2005/Acta No 09-05.pdf")?>" target="actas"> Acta 9. Jun 16</a></td>
		<td><a href="<?=makeURL("2005/Acta No 10-05.pdf")?>" target="actas"> Acta 10. Ago 25</a></td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</td>
</tr>
</table>

<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2004:</H2>
<table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%" border="0">
	<tr>
		<td width="25%"><A href="<?=makeURL("2004/Acta No 01-04.pdf")?>" target="actas"> Acta 1. Ene 22</a></td>
		<td width="25%"><a href="<?=makeURL("2004/Acta No 02-04.pdf")?>" target="actas"> Acta 2. Feb 5</a></td>
		<td width="25%"><a href="<?=makeURL("2004/Acta No 03-04.pdf")?>" target="actas"> Acta 3. Feb 19</a></td>
		<td width="25%"><a href="<?=makeURL("2004/Acta No 04-04.pdf")?>" target="actas"> Acta 4. Mar 4</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2004/Acta No 05-04.pdf")?>" target="actas"> Acta 5. Mar 25</a></td>
		<td><a href="<?=makeURL("2004/Acta No 06-04.pdf")?>" target="actas"> Acta 6. Abr 26</a></td>
		<td><a href="<?=makeURL("2004/Acta No 07-04.pdf")?>" target="actas"> Acta 7. May 13</a></td>
		<td><a href="<?=makeURL("2004/Acta No 08-04.pdf")?>" target="actas">Acta 8. Jun 3</a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2004/Acta No 09-04.pdf")?>" target="actas">Acta 9. Jun 17</a></td>
		<td><a href="<?=makeURL("2004/Acta No 10-04.pdf")?>" target="actas">Acta 10. Sep 6</a></td>
		<td><a href="<?=makeURL("2004/Acta No 11-04.pdf")?>" target="actas">Acta 11. Sep 27 </a></td>
		<td><a href="<?=makeURL("Acta No 12-04.pdf")?>" target="actas">Acta 12. Oct 14 </a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("2004/Acta No 13-04.pdf")?>" target="actas">Acta 13. Nov 12</a></td>
		<td><a href="<?=makeURL("2004/Acta No 14-04.pdf")?>" target="actas">Acta 14. Nov 25</a></td>
		<td><a href="<?=makeURL("2004/Acta No 15-04.pdf")?>" target="actas">Acta 15. Dic 20</a></td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<? 
   PageEnd();
?>