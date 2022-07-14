<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: salidas.php
	Objetivo: Este archivo es el encargado de registrar una salida del catalogo, reduciendo entonces la cantidad 
				de existencias.
	Modificado por: Deisy Chaves
	Autor: Angela Benavides
	A&ntilde;o: 2008
	*********************************************************/
	
	session_start();
	
	if(!isset($_SESSION['inventario']))
	{
		header ("Location: /Comunidad/Inventario/index.php");
		die();
	}
	
	require '../../functions.php';
	$root_path = "../..";
	date_default_timezone_set('GMT-4'); //Establece zona horaria, evita desfaces
	if(empty ($_POST['fecha']))
	{
		$fecha = date('Y')."-".date('m')."-".date('d');
	}
	else
	{
		$fecha = $_POST['fecha'];
	}
	
	$hora = date('H').":".date('i');
	
	$_GET['submenu_inventario'] = true;
		
	$idUbicacion = $_SESSION['idUbicacion'];
	$ubicacion = $_SESSION['ubicacion'];
	$codVenta;
	
	//Se leen los items de la venta hasta el momento		
	if(isset($_SESSION['items']))
	{
		$items=$_SESSION['items'];
	}
	else
	{
		$items = array( );
	}
	
	if(isset($_SESSION['datosSalida']))
	{
		$datos_salida=$_SESSION['datosSalida'];

		//Si se cancela un item de la venta, este corresponde al ultimo item agragado
		if(!isset($_GET['itemcancelado']))
		{
			$posUltimoItem= count($items)-1;
			$ultimoItem = $items[$posUltimoItem];
			$datos_salida['total_salida'] = $datos_salida['total_salida'] + $ultimoItem['total'];
		}
	}
	else
	{
		$datos_salida = array( 'total_salida' => 0);
	}
	

	//Procesamiento de la venta		
	if(isset($_POST['aceptar']))
	{	
		$usuario = $_POST['usuario'];
		$vinculacion = $_POST['vinculacion'];
		$tipo_doc = $_POST['tipo_doc'];
		$num_doc=$_POST['num_doc'];
		$plan = $_POST['plan'];
		$doc = $_POST['documento'];
		$codVenta;
		//Validaciones
		if(empty($usuario) || empty($vinculacion) || empty($tipo_doc) || empty($num_doc) || empty($doc) || empty($total_salida))
			$_GET['vacios'] = true;
		else if($vinculacion=='Estudiante' && empty($plan))
			$_GET['faltaPlan'] = true;
		else if($vinculacion=='Estudiante' && !is_numeric($plan))
			$_GET['numero'] = true;
		else if(!is_numeric($num_doc))
			$_GET['numero'] = false;
		else if( empty($items))
			$_GET['hayItems'] = false;
		else
		{
			$conexion = @DBConnect('inventario');

			if(empty($conexion)) //Si no hay conexion
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible agregar la existencia del libro, por favor intentelo m&aacute;s tarde.</p>";
			}
			else
			{			
			 //Ingresar la venta
				$fallo = false;
						
				db_query('begin');
				
				$fecha = $_POST['fecha'];
				
				//Se registra la informaci&oacute;n general de la venta, basicamente informaci&oacute;n del comprador
				
				$rs = db_query("insert into ventas (codUbicacion, comprador, vinculacion ,tipo_identificacion, doc_identificacion, codPlan, total_venta, documento,fecha,hora,hecha_por)
				values ('$idUbicacion','$usuario','$vinculacion','$tipo_doc','$num_doc','$plan','$total_salida','$doc','$fecha','$hora','{$_SESSION[inventario][login]}')
				");
				
				if(!$rs) $fallo = true;
				
				if($fallo) // fallo registrar venta
				{
					db_query('rollback');
					$_GET['fallo'] = true;		
					
					//borrar variables
					unset($_SESSION['datosSalida']);
					unset($_SESSION['items']);			
				}
				else
				{
					$rs1 = db_query("select last_value from ventas_seq");
					$obj = pg_fetch_object($rs1);
					$codVenta = $obj->last_value;
					
					if(!$rs1) $fallo = true;
					
					if($fallo)// fallo obtener codventa
					{
						db_query('rollback');
						$_GET['fallo'] = true;		
						
						//borrar variables
						unset($_SESSION['datosSalida']);
						unset($_SESSION['items']);			
					}
					else
					{				
						// Finalmente se ingresan cada uno de los items de la venta
						$errorCantidad = false;
						
						foreach($items as $k => $item)
						{
						   if(!$errorCantidad)
						   {
								$codCatalogo= $item['codCatalogo'];
								$cantidad = $item['cantidad'];
								$descuento = $item['descuento'];
								$tipoCodMaterial = $item['tipoCodItem'];
								$codMaterial =$item['codItem'];
								
								$rs2 = db_query("select * from inventario where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion = '$idUbicacion'");
								
								$obj2 = pg_fetch_object($rs2);
								if(!$rs2) $fallo = true;
								
								$existencias = $obj2->existencia - $cantidad;
								
								if($existencias>=0)
								{	
									//Se actualiza el inventario		
									$rs3 = db_query("update inventario set existencia = '$existencias' where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion ='$idUbicacion'");
									if(!$rs3) $fallo = true;
									
									//se ingresa el item de venta
									$rs4 = db_query("insert into items_venta (codVenta, codCatalogo, cantidad ,descuento, codMaterial) values ('$codVenta','$codCatalogo','$cantidad','$descuento', '$codMaterial')");
							
									if(!$rs4) $fallo = true;
								}
								else
								{
								  $errorCantidad=true;
								}
							}
						}
											
						//Si hay algun error, se elimina toda la operacion
						if($fallo || $errorCantidad)
						{
							$_GET['fallo'] = true;
							
							//borrar variables
							unset($_SESSION['datosSalida']);
							unset($_SESSION['items']);
							
							//se eliminan todos los registros del item en esa venta y es necesario agregar al inventario el valor devuelto
							
							$rs5 = db_query(" select coditem,catalogo.codcatalogo,codmaterial, tipocodmaterial, cantidad from catalogo, items_venta where codventa='$codVenta'and catalogo.codcatalogo=items_venta.codcatalogo;");
							
							while($obj1 = pg_fetch_object($rs5))
							{
								$cantidad = $obj1->cantidad;
								$codmaterial = $obj1->codmaterial;
								$tipocodmaterial = $obj1->tipocodmaterial;
								$coditem = $obj1->coditem;
								
								//se agregan las existencias q no se pudieron vender
								$rs6 = db_query("update inventario set existencia = existencia + '$cantidad' where tipocodmaterial='$tipocodmaterial' and codmaterial='$codmaterial' and codUbicacion='$idUbicacion';");
								
								//se elimina el registro del item como tal
								$rs7 = db_query("delete FROM items_venta  where coditem ='$coditem';");
							}
							
							//se elimina el registro de la venta
							$rs8 = db_query("delete FROM ventas  where codventa='$codVenta';");
							
						}
						
						if($errorCantidad)
						{
							$_GET['errorCantidad'] = true;
						}									
					}
				}

				if(!$fallo)
				{
					db_query('commit');
					
					//borrar variables
					unset($_SESSION['datosSalida']);
					unset($_SESSION['items']);

					$_GET['salida_exitosa'] = true;
			
				}
									
				unset($_POST);
			}
		}		
	}
	
	//Se agrega un nuevo item a la venta
	if(isset($_POST['agregarItem']))
	{	
		$usuario = $_POST['usuario'];
		$vinculacion = $_POST['vinculacion'];
		$tipo_doc = $_POST['tipo_doc'];
		$num_doc=$_POST['num_doc'];
		$plan=$_POST['plan'];
		$doc = $_POST['documento'];
		
		$datos_salida = array("tipo_salida"=>$tipoSalida, "usuario"=>$usuario,"vinculacion"=>$vinculacion,"tipo_doc"=>$tipo_doc,"num_doc"=>$num_doc,"plan"=>$plan,"documento"=>$doc,"total_salida"=>$total_salida);
		$_SESSION['datosSalida']=$datos_salida;
	
		?>
		<script language="javascript">
		location.href="item.php";
		</script>
		<?
	}
	
	//Se cancela la venta
	if($_POST['cancelar'])
	{
		unset($_SESSION['datosSalida']);
		unset($_SESSION['items']);
		?>
		<script language="javascript">
		location.href="index.php";
		</script>
		<?
	}
	
	//Formato para realizar una venta
	PageInit("Ventas", "../menu.php");
	
	?> <h1 class="shiny">Venta</h1> 
	<div style="float:right ">Hora <?= $hora;?></div>
	<?
	
	if(!isset($_SESSION['salida']))
	{
		?>
		<h2>Formulario de salidas: </h2>
		<form name="salidas" enctype="multipart/form-data" method="post" action="">
		<table width="70%" border="0" align="center">
		<tr>
			<td width="30%" class="titulosContenidoInterno">Fecha</td>
			<td><input type="text" name="fecha" value="<?=$fecha?>" size="20"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Beneficiario</td>
			<td><input type="text" name="usuario" value="<?=$datos_salida['usuario'] ?>" size="20"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>	
		<tr>
		<td width="60%" class="titulosContenidoInterno">Vinculaci&oacute;n con <br> la Universidad</td>
			<td>
				<select name="vinculacion">
				<option>&nbsp;</option>				
				<option<? if($datos_salida['vinculacion'] == 'Estudiante') echo " selected "; ?>>Estudiante</option>
				<option<? if($datos_salida['vinculacion'] == 'Docente') echo " selected "; ?>>Docente</option>
				<option<? if($datos_salida['vinculacion'] == 'Trabajador') echo " selected "; ?>>Trabajador</option>
				<option<? if($datos_salida['vinculacion'] == 'Personal Externo') echo " selected "; ?>>Personal Externo</option>				
				</select>
			</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
		<td width="60%" class="titulosContenidoInterno">Tipo de Documento <br> Identificaci&oacute;n</td>
			<td>
				<select name="tipo_doc">
				<option>&nbsp;</option>
				<option<? if($datos_salida['tipo_doc'] == 'Codigo') echo " selected "; ?>>Codigo</option>
				<option<? if($datos_salida['tipo_doc'] == 'C.C.') echo " selected "; ?>>C.C.</option>
				<option<? if($datos_salida['tipo_doc'] == 'Tarjeta Identidad') echo " selected "; ?>>Tarjeta Identidad</option>		
				</select>
			</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">N&uacute;mero Documento <br> Identificaci&oacute;n</td>
			<td><input type="text" name="num_doc" value="<?=$datos_salida['num_doc'] ?>" size="20"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">C&oacute;digo Plan de Estudios <br>(Solo Para Estudiantes)</td>
			<td><input type="text" name="plan" value="<?=$datos_salida['plan'] ?>" size="20"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Documento</td>
			<td>
			<select name="documento">
			<option>&nbsp;</option>
			<option<? if($datos_salida['documento'] == 'Oficio') echo " selected "; ?>>Oficio</option>
			<option<? if($datos_salida['documento'] == 'Reporte de Venta') echo " selected "; ?>>Reporte de Venta</option>
			</select>
			</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td width="40%" class="titulosContenidoInterno">Total Venta</td>
			<td><input readonly type="text" name="total_salida" value="<?=$datos_salida['total_salida'] ?>" size="20"></td>
		</tr>
		<tr><td colspan="2"><br><br></td></tr>
        <tr><td colspan="2"><h2>Detalles de la venta</h2></td></tr>		
		</table>
		
		<table width="90%" align="center" border="1">
		<tr>
			<th colspan="2" width="10%">Codigo Item</th>
			<th  width="40%">Titulo</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>% Descuento</th>
			<th>Total</th>
		</tr>
		<?
		foreach($items as $k => $item)
		{
		?>
		<tr>
			<td><?=$item['tipoCodItem']?></td>
			<td><?=$item['codItem']?></td>
			<td><?=$item['titulo']?></td>
			<td><?=$item['precio']?></td>
			<td><?=$item['cantidad']?></td>
			<td><?=$item['descuento']?></td>
			<td><?=$item['total']?></td>
		</tr>
		<?
		}
		?>
		</table>
		<br>
		
		<table  width="70%" align="center" border="0">
			<tr><td><br></td></tr>
			<tr >
				<td>
				    <input type="submit" name="agregarItem" value="Agregar Item">
				</td>
				<td>
					<input type="submit" name="aceptar" value="Aceptar">
				</td>
				<td>	
					<input type="submit" name="cancelar" value="Cancelar">
				</td>
			</tr>		
		</table>
		</form>
		
		<?
	}
	
	//Manejo de mensajes de error
	if(isset($_GET['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe ingresar todos los campos.  Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['faltaPlan']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe ingresar el plan de estudios cuando realiza una venta y/o donaci&oacute;n a un estudiante.");
		</script>
		<?
	}
		
	if(isset($_GET['numero']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El campo n&uacute;mero de documento de identificaci&oacute;n debe ser de tipo numerico. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['fallo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Ocurrio un error al tratar de realizar la opreaci&oacute;n intente. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['salida_exitosa']))
	{
		echo '
		<script language="JavaScript">
			   window.open("recibo.php?id='.$codVenta.'" , "ventana1" , "width=600,height=550,scrollbars=NO");
		</script>';
		
		?>
		<script language="javascript" type="text/javascript">
		alert("Se finalizó la operación exitosamente.");
		location.href="salidas.php";
		</script>
		<?
		

	}
	
	if(isset($_GET['hayItems']))
	{
		
		?>
		<script language="javascript" type="text/javascript">
		alert("Antes de realizar la operaci&oacute;n debe agregar un item.");
		location.href="salidas.php";
		</script>
		<?
	}
	
		if(isset($_GET['errorCantidad']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("La cantidad que desea sacar de uno de los items es mayor que a la existente. Intente nuevamente.");
		</script>
		<?
	}
	
	PageEnd();
?>