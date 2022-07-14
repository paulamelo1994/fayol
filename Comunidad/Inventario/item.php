<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: item.php
	Objetivo: Este archivo permite obtener la informaci&oacute;n de cada uno de los items de una venta
	Autor: Angela Benavides
	Modificado por: Deisy Chaves
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
	
	$fecha = date('Y')."-".date('m')."-".date('d');
	
	$_GET['submenu_inventario'] = true;
	$idUbicacion= $_SESSION['idUbicacion'];
	$ubicacion= $_SESSION['ubicacion'];
	
	//Se recupera la informaci&oacute;n de los items que hay hasta el momento
	if(isset($_SESSION['items']))
	{
		$items=$_SESSION['items'];
	}
	else
	{
		$items=array();
	}
	
	if(!isset($_POST['descuento']))
		$_POST['descuento'] = 0;
	
	//Se busca la informaci&oacute;n del material  a agregar a la venta
	if($_POST['buscar'])
	{							
		if(!empty($_POST['codMaterial']) && !empty($_POST['tipoCodMaterial']))
		{
			$conexion = DBConnect('inventario');
			
			if(!conexion)
					echo("<td>No se pudo lograr la conexi&oacute;n con la BD.</td>");
			else
			{
				$codigo = $_POST['codigo'];
				$rs = db_query("select * from catalogo where codMaterial = '$_POST[codMaterial]' and tipoCodMaterial = '$_POST[tipoCodMaterial]' and estado ='0'");
				
				if($obj = pg_fetch_object($rs))
				{
					
					$codCatalogo = $obj->codcatalogo;
					$titulo = $obj->titulo;
					$autor  = $obj->autores;						
					$tipoCodMaterial = $obj->tipocodmaterial;
					$codMaterial= $obj->codmaterial;
					
					$precio = $obj->precio;					
					$cantidad = $_POST['cantidad'];
				}
				else
				{
					?>
					<script language="javascript">
					location.href="item.php?noEncontro=true";
					</script>
					<?
				}
			}
		}
	}

	if(isset($_POST['consultar']) )
	{
		if(isset($_POST['codMaterial']))
		{
			echo '
				<SCRIPT LANGUAGE="JavaScript">
				var myWind = ""
				function doNew() {
					if (myWind == "" || myWind.closed || myWind.name == undefined) {
						myWind = window.open("libros.php?texto='.$_POST['codMaterial'].'","subWindow","width=640,height=400,scrollbars=yes")
					//alert("Mywindow.name="+myWind.name);
				} else{
				myWind.focus();
				}
			}
			</SCRIPT>
			';
			}
		
	}



	
	//Se pre calcula el valor del item vendido
	if(isset($_POST['calcular']) || isset($_POST['aceptar']))
	{
		//Se validan campos vacios
		if(empty($_POST['codMaterial']) && empty($_POST['tipoCodMaterial']) || empty($_POST['cantidad']))
			$_GET['vacios'] = true;
		else if(!is_numeric($_POST['cantidad']) || !is_numeric($_POST['descuento']))
			$_GET['numero'] = false;
		else
		{
			$conexion = DBConnect('inventario');
			$tipoCodMaterial = $_POST['tipoCodMaterial'];
			$codMaterial = $_POST['codMaterial'];
			
			$rs = db_query("select codCatalogo,costo,precio, existencia from catalogo,inventario where inventario.tipoCodMaterial = catalogo.tipoCodMaterial and inventario.codMaterial = catalogo.codMaterial and codUbicacion = '$idUbicacion' and catalogo.codMaterial='$codMaterial' and catalogo.tipoCodMaterial='$tipoCodMaterial' and estado = '0'");
						
			if($obj = pg_fetch_object($rs))
			{
				$codCatalogo = $obj->codcatalogo; 
				$precio = $obj->precio;
				$costo = $obj->costo;				
				$existencias = $obj->existencia;
			}
			
			//Se valida que halla suficiente cantidad para realizar la venta
			if($existencias<$cantidad)
			{
				$_GET['hayCantidad'] = false;
			}
			else
			{
				$total = abs($cantidad) * $precio;
				$total = $total - ($total * (abs($descuento)/100.0));
			
				//Se verifica que el descuento dado sea valido, es decir que no haga que el libro tengo un valor inferior a su costo
				if(($costo*$cantidad)>$total)
				{
					$_GET['errorDescuento'] = false;
					$total = 0;
				}
				else if(isset($_POST['aceptar']))
				{
					$numItem= count($items);			
					$items[$numItem] = array("codCatalogo"=>$codCatalogo,"tipoCodItem"=>$tipoCodMaterial,"codItem"=>$codMaterial,"titulo"=>$titulo,"precio"=>$precio, "cantidad"=>$cantidad,"descuento"=>$descuento,"total"=>$total);
					$_SESSION['items']=$items;
					echo"
							<script language='javascript'>
							location.href='salidas.php';
							</script>";
				}				
			}
		}
	}

	// Si se decide no ingresar el item a la venta
	if($_POST['cancelar'])
	{
		?>
		<script language="javascript">
		location.href="salidas.php?itemcancelado=true";
		</script>
		<?
	}
	

//Formulario para el ingreso del item a la venta
	PageInit("Item Salida", "../menu.php");
?>

<h2 align="center">Detalle Item</h2>

<form name="ingresar" enctype="multipart/form-data" method="post" action="item.php">

<table width="70%" border="0" align="center">
<tr>
	<td class="titulosContenidoInterno">
	<input type="radio" name="tipoCodMaterial"  value="ISBN" <? if($tipoCodMaterial == 'ISBN') echo "checked"; ?>>ISBN
	<br>
	<input type="radio" name="tipoCodMaterial"  value="ISSN" <? if($tipoCodMaterial == 'ISSN') echo "checked"; ?>>ISSN
	</td>
	<td><input type="text" name="codMaterial" value="<?=$codMaterial?>" size="20">
	&nbsp;	
	<input name="buscar" type="submit" value="..." title="Consultar Material!">
	&nbsp;	
	<input type='submit' name="consultar" value="Buscar" onClick="doNew()">
	</td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Titulo</td>
	<td><input type="text" name="titulo" readonly value="<?=$titulo?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Autores</td>
	<td><input type="text" name="autor" readonly value="<?=$autor?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Precio</td>
	<td><input readonly type="text" name="precio" value="<?=$precio?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Cantidad</td>
	<td><input type="text" name="cantidad" value="<?=$cantidad?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Descuento</td>
	<td><input type="text" name="descuento" value="<?=$_POST['descuento'];?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td width="20%" class="titulosContenidoInterno">Total</td>
	<td><input readonly type="text" name="total_item" value="<?=$total?>" size="30"></td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td colspan="2" align="center">
	<input type="submit" name="calcular" value="Calcular">&nbsp;&nbsp;&nbsp;
	<input type="submit" name="aceptar" value="Aceptar">&nbsp;&nbsp;&nbsp;
	<input type="submit" name="cancelar" value="Cancelar">
	</td>
</tr>
</table>
</form>
<?

//Manejo mensajes de error
	if(isset($_GET['noEncontro']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El material no existe en el catalogo.");
		</script>
		<?
	}
	
	if(isset($_GET['hayCantidad']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("La cantidad que desea sacar del catalogo es mayor que la existente. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['errorDescuento']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("El descuento que desea dar es mayor a lo permitido. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['vacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe ingresar todos los campos. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['numero']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Los campos de cantidad y descuneto deben ser valores numericos. Intente nuevamente.");
		</script>
		<?
	}
	
	if(isset($_GET['fallo']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Ocurrio un error al tratar de ingresar la informaci&oacute;n. Intente nuevamente.");
		</script>
		<?
	} 

	PageEnd();
?>