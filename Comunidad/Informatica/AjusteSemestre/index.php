<?

$dia=date(d);
$mes=date(m);
$anno=date(Y);



$diasMes=cal_days_in_month(1,$mes,$anno);

?>
<?
// 
?>
<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript">
		
		$(function(){
			$("#elestado").bind("change", function(){
				var value1 = $(this).val();
				if(value1=='p')
					$("#ocultoPendiente").fadeIn("slow");
					//$("#oculto2").fadeIn("slow");
				else
					$("#ocultoPendiente").fadeOut("slow");
					//$("#oculto2").fadeOut("slow");
			});
		});
</script>

<form name="ajusteSemestre" method="post" enctype="multipart/form-data" action="">
<table width="383" border="0">
  <tr>
    <td height="35" colspan="2">Inicio clases </td>
    <td colspan="2">Finalizacion clases </td>
  </tr>
  <tr>
    <td width="47" height="32">Dia :</td>
    <td width="131"><select name="diaInicio" id="diaInicio">
		<?
			for($a=1; $a<=$diasMes;$a++){
				
				if($dia==$a){echo "<option value=".$a." selected='selected' > $a </option>"; }
				else{echo "<option value=".$a."  > $a </option>";}
			}
		?>
    </select></td>
    <td width="57">Dia : </td>
    <td width="130"><select name="diaFinal" id="diaFinal">
		<?
		for($b=1; $b<=$diasMes;$b++){
				
				if($b==$dia){echo "<option value=".$b." selected='selected' > $b </option>"; }
				else{echo "<option value=".$b."  > $b </option>";}
			}
		?>
        </select></td>
  </tr>
  <tr>
    <td height="34">Mes : </td>
    <td><select name="mesInicio" id="mesInicio">
      <option value="0" selected></option>
      <option value="1" <?PHP if($mes==1){echo " selected='selected'" ;} ?> >Enero</option>
      <option value="2"  <?PHP if($mes==2){echo " selected='selected'" ;} ?>>Febrero</option>
      <option value="3"  <?PHP if($mes==3){echo " selected='selected'" ;} ?>>Marzo</option>
      <option value="4"  <?PHP if($mes==4){echo " selected='selected'" ;} ?>>Abril</option>
      <option value="5"  <?PHP if($mes==5){echo " selected='selected'" ;} ?>>Mayo</option>
      <option value="6"  <?PHP if($mes==6){echo " selected='selected'" ;} ?>>Junio</option>
      <option value="7"  <?PHP if($mes==7){echo " selected='selected'" ;} ?>>Julio</option>
      <option value="8"  <?PHP if($mes==8){echo " selected='selected'" ;} ?>>Agosto</option>
      <option value="9"  <?PHP if($mes==9){echo " selected='selected'" ;} ?>>Septiembre</option>
      <option value="10" <?PHP if($mes==10){echo " selected='selected'" ;} ?>>Octubre</option>
      <option value="11" <?PHP if($mes==11){echo " selected='selected'" ;} ?>>Noviembre</option>
      <option value="12" <?PHP if($mes==12){echo " selected='selected'" ;} ?>>Diciembre</option>
                    </select></td>
    <td>Mes : </td>
    <td><select name="mesFinal" id="mesFinal">
	 <option value="0" selected></option>
      <option value="1" <?PHP if($mes==1){echo " selected='selected'" ;} ?> >Enero</option>
      <option value="2"  <?PHP if($mes==2){echo " selected='selected'" ;} ?>>Febrero</option>
      <option value="3"  <?PHP if($mes==3){echo " selected='selected'" ;} ?>>Marzo</option>
      <option value="4"  <?PHP if($mes==4){echo " selected='selected'" ;} ?>>Abril</option>
      <option value="5"  <?PHP if($mes==5){echo " selected='selected'" ;} ?>>Mayo</option>
      <option value="6"  <?PHP if($mes==6){echo " selected='selected'" ;} ?>>Junio</option>
      <option value="7"  <?PHP if($mes==7){echo " selected='selected'" ;} ?>>Julio</option>
      <option value="8"  <?PHP if($mes==8){echo " selected='selected'" ;} ?>>Agosto</option>
      <option value="9"  <?PHP if($mes==9){echo " selected='selected'" ;} ?>>Septiembre</option>
      <option value="10" <?PHP if($mes==10){echo " selected='selected'" ;} ?>>Octubre</option>
      <option value="11" <?PHP if($mes==11){echo " selected='selected'" ;} ?>>Noviembre</option>
      <option value="12" <?PHP if($mes==12){echo " selected='selected'" ;} ?>>Diciembre</option>
        </select></td>
  </tr>
  <tr>
    <td height="30"> A&ntilde;o : </td>
    <td><input name="anoInicio" type="text" id="anoInicio" size="4" maxlength="4" value="<? echo $anno; ?>"></td>
    <td>A&ntilde;o : </td>
    <td><input name="anoFinal" type="text" id="anoFinal" size="4" maxlength="4"  value="<? echo $anno; ?>"></td>
  </tr>
  
  <tr>
    <td height="30" colspan="4"><div align="center">
      <p>
        <input name="guardar" type="submit" id="guardar" value="Guardar">
        </p>
      </div></td>
  </tr>
</table>
