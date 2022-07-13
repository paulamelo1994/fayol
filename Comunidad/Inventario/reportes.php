<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: reportes.php
	Objetivo: Este archivo permite al usuario administrador generar una lista de registros de acuerdo al criterio
			 seleccionado. Se ofrece ingresos, salidas , inventario y de ventas. 
			 El reporte de ventas se puede generar en formato txt.
	Autor: Angela Benavides
	Modificador Por: Deisy Chaves
	Año: 2008
	*********************************************************/
	
	session_start();
	
	if(!isset($_SESSION['inventario']))
	{
		header ("Location: /Comunidad/Inventario/index.php");
		die();
	}
	
	require '../../functions.php';
	$root_path = "../..";
	
	$_GET['submenu_inventario'] = true;
	$idUbicacion = $_SESSION['idUbicacion'];
	$ubicacion = $_SESSION['ubicacion'];
	
	//Se obtiene el intervalo de tiempo para generar el reporte
	$fecha = date('Y')."-".date('m')."-".date('d');
	
	if(empty ($_POST['fechaInicio']))
	{
		$fechaInicio = date('Y')."-".date('m')."-".date('d');
	}
	else
	{
		$fechaInicio = $_POST['fechaInicio'];
	}
	
	if(empty ($_POST['fechaFin']))
	{
		$fechaFin = date('Y')."-".date('m')."-".date('d');
	}
	else
	{
		$fechaFin = $_POST['fechaFin'];
	}

	if(isset($_POST['volver']))
	{
		?>
		<script language="javascript">
		location.href="reportes.php";
		</script>
		<?
		die();
	}
	
	//Formulario para seleccionar la ubicación y tipo de reporte a generar
	PageInit("Reportes", "../menu.php");
	
	if(!isset($_POST['tipoReporte']) && !isset($_POST['ubicacionReporte']))
	{
		?>
		<h1 class="shiny">Reportes</h1>
		<h3>Seleccione que tipo de reporte desea ver:</h3>	

		<form name="reportes" enctype="multipart/form-data" method="post" action="reportes.php">
		<table width="70%" border="0" align="center">
		<tr>
			<td width="30%" class="titulosContenidoInterno">Fecha</td>
			<td><?=MakeDate($fecha)?></td>
		</tr>		
		<tr><td colspan="2"><br></td></tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td  width="30%" class="titulosContenidoInterno">Fecha Inicio</td>
			<td><input type="text" name="fechaInicio" value="<?=$fecha?>" size="15"></td>
		</tr>		
		<tr>
			<td width="30%" class="titulosContenidoInterno">Fecha Fin</td>		
			<td><input type="text" name="fechaFin" value="<?=$fecha?>" size="15"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<?
		if ($_SESSION['inventario']['permisos'] == 'administrador' ||$_SESSION['inventario']['permisos'] == 'responsable')
		{
		?>
		<tr>
			<td width="30%" class="titulosContenidoInterno" >Tipo de Reporte</td>
			<td>

				<select name="tipoReporte">
				<option>&nbsp;</option>

				<option>Costos</option>
				<option>Precios</option>
				<option>Inventario</option>
				<option>Ventas</option>
				</select>
			</td>
		</tr>
		<?
		}
		else
		{
		?>
			<tr>
				<td width="30%" class="titulosContenidoInterno" >Tipo de Reporte</td>
				<td><input readonly type="text" name="tipoReporte" value="Ventas" size="15"></td>
			</tr>
		<?
		}
		?>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td width="30%" class="titulosContenidoInterno">Ubicaci&oacute;n</td>
			<td>
				<select name="ubicacionReporte">
				<option>&nbsp;</option>
				<option>Bodega</option>
				<option>Libreria</option>
				<option>Oficina</option>
				</select>
			</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td colspan="2">
			<input type="submit" name="generarReporte" value="Generar Reporte">&nbsp;&nbsp;&nbsp;
			<input type="submit" name="cancelar" value="Cancelar">
			</td>
		</tr>
		</table>
		</form>
		<?
	}
	
	//Se genera el reporte seleccionado
	if(isset($_POST['generarReporte']))
	{
	
		if(empty($_POST['tipoReporte']) || empty($_POST['ubicacionReporte']))
			$_GET['vacios'] = true;
		else
		{

			$conexion = DBConnect('inventario');
			
			if(!$conexion) echo "<h1>No se logro la conexi&oacute;n con la BD.</h1>";
			else
			{
				$rs = db_query("select codUbicacion, nombre as ubicacion from ubicacion where nombre = '$_POST[ubicacionReporte]'");
								
				$obj = pg_fetch_object($rs);			
				$idUbicacionReporte = $obj->codubicacion;				
				
				//Reporte de Costos, es igual al numero de existencias por el costo del material
				if($_POST['tipoReporte']=='Costos')
				{
				
					$rs1 = @db_query("select titulo,catalogo.tipoCodMaterial as tipocodmaterial,catalogo.codMaterial as codmaterial,costo, existencia from catalogo,inventario where inventario.tipoCodMaterial = catalogo.tipoCodMaterial and inventario.codMaterial = catalogo.codMaterial and codUbicacion = '$idUbicacionReporte' and estado = '0' order by codCatalogo, titulo");			
					
					if(pg_num_rows($rs1) == 0) //No hay registros en el catalogo
					{
						echo "<h2>No hay registros en el catalogo!</h2>";
						?>
						<br />
						<div align="center">
							<form  name="reporte" method="post"  action="reportes.php">
								<input type="submit" name="volver" value="Volver">
							</form>
						</div>
						<?
					}
					else
					{
					?>
						<h2>Reporte de <?=$_POST['tipoReporte']?> para la <?=$_POST['ubicacionReporte']?>.</h2>
						<br>
						<b>Fecha: </b> <?=MakeDate($fecha)?>
						<br />
						<br />
						<table width="800" border="1"  cellpadding="1" cellspacing="1">
						<tr>
							<th colspan="2" width="10%">C&oacute;digo Material</th>
							<th width="32%">Titulo</th>							
							<th width="10%">Existencias</th>
							<th width="15%">Costo Unitario</th>
							<th width="15%">Costo Total</th>	
						</tr>
						<?
						while($obj1 = pg_fetch_object($rs1))
						{
						?>				
							<tr>
								<td align="center"><?=$obj1->tipocodmaterial?> </td>
								<td align="center"><?=$obj1->codmaterial?> </td>
								<td><?=makeHtml($obj1->titulo)?></td>
								
						<?
						        $existencia = $obj1->existencia;
								$costo = $obj1->costo;
								$costoTotal = $existencia * $costo;
						?>
								<td align="center"><?=$existencia?></td>
								<td align="center"><?=$costo?></td>	
								<td align="center"><?=$costoTotal?></td>
							</tr>				
						<?
						}
						?>
						</table>
						<?
					}	

				}
				
				//Reporte de Precios, es igual al numero de existencias por el precio de venta del material
				else if($_POST['tipoReporte']=='Precios')
				{
				
					$rs2 = @db_query("select titulo,catalogo.tipoCodMaterial as tipocodmaterial,catalogo.codMaterial as codmaterial,precio, existencia from catalogo,inventario where inventario.tipoCodMaterial = catalogo.tipoCodMaterial and inventario.codMaterial = catalogo.codMaterial and codUbicacion = '$idUbicacionReporte' and estado = '0' order by codCatalogo, titulo");			
					
					if(pg_num_rows($rs2) == 0) //No hay registros en el catalogo
					{
						echo "<h2>No hay registros en el catalogo!</h2>";
						
						?>
						<br />
						<div align="center">
							<form  name="reporte" method="post"  action="reportes.php">
								<input type="submit" name="volver" value="Volver">
							</form>
						</div>
						<?
					}
					else
					{
					?>
						<h2>Reporte de <?=$_POST['tipoReporte']?> para la <?=$_POST['ubicacionReporte']?>.</h2>
						<br>
						<b>Fecha: </b> <?=MakeDate($fecha)?>
						<br />
						<br />
						<table width="800" border="1"  cellpadding="1" cellspacing="1">
						<tr>
							<th colspan="2" width="10%">C&oacute;digo Material</th>
							<th width="32%">Titulo</th>							
							<th width="10%">Existencias</th>
							<th width="15%">Precio Unitario</th>
							<th width="15%">Precio Total</th>	
						</tr>
						<?
						while($obj2 = pg_fetch_object($rs2))
						{
						?>				
							<tr>
								<td align="center"><?=$obj2->tipocodmaterial?> </td>
								<td align="center"><?=$obj2->codmaterial?> </td>
								<td><?=makeHtml($obj2->titulo)?></td>
								
						<?
						        $existencia = $obj2->existencia;
								$precio= $obj2->precio;
								$precioTotal = $existencia * $precio;

								
						?>
								<td align="center"><?=$existencia?></td>						
								<td align="center"><?=$precio?></td>	
								<td align="center"><?=$precioTotal?></td>
							</tr>				
						<?
						}
						?>
						</table>
						<?
					}	
				}
				
				//Reporte Inventario, se lista el numero de existencias, asi como su costo y precio 
				else if($_POST['tipoReporte']=='Inventario')
				{
				
					$rs3 = @db_query("select titulo,catalogo.tipoCodMaterial as tipocodmaterial,catalogo.codMaterial as codmaterial,costo,precio, existencia from catalogo,inventario where inventario.tipoCodMaterial = catalogo.tipoCodMaterial and inventario.codMaterial = catalogo.codMaterial and codUbicacion = '$idUbicacionReporte' and estado = '0' order by codCatalogo, titulo");			
					
					if(pg_num_rows($rs3) == 0) //No hay registros en el catalogo
					{
						echo "<h2>No hay registros en el catalogo!</h2>";
						?>
						<br />
						<div align="center">
							<form  name="reporte" method="post"  action="reportes.php">
								<input type="submit" name="volver" value="Volver">
							</form>
						</div>
						<?
					}
					else
					{
					?>
						<h2>Reporte de <?=$_POST['tipoReporte']?> para la <?=$_POST['ubicacionReporte']?>.</h2>
						<br>
						<b>Fecha: </b> <?=MakeDate($fecha)?>
						<br />
						<br />
						<table width="800" border="1"  cellpadding="1" cellspacing="1">
						<tr>
							<th colspan="2" width="10%">C&oacute;digo Material</th>
							<th width="32%">Titulo</th>							
							<th width="10%">Existencias</th>
							<th width="15%">Costo Unitario</th>
							<th width="15%">Precio Unitario</th>	
						</tr>
						<?
						while($obj3 = pg_fetch_object($rs3))
						{
						?>				
							<tr>
								<td align="center"><?=$obj3->tipocodmaterial?></td>
								<td align="center"><?=$obj3->codmaterial?></td>
								<td><?=makeHtml($obj3->titulo)?></td>
								<td><?=$obj3->existencia?></td>
								<td><?=$obj3->costo?></td>
								<td><?=$obj3->precio?></td>
							</tr>			
						<?
						}
						?>
						</table>
						<?
					}	
				}
				
				//Reporte de Ventas
				else if($_POST['tipoReporte']=='Ventas')
				{
					//fechas para generar el reporte
					if(empty ($_POST['fechaInicio']))
					{
						$fechaInicio = date('Y')."-".date('m')."-".date('d');
					}
					else
					{
						$fechaInicio = $_POST['fechaInicio'];
					}
					
					if(empty ($_POST['fechaFin']))
					{
						$fechaFin = date('Y')."-".date('m')."-".date('d');
					}
					else
					{
						$fechaFin = $_POST['fechaFin'];
					}
					
					$ubicacionReporte  = $_POST['ubicacionReporte'];					
					$rs4 = @db_query("select ventas.codventa, fecha,comprador,vinculacion, titulo, cantidad, precio,costo,descuento,hecha_por from catalogo, items_venta,ventas where items_venta.codventa = ventas.codventa and items_venta.codcatalogo = catalogo.codcatalogo and codUbicacion = '$idUbicacionReporte' and estado = '0' and fecha >= '$fechaInicio' and fecha <= '$fechaFin'order by fecha, ventas.codventa"); 
					
					
					if(pg_num_rows($rs4) == 0) //No hay registros en el catalogo
					{
						echo "<h2>No hay registros de ventas en el catalogo!</h2>";
					}
					
					//Se genera el reporte en formato txt
					else if (isset($_POST['txt']))
					{

						$nombre_archivo = "";
						if ($_SESSION['inventario']['permisos'] == 'administrador' ||$_SESSION['inventario']['permisos'] == 'responsable')
						{
							$nombre_archivo = "reportes/reporteVentaCostos".$_POST['ubicacionReporte']."_$fecha.txt";
						}
						else
						{
							$nombre_archivo = "reportes/reporteVenta".$_POST['ubicacionReporte']."_$fecha.txt";
						}
						
						
						$file = fopen($nombre_archivo, "a") or die("Can't open file"); 			
						fwrite($file, "Elaborado el... ".$fecha."\n");
						fwrite($file, "Del ".$fechaInicio." al ".$fechaFin."\n");
						fwrite($file, "COD VENTA | FECHA | BENEFICIARIO | VINCULACION|MATERIAL| CANTIDAD | PRECIO | DESCUENTO | TOTAL VENTA | REALIZADO POR\n\n");
						
						$sum_total_venta =0;
						$sum_total_costo =0;
						while($obj4 = pg_fetch_object($rs4))
						{						
							$codVenta = $obj4->codventa;
							$fechaVenta = $obj4->fecha;
							$comprador = $obj4->comprador;
							$vinculacion= $obj4->vinculacion;
							$material = $obj4->titulo;
							$cantidad = $obj4->cantidad;							
							$precio = $obj4->precio;
							$descuento = $obj4->descuento;
							
							$costo= $obj4->costo;
							$costoTotal = $obj4->cantidad * $costo;
							$sum_total_costo= $sum_total_costo + $costoTotal;
							
						
							
							$precio_venta = $obj4->precio * $obj4->cantidad ; 			
							$total_venta = $precio_venta - ($precio_venta * (abs($obj4->descuento)/100.0));
							$sum_total_venta = $sum_total_venta +  $total_venta ;
							
							$vendedor =$obj4->hecha_por;
							
							if($obj4->hecha_por == "graceruz")
							{
								$vendedor ='Grace';
							}
							else if($obj4->hecha_por == "yulianag")
							{
								$vendedor ='Yuliana';
							}
							else if($obj4->hecha_por == "yespino")
							{
								$vendedor ='Yamid';
							}							
							
							if ($_SESSION['inventario']['permisos'] == 'administrador' ||$_SESSION['inventario']['permisos'] == 'responsable')
							{
								fwrite($file, " $codVenta | $fechaVenta | $comprador  | $vinculacion | $material |$cantidad | $costo | $descuento | $costoTotal | $descuento | $total_venta |$vendedor\n");
							}
							else
							{
								fwrite($file, "$fechaVenta | $comprador  | $vinculacion | $material |$cantidad | $precio | $descuento | $total_venta |$vendedor\n");
							}
							
						
						}
						if ($_SESSION['inventario']['permisos'] == 'administrador' ||$_SESSION['inventario']['permisos'] == 'responsable')
						{
							fwrite($file, " |	|	| 	|	|	|Total Costos	| $sum_total_costo |	Total Ventas| $sum_total_venta |\n");
						}
						else
						{
							fwrite($file, " |  |  |  |  |  | Total Ventas | $sum_total_venta  |\n");
						}
						
						
						fwrite($file, "\n\n");
						fclose($file);
						
						?>
							<script language="javascript">
							window.open("<?=$nombre_archivo?>");
							</script>
						<?
						
					}
					
					//Se genera el reporte en html
					else
					{
						$sum_total_venta =0;
						$sum_total_costo =0;
					?>
						<h2>Reporte de <?=$_POST['tipoReporte']?> para la <?=$ubicacionReporte?>.</h2>
						<br>
						<b>Fecha: </b> <?=MakeDate($fecha)?>
						<br />
						<br />
						<table width="800" border="1"  cellpadding="1" cellspacing="1">
						<tr>
							<th width="10%">Fecha</th>							
							<th width="15%">Beneficiario</th>
							<th width="9%">Vinculacion</th>
							<th width="30%">Material</th>	
							<th width="9%">Cantidad</th>
							<?
							if ($_SESSION['inventario']['permisos'] == 'administrador' ||$_SESSION['inventario']['permisos'] == 'responsable')
							{
							?>
								<th width="10%">Costo Unitario</th>
								<th width="10%">Total Costo</th>
							<?
							}
							?>		
							<th width="5%">Precio</th>
							<th width="9%">Descuento</th>	
							<th width="10%">Total Venta</th>	
							<th width="10%">Realizado Por</th>
						</tr>
						<?
						while($obj4 = pg_fetch_object($rs4))
						{
						?>				
							<tr>
								<td align="center"><?=$obj4->fecha?></td>
								<td align="center"><?=makeHtml($obj4->comprador)?></td>
								<td align="center"><?=makeHtml($obj4->vinculacion)?></td>
								<td><?=makeHtml($obj4->titulo)?></td>
								<td><?=$obj4->cantidad?></td>
								
								<?
								$costo= $obj4->costo;
								$costoTotal = $obj4->cantidad * $costo;
								$sum_total_costo= $sum_total_costo + $costoTotal;
							
								if ($_SESSION['inventario']['permisos'] == 'administrador' ||$_SESSION['inventario']['permisos'] == 'responsable')
								{
								?>
										<td align="center"><?=$costo?></td>	
										<td align="center"><?=$costoTotal?></td>
								<?
								}
								?>	
														
								<td><?=$obj4->precio?></td>
								<td><?=$obj4->descuento?></td>
								<!-- <td>< ?=$obj4->total_venta?></td>-->
						
						<?
								$precio_venta = $obj4->precio * $obj4->cantidad ; 			
								$total_venta = $precio_venta - ($precio_venta * (abs($obj4->descuento)/100.0));
								
								$sum_total_venta = $sum_total_venta +  $total_venta ;
								
								$vendedor =$obj4->hecha_por;
								
								if($obj4->hecha_por == "graceruz")
								{
									$vendedor ='Grace';
								}
								else if($obj4->hecha_por == "yulianag")
								{
									$vendedor ='Yuliana';
								}
								else if($obj4->hecha_por == "yespino")
								{
									$vendedor ='Yamid';
								}
								else
								{
									$vendedor =$obj4->hecha_por;
								}							
								
						?>
								<td><?=$total_venta?></td>
								<td><?=$vendedor?></td>
							</tr>			
						<?
						}
									
						if ($_SESSION['inventario']['permisos'] == 'administrador' ||$_SESSION['inventario']['permisos'] == 'responsable')
						{
						?>
							<tr>
								<td  colspan="6">&nbsp;</td>
								<td>Total Costos</td>
								<td><?=$sum_total_costo?></td>
								<td>Total Ventas</td>
								<td><?=$sum_total_venta?></td>
								<td>&nbsp;</td>
							</tr>	
						<?
						}
						else
						{					
						?>
							<tr>
								<td  colspan="6">&nbsp;</td>
								<td>Total</td>
								<td><?=$sum_total_venta?></td>
								<td>&nbsp;</td>
							</tr>	
						<?
						}
						?>
						</table>
						<br />
						<div align="right">
							<form  name="reporte" method="post"  action="reportes.php">
								<input type="hidden" name="tipoReporte" value="Ventas">
								<input type="hidden" name="ubicacionReporte" value="<?=$ubicacionReporte?>">
								<input type="hidden" name="fechaInicio" value="<?=$fechaInicio?>">
								<input type="hidden" name="fechaFin" value="<?=$fechaFin?>">
								<input type="hidden" name="generarReporte" value="generarReporte">
								<button type="submit" name="txt" title="Escribir archivo" value="<?=$fecha?>">
								<img src="../../../Images/escribir.jpg" width="15" height="15" title="Escribir archivo" alt=""></button>
							</form>
						</div>
						<?
					}	
				}
				?>
				<br />
				<div align="center">
					<form  name="reporte" method="post"  action="reportes.php">
						<input type="submit" name="volver" value="Volver">
					</form>
				</div>
				<?				
			}
		}
	}
	
	if(isset($_GET['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe ingresar todos los campos antes de generar el reporte. Intente nuevamente.");
		</script>
		<?
	}

	PageEnd();
?>