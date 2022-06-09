 <?
   require '../../../functions.php';
   $rootPath = '../../../';
   
   $valign = 'top';
   $centrar_contenido = false;
   //$_GET['submenu_actas'] = true;
   $_GET['actas_facultad'] = true;
   DBConnect("new_fayol");
   
   //PageInit('Actas del Consejo de Facultad', '../../menu.php', 'left', 'top');

	if($_GET['agno']>2010){
		$anio=$_GET['agno'];	
		$query1 = db_query("select * from actas_facultad where fecha >='$anio-01-01' and fecha<= '$anio-12-31' and  tipo_acta='1' order by n_acta ASC");
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
	else if($_GET['agno']=='2010')
	{
	?>
		<a href="index-Copia.php">Volver</a>
		<br/>
		<H2 STYLE="color:black;">
		  <?= IMAGEN_ACTAS_MINI ?>
  A&ntilde;o 2010:</H2>
		<table width="100%">
          <tr>
            <td width="30">&nbsp;</td>
            <td><table width="100%">
                <tr>
                  <td width="25%"><a href="2010/Acta%20No.01-10.pdf" target="_blank">Acta 1. Enero 13 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td width="25%"><a href="2010/Acta%20No.02-10.pdf" target="_blank">Acta 2. Enero 19 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
				</tr>
				<tr>
                  <td width="25%"><a href="2010/Acta%20No.03-10.pdf" target="_blank">Acta 3. Enero 22 </a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td width="25%"><a href="2010/Acta%20No.04-10.pdf" target="_blank">Acta 4. Enero 26 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
                <tr>
                  <td height="21"><a href="2010/acta%20no.05-10.pdf" target="_blank">Acta 5. Febrero 02</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/acta%20no.06-10.pdf" target="_blank">Acta 6. Febrero 10</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
               </tr>
				<tr>   
				  <td><a href="2010/acta%20no.07-10.pdf" target="_blank">Acta 7. Febrero 18</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/acta%20no.08-10.pdf" target="_blank">Acta 8. Febrero 23 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
                <tr>
                  <td height="21"><a href="2010/acta%20no.09-10.pdf" target="_blank">Acta 9. Marzo 02 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/acta%20no.10-10.pdf" target="_blank">Acta 10. Marzo 09</a><img src="../../../Images/plantilla/pdf_button.png"></td>
               </tr>
				<tr>   
				  <td><a href="2010/acta%20no.11-10.pdf" target="_blank">Acta 11. Marzo 16 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/acta%20no.12-10.pdf" target="_blank">Acta 12. Marzo 23 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
                <tr>
                  <td height="26"><a href="2010/acta%20no.13-10.pdf" target="_blank">Acta 13. Abril 06</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/acta%20no.14-10.pdf" target="_blank">Acta 14. Abril 13 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr>  
				  <td><a href="2010/acta%20no.15-10.pdf" target="_blank">Acta 15. Abril 06</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/acta%20no.16-10.pdf" target="_blank">Acta 16. Abril 27 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
                <tr>
                  <td height="26"><a href="2010/Acta_No_17-10.pdf" target="_blank">Acta 17. Mayo 4 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/Acta_No_18-10.pdf" target="_blank">Acta 18. Mayo 14 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr>  
				  <td><a href="2010/Acta_No_19-10.pdf" target="_blank">Acta 19.Mayo 21 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/Acta_No.20-10.pdf" target="_blank">Acta 20. Mayo 25 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
                <tr>
                  <td height="26"><a href="2010/Acta_No_21-10.pdf" target="_blank">Acta 21. Junio 1 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/Acta_No.22-10.pdf" target="_blank">Acta 22. Junio 8 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr>  
				  <td><a href="2010/Acta_No.23-10.pdf" target="_blank">Acta 23. Junio 15</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/Acta_No.24-10.pdf" target="_blank">Acta 24. Junio 22 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr>
                  <td height="26"><a href="2010/Acta_No.25-10.pdf" target="_blank">Acta 25. Junio 28</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/Acta_No.26-10.pdf" target="_blank">Acta 26. Junio 29 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
               </tr>
				<tr> 
				  <td><a href="2010/Acta_No_27-10.pdf" target="_blank">Acta 27. Julio 6 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td><a href="2010/Acta_No_28-10.pdf" target="_blank">Acta 28. Agosto 6 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr>
                  <td height="26"><a href="2010/Acta_No_29-10.pdf" target="_blank">Acta 29. Agosto 17</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td height="26"><a href="2010/Acta%20No.30-10.pdf" target="_blank">Acta 30. Agosto 24 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr> 
				  <td height="26"><a href="2010/Acta%20No.31-10.pdf" target="_blank">Acta 31. Agosto 31 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
				  <td height="26"><a href="2010/Acta%20No.32-10.pdf" target="_blank">Acta 32. Septiembre 7 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr>
				  <td height="26"><a href="2010/Acta%20No.33-10.pdf" target="_blank">Acta 33. Septiembre 14 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
				  <td height="26"><a href="2010/Acta%20No.34-10.pdf" target="_blank">Acta 34. Septiembre 15 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
				</tr>
				<tr>  
				  <td height="26"><a href="2010/Acta%20No.35-10.pdf" target="_blank">Acta 35. Septiembre 21 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
				  <td height="26"><a href="2010/Acta_No_36-10.pdf" target="_blank">Acta 36. Septiembre 28 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
			  </tr>
				<tr>
                  <td height="26"><a href="2010/Acta%20No.37-10.pdf" target="_blank">Acta 37. Octubre 5 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td height="26"><a href="2010/Acta%20No.38-10.pdf" target="_blank">Acta 38. Oct ubre12</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr>  
				  <td height="26"><a href="2010/Acta%20No.39-10.pdf" target="_blank">Acta 39. Octubre 19 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
				  <td height="26"><a href="2010/Acta%20No.40-10.pdf" target="_blank">Acta 40. Octubre 26 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr>
                  <td height="26"><a href="2010/Acta%20No.41-10.pdf" target="_blank">Acta 41. Noviembre 2 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td height="26"><a href="2010/Acta%20No.42-10.pdf" target="_blank">Acta 42. Noviembre 8 </a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr>
                  <td height="26"><a href="2010/ActaNo.43_nov_9.pdf" target="_blank">Acta 43. Noviembre 9 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td height="26"><a href="2010/Acta%20No.44-10.pdf" target="_blank">Acta 44. Noviembre 16 </a><img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr>
                  <td height="26"><a href="2010/Acta%20No.45-10.pdf" target="_blank">Acta 45. Noviembre 23</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td height="26"><a href="2010/ActaNo.46_nov_30.pdf" target="_blank">Acta 46. Noviembre 30</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
				<tr>
                  <td height="26"><a href="2010/ActaNo.47_dic_7.pdf" target="_blank">Acta 47. Diciembre 7</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                  <td height="26"><a href="2010/ActaNo.48_dic_14.pdf" target="_blank">Acta 48. Diciembre 14</a> <img src="../../../Images/plantilla/pdf_button.png"></td>
                </tr>
            </table></td>
          </tr>
        </table>
		<br/>		
	<?
	BorderEnd();
	}
	
	else if($_GET['agno']=='2009')
	{
		?><a href="index-Copia.php">Volver</a>
		<br/><br/>		
		<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2009:</H2>
        <table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%">
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2009/Acta No.01-09.pdf")?>" target="actas">Acta 1. Ene 13</a></td>
		<td width="25%"><A HREF="<?=makeURL("2009/Acta No.02-09.pdf")?>" target="actas">Acta 2. Ene 20</a></td>
		<td width="25%"><A HREF="<?=makeURL("2009/Acta No.03-09.pdf")?>" target="actas">Acta 3. Ene 26</a></td>
		<td width="25%"><A HREF="<?=makeURL("2009/Acta No.04-09.pdf")?>" target="actas">Acta 4. Feb 03</a></td>
	</tr>
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2009/Acta No.05-09.pdf")?>" target="actas">Acta 5. Feb 10</a></td>
		<td width="25%"><a href="2009/Acta No.06-09.pdf" target="_blank">Acta 6. Feb 17</a></td>
		<td width="25%"><a href="2009/Acta No.07-09.pdf" target="_blank">Acta 7. Feb 24</a></td>
		<td width="25%"><a href="2009/Acta No.08-09.pdf" target="_blank">Acta 8. Mar 03</a></td>
	</tr>
	<tr>
		<td width="25%"><a href="2009/Acta No. 09-09.pdf" target="_blank">Acta 9. Mar 5</a></td>
		<td width="25%"><a href="2009/Acta No.10-09.pdf" target="_blank">Acta 10. Mar 10</a></td>
		<td width="25%"><a href="2009/Acta No.11-09.pdf" target="_blank">Acta 11. Mar 17 </a></td>
		<td width="25%"><a href="2009/Acta No.12-09.pdf" target="_blank">Acta 12. Mar 24</a></td>
	</tr>
	<tr>
		<td width="25%"><a href="2009/Acta No.13-09.pdf" target="_blank">Acta 13. Mar 31</a></td>
		<td width="25%"><a href="2009/Acta%20No.14-09.pdf" target="_blank">Acta 14. Abr 14</a> </td>
		<td width="25%"><a href="2009/Acta%20No.15-09.pdf" target="_blank">Acta 15. Abr 21</a> </td>
		<td width="25%"><a href="2009/Acta%20No.16-09.pdf" target="_blank">Acta 16. Abr 28</a></td>
	</tr>
	<tr>
	  <td><a href="2009/Acta%20No.17-09.pdf" target="_blank">Acta 17. May 5 </a></td>
	  <td><a href="2009/Acta%20No.18-09.pdf" target="_blank">Acta 18. May 12</a> </td>
	  <td><a href="2009/Acta%20No.19-09.pdf" target="_blank">Acta 19. May 19</a> </td>
	  <td></td>
	  </tr>
	<tr>
	  <td><a href="2009/Acta_No.21-09.pdf" target="_blank">Acta 21. Jun 2</a> </td>
	  <td><a href="2009/Acta_No.22-09.pdf" target="_blank">Acta 22. Jun 8</a> </td>
	  <td><a href="2009/Acta_No.23-09.pdf" target="_blank">Acta 23. Jun 16</a> </td>
	  <td><a href="2009/Acta_No.24-09.pdf" target="_blank">Acta 24. Jun 18</a> </td>
	  </tr>
	<tr>
	  <td><a href="2009/Acta%20No.25-09.pdf" target="_blank">Acta 25. Jun 23</a> </td>
	  <td><a href="2009/Acta_No.26-09.pdf" target="_blank">Acta 26. Jun 24</a> </td>
	  <td><a href="2009/Acta_No.27-09.pdf" target="_blank">Acta 27. Jun 30</a> </td>
	  <td><a href="2009/Acta_No.28-09.pdf" target="_blank">Acta 28. Jul 07 </a></td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><a href="2009/Acta_No.30%20-09.pdf" target="_blank">Acta 30. Ago 25 </a></td>
	  <td><a href="2009/Acta_No.31%20-09.pdf" target="_blank">Acta 31. Sep 02 </a></td>
	  <td><a href="2009/Acta_No.32%20-09.pdf" target="_blank">Acta 32. Sep 07 </a></td>
	  </tr>
	<tr>
	  <td><a href="2009/Acta_No.33%20-09.pdf" target="_blank">Acta 33. Sep 15 </a></td>
	  <td><a href="2009/Acta_No.34%20-09.pdf" target="_blank">Acta 34. Sep 22</a></td>
	  <td><a href="2009/Acta_No.35%20-09.pdf" target="_blank">Acta 35. Sep 29 </a></td>
	  <td><a href="2009/Acta_No.36%20-09.pdf" target="_blank">Acta 36. Oct 06 </a></td>
	  </tr>
	<tr>
	  <td><a href="2009/Acta_No.37%20-09.pdf" target="_blank">Acta 37. Oct 13 </a></td>
	  <td><a href="2009/Acta_No.38-09.pdf" target="_blank">Acta 38. Oct 20 </a></td>
	  <td><a href="2009/Acta_No.39-09.pdf" target="_blank">Acta 39. Oct 27</a></td>
	  <td><a href="2009/Acta_No.40-09.pdf" target="_blank">Acta 40. Nov 03 </a></td>
	  </tr>
	<tr>
	  <td><a href="2009/Acta_No.41-09.pdf" target="_blank">Acta 41. Nov 10 </a></td>
	  <td><a href="2009/Acta_No.42-09.pdf" target="_blank">Acta 42. Nov 17. </a></td>
	  <td><a href="2009/Acta_No.43-09.pdf" target="_blank">Acta 43. Nov 24. </a></td>
	  <td><a href="2009/Acta_No.44-09.pdf" target="_blank">Acta 44. Dic 01. </a></td>
	  </tr>
	<tr>
	  <td><a href="2009/Acta_No.45-09.pdf" target="_blank">Acta 45. Dic 14</a></td>
	  <td><a href="2009/Acta_No.46-09.pdf" target="_blank">Acta 46. Dic 15 </a></td>
	  <td>&nbsp;</td>
	  <td></td>
	  </tr>
	</table>
	</td>
</tr>
</table>
		<br>
	<?
	BorderEnd();
	}
	
	else if($_GET['agno']=='2008')
	{
	?>
		<a href="index-Copia.php">Volver</a>
		<br/><br/>		
		
		<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2008:</H2>
<table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%">
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.01-08.pdf")?>" target="actas">Acta 1. Ene 15</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.02-08.pdf")?>" target="actas">Acta 2. Ene 17</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.03-08.pdf")?>" target="actas">Acta 3. Ene 22</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.03 A-08.pdf")?>" target="actas">Acta 3 A. Ene 22</a></td>
	</tr>
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.04-080.pdf")?>" target="actas">Acta 4. Ene 29</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.05-08.pdf")?>" target="actas">Acta 5. Feb 5</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.06-08.pdf")?>" target="actas">Acta 6. Feb 8</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.07-08.pdf")?>" target="actas">Acta 7. Feb 19</a></td>
	</tr>
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.08-08.pdf")?>" target="actas">Acta 8. Feb 22</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.09-08.pdf")?>" target="actas">Acta 9. Feb 26</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.10-08.pdf")?>" target="actas">Acta 10. Mar 4</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No 11-08.pdf")?>" target="actas">Acta 11. Mar 8</a></td>
	</tr>
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No 12-08.pdf")?>" target="actas">Acta 12. Mar 13</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No 13-08.pdf")?>" target="actas">Acta 13. Abr 1</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No 14-08.pdf")?>" target="actas">Acta 14. Abr 8</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No 15-08.pdf")?>" target="actas">Acta 15. Abr 15</a></td>
	</tr>
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.17-08.pdf")?>" target="actas">Acta 17. Abr 28</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.18-08.pdf")?>" target="actas">Acta 18. May 6</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.19-08.pdf")?>" target="actas">Acta 19. May 7</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.20-08.pdf")?>" target="actas">Acta 20. May 13</a></td>
	</tr>
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.21-08.pdf")?>" target="actas">Acta 21. May 20</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.22-08.pdf")?>" target="actas">Acta 22. May 27</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.23-08.pdf")?>" target="actas">Acta 23. Jun 3</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.24-08.pdf")?>" target="actas">Acta 24. Jun 10</a></td>
	</tr>
		<tr>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.25-08.pdf")?>" target="actas">Acta 25. Jun 17 </a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.26-08.pdf")?>" target="actas">Acta 26. Jun 23</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.27-08.pdf")?>" target="actas">Acta 27. Jun 24</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.28-08.pdf")?>" target="actas">Acta 28. Jul 1 </a></td>
	</tr>
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.29-08.pdf")?>" target="actas">Acta 29. Jul 8 </a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.30-08.pdf")?>" target="actas">Acta 30. Ago 21</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.31-08.pdf")?>" target="actas">Acta 31. Ago 26</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.32-08.pdf")?>" target="actas">Acta 32. Sep 2 </a></td>
	</tr>
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.33-08.pdf")?>" target="actas">Acta 33. Sep 9 </a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.34-08.pdf")?>" target="actas">Acta 34. sep 16</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.35-08.pdf")?>" target="actas">Acta 35. Sep 23</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.36-08.pdf")?>" target="actas">Acta 36. Sep 29</a></td>
	</tr>
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.37-08.pdf")?>" target="actas">Acta 37. Sep 30 </a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.40-08.pdf")?>" target="actas">Acta 40. Oct 28</a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.41-08.pdf")?>" target="actas">Acta 41. Nov 4</a></td>
		<td width="25%"><a href="<?=makeURL("2008/Acta No.42-08.pdf")?>" target="actas">Acta 42. Nov 11 </a></td>
	</tr>
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.43-08.pdf")?>" target="actas">Acta 43. Nov 18</a></td>
		<td width="25%"><a href="<?=makeURL("2008/Acta No.44-08.pdf")?>" target="actas">Acta 44. Nov 25 </a></td>
		<td width="25%"><A HREF="<?=makeURL("2008/Acta No.45-08.pdf")?>" target="actas">Acta 45. Dic 2 </a></td>
		<td width="25%">&nbsp;</td>
	</tr>
	</table>
	</td>
</tr>
</table>
		
			
		<br>
	<?
	BorderEnd();
	}
	else if($_GET['agno']=='2007')
	{
	?>
		<a href="index-Copia.php">Volver</a>
		<br/><br/>		
		<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2007:</H2>
<table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%">
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2007/Acta No 01-07.pdf")?>" target="actas">Acta 1. Ene 17</a></td>
		<td width="25%"><A HREF="<?=makeURL("2007/Acta No 02-07.pdf")?>" target="actas">Acta 2. Ene 23</a></td>
		<td width="25%"><A HREF="<?=makeURL("2007/Acta No 03-07.pdf")?>" target="actas">Acta 3. Feb 6</a></td>
		<td width="25%"><A HREF="<?=makeURL("2007/Acta No 04-07.pdf")?>" target="actas">Acta 4. Feb 13</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2007/Acta No 05-07.pdf")?>" target="actas">Acta 5. Feb 20</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 06-07.pdf")?>" target="actas">Acta 6. Feb 27</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 07-07.pdf")?>" target="actas">Acta 7. Mar 6</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 08-07.pdf")?>" target="actas">Acta 8. Mar 13</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2007/Acta No 09-07.pdf")?>" target="actas">Acta 9. Mar 20</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 10-07.pdf")?>" target="actas">Acta 10. Mar 27</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 11-07.pdf")?>" target="actas">Acta 11. Abr 10</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 12-07.pdf")?>" target="actas">Acta 12. Abr 17</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2007/Acta No 13-07.pdf")?>" target="actas">Acta 13. Abr 23</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 14-07.pdf")?>" target="actas">Acta 14. Abr 24</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 15-07.pdf")?>" target="actas">Acta 15. May 02</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 17-07.pdf")?>" target="actas">Acta 17. May 15</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2007/Acta No 18-07.pdf")?>" target="actas">Acta 18. May 22</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 19-07.pdf")?>" target="actas">Acta 19. May 29</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 20-07.pdf")?>" target="actas">Acta 20. Jun 05</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 21-07.pdf")?>" target="actas">Acta 21. Jun 26</a></td>		
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2007/Acta No 22-07.pdf")?>" target="actas">Acta 22. Jun 29</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No 23-07.pdf")?>" target="actas">Acta 23. Jul 11</a></td>		
		<td><A HREF="<?=makeURL("2007/Acta No.24-07.pdf")?>" target="actas">Acta 24. Ago 16</a></td>	
		<td><A HREF="<?=makeURL("2007/Acta No.25-07.pdf")?>" target="actas">Acta 25. Ago 21</a></td>	
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2007/Acta No.26-07.pdf")?>" target="actas">Acta 26. Ago 28</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No.27-07.pdf")?>" target="actas">Acta 27. Sep 03</a></td>		
		<td><A HREF="<?=makeURL("2007/Acta No 28-07.pdf")?>" target="actas">Acta 28. Sep 04</a></td>	
		<td><A HREF="<?=makeURL("2007/Acta No.29-07.pdf")?>" target="actas">Acta 29. Sep 11</a></td>	
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2007/Acta No.30-07.pdf")?>" target="actas">Acta 30. Sep 13</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No.31-07.pdf")?>" target="actas">Acta 31. Sep 18</a></td>		
		<td><A HREF="<?=makeURL("2007/Acta No.32-07.pdf")?>" target="actas">Acta 32. Sep 20</a></td>	
		<td><A HREF="<?=makeURL("2007/Acta No.33-07.pdf")?>" target="actas">Acta 33. Sep 25</a></td>	
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2007/Acta No.35-07.pdf")?>" target="actas">Acta 35. Oct 02</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No.36-07.pdf")?>" target="actas">Acta 36. Oct 11</a></td>		
		<td><A HREF="<?=makeURL("2007/Acta No.37-07.pdf")?>" target="actas">Acta 37. Oct 16</a></td>	
		<td><A HREF="<?=makeURL("2007/Acta No.38-07.pdf")?>" target="actas">Acta 38. Oct 26</a></td>	
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2007/Acta No.39-07.pdf")?>" target="actas">Acta 39. Nov 06</a></td>
		<td><A HREF="<?=makeURL("2007/Acta No.40-07.pdf")?>" target="actas">Acta 40. Nov 13</a></td>		
		<td><A HREF="<?=makeURL("2007/Acta No.41-07.pdf")?>" target="actas">Acta 41. Nov 27</a></td>	
		<td><A HREF="<?=makeURL("2007/Acta No.42-07.pdf")?>" target="actas">Acta 42. Nov 30</a></td>	
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2007/Acta No.43-07.pdf")?>" target="actas">Acta 43. Dic 04</a></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</td>
</tr>
</table>
		<br>
	<?
	BorderEnd();
	}
	else if($_GET['agno']=='2006')
	{
	?>
		<a href="index-Copia.php">Volver</a>
		<br/><br/>		
		<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2006:</H2>
<table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%">
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2006/Acta No 01-06.pdf")?>" target="actas">Acta 1. Ene 11</a></td>
		<td width="25%"><A HREF="<?=makeURL("2006/Acta No 02-06.pdf")?>" target="actas"> Acta 2. Ene 19</a></td>
		<td width="25%"><A HREF="<?=makeURL("2006/Acta No 03-06.pdf")?>" target="actas"> Acta 3. Ene 24</a></td>
		<td width="25%"><A HREF="<?=makeURL("2006/Acta No 04-06.pdf")?>" target="actas"> Acta 4. Ene 30</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2006/Acta No 05-06.pdf")?>" target="actas"> Acta 5. Feb 8</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 06-06.pdf")?>" target="actas"> Acta 6. Feb 14</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 07-06.pdf")?>" target="actas"> Acta 7. Feb 28</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 08-06.pdf")?>" target="actas"> Acta 8. Mar 14</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2006/Acta No 09-06.pdf")?>" target="actas"> Acta 9. Mar 28</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 10-06.pdf")?>" target="actas"> Acta 10. Abr 4</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 11-06.pdf")?>" target="actas"> Acta 11. Abr 18</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 12-06.pdf")?>" target="actas"> Acta 12. Abr 25</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2006/Acta No 13-06.pdf")?>" target="actas"> Acta 13. May 9</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 14-06.pdf")?>" target="actas"> Acta 14. May 23</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 15-06.pdf")?>" target="actas"> Acta 15. May 30</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 16-06.pdf")?>" target="actas"> Acta 16. Jun 2</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2006/Acta No 17-06.pdf")?>" target="actas"> Acta 17. Jun 6</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 18-06.pdf")?>" target="actas"> Acta 18. Jun 8</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 19-06.pdf")?>" target="actas"> Acta 19. Jun 16</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 20-06.pdf")?>" target="actas"> Acta 20. Jun 22</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2006/Acta No 21-06.pdf")?>" target="actas"> Acta 21. Ago 9</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 22-06.pdf")?>" target="actas"> Acta 22. Ago 24</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 23-06.pdf")?>" target="actas"> Acta 23. Sep 5</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 24-06.pdf")?>" target="actas"> Acta 24. Sep 22</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2006/Acta No 25-06.pdf")?>" target="actas"> Acta 25. Oct 3</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 26-06.pdf")?>" target="actas"> Acta 26. Oct 9</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 27-06.pdf")?>" target="actas"> Acta 27. Oct 12</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 28-06.pdf")?>" target="actas"> Acta 28. Oct 17</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2006/Acta No 29-06.pdf")?>" target="actas"> Acta 29. Oct 19</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 30-06.pdf")?>" target="actas"> Acta 30. Oct 31</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 31-06.pdf")?>" target="actas"> Acta 31. Nov 8</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 32-06.pdf")?>" target="actas"> Acta 32. Nov 15</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2006/Acta No 33-06.pdf")?>" target="actas"> Acta 33. Nov 21</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 34-06.pdf")?>" target="actas"> Acta 34. Nov 27</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 35-06.pdf")?>" target="actas"> Acta 35. Nov 30</a></td>
		<td><A HREF="<?=makeURL("2006/Acta No 36-06.pdf")?>" target="actas"> Acta 36. Dic 5</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2006/Acta No 37-06.pdf")?>" target="actas"> Acta 37. Dic 14</a></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</td>
</tr>
</table>

		<br>

	<?
	BorderEnd();
	}
	else if($_GET['agno']=='2005')
	{
	?>
		<a href="index-Copia.php">Volver</a>
		<br/><br/>		
		<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2005:</H2>
<table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%">
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2005/Acta No 01-05.pdf")?>" target="actas">Acta 1. Ene 12</a></td>
		<td width="25%"><A HREF="<?=makeURL("2005/Acta No 02-05.pdf")?>" target="actas"> Acta 2. Ene 18</a></td>
		<td width="25%"><A HREF="<?=makeURL("2005/Acta No 03-05.pdf")?>" target="actas"> Acta 3. Ene 20</a></td>
		<td width="25%"><A HREF="<?=makeURL("2005/Acta No 04-05.pdf")?>" target="actas"> Acta 4. Ene 25</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 05-05.pdf")?>" target="actas"> Acta 5. Ene 27</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 06-05.pdf")?>" target="actas"> Acta 6. Feb 1</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 07-05.pdf")?>" target="actas"> Acta 7. Feb 8</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 08-05.pdf")?>" target="actas"> Acta 8. Feb 15</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 09-05.pdf")?>" target="actas"> Acta 9. Feb 22</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 10-05.pdf")?>" target="actas"> Acta 10. Mar 1</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 11-05.pdf")?>" target="actas"> Acta 11. Mar 3</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 12-05.pdf")?>" target="actas"> Acta 12. Mar 8</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 13-05.pdf")?>" target="actas"> Acta 13. Mar 11</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 14-05.pdf")?>" target="actas"> Acta 14. Mar 16</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 15-05.pdf")?>" target="actas"> Acta 15. Mar 28</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 16-05.pdf")?>" target="actas"> Acta 16. Abr 04</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 17-05.pdf")?>" target="actas"> Acta 17. Abr 12</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 18-05.pdf")?>" target="actas"> Acta 18. Abr 20</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 19-05.pdf")?>" target="actas"> Acta 19. Abr 26</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 20-05.pdf")?>" target="actas"> Acta 20. Abr 28</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 21-05.pdf")?>" target="actas"> Acta 21. May 13</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 22-05.pdf")?>" target="actas"> Acta 22. May 10</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 23-05.pdf")?>" target="actas"> Acta 23. May 17</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 24-05.pdf")?>" target="actas"> Acta 24. May 24</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 25-05.pdf")?>" target="actas"> Acta 25. May 31</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 26-05.pdf")?>" target="actas"> Acta 26. Jun 7</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 27-05.pdf")?>" target="actas"> Acta 27. Jun 14</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 28-05.pdf")?>" target="actas"> Acta 28. Jun 21</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 29-05.pdf")?>" target="actas"> Acta 29. Jun 28</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 30-05.pdf")?>" target="actas"> Acta 30. Jul 5</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 31-05.pdf")?>" target="actas"> Acta 31. Ago 9</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 32-05.pdf")?>" target="actas"> Acta 32. Ago 17</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 33-05.pdf")?>" target="actas"> Acta 33. Ago 19</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 34-05.pdf")?>" target="actas"> Acta 34. Ago 23</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 35-05.pdf")?>" target="actas"> Acta 35. Ago 30</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 36-05.pdf")?>" target="actas"> Acta 36. Sep 6</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 37-05.pdf")?>" target="actas"> Acta 37. Sep 13</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 38-05.pdf")?>" target="actas"> Acta 38. Sep 15</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 39-05.pdf")?>" target="actas"> Acta 39. Sep 20</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 40-05.pdf")?>" target="actas"> Acta 40. Sep 28</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 41-05.pdf")?>" target="actas"> Acta 41. Oct 3</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 42-05.pdf")?>" target="actas"> Acta 42. Oct 11</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 43-05.pdf")?>" target="actas"> Acta 43. Oct 13</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 44-05.pdf")?>" target="actas"> Acta 44. Oct 18</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 45-05.pdf")?>" target="actas"> Acta 45. Oct 25</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 46-05.pdf")?>" target="actas"> Acta 46. Nov 1</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 47-05.pdf")?>" target="actas"> Acta 47. Nov 8</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 48-05.pdf")?>" target="actas"> Acta 48. Nov 15</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 49-05.pdf")?>" target="actas"> Acta 49. Nov 22</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 50-05.pdf")?>" target="actas"> Acta 50. Nov 29</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 51-05.pdf")?>" target="actas"> Acta 51. Nov 29</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 52-05.pdf")?>" target="actas"> Acta 52. Dic 6</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2005/Acta No 53-05.pdf")?>" target="actas"> Acta 53. Dic 13</a></td>
		<td><A HREF="<?=makeURL("2005/Acta No 54-05.pdf")?>" target="actas"> Acta 54. Dic 23</a></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</td>
</tr>
</table>
		<br>
	
	<?
	BorderEnd();
	}
	else if($_GET['agno']=='2004')
	{
	?>
		<a href="index-Copia.php">Volver</a>
		<br/><br/>		
		<H2 STYLE="color:black;"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2004:</H2>
<table width="100%">
<tr>
	<td width="30">&nbsp;</td>
	<td>
	<table width="100%">
	<tr>
		<td width="25%"><A HREF="<?=makeURL("2004/Acta No 01-04.pdf")?>" target="actas">Acta 1. Ene 14</a></td>
		<td width="25%"><A HREF="<?=makeURL("2004/Acta No 02-04.pdf")?>" target="actas"> Acta 2. Ene 21</a> </td>
		<td width="25%"><A HREF="<?=makeURL("2004/Acta No 03-04.pdf")?>" target="actas"> Acta 3. Ene 26</a> </td>
		<td width="25%"><A HREF="<?=makeURL("2004/Acta No 04-04.pdf")?>" target="actas"> Acta 4. Feb 4</a> </td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2004/Acta No 06-04.pdf")?>" target="actas"> Acta 6. Feb 18</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 07-04.pdf")?>" target="actas"> Acta 7. Feb 25</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 08-04.pdf")?>" target="actas"> Acta 8. Mar 2</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 09-04.pdf")?>" target="actas"> Acta 9. Mar 10</a> </td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2004/Acta No 10-04.pdf")?>" target="actas"> Acta 10. Mar 17</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 11-04.pdf")?>" target="actas"> Acta 11. Mar 25</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 12-04.pdf")?>" target="actas"> Acta 12. Mar 30</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 13-04.pdf")?>" target="actas"> Acta 13. Mar 31</a> </td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2004/Acta No 15-04.pdf")?>" target="actas"> Acta 15. Abr 14</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 16-04.pdf")?>" target="actas"> Acta 16. Abr 16</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 17-04.pdf")?>" target="actas"> Acta 17. Abr 21</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 18-04.pdf")?>" target="actas"> Acta 18. May 5</a> </td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2004/Acta No 19-04.pdf")?>" target="actas"> Acta 19. May 14</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 20-04.pdf")?>" target="actas"> Acta 20. May 19</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 21-04.pdf")?>" target="actas"> Acta 21. May 21</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 22-04.pdf")?>" target="actas"> Acta 22. May 27</a> </td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2004/Acta No 23-04.pdf")?>" target="actas"> Acta 23. Jun 2</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 24-04.pdf")?>" target="actas"> Acta 24. Jun 11</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 25-04.pdf")?>" target="actas"> Acta 25. Jun 16</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 26-04.pdf")?>" target="actas"> Acta 26. Jun 22</a> </td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2004/Acta No 27-04.pdf")?>" target="actas"> Acta 27. Jun 29</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 28-04.pdf")?>" target="actas"> Acta 28. Jul 8</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 29-04.pdf")?>" target="actas"> Acta 29. Ago 24</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 30-04.pdf")?>" target="actas"> Acta 30. Ago 31</a> </td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2004/Acta No 31-04.pdf")?>" target="actas"> Acta 31. Sep 6</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 32-04.pdf")?>" target="actas"> Acta 32. Sep 7</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 33-04.pdf")?>" target="actas"> Acta 33. Sep 14</a> </td>
		<td><A HREF="<?=makeURL("2004/Acta No 34-04.pdf")?>" target="actas"> Acta 34. Sep 23</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2004/Acta No 35-04.pdf")?>" target="actas">Acta 35. Sep 29</a></td>
		<td><A HREF="<?=makeURL("2004/Acta No 36-04.pdf")?>" target="actas">Acta 36. Oct 6</a></td>
		<td><A HREF="<?=makeURL("2004/Acta No 37-04.pdf")?>" target="actas">Acta 37. Oct 8</a></td>
		<td><A HREF="<?=makeURL("2004/Acta No 38-04.pdf")?>" target="actas">Acta 38. Oct 13</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2004/Acta No 39-04.pdf")?>" target="actas">Acta 39. Oct 20</a></td>
		<td><A HREF="<?=makeURL("2004/Acta No 40-04.pdf")?>" target="actas">Acta 40. Oct 28</a></td>
		<td><A HREF="<?=makeURL("2004/Acta No 41-04.pdf")?>" target="actas">Acta 41. Nov 3</a></td>
		<td><A HREF="<?=makeURL("2004/Acta No 42-04.pdf")?>" target="actas">Acta 42. Nov 5</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2004/Acta No 43-04.pdf")?>" target="actas">Acta 43. Nov 12</a></td>
		<td><A HREF="<?=makeURL("2004/Acta No 44-04.pdf")?>" target="actas">Acta 44. Nov 17</a></td>
		<td><A HREF="<?=makeURL("2004/Acta No 45-04.pdf")?>" target="actas">Acta 45. Nov 24</a></td>
		<td><A HREF="<?=makeURL("2004/Acta No 46-04.pdf")?>" target="actas">Acta 46. Dic 7</a></td>
	</tr>
	<tr>
		<td><A HREF="<?=makeURL("2004/Acta No 47-04.pdf")?>" target="actas">Acta 47. Dic 9</a></td>
		<td><A HREF="<?=makeURL("2004/Acta No 48-04.pdf")?>" target="actas">Acta 48. Dic 21</a></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</td>
</tr>
</table>
		<br>
	<?
	BorderEnd();
	}
	else
	{
	
	$query1 = db_query("select distinct extract (YEAR from fecha)as anno from actas_facultad where tipo_acta='1' order by anno Desc");
	if(pg_num_rows($query1) != 0 ){
   
		 while($obj1=pg_fetch_object($query1)){?>
		 	<A HREF="index-Copia.php?agno=<? echo $obj1->anno; ?>" TARGET="_self"> <?= IMAGEN_ACTAS_MINI ?> A&ntilde;o <? echo $obj1->anno; ?> </A><br><br>
		 <?
		}
	}
	 ?>
	 <A HREF="index-Copia.php?agno=2010" TARGET="_self"> <?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2010</A><br><br>
	 <A HREF="index-Copia.php?agno=2009" TARGET="_self"> <?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2009</A><br><br>
	 <A HREF="index-Copia.php?agno=2008" TARGET="_self"> <?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2008</A><br><br>
	 <A HREF="index-Copia.php?agno=2007" TARGET="_self"> <?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2007</A><br><br>
	 <A HREF="index-Copia.php?agno=2006" TARGET="_self"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2006</A><br><br>
	 <A HREF="index-Copia.php?agno=2005" TARGET="_self"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2005</A><br><br>
	 <A HREF="index-Copia.php?agno=2004" TARGET="_self"><?= IMAGEN_ACTAS_MINI ?> A&ntilde;o 2004</A><br>
	 <?
	} 
   //PageEnd();
?>

