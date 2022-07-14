<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: donaciones.php
	Objetivo: Este archivo es el encargado de registrar una salida del catalogo, cuando se realiza una donación.
	Autor: Angela Benavides
	Modificado por: Deisy Chaves
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
		
	$fecha = date('Y')."-".date('m')."-".date('d');
	$hora = date('H').":".date('i');
	
	$_GET['submenu_inventario'] = true;
		
	$idUbicacion = $_SESSION['idUbicacion'];
	$ubicacion = $_SESSION['ubicacion'];
	
	
	//Se leen los items de la donacion hasta el momento	
	if(isset($_SESSION['itemsDonacion']))
	{
		$items=$_SESSION['itemsDonacion'];
	}
	else
	{
		$items = array( );
	}
	
	if(isset($_SESSION['datosDonacion']))
	{
		$datos_donacion=$_SESSION['datosDonacion'];

		// Se realiza la cancelacion de un item, este coindice con el ultimo del arreglo de items
		if(!isset($_GET['itemcancelado']))
		{
			$posUltimoItem= count($items)-1;
			$ultimoItem = $items[$posUltimoItem];
			$datos_donacion['total_donacion'] = $datos_donacion['total_donacion'] + $ultimoItem['total'];
		}
	}
	else
	{
		$datos_donacion = array( 'total_donacion' => 0);
	}
	
	
	//Se procesa la donacion
	if(isset($_POST['aceptar']))
	{	
		$usuario = $_POST['usuario'];
		$vinculacion = $_POST['vinculacion'];
		$tipo_doc = $_POST['tipo_doc'];
		$num_doc=$_POST['num_doc'];
		$plan = $_POST['plan'];
		$doc = $_POST['documento'];
		$concepto = $_POST['concepto'];
		$aprobado = $_POST['aprobado'];

		//Validaciones
		if(empty($usuario) || empty($vinculacion) || empty($tipo_doc) || empty($num_doc) || empty($doc) || empty($concepto) || empty($aprobado)|| empty($total_donacion))
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
			//Se realiza la donacion
			$conexion = @DBConnect('inventario');

			if(empty($conexion)) //Si no hay conexion
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible agregar la existencia del libro, por favor intentelo m&aacute;s tarde.</p>";
			}
			else
			{
			
			 //Se registra los datos del benefiicario de la donacion
				$fallo = false;
						
				db_query('begin');
						
				$rs = db_query("insert into donaciones (codUbicacion, beneficiario, vinculacion ,tipo_identificacion, doc_identificacion, codPlan, total_donacion,fecha,hora,hecha_por,aprobada_por, documento, concepto)
				values ('$idUbicacion','$usuario','$vinculacion','$tipo_doc','$num_doc','$plan','$total_donacion','$fecha','$hora','{$_SESSION[inventario][login]}','$aprobado','$doc','$concepto')
				");
				
				if(!$rs) $fallo = true;
				
				
			 //Se registra cada uno de los items
				$rs1 = db_query("select last_value from donaciones_seq");
				$obj = pg_fetch_object($rs1);
				$codDonacion = $obj->last_value;
				
				if(!$rs1) $fallo = true;
				
				$errorCantidad = false;
				
				foreach($items as $k => $item)
				{
				   if(!$errorCantidad)
				   {
						$codCatalogo= $item['codCatalogo'];
						$cantidad = $item['cantidad'];
						$tipoCodMaterial = $item['tipoCodItem'];
						$codMaterial =$item['codItem'];
						
						$rs2 = db_query("select * from inventario where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion = '$idUbicacion'");
						
						$obj2 = pg_fetch_object($rs2);
						if(!$rs2) $fallo = true;
						
						$existencias = $obj2->existencia - $cantidad;
						
						if($existencias>0)
						{	
							//Se actualiza el inventario		
							$rs3 = db_query("update inventario set existencia = '$existencias' where codMaterial = '$codMaterial' and tipoCodMaterial = '$tipoCodMaterial' and codUbicacion ='$idUbicacion'");
							if(!$rs3) $fallo = true;
							
							//se ingresa el item de donacion
							$rs4 = db_query("insert into items_donacion (codDonacion, codCatalogo, cantidad)
					values ('$codDonacion','$codCatalogo','$cantidad')");
					
							if(!$rs4) $fallo = true;
						}
						else
						{
						  $errorCantidad=true;
						}
					}
				}

				if($fallo)
				{
					db_query('rollback');
					$_GET['fallo'] = true;
				}
				else
				{
					db_query('commit');
					
					 //borrar variables
					unset($_SESSION['datosDonacion']);
					unset($_SESSION['itemsDonacion']);
				   
				    if($errorCantidad)
					{
						$_GET['errorCantidad'] = true;
					}
					else
					{
						$_GET['donacion_exitosa'] = true;
					}
				}
									
				unset($_POST);
			}
		}
	}
	
	//Agragar otro item a la donacion
	if(isset($_POST['agregarItem']))
	{	
		$usuario = $_POST['usuario'];
		$vinculacion = $_POST['vinculacion'];
		$tipo_doc = $_POST['tipo_doc'];
		$num_doc=$_POST['num_doc'];
		$plan=$_POST['plan'];
		$doc = $_POST['documento'];
		$concepto = $_POST['concepto'];
		$aprobado = $_POST['aprobado'];
		
		$datos_donacion = array("usuario"=>$usuario,"vinculacion"=>$vinculacion,"tipo_doc"=>$tipo_doc,"num_doc"=>$num_doc,"plan"=>$plan,"documento"=>$doc,"concepto"=>$concepto,"aporbado"=>$aprobado,"total_donacion"=>$total_donacion);
		$_SESSION['datosDonacion']=$datos_donacion;
	
		?>
		<script language="javascript">
		location.href="itemDonacion.php";
		</script>
		<?
	}
	
	//Cancelar Donacion
	if($_POST['cancelar'])
	{
		unset($_SESSION['datosDonacion']);
		unset($_SESSION['itemsDonacion']);
		?>
		<script language="javascript">
		location.href="index.php";
		</script>
		<?
	}
	
	
	//Formulario para el ingreso de los datos del beneficiario de la donacion
	PageInit("Donaciones", "../menu.php");	
	
	?> <h1 class="shiny">Donaciones</h1> <?
	
	if(!isset($_SESSION['donacion']))
	{
		?>
		<h2>Formulario de donaciones:</h2>
		<form name="donaciones" enctype="multipart/form-data" method="post" action="">
		<table width="70%" border="0" align="center">
		<tr>
			<td width="30%" class="titulosContenidoInterno">Fecha</td>
			<td><?=MakeDate($fecha)?></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Beneficiario</td>
			<td><input type="text" name="usuario" value="<?=$datos_donacion['usuario'] ?>" size="20"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>	
		<tr>
		<td width="60%" class="titulosContenidoInterno">Vinculación con <br> la Universidad</td>
			<td>
				<select name="vinculacion">
				<option>&nbsp;</option>				
				<option<? if($datos_donacion['vinculacion'] == 'Estudiante') echo " selected "; ?>>Estudiante</option>
				<option<? if($datos_donacion['vinculacion'] == 'Docente') echo " selected "; ?>>Docente</option>
				<option<? if($datos_donacion['vinculacion'] == 'Trabajador') echo " selected "; ?>>Trabajador</option>
				<option<? if($datos_donacion['vinculacion'] == 'Personal Externo') echo " selected "; ?>>Personal Externo</option>				
				</select>
			</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
		<td width="60%" class="titulosContenidoInterno">Tipo de Documento <br> Identificación</td>
			<td>
				<select name="tipo_doc">
				<option>&nbsp;</option>
				<option<? if($datos_donacion['tipo_doc'] == 'Codigo') echo " selected "; ?>>Codigo</option>
				<option<? if($datos_donacion['tipo_doc'] == 'C.C.') echo " selected "; ?>>C.C.</option>
				<option<? if($datos_donacion['tipo_doc'] == 'Tarjeta Identidad') echo " selected "; ?>>Tarjeta Identidad</option>		
				</select>
			</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">N&uacute;mero Documento <br> Identificaci&oacute;n</td>
			<td><input type="text" name="num_doc" value="<?=$datos_donacion['num_doc'] ?>" size="20"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">C&oacute;digo Plan de Estudios <br>(Solo Para Estudiantes)</td>
			<td><input type="text" name="plan" value="<?=$datos_donacion['plan'] ?>" size="20"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td class="titulosContenidoInterno">Documento</td>
			<td>
			<select name="documento">
			<option>&nbsp;</option>
			<option<? if($datos_donacion['documento'] == 'Oficio') echo " selected "; ?>>Oficio</option>
			<option<? if($datos_donacion['documento'] == 'Reporte de Venta') echo " selected "; ?>>Reporte de Venta</option>
			</select>
			</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td width="40%" class="titulosContenidoInterno">Concepto</td>
			<td><input type="text" name="concepto" value="<?=$datos_donacion['concepto'] ?>" size="20"></td>
		</tr>
				<tr><td colspan="2"><br></td></tr>
		<tr>
			<td width="40%" class="titulosContenidoInterno">Aprobada por</td>
			<td><input type="text" name="aprobado" value="<?=$datos_donacion['aprobado'] ?>" size="20"></td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td width="40%" class="titulosContenidoInterno">Total Donaci&oacute;n</td>
			<td><input readonly type="text" name="total_donacion" value="<?=$datos_donacion['total_donacion'] ?>" size="20"></td>
		</tr>
		<tr><td colspan="2"><br><br></td></tr>
        <tr><td colspan="2"><h2>Detalles de la donaci&oacute;n</h2></td></tr>		
		</table>
		
		<table width="90%" align="center" border="1">
		<tr>
			<th colspan="2" width="10%">Codigo Item</th>
			<th  width="40%">Titulo</th>
			<th>Costo</th>
			<th>Cantidad</th>
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
			<td><?=$item['costo']?></td>
			<td><?=$item['cantidad']?></td>
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
		alert("Debe ingresar el plan de estudios cuando realiza una venta y/o donación a un estudiante.");
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
		alert("Ocurrio un error al tratar de realizar la opreación intente. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['donacion_exitosa']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se finalizó la operación exitosamente.");
		location.href="donaciones.php";
		</script>
		<?
	}
	
	if(isset($_GET['hayItems']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Antes de realizar la operación debe agregar un item.");
		location.href="donaciones.php";
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