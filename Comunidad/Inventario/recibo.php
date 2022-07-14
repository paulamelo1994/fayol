
<?
	session_start();

	$root_path = "../..";
	require '../../functions.php';

	$codVenta = $_GET['id'];
		
	$cosa;
	$conexion = DBConnect('inventario');
			
	if(!conexion)
		$cosa = 'No se pudo lograr la conexi&oacute;n con la BD.';

	$consulta = "SELECT * from ventas, usuario where ventas.codventa='$codVenta' and  usuario.login = ventas.hecha_por ";
	$rs1 = db_query($consulta);
	$obj = pg_fetch_object($rs1);

	
	$consulta2 = "SELECT * from ubicacion where indice = '$obj->codubicacion'";
	$rs2 = db_query($consulta2);
	$obj2 = pg_fetch_object($rs2);
	
	
	
	/* RS1
 $codventa           
 $codubicacion       
 $comprador           
 $vinculacion         
 $tipo_identificacion 
 $doc_identificacion  
 $total_venta         
 $fecha              
 $hora                
 $hecha_por           
 $conceptodescuento   */
 	
	
?>

<html>
<title>Recibo de venta<?= $obj->fecha?><?= $obj->hora?></title>
<body>
<div id=noprint>
<a href='javascript:window.print(); void 0;'><img src="../../Images/imprimir.jpg">Imprimir</a> 
</div>
<? echo '<h1>'.$obj3->indice.'</h1>';?> 

<table width="600" border="1" bordercolor="#FF0000">

<tr><td>
<table width="100%" height="100%">
<tr><td>

<br>
<P align="center"><strong>REMISI&Oacute;N - 
		LIBRERIA</strong></P>
<br>
	<div style="float:right "> &nbsp;&nbsp;<strong>Fecha: </strong> <?= $obj->fecha?> <?= $obj->hora?></div><br>
	 &nbsp;&nbsp;<strong>Beneficiario: </strong> <?= $obj->comprador?> <br>
	 &nbsp;&nbsp;<strong>Tipo vinculacion: </strong> <?= $obj->vinculacion?><br>
	 &nbsp;&nbsp;<strong><?= $obj->tipo_identificacion?>: </strong> <?= $obj->doc_identificacion?> <br>
	 &nbsp;&nbsp;<strong>Vendedor: </strong><?= $obj->nombre?><br>
	<br>
	
	</p>
</td>
</tr>

<TR><TD>
<table width="95%" align="center" border="1">
	<tr><td colspan="7" align="center"><strong>DETALLE</strong></td></tr>
		<tr>
			
			<th  width="40%">Material</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th width="10%">% Descuento</th>
			<th>Total</th>
		</tr>
		<?
		$consultas = "SELECT * from items_venta, catalogo where items_venta.codventa = '$codVenta' and
		items_venta.codmaterial = catalogo.codmaterial and items_venta.codcatalogo = catalogo.codcatalogo";
		$rss = db_query($consultas);
		if(pg_num_rows($rss) != 0)
		{
			while($objj = pg_fetch_object($rss))
			{
			?>	
				<tr><td><?=$objj->titulo?></td>
				<td><?=$objj->precio?></td>
				<td><?=$objj->cantidad?></td>
				<td><?=$objj->descuento?></td>
				<td><? if ($objj->descuento != 0) 
						echo ($objj->precio-($objj->precio*$objj->descuento/100))*$objj->cantidad;
					else
						echo $objj->precio*$objj->cantidad;?></td>
				</tr>
			<?		
			}
		}
		?>
		<tr><td align="right" colspan="7"><strong>TOTAL A PAGAR</strong>  $<?=$obj->total_venta?>.00</td></tr>
		</table>
		<br>
	</TD></TR>
<tr><td align="right"></td></tr>
<tr>
	<td> &nbsp;&nbsp;<strong>Observaciones</strong>:<br><?= $obj->conceptodescuento?>
		<br></td>
</tr>
<tr><td><BR>
<font size="-1"> &nbsp;&nbsp;Facultad de Ciencias de la Administraci&oacute;n - Universidad
del Valle - San Fernando - Cali</font></td>
</tr>
</table>
</td></tr>
</table>
<br>
</body>
</html>
