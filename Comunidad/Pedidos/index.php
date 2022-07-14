<?
	require '../../functions.php';
	$rootPath = '../..';
  if(!$_GET['item'])
  {
  	$_GET['item']=1;
  }
  $_GET['submenu_pedidos'] = true;
  PageInit('Realización de pedidos', '../menu.php');
 
  
  if($_GET['item']==1)
  {
	$requestNumber=getNextRequestNumber();
  ?>
  	
  	<h1 class="shiny">Realizaci&oacute;n de pedidos </h1>
	<p>Para realizar una solicitud por Internet usted debe completar el siguiente formulario.</p>
<?
	include("formato.php");
  }
  if($_GET['item']==2)
  {
	$prod[1]['cantidad']=$_POST['cantidad1'];
	$prod[1]['unidades']=$_POST['unidades1'];
	$prod[1]['descripcionespecifica']=$_POST['descripcionespecifica1'];
	$prod[1]['valorsiniva']=$_POST['valorconiva1'];
	$prod[1]['valorconiva']=$_POST['valorconiva1'];
	
	$prod[2]['cantidad']=$_POST['cantidad2'];
	$prod[2]['unidades']=$_POST['unidades2'];
	$prod[2]['descripcionespecifica']=$_POST['descripcionespecifica2'];
	$prod[2]['valorsiniva']=$_POST['valorconiva2'];
	$prod[2]['valorconiva']=$_POST['valorconiva2'];
	
	$prod[3]['cantidad']=$_POST['cantidad3'];
	$prod[3]['unidades']=$_POST['unidades3'];
	$prod[3]['descripcionespecifica']=$_POST['descripcionespecifica3'];
	$prod[3]['valorsiniva']=$_POST['valorconiva3'];
	$prod[3]['valorconiva']=$_POST['valorconiva3'];
	
	$prod[4]['cantidad']=$_POST['cantidad4'];
	$prod[4]['unidades']=$_POST['unidades4'];
	$prod[4]['descripcionespecifica']=$_POST['descripcionespecifica4'];
	$prod[4]['valorsiniva']=$_POST['valorconiva4'];
	$prod[4]['valorconiva']=$_POST['valorconiva4'];
	
	$prod[5]['cantidad']=$_POST['cantidad5'];
	$prod[5]['unidades']=$_POST['unidades5'];
	$prod[5]['descripcionespecifica']=$_POST['descripcionespecifica5'];
	$prod[5]['valorsiniva']=$_POST['valorconiva5'];
	$prod[5]['valorconiva']=$_POST['valorconiva5'];
	
	/*Validation*/
	/*1. At least one item must have been specified*/
	$atLeastOneItemSpecified=false;//we don't know yet
	for($i=1; $i<=5; $i++)
	{
		if($prod[$i]['cantidad']!="" and $prod[$i]['descripcionespecifica']!="" and ($prod[$i]['valorsiniva']!="" or $prod[$i]['valorconiva']!=""))
		{
			$atLeastOneItemSpecified=true;
		}
	}
	
	/*2. We must make sure that all the information about an item has been provided, that is, all fields have been filled*/
	$incompleteItem=false;
	for($i=1; $i<=5; $i++)
	{
		/*If there is one field filled but not all of them are filled*/
		if(($prod[$i]['cantidad']!="" || $prod[$i]['unidades']!="" || $prod[$i]['descripcionespecifica']!="" || $prod[$i]['valorsiniva']!="" || $prod[$i]['valorconiva']!="") && !($prod[$i]['cantidad']!="" && $prod[$i]['unidades']!="" && $prod[$i]['descripcionespecifica']!="" && $prod[$i]['valorsiniva']!="" && $prod[$i]['valorconiva']!=""))
		{
			if($prod[$i]['cantidad']=="")
			{
				$prod[$i]['error']['cantidad']=true;
				$prod['error']['cantidad']=true;
				$incompleteItem=true;
			}
			/*if($prod[$i]['unidades']=="")
			{
				$prod[$i]['error']['unidades']=true;
				$prod['error']['unidades']=true;
				$incompleteItem=true;
			}*/
			if($prod[$i]['descripcionespecifica']=="")
			{
				$prod[$i]['error']['descripcionespecifica']=true;
				$prod['error']['descripcionespecifica']=true;
				$incompleteItem=true;
			}
			/*if($prod[$i]['valorsiniva']=="")
			{
				$prod[$i]['error']['valorsiniva']=true;
				$prod['error']['valorsiniva']=true;
				$incompleteItem=true;
			}
			if($prod[$i]['valorconiva']=="")
			{
				$prod[$i]['error']['valorconiva']=true;
				$prod['error']['valorconiva']=true;
				$incompleteItem=true;
			}*/
			/*No deben estar vacíos los dos campos, al menos uno debe estra lleno*/
			if($prod[$i]['valorsiniva']=="" && $prod[$i]['valorconiva']=="")
			{
				$prod[$i]['error']['valorsiniva']=true;
				$prod['error']['valorsiniva']=true;
				$incompleteItem=true;
				
				$prod[$i]['error']['valorconiva']=true;
				$prod['error']['valorconiva']=true;
				$incompleteItem=true;
			}
		}
	}
	
	/*3. We must verify that all the numeric fields are actually filled with integer values*/
	$allIntegerValues=true;
	for($i=1; $i<=5; $i++)
	{
		$cantidad=$prod[$i]['cantidad'];
		$unidades=$prod[$i]['unidades'];
		$descripcionespecifica=$prod[$i]['descripcionespecifica'];
		$valorsiniva=$prod[$i]['valorsiniva'];
		$valorconiva=$prod[$i]['valorconiva'];
		
		if($prod[$i]['cantidad']!="" and strval($cantidad)!=strval(intval($cantidad)))
		{
			$allIntegerValues=false;
			$prod[$i]['error']['cantidad']=true;
		}
		if($prod[$i]['unidades']!="" and strval($unidades)!=strval(intval($unidades)))
		{
			$allIntegerValues=false;
			$prod[$i]['error']['unidades']=true;
		}
		/*if($prod[$i]['valorsiniva']!="" and strval($valorsiniva)!=strval(intval($valorsiniva)))
		{
			$allIntegerValues=false;
			$prod[$i]['error']['valorsiniva']=true;
		}*/
		if($prod[$i]['valorconiva']!="" and strval($valorconiva)!=strval(intval($valorconiva)))
		{
			$allIntegerValues=false;
			$prod[$i]['error']['valorconiva']=true;
		}
	}
	
	/*After validation the system must choose something to do*/
	/*If there's something wrong with the information*/
	
	
	
	if($incompleteItem)
	{
	?>
		<h1>Error</h1>
		<p>Ha surgido un error al intentar procesar su petici&oacute;n, la informaci&oacute;n de algunos de los items es incompleta. Por favor revise el formulario cuidadosamente y llene los campos referentes a los &iacute;tems que desea solicitar prestando especial atenci&oacute;n a los campos marcados con asterisco(<font size="-1" color="#FF0000">*</font>).</p>
	    <?
		$requestNumber=getNextRequestNumber();
		include('formato.php');
	}//if($incompleteItem==true)
	
	/*No item was specified*/
	elseif(!$atLeastOneItemSpecified)
	{
	?>
		<h1>Error</h1>
		<p>Ha surgido un error al intentar procesar su petici&oacute;n, ha olvidado proporcionar informaci&oacute;n expl&iacute;cita de los items que desea solicitar. Por favor revise el formulario cuidadosamente y llene los campos necesarios. </p>
	<?
		$requestNumber=getNextRequestNumber();
		include('formato.php');
	}//if(!atLeastOneItemSpecified)
	
	elseif(!$allIntegerValues)
	{
	?>
		<h1>Error</h1>
		<p>Ha surgido un error al intentar procesar su petici&oacute;n, algunos campos num&eacute;ricos fueron llenados con valores no num&eacute;ricos. Por favor revise el formulario cuidadosamente y llene los campos referentes a los &iacute;tems que desea solicitar prestando especial atenci&oacute;n a los campos marcados con asterisco(<font size="-1" color="#FF0000">*</font>).</p>
	<?
		$requestNumber=getNextRequestNumber();
		include('formato.php');
	}//if(!$allIntegerValues)
	
	/*At this point, everything is correct. We have to insert the information into the database*/
	else
	{
		$_POST[tipo] = strtoupper($_POST[tipo]);
		$_POST[proveedor]=strtoupper($_POST[proveedor]);
		$_POST[nit]=strtoupper($_POST[nit]);
		$_POST[direccion]=strtoupper($_POST[direccion]);
		$_POST[numeroTelefonico]=strtoupper($_POST[numeroTelefonico]);
		$_POST[ciudad]=strtoupper($_POST[ciudad]);
		$_POST[dependencia]=strtoupper($_POST[dependencia]);
		$_POST[division]=strtoupper($_POST[division]);
		$_POST[descripcion]=strtoupper($_POST[descripcion]);
		$_POST[dep]=strtoupper($_POST[dep]);
		$_POST[cta]=strtoupper($_POST[cta]);
		$_POST[act]=strtoupper($_POST[act]);
		$_POST[subgrupo]=strtoupper($_POST[subgrupo]);
		$_POST[cc]=strtoupper($_POST[cc]);
		$_POST[ci]=strtoupper($_POST[ci]);
		$_POST[registropresupuestal]=strtoupper($_POST[registropresupuestal]);
		$_POST[observaciones]=strtoupper($_POST[observaciones]);
		$_POST[condicionesgenerales]=strtoupper($_POST[condicionesgenerales]);
		$_POST[tiempodeentrega]=strtoupper($_POST[tiempodeentrega]);
		$_POST[formadepago]=strtoupper($_POST[formadepago]);
		$_POST[garantia]=strtoupper($_POST[garantia]);
		$_POST[lugardeentrega]=strtoupper($_POST[lugardeentrega]);
		$_POST[sede]=strtoupper($_POST[sede]);
		$_POST[edificio]=strtoupper($_POST[edificio]);
		$_POST[espacio]=strtoupper($_POST[espacio]);
		$_POST[autor]=strtoupper($_POST[autor]);
		$_POST[jefedeseccion]=strtoupper($_POST[jefedeseccion]);
		$_POST[jefedeunidad]=strtoupper($_POST[jefedeunidad]);
		if($_POST['subtotalsiniva']=="")
		{
			$_POST['subtotalsiniva']=0;
		}
		if($_POST['descuento']=="")
		{
			$_POST['descuento']=0;
		}
		if($_POST['subtotalcondescuento']=="")
		{
			$_POST['subtotalcondescuento']=0;
		}
		if($_POST['iva']=="")
		{
			$_POST['iva']=0;
		}
		if($_POST['valortotalconiva']=="")
		{
			$_POST['valortotalconiva']=0;
		}
		if($_POST['porcentajedescuento']=="")
		{
			$_POST['porcentajedescuento']=0;
		}
		if($_POST['porcentajeiva']=="")
		{
			$_POST['porcentajeiva']=0;
		}
		$userIP=getIP();
		$okData=false;
		DBConnect('fayol');
		/*The first thing we have to do is insert information about the request, not the items*/
		$requestNumber=getNextRequestNumber();
		$result=@db_query("INSERT INTO pedidos(numero, tipo, proveedor, nit, direccion, telefono, ciudad, dependencia, division, descripcion, dep, cta, act, subgrupo, cc, ci, registropresupuestal, observaciones, condiciones, tiempoentrega, formadepago, garantia, lugardeentrega, sede, edificio, espacio, autor, jefedeseccion, jefedeunidad, ip, subtotalsiniva, descuento, subtotalcondescuento, iva, valortotalconiva, porcentajedescuento, porcentajeiva) VALUES ($requestNumber, '$_POST[tipo]', '$_POST[proveedor]', '$_POST[nit]', '$_POST[direccion]', '$_POST[numeroTelefonico]', '$_POST[ciudad]', '$_POST[dependencia]', '$_POST[division]', '$_POST[descripcion]', '$_POST[dep]', '$_POST[cta]', '$_POST[act]', '$_POST[subgrupo]', '$_POST[cc]', '$_POST[ci]', '$_POST[registropresupuestal]', '$_POST[observaciones]', '$_POST[condicionesgenerales]', '$_POST[tiempodeentrega]', '$_POST[formadepago]', '$_POST[garantia]', '$_POST[lugardeentrega]', '$_POST[sede]', '$_POST[edificio]', '$_POST[espacio]', '$_POST[autor]', '$_POST[jefedeseccion]', '$_POST[jefedeunidad]', '$userIP', $_POST[subtotalsiniva], $_POST[descuento], $_POST[subtotalcondescuento], $_POST[iva], $_POST[valortotalconiva], $_POST[porcentajedescuento], $_POST[porcentajeiva])");
		if($result)
		{
			$okData=true;
		}
		/*Once the information about the request has been entered, we must enter information about the item*/
		if($_POST['cantidad1']!="")
		{
			$_POST[descripcionespecifica1]=strtoupper($_POST[descripcionespecifica1]);
			$result=@db_query("INSERT INTO itemspedido(numero, numeroitem, descripcion, cantidad, valorunitario, valorunitariosiniva, unid) VALUES($requestNumber, 1, '$_POST[descripcionespecifica1]', $_POST[cantidad1], '$_POST[valorconiva1]', '$_POST[valorsiniva1]', '$_POST[unidades1]')");
		}
		if($_POST['cantidad2']!="")
		{
			$_POST[descripcionespecifica2]=strtoupper($_POST[descripcionespecifica2]);
			$result=@db_query("INSERT INTO itemspedido(numero, numeroitem, descripcion, cantidad, valorunitario, valorunitariosiniva, unid) VALUES($requestNumber, 2, '$_POST[descripcionespecifica2]', $_POST[cantidad2], '$_POST[valorconiva2]', '$_POST[valorsiniva2]', '$_POST[unidades2]')");
		}
		if($_POST['cantidad3']!="")
		{
			$_POST[descripcionespecifica3]=strtoupper($_POST[descripcionespecifica3]);
			$result=@db_query("INSERT INTO itemspedido(numero, numeroitem, descripcion, cantidad, valorunitario, valorunitariosiniva, unid) VALUES($requestNumber, 3, '$_POST[descripcionespecifica3]', $_POST[cantidad3], '$_POST[valorconiva3]', '$_POST[valorsiniva3]', '$_POST[unidades3]')");
		}
		if($_POST['cantidad4']!="")
		{
			$_POST[descripcionespecifica4]=strtoupper($_POST[descripcionespecifica4]);
			$result=@db_query("INSERT INTO itemspedido(numero, numeroitem, descripcion, cantidad, valorunitario, valorunitariosiniva, unid) VALUES($requestNumber, 4, '$_POST[descripcionespecifica4]', $_POST[cantidad4], '$_POST[valorconiva4]', '$_POST[valorsiniva4]', '$_POST[unidades4]')");
		}
		if($_POST['cantidad5']!="")
		{
			$_POST[descripcionespecifica5]=strtoupper($_POST[descripcionespecifica5]);
			$result=@db_query("INSERT INTO itemspedido(numero, numeroitem, descripcion, cantidad, valorunitario, valorunitariosiniva, unid) VALUES($requestNumber, 5, '$_POST[descripcionespecifica5]', $_POST[cantidad5], '$_POST[valorconiva5]', '$_POST[valorsiniva5]', '$_POST[unidades5]')");
		}
		if($okData)
		{
		?>
			<h1>Registro completo</h1>
			<p>La información de su solicitud ha sido registrada exitosamente. El número de registro es <?= $formatted=toFormat($requestNumber)?></p>
		<?
		}
		if(!$okData)
		{
		?>
			<h1>Ha ocurrido un error</h1>
			<p>La información de su solicitud no ha podido ser registrada, por favor inténtelo más tarde</p>
		<?	
		}
	}//else
	
  }//if($_GET['item']==2)
  if($_GET['item']==3)
  {
  ?>
  	<h1>Visualizar informaci&oacute;n de pedidos realizados</h1>
	<p>A continuaci&oacute;n usted podr&aacute; buscar informaci&oacute;n sobre los pedidos realizados v&iacute;a web.</p>
    <?
	include('searchFormat.php');
  }//if($_GET['item']==3)
  
  
  if($_GET['item']==4)
  {
 		$_POST[tipo] = strtoupper($_POST[tipo]);
		$_POST[proveedor]=strtoupper($_POST[proveedor]);
		$_POST[nit]=strtoupper($_POST[nit]);
		$_POST[direccion]=strtoupper($_POST[direccion]);
		$_POST[numeroTelefonico]=strtoupper($_POST[numeroTelefonico]);
		$_POST[ciudad]=strtoupper($_POST[ciudad]);
		$_POST[dependencia]=strtoupper($_POST[dependencia]);
		$_POST[division]=strtoupper($_POST[division]);
		$_POST[descripcion]=strtoupper($_POST[descripcion]);
		$_POST[dep]=strtoupper($_POST[dep]);
		$_POST[cta]=strtoupper($_POST[cta]);
		$_POST[act]=strtoupper($_POST[act]);
		$_POST[subgrupo]=strtoupper($_POST[subgrupo]);
		$_POST[cc]=strtoupper($_POST[cc]);
		$_POST[ci]=strtoupper($_POST[ci]);
		$_POST[registropresupuestal]=strtoupper($_POST[registropresupuestal]);
		$_POST[observaciones]=strtoupper($_POST[observaciones]);
		$_POST[condicionesgenerales]=strtoupper($_POST[condicionesgenerales]);
		$_POST[tiempodeentrega]=strtoupper($_POST[tiempodeentrega]);
		$_POST[formadepago]=strtoupper($_POST[formadepago]);
		$_POST[garantia]=strtoupper($_POST[garantia]);
		$_POST[lugardeentrega]=strtoupper($_POST[lugardeentrega]);
		$_POST[sede]=strtoupper($_POST[sede]);
		$_POST[edificio]=strtoupper($_POST[edificio]);
		$_POST[espacio]=strtoupper($_POST[espacio]);
		$_POST[autor]=strtoupper($_POST[autor]);
		$_POST[jefedeseccion]=strtoupper($_POST[jefedeseccion]);
		$_POST[jefedeunidad]=strtoupper($_POST[jefedeunidad]); 
  
  	DBConnect('fayol');
  	/*We have to prepare the query statement based on what fields were filled by the user*/
  	$sql="SELECT * FROM pedidos ";
	$alreadyWithCondition=false;
  	if($_POST['diaAntes']!="")
	{
		$sql=$sql."WHERE fecha < '$_POST[anoAntes]-$_POST[mesAntes]-$_POST[diaAntes]' ";
		$alreadyWithCondition=true;
	}
	if($_POST['diaDespues']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND fecha > '$_POST[anoDespues]-$_POST[mesDespues]-$_POST[diaDespues]' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE fecha > '$_POST[anoDespues]-$_POST[mesDespues]-$_POST[diaDespues]' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['numero']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND numero='$_POST[numero]' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE numero='$_POST[numero]' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['tipo']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND tipo='$_POST[tipo]' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE tipo='$_POST[tipo]' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['nit']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND nit='$_POST[nit]' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE nit='$_POST[nit]' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['ciudad']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND ciudad like '%$_POST[ciudad]%' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE ciudad like '%$_POST[ciudad]%' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['dependencia']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND dependencia like '%$_POST[dependencia]%' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE dependencia like '%$_POST[dependencia]%' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['division']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND division like '%$_POST[division]%' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE division like '%$_POST[division]%' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['dep']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND dep like '%$_POST[dep]%' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE dep like '%$_POST[dep]%' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['cta']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND cta like '%$_POST[cta]%' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE cta like '%$_POST[cta]%' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['subgrupo']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND subgrupo like '%$_POST[subgrupo]%' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE subgrupo like '%$_POST[subgrupo]%' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['cc']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND cc like '%$_POST[cc]%' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE cc '%$_POST[cc]%' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['ci']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND ci like '%$_POST[ci]%' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE ci '%$_POST[ci]%' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['registropresupuestal']!="")
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND registropresupuestal like '%$_POST[registropresupuestal]%' ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE registropresupuestal like '%$_POST[registropresupuestal]%' ";
			$alreadyWithCondition=true;
		}
	}
	if($_POST['anuladas']==1)
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND valido=false ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE valido=false ";
			$alreadyWithCondition=true;
		}

	}
	if($_POST['anuladas']==2)
	{
		if($alreadyWithCondition)
		{
			$sql=$sql."AND valido=true ";
		}
		if(!$alreadyWithCondition)
		{
			$sql=$sql."WHERE valido=true ";
			$alreadyWithCondition=true;
		}

	}
	/*Once the query statement is ready, we execute it*/	
	$result=db_query($sql);
	//echo "Query was '".$sql."'";
	$numberOfRows=pg_num_rows($result);
	if($numberOfRows!=0)
	{
		?>
		<TABLE width=100% border=1>
					<TBODY>
						<TR bgColor=#cccccc vAlign=top>
							<TD width="61%"><P><FONT size=-1><b>Resultados de la b&uacute;squeda </b></FONT></P></TD>
					  </TR>
						<TR vAlign=top>
							<TD height="25"><TABLE width="100%" border=0 align=center>
									<TBODY>
										<TR bgcolor="#CCCCCC">
											<TD width="12%">            							  <div align="center"><font size="-2"><FONT color="#333333">N&uacute;mero de solicitud </FONT></font></div></TD>
											<TD width="16%">            							  <div align="center"><font size="-2"><FONT color="#333333">Tipo
										  </FONT></font></div></TD>
											<TD width="45%">       							          <div align="center"><font size="-2"><font color="#333333">Proveedor</font></font></div></TD>
											<TD width="27%">       							          <div align="center"><font size="-2"><font color="#333333">Nit</font></font></div></TD>
									  </TR>
									  <?
										for($i=0; $i<$numberOfRows; $i++)
										{
											$requestObject=pg_fetch_object($result, $i);
											$numeroDeSolicitud=$requestObject->numero;
											$tipo=$requestObject->tipo;
											$proveedor=$requestObject->proveedor;
											$nit=$requestObject->nit;
											?>
											<tr>
											<td><a href='index.php?item=5&&request=<?= $numeroDeSolicitud?>'><?= $formatted=toFormat($numeroDeSolicitud)?></a></td><td><a href='index.php?item=5&&request=<?= $numeroDeSolicitud?>'><?= $tipo?></a></td><td><a href='index.php?item=5&&request=<?= $numeroDeSolicitud?>'><?= $proveedor?></a></td><td><a href='index.php?item=5&&request=<?= $numeroDeSolicitud?>'><?= $nit?></a></td>
											</tr>
											<?
										}
									  ?>
							  </TBODY>
						  </TABLE></TD>
						</TR>
				  </TBODY>
	  </TABLE>
		<?
	}
	else
	{
		?>
			<h1>Resultados de b&uacute;squeda</h1>
			<p>No hay resultados que coincidan con sus patrones de b&uacute;squeda. <br><a href="index.php?item=3">Regresar al formulario</a></p>
		<?
	}
  }//if($_GET['item']==4)
  if($_GET['item']==5)//Display information about a specific request
  {
  	if($_GET['request']!="")
	{
		DBConnect('fayol');
		if($_GET['anular']==5)
		{
			db_query("UPDATE pedidos SET valido=false WHERE numero=$_GET[request]");
			#echo "Anulado";
		}
		if($_GET['anular']==6)
		{
			#echo "Aprobado";
			db_query("UPDATE pedidos SET valido=true WHERE numero=$_GET[request]");
		}
		$result=db_query("SELECT * FROM pedidos WHERE numero=$_GET[request]");
		$numberOfRows=pg_num_rows($result);
		if($numberOfRows>0)
		{
			$requestObject=pg_fetch_object($result);
		  ?>
				<h1>Solicitud No <?= $formatted=toFormat($_GET['request'])?></h1>
				<p><a href="receipt.php?request=<?= $requestObject->numero?>">Versión imprimible</a> </p>
				<TABLE width=100% border=1>
            	<TBODY>
            		<TR bgColor=#cccccc vAlign=top>
            			<TD width="61%"><h1><FONT size=-1>La solicitud No
                              <?= $formatted=toFormat($_GET['request'])?><? if(getIP()==$requestObject->ip)
							  												{
																				$valido=$requestObject->valido;
							  													if($valido=="t")
																				{
																				?>
																					es actualmente vigente.
																					<?
																					$currentDate=date("Y-m-d");
																					if(nextMonthDay($requestObject->fecha)>$currentDate)
																					//if('2005-09-01'>$currentDate)
																					{
																					?>
																					 <a href="index.php?item=5&&request=<?= $requestObject->numero?>&&anular=5">Anular solicitud</a>
																					<?
																					}
																				}
																				if($valido=="f")
																				{
																				?>
																					actualmente se encuentra anulada. 
																					<?
																					$currentDate=date("Y-m-d");
																					if(nextMonthDay($requestObject->fecha)>$currentDate)
																					//if('2005-09-01'>$currentDate)
																					{
																					?>
																					<a href="index.php?item=5&&request=<?= $requestObject->numero?>&&anular=6">Aprobar solicitud</a>
																					<?
																					}
																				}
																			}?>
</FONT></h1></TD>
       			  </TR>
            		<TR vAlign=top>
            			<TD><TABLE width="100%" border=0 align=center>
            					<TBODY>
            						<TR>
            							<TD width="48%"><div align="left"><strong><FONT size=-1>N&uacute;mero de solicitud</FONT></strong></div></TD>
            							<TD width="52%"><FONT size=-1><?= $formatted=toFormat($requestObject->numero)?>
           							  </FONT></TD>
       							  </TR>
            						<TR>
            						  <TD width="48%"> <div align="left"><strong><font size="-1">Tipo</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->tipo?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Proveedor</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->proveedor?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Fecha de realizaci&oacute;n </font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->fecha?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">N&uacute;mero de NIT </font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->nit?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Direcci&oacute;n</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->direccion?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">N&uacute;mero telef&oacute;nico</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->telefono?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Ciudad</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->ciudad?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Dependencia</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->dependencia?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Divisi&oacute;n</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->division?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Descripci&oacute;n general</font></strong></div></TD>
            						  <TD width="52%"><FONT size=-1>
            						    <?= $requestObject->descripcion?>
            						  </FONT></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Dep</font></strong></div></TD>
            						  <TD width="52%"><FONT size=-1>
            						    <?= $requestObject->dep?>
            						  </FONT></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Cta</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->cta?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Act</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->act?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Subgrupo</font></strong></div></TD>
            						  <TD width="52%"><FONT size=-1>
            						    <?= $requestObject->subgrupo?>
            						  </FONT></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">CC</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->cc?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">CI</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->ci?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Registro presupuestal</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->registropresupuestal?>
            						  </font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Observaciones</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->observaciones?>
</font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Tiempo de entrega en d&iacute;as </font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->tiempoentrega?>
</font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Forma de pago</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->formadepago?>
</font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Garant&iacute;a</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->garantia?>
</font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Lugar de entrega</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->lugardeentrega?>
</font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Sede</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->sede?>
</font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Edificio</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->edificio?>
</font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Espacio</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->espacio?>
</font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Solicitud realizada por</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->autor?>
</font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Jefe de secci&oacute;n</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->jefedeseccion?>
</font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Jefe de unidad</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->jefedeunidad?>
</font></TD>
          						  </TR>
            						<TR>
            						  <TD width="48%"><div align="left"><strong><font size="-1">Condiciones</font></strong></div></TD>
            						  <TD width="52%"><font size="-1">
            						    <?= $requestObject->condiciones?>
</font></TD>
          						  </TR>
            						<TR>
                                      <TD><div align="left"><strong><font size="-1">Esta solicitud se realiz&oacute; desde el equipo </font></strong></div></TD>
                                      <TD><font size="-1">
                                        <?= $requestObject->ip?>
                                      </font></TD>
          						  </TR>
   						  </TBODY>
            					</TABLE></TD>
           			</TR>
       		  </TBODY>
  </TABLE>
		  <?
		  /*After displaying information about the request, we must show information about the items*/
		  $result=db_query("SELECT * FROM itemspedido WHERE numero=$_GET[request]");
		  $numberOfRows=pg_num_rows($result);
		  for($i=0; $i<$numberOfRows; $i++)
		  {
		  		$itemObject=pg_fetch_object($result, $i);  
			  ?>
				<TABLE width=100% border=1>
					<TBODY>
						<TR bgColor=#cccccc vAlign=top>
							<TD width="61%"><h1><FONT size=-1>Item No <?= $itemObject->numeroitem?></FONT></h1></TD>
					  </TR>
						<TR vAlign=top>
							<TD height="124"><TABLE width="100%" border=0 align=center>
									<TBODY>
										<TR>
											<TD width="29%"><div align="justify"><font size="-1"><strong>Descripci&oacute;n</strong></font></div></TD>
											<TD width="60%"><FONT size=-1>
											  <?= $itemObject->descripcion?>
											</FONT></TD>
									  </TR>
										<TR>
										  <TD width="29%"><div align="justify"><font size="-1"><strong>Cantidad</strong></font></div></TD>
										  <TD><FONT size=-1>
										    <?= $itemObject->cantidad?>
										  </FONT></TD>
									  </TR>
										<TR>
										  <TD width="29%"><div align="justify"><font size="-1"><strong>Valor unitario sin IVA </strong></font></div></TD>
										  <TD><FONT size=-1>
										    <?= $itemObject->valorunitariosiniva?>
										  </FONT></TD>
									  </TR>
										<TR>
										  <TD width="29%"><div align="justify"><font size="-1"><strong>Valor total sin IVA </strong></font></div></TD>
										  <TD><FONT size=-1>
										    <?= $itemObject->valorunitario?>
										  </FONT></TD>
									  </TR>
										<TR>
										  <TD width="29%"><div align="justify"><font size="-1"><strong>Unid</strong></font></div></TD>
										  <TD><FONT size=-1>
										    <?= $itemObject->unid?>
										  </FONT></TD>
									  </TR>
							  </TBODY>
									</TABLE></TD>
						</TR>
				  </TBODY>
	  </TABLE>
			  <?
		  }
	  	}//if($numberOfRows>0)
	  else
	  {
	  	?>
				<h1>La solicitud No <?= $_GET['request']?> no existe</h1>
		<?
	  }
  	}//if(isset($_GET['request']))
	else
	{
		/*The user entered ilegally here*/
	}
  }//if($_GET['item']==5)
  PageEnd();
?>	  