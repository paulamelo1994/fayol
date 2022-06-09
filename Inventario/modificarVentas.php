<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: modificarVentas.php
	Objetivo: Este archivo permite modificar la fecha de una venta realizada y eliminarla del sistema. 
			  A esta funcion solo tenemos acceso nosotros :D
	Autor: Deisy Chaves
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
	
	//Se obtienen el intervalo de tiempo en el que se listan las ventas para modificar o eliminar
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
		location.href="modificarVentas.php";
		</script>
		<?
		die();
	}
	
	PageInit("Modificar y/o Eliminar Ventas", "../menu.php");
	
	
    //ELIMINAR VENTA
	if(isset($_GET['eliminarVenta']))
	{
		$conexion = DBConnect('inventario');
		
		$codVenta = $_GET['eliminarVenta'];
		$codUbicacion = $_GET['ubicacion'];
		$rs2 = db_query("select * from items_venta where codVenta='$codVenta'"); 
		$fallo = false;
		
		$articulosVenta ="Ojo ver que tanto se borro y q tanto no articulos \n\n Cod Venta:  $codVenta \n\n Articulo Venta:\n";
		
		while($obj2 = pg_fetch_object($rs2))
		{
			//Se obtienen los datos para cada item
			$codCatalogo = $obj2->codcatalogo;
			$cantidad = $obj2->cantidad;
			$codItem =  $obj2->coditem;	
			$articulosVenta = $articulosVenta."Catalogo: $codCatalogo   Codigo Item Venta: $codItem \n";
					
			$rs3 = @db_query("select tipocodmaterial,codmaterial from catalogo where codcatalogo = '$codCatalogo'"); 

			$obj3 = pg_fetch_object($rs3);
			$tipoCodMaterial = $obj3->tipocodmaterial;
			$codMaterial =$obj3->codmaterial;

			$rs4 =@db_query("update inventario set existencia = existencia + '$cantidad' where tipocodmaterial='$tipoCodMaterial' and codmaterial='$codMaterial' and codubicacion ='$codUbicacion'");
			if(!$rs4) $fallo = true;
			
			$rs5 =@db_query("delete from items_venta where coditem = '$codItem'");
			if(!$rs5) $fallo = true;
		}
		
		//Se elimina el registro de la venta
		$rs6 =@db_query("delete from ventas where codventa = '$codVenta'");
		if(!$rs6) $fallo = true;

		//Si por algun motivo no se puede completar la operación se encia un correo con toda la información de la
		//venta que se intento eliminar pra terminar el procedimiento de forma manual.
		if($fallo)
		{
			mail("webwoman@univalle.edu.co", 'Error Eliminar Venta. '.$codVenta, $articulosVenta  );
			Failed("No se pudo eliminar la venta del sistema");
		}
		else
		{
			Succeded("La venta fue eliminada del sistema exitosamente");
		}
		?>
		<br />
		<div align="center">
			<form  name="reporte" method="post"  action="modificarVentas.php">
				<input type="submit" name="volver" value="Volver">
			</form>
		</div>	
		<?
		
		die();
		
	}
	
	
	//MODIFICAR FECHA DE VENTA
	
	//Se actualiza la fecha
	if(isset($_POST['actualizarFecha']))
	{
		$conexion = DBConnect('inventario');
		
		$codVenta = $_POST['codVenta'];
		$nuevaFecha = $_POST['fechaVenta'];
		
		$rs7 = db_query("update ventas set fecha='$nuevaFecha' where codventa ='$codVenta'");
		if(!$rs7) $fallo = true;
		
		if($fallo)
		{
			Failed("No se pudo actualizar la fecha de venta en el sistema");
		}
		else
		{
			Succeded("Se actualizo la fecha de venta en el sistema exitosamente");
		}
		?>
		<br />
		<div align="center">
			<form  name="reporte" method="post"  action="modificarVentas.php">
				<input type="submit" name="volver" value="Volver">
			</form>
		</div>	
		<?
		
		die();
		
	}
	
	//Formulario para obtiener la nueva fecha para la venta
	if(isset($_GET['modificarVenta']))
	{
		$conexion = DBConnect('inventario');
		
		$codVenta = $_GET['modificarVenta'];
		$codUbicacion = $_GET['ubicacion'];
		$rs4 = @db_query("select ventas.codventa, fecha,comprador,titulo, cantidad, precio,descuento,total_venta from catalogo, items_venta,ventas where items_venta.codcatalogo = catalogo.codcatalogo and items_venta.codventa = ventas.codventa  and ventas.codventa='$codVenta'"); 
		
		$obj4 = pg_fetch_object($rs4);
		
		?>
		<h1 class="shiny">Modificar Fecha Venta</h1>

		<form name="modificarVentas" enctype="multipart/form-data" method="post" action="modificarVentas.php">
			<table width="100%" border="0" align="center">
				<tr>
					<td width="30%" class="titulosContenidoInterno">Fecha</td>
					<td><input type="text" name="fechaVenta" value="<?=$obj4->fecha?>" size="15"> </td>
				</tr>		
				<tr>
					<td  width="30%" class="titulosContenidoInterno">Beneficiario</td>
					<td><?=makeHtml($obj4->comprador)?></td>
				</tr>
				<tr>
					<td  width="30%" class="titulosContenidoInterno">Total Venta</td>
					<td ><?=makeHtml($obj4->total_venta)?></td>
				</tr>
			</table>
			
			<br>
			<h2>Detalles de la Venta</h2>			
			<table width="100%" border="1" align="center">
				<tr>
					<th width="40%">Material</th>	
					<th width="8%">Cantidad</th>
					<th width="5%">Precio</th>
					<th width="9%">Descuento</th>	
					<th width="10%">Total Venta</th>
				</tr>
				<tr>
					<td><?=makeHtml($obj4->titulo)?></td>
					<td><?=$obj4->cantidad?></td>			
					<td><?=$obj4->precio?></td>
					<td><?=$obj4->descuento?></td>
				<?
					$precio_venta = $obj4->precio * $obj4->cantidad; 			
					$total_venta = $precio_venta - ($precio_venta * (abs($obj4->descuento)/100.0));
				
				?>
					<td><?=$total_venta?></td>
				</tr>
		<?		
		
		while($obj4 = pg_fetch_object($rs4))
		{
		?>
				<tr>
					<td><?=makeHtml($obj4->titulo)?></td>
					<td><?=$obj4->cantidad?></td>			
					<td><?=$obj4->precio?></td>
					<td><?=$obj4->descuento?></td>
				<?
					$precio_venta = $obj4->precio * $obj4->cantidad ; 			
					$total_venta = $precio_venta - ($precio_venta * (abs($obj4->descuento)/100.0));
				
				?>
					<td><?=$total_venta?></td>
				</tr>
		<?
		}
		?>
				</table>
				<br>
				<div align="center">
					<input type="hidden" name="codVenta" value="<?=$codVenta?>">
					<input type="submit" name="actualizarFecha" value="Modificar">&nbsp;&nbsp;&nbsp;
					<input type="submit" name="cancelar" value="Cancelar">
				</div>
								
			</form>
		<?
		
		die();
		
	}
	
	//Formulario para ingresar el intervalo de tiempo en el que se listan las ventas y la ubicación (Genralmente libreria)
	if(!isset($_POST['ubicacionReporte']))
	{
		?>
		<h1 class="shiny">Modificar y/o Eliminar Ventas</h1>

		<form name="listadoVentas" enctype="multipart/form-data" method="post" action="modificarVentas.php">
		<table width="70%" border="0" align="center">
		<tr>
			<td width="30%" class="titulosContenidoInterno">Fecha</td>
			<td><?=MakeDate($fecha)?></td>
		</tr>		
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
			<input type="submit" name="listarVentas" value="Listar Ventas">&nbsp;&nbsp;&nbsp;
			<input type="submit" name="cancelar" value="Cancelar">
			</td>
		</tr>
		</table>
		</form>
		<?
	}
	
	
	//Se listan las ventas a modificar o eliminar 
	if(isset($_POST['listarVentas']))
	{
		if(empty($_POST['ubicacionReporte']))
			$_GET['vacios'] = true;
		else
		{
			$conexion = DBConnect('inventario');
			
			if(!$conexion) echo "<h1>No se logro la conexi&oacute;n con la BD.</h1>";
			else
			{
				//Se obtiene la fecha de inicio y la fecha fin para el reporte
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
				
				
				if(strlen($_POST[ubicacionReporte]) == 1)
				{
					?>
								<script language="javascript" type="text/javascript">
								alert("Ingrese la Ubicación");
								</script>
					<?
				}
				else
				{
					//Se obtienen el id de la ubicacion
					$rs = db_query("select codUbicacion, nombre as ubicacion from ubicacion where nombre = '$_POST[ubicacionReporte]'");
				
					
				
					$obj = pg_fetch_object($rs);			
					$idUbicacionReporte = $obj->codubicacion;		
					
					//Se obtienen la lista de ventas
					$ubicacionReporte  = $_POST['ubicacionReporte'];					
					$rs1 = @db_query("select ventas.codventa, fecha,comprador,titulo, cantidad, precio,descuento from catalogo, items_venta,ventas where items_venta.codventa = ventas.codventa and items_venta.codcatalogo = catalogo.codcatalogo and codUbicacion = '$idUbicacionReporte' and estado = '0' and fecha >= '$fechaInicio' and fecha <= '$fechaFin'order by fecha, ventas.codventa"); 
					
					
														
					
					if(pg_num_rows($rs1) == 0) //No hay registros en el catalogo
					{
						echo "<h2>No hay registros de ventas en el catalogo!</h2>";
					}
					else
					{
						$sum_total_venta =0;					
						?>
							<h2>Listado de ventas realizadas en la <?=$ubicacionReporte?>.</h2>
							<br>
							<b>Fecha: </b> <?=MakeDate($fecha)?>
							<br />
							<br />
							<table width="800" border="1"  cellpadding="1" cellspacing="1">
							<tr>
								<th width="10%">Fecha</th>							
								<th width="15%">Beneficiario</th>
								<th width="30%">Material</th>	
								<th width="9%">Cantidad</th>
								<th width="5%">Precio</th>
								<th width="9%">Descuento</th>	
								<th width="10%">Total Venta</th>	
								<th width="10%">Modificar Fecha</th>
								<th width="10%">Eliminar</th>
							</tr>
							<?
							while($obj1 = pg_fetch_object($rs1))
							{
							?>				
								<tr>
									<td align="center"><?=$obj1->fecha?></td>
									<td align="center"><?=makeHtml($obj1->comprador)?></td>
									<td><?=makeHtml($obj1->titulo)?></td>
									<td><?=$obj1->cantidad?></td>			
									<td><?=$obj1->precio?></td>
									<td><?=$obj1->descuento?></td>														
							<?
									$precio_venta = $obj1->precio * $obj1->cantidad ; 			
									$total_venta = $precio_venta - ($precio_venta * (abs($obj1->descuento)/100.0));
									
									$sum_total_venta = $sum_total_venta +  $total_venta ;
									
							?>
									<td><?=$total_venta?></td>
									<td><a href="modificarVentas.php?modificarVenta=<?=$obj1->codventa?>&ubicacion=<?=$idUbicacionReporte?>">modificar</a></td>
									<td><a href="modificarVentas.php?eliminarVenta=<?=$obj1->codventa?>&ubicacion=<?=$idUbicacionReporte?>">eliminar</a></td>
									
								</tr>			
							<?
							}	
							?>
								<tr>
									<td  colspan="6">&nbsp;</td>
									<td>Total</td>
									<td><?=$sum_total_venta?></td>
									<td>&nbsp;</td>
								</tr>	
							</table>
							<?
					}	
				}
			}
				?>
				<br />
				<div align="center">
					<form  name="reporte" method="post"  action="modificarVentas.php">
						<input type="submit" name="volver" value="Volver">
					</form>
				</div>
				<?				
		}
	}

	//Mensajes de error	
	if(isset($_GET['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe ingresar todos los campos antes de listar las ventas. Intente nuevamente.");
		</script>
		<?
	}

	PageEnd();
?>