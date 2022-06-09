<?
	require '../../functions.php';
	$rootPath = '../..';
	DBConnect('fayol');
	$result=db_query("select * from pedidos where numero=$_GET[request]");
	$numberOfRows=pg_num_rows($result);
	if($numberOfRows>0)
	{
		$requestObject=pg_fetch_object($result, 0);
		$requestNumber=toFormat($requestObject->numero);
		$date=$requestObject->fecha;
		$year=substr($date, 0, 4);#2005-09-17
		$month=substr($date, 5, 2);
		$day=substr($date, 8, 2);
		
		/*Information about the items*/
		$itemResult=db_query("select * from itemspedido where numero=$_GET[request]");
		$numberOfRows=pg_num_rows($itemResult);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>ORDEN DE PEDIDO No <?= $requestNumber?></title>
<style type="text/css">
<!--
.Estilo1 {font-size: 14px}
.Estilo3 {font-size: 14px; font-weight: bold; }
.Estilo4 {color: #000000}
-->
</style>
</head>

<body>
<table width="1026" height="91" border="1" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="1020" height="85"><table width="986" height="81" border="0">
      <tr>
        <td width="77" height="77" class="Estilo4"><img src="uv_receipt.jpe" alt="UV" height="75" align="center"> </td>
        <td width="766" class="Estilo4"><p class="Estilo1">VICERRECTOR&Iacute;A ADMINISTRATIVA</p>
          <p class="Estilo1">Divisi&oacute;n de administraci&oacute;n de bienes y servicios  </p></td>
        <td width="129" class="Estilo4"><p class="Estilo3">ORDEN DE PEDIDO</p>
          No FCA -          <?= $requestNumber?></td>
      </tr>
    </table></td>
  </tr>
</table>

<table width="1026" height="100" border="0">
  <tr>
    <td width="1020"><table width="1020" height="36" border="0" cellspacing="0">
      <tr class="Estilo1">
        <td width="91"><span class="Estilo1">Compra</span></td>
        <td width="76"><span class="Estilo1"><? if($requestObject->tipo=="COMPRA"){?><img src="checked_box.gif" alt="checked" align="middle"><?}else{?><img src="unchecked_box.gif" alt="checked" align="middle"><?}?></span></td>
        <td width="91"><span class="Estilo1">Obras</span></td>
        <td width="76"><span class="Estilo1">
          <? if($requestObject->tipo=="OBRAS"){?>
          <img src="checked_box.gif" alt="checked" align="middle">
          <?}else{?>
          <img src="unchecked_box.gif" alt="checked" align="middle">
          <?}?>
        </span></td>
        <td width="91"><span class="Estilo1">Servicios</span></td>
        <td width="76"><span class="Estilo1">
          <? if($requestObject->tipo=="SERVICIOS"){?>
          <img src="checked_box.gif" alt="checked" align="middle">
          <?}else{?>
          <img src="unchecked_box.gif" alt="checked" align="middle">
          <?}?>
        </span></td>
        <td width="91"><span class="Estilo1">Otro</span></td>
        <td width="76"><? if($requestObject->tipo=="OTRO"){?>
          <img src="checked_box.gif" alt="checked" align="middle">
          <?}else{?>
          <img src="unchecked_box.gif" alt="checked" align="middle">
          <?}?></td>
        <td width="334"><table width="333" border="0" cellspacing="0">
          <tr align="center" valign="bottom" class="Estilo3">
            <td width="108">D&Iacute;A</td>
            <td width="109">MES</td>
            <td width="109">A&Ntilde;O</td>
          </tr>
        </table>
        <table width="336" height="24" border="1" cellspacing="0" bordercolor="#000000">
          <tr>
            <td width="103" height="22"><div align="center"><?= $day?></div></td>
            <td width="103"><div align="center"><?= $month?></div></td>
            <td width="116"><div align="center"><?= $year?></div></td>
            </tr>
        </table>          
          <span class="Estilo1"></span></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="1034" height="226" border="0">
  <tr>
    <td width="1028" height="222"><table width="1020" height="112" border="1" cellspacing="0" bordercolor="#000000">
      <tr valign="top">
        <td height="25" colspan="2"><span class="Estilo3">Proveedor:</span>          <?= $requestObject->proveedor?></td>
        <td width="323"><span class="Estilo3">Nit:</span>          <?= $requestObject->nit?></td>
        </tr>
      <tr valign="top">
        <td height="25" colspan="2"><span class="Estilo3">Direcci&oacute;n:</span>          <?= $requestObject->direccion?></td>
        <td><span class="Estilo3">Tel&eacute;fono:</span>          <?= $requestObject->telefono?></td>
        </tr>
      <tr valign="top">
        <td width="131" height="25"><span class="Estilo3">Ciudad:</span>          <?= $requestObject->ciudad?></td>
        <td width="552"><span class="Estilo3">Facultad/Dependencia solicitante:</span>          <?= $requestObject->dependencia?></td>
        <td><span class="Estilo3">Divisi&oacute;n: </span><?= $requestObject->division?></td>
        </tr>
    </table>
      
      <table bordercolor="#000000" width="1020" height="32" border="1" cellspacing="0">
        <tr>
          <td width="1014" align="left" valign="top"><span class="Estilo3">DESCRIPCI&Oacute;N GENERAL:</span>            <?= $requestObject->descripcion?></td>
        </tr>
      </table>
      <table width="1014" height="27" border="0" cellspacing="0">
        <tr align="center" valign="bottom" class="Estilo3">
          <td width="525"><div align="center">CONCEPTO</div></td>
          <td width="485"><div align="center">VALORES</div></td>
        </tr>
      </table>      
      <table bordercolor="#000000" width="1020" height="31" border="1" cellspacing="0">
        <tr align="center" valign="top" bgcolor="#CCCCCC" >
          <td width="40"><span class="Estilo1 Estilo4"><strong>ITEM</strong></span></td>
          <td width="40"><span class="Estilo1 Estilo4"><strong>CANT</strong></span></td>
          <td width="40"><span class="Estilo1 Estilo4"><strong>UNID</strong></span></td>
          <td width="389"><span class="Estilo1 Estilo4"><strong>DESCRIPCI&Oacute;N ESPEC&Iacute;FICA </strong></span></td>
          <td width="228"><span class="Estilo1 Estilo4"><strong>VALOR UNITARIO SIN IVA </strong></span></td>
          <td width="257"><span class="Estilo1 Estilo4"><strong>VALOR TOTAL SIN IVA </strong></span></td>
        </tr>
		<?
		$subTotalSinIva=0;
		for($i=0; $i<$numberOfRows; $i++)
		{
			$itemObject=pg_fetch_object($itemResult, $i);
			$subTotalSinIva=$subTotalSinIva+$itemObject->valorunitariosiniva;
		?>
        <tr>
          <td align="right"><?= $itemObject->numeroitem?></td>
          <td align="right"><?= $itemObject->cantidad?></td>
          <td align="right"><?= $itemObject->unidades?></td>
          <td><?= $itemObject->descripcion?></td>
          <td align="right"><?= $itemObject->valorunitario?></td>
          <td align="right"><?= $itemObject->valorunitariosiniva?></td>
        </tr>
		<?
		}
		$leftRows=14-$numberOfRows;
		for($i=0; $i<$leftRows; $i++)
		{
		?>
		<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
		<?
		}
		?>
      </table>
      <table bordercolor="#000000" width="1020" height="115" border="1" cellspacing="0">
        <tr>
          <td width="689" rowspan="5" valign="top" class="Estilo1"><span class="Estilo3">OBSERVACIONES</span>          <?= $requestObject->observaciones?></td>
          <td width="60" align="right">&nbsp;</td>
          <td width="151">Subtotal sin I.V.A. </td>
          <td width="102" align="right"><?= $requestObject->subtotalsiniva?></td>
        </tr>
        <tr>
          <td align="right"><?= $requestObject->porcentajedescuento?>%</td>
          <td>Descuento</td>
          <td align="right"><?= $requestObject->descuento?></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>Subtotal con Dcto </td>
          <td align="right"><?= $requestObject->subtotalcondescuento?></td>
        </tr>
        <tr>
          <td align="right"><?= $requestObject->porcentajeiva?>%</td>
          <td>I.V.A.</td>
          <td align="right"><?= $requestObject->iva?></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>Total con I.V.A. </td>
          <td align="right"><?= $requestObject->valortotalconiva?></td>
        </tr>
      </table>
      
      <table bordercolor="#000000" width="1020" border="1" cellspacing="0">
        <tr>
          <td width="190" class="Estilo3">CONDICIONES GENERALES </td>
          <td width="398" colspan="3"><?= $requestObject->condiciones?></td>
        </tr>
      </table>
	  <table bordercolor="#000000" width="1020" height="32" border="1" cellspacing="0">
	  	<tr>
          <td width="419"><span class="Estilo3">Tiempo de entrega(en d&iacute;as)</span>:
          <?= $requestObject->tiempoentrega?></td>
          <td width="328"><span class="Estilo3">Forma de pago</span>:
          <?= $requestObject->formadepago?></td>
          <td width="259"><span class="Estilo3">Garant&iacute;a:</span>
            <?= $requestObject->garantia?></td>
        </tr>
	  </table>
      <table width="1013" border="0" cellspacing="0">
        <tr>
          <td>Entregar los art&iacute;culos en las instalaciones de la Universidad del Valle en la siguiente localizaci&oacute;n </td>
        </tr>
      </table>
      <table bordercolor="#000000" width="1020" height="32" border="1" cellspacing="0">
        <tr>
          <td width="419"><span class="Estilo3">Sede:</span>          <?= $requestObject->sede?></td>
          <td width="328"><span class="Estilo3">Edificio:</span>          <?= $requestObject->edificio?></td>
          <td width="259"><span class="Estilo3">Espacio</span>:          <?= $requestObject->espacio?></td>
        </tr>
      </table>
      <table bordercolor="#000000" width="1020" height="36" border="1" cellspacing="0">
        <tr>
          <td width="1014" height="34"> <p align="justify">La presente Orden de Pedido, se desarrollar&aacute; bajo las politicas establecidas en el Estatuto de Contrataci&oacute;n de la Universidad del Valle.(Resoluci&oacute;n No 046 del consejo superior de Julio de 2004).</p>
            <p align="justify"><strong>Perfeccionamiento:</strong> <font class="font6">La presente Orden se<span style=""> </span>da por perfeccionada una vez tenga el n&uacute;mero de Registro Presupuestal aprobado por el Ordenador del Gasto, la firma del Jefe de Unidad y se suscriban</font> las p&oacute;lizas a que
    haya lugar. </p></td>
        </tr>
      </table>
      <table bordercolor="#000000" width="1020" height="46" border="1" cellspacing="0">
        <tr>
          <td width="232" align="center" valign="bottom"><p>&nbsp;</p>
          <?= $requestObject->jefedeseccion?></td>
          <td width="283" align="center" valign="bottom"><?= $requestObject->jefedeunidad?></td>
          <td width="248" align="left" valign="top" class="Estilo3">Aceptado          </td>
          <td width="239" align="left" valign="top" class="Estilo3">Recibo a satisfacci&oacute;n </td>
        </tr>
        <tr align="center" valign="top" class="Estilo3">
          <td> Jefe de Secci&oacute;n/Coordinador de &Aacute;rea/ Jefe de Departamento </td>
          <td> Jefe de Unidad (Divisi&oacute;n/Jefe de Oficina/Director de Escuela) </td>
          <td> Contratista </td>
          <td> Firma </td>
        </tr>
      </table>
      <table width="1013" height="24" border="0" cellspacing="0">
        <tr>
          <td width="1011"> <div align="right">Elaborado por: Calidad y Mejoramiento </div></td>
        </tr>
      </table>
      <table width="2030" border="0" cellspacing="0">
        <tr>
          <td width="1013"><span class="Estilo3">Elabor&oacute;:</span>
            <?= $requestObject->autor?></td>
        </tr>
      </table>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
<?
	}
	/*Para los que entraron mamando gallo*/
	else
	{
		header("Location: index.php");
	}
?>
