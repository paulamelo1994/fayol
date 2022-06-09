
<?
   require '../../../functions.php';
   $rootPath = '../../../';
  	
	session_start();
	
	if(!isset($_SESSION['sesionActas'])){
		header('Location: /Comunidad/Actas/Administrador/autenticar.php');
	  die();
	}
	
	PageInit("Administrador de Actas",'../../menu.php');
	
	 include "../../../php-scripts/validadorFormularios/formActas.php";
	 include "../../../php-scripts/selectorFechas.php";
?>

<script language="javascript" type="text/javascript"> 
		var posicionCampo=1;
		
		function agregarAccion(){
		
		/* Declaramos una variable llamada nuevaFila y a ella le asignamos la recuperaci�n del elemento HTML designado por el id tablaUsuarios. En este caso, la tabla en la que manejamos los campos din�micamente y llamamos a la funci�n insertRow para agregar una fila */
		
			nuevaFila = document.getElementById("tablacciones").insertRow(-1);
			
			nuevaFila.id=posicionCampo;
			
			nuevaCelda=nuevaFila.insertCell(-1);			
			nuevaCelda.innerHTML="<td><input  name='n_acta["+posicionCampo+"]' type='text' size='4' maxlength='4'></td>";
			
			nuevaCelda=nuevaFila.insertCell(-1);			
			nuevaCelda.innerHTML="<td><input  class='dateform' name='dateform["+posicionCampo+"]' type='text' size='10' maxlength='10'></td>";
			
			nuevaCelda=nuevaFila.insertCell(-1);			
			nuevaCelda.innerHTML="<td><input  name='archivo["+posicionCampo+"]' type='file' size='70'></td>";
			
			nuevaCelda=nuevaFila.insertCell(-1);			
			nuevaCelda.innerHTML="<td><select  name='tipo["+posicionCampo+"]' title=''><option value='' selected ></option><option value='1'>Actas Consejo Facultad</option><option value='2'>Actas Comite Curriculo</option><option value='3'>Actas Comite Contadurio Publica</option><option value='8'>Actas Comite Administraci&oacute;n de Empresas</option><option value='4'>Actas Maestria Adm Empresas</option><option value='5'>Actas Dep Contabilidad Finanzas</option><option value='6'>Actas Dep Administracion Organizacion</option><option value='7'>Actas De Claustro De Facultas</option><option value='9'>Actas De Comit&eacute; De Posgrados</option></select></td>";
			
			nuevaCelda=nuevaFila.insertCell(-1);			
			nuevaCelda.innerHTML="<td><input type='button' value='Eliminar' onclick='eliminarAccion(this)'></td>"
			posicionCampo++;
		
		}
		
		function eliminarAccion(obj){
		
		var oTr = obj;
		
			while(oTr.nodeName.toLowerCase()!='tr'){
			
			oTr=oTr.parentNode;
			
			}
		
		var root = oTr.parentNode;
		
		root.removeChild(oTr);
		
		}
		
		

</script>
<?	
		
	
	
if(isset($_POST['guardar'])){

	DBConnect("new_fayol");
	
	echo "linea";
	print_r($POST);
	
	$fecha=$_POST['dateform'];
	$n_acta=$_POST['n_acta'];
	$tipo=$_POST['tipo'];
	$archivo=$_FILES['archivo'];
	/*echo "<pre>";
	print_r($_POST);
	print_r($_FILES);
	echo "</pre>";*/
	
	$tam=count($n_acta);
	
	$keys = array_keys($n_acta);
	$ultimo = $keys[count($keys)-1];
		
	for($i=0; $i<=$ultimo; $i++){
		$name_arch=$archivo['name'][$i];
		
		if(($fecha[$i]!='')&&($n_acta[$i]!='')&&($tipo[$i]!='')&&($name_arch!='')){
			
			$rs1 = db_query("SELECT last_value FROM actas_facultad_id_seq");
			$obj1 = pg_fetch_object($rs1);
			
			
			$target_path = $obj1->last_value.substr($name_arch,-4);
						
			$agno=substr($fecha[$i],0,4);
						
			switch ($tipo[$i]){
					case 1:
							$ruta="/var/www/Comunidad/Actas/Consejo Facultad/".$agno;
							break;
					case 2:
							$ruta="/var/www/Comunidad/Actas/Comite Curriculo/".$agno;
							break;
					case 3:
							$ruta="/var/www/Comunidad/Actas/Contaduria/".$agno;
							break;
					case 4:
							$ruta="/var/www/Comunidad/Actas/MaAdmon/".$agno;
							break;
					case 5:
							$ruta="/var/www/Comunidad/Actas/Comite_contabilidad_finanzas/".$agno;
							break;
					case 6:
							$ruta="/var/www/Comunidad/Actas/DepAdminOrgan/".$agno;
							break;
					case 8:
							$ruta="/var/www/Comunidad/Actas/Admin/".$agno;
							break;
					case 7:
							$ruta="/var/www/Comunidad/Actas/Claustro/".$agno;
							break;
					case 9:
							$ruta="/var/www/Comunidad/Actas/Comite Posgrados/".$agno;
							break;
			}
			
				if(!file_exists($ruta)){				 
					mkdir($ruta);
				}
				$ruta=$ruta."/";
			
				if(move_uploaded_file($archivo['tmp_name'][$i], $ruta.$target_path)){
				
					chmod($ruta.$target_path, 0755);
					chgrp($ruta.$target_path, "www-data");
					DBConnect('new_fayol');
					
					$query=db_query("insert into actas_facultad
								 (n_acta,fecha,archivo,tipo_acta)values('$n_acta[$i]','$fecha[$i]','$target_path','$tipo[$i]')");
					
					
					
					printOK("Se a cargado el archivo ".$name_arch." exitosamente");
				}else{	
					printError("Se ha presentado un error al cargar el archivo ".$name_arch.", inténtelo de nuevo!");
					unset($archivo[$i]);
				}
			
		}
	}
				
	
	
	


}	
		
if(isset($_GET['opc'])){				
	
			?>
			<div id="formActas" align="center">
            <h2>Administrador  Actas de la Facultad</h2>
			<br>
			<br>
			<div align="left"><a href="autenticar.php?cerrarSesion=1">Cerrar Sesion</a></div>
			<br>
			<br>
			<form id="actas" name="actas" action="" method="post" enctype="multipart/form-data">
				<table id="tablacciones">
				    <tr>
						<td  class="titulosContenidoInterno">No. Acta:  </td>
                        <td class="titulosContenidoInterno">Fecha:  </td>
                        <td class="titulosContenidoInterno">Archivo:  </td>
                        <td class="titulosContenidoInterno">Tipo Acta:  </td>
                        <td></td>
					</tr>
					<tr>									
						<td><input  name="n_acta[0]" type="text" size="4" maxlength="4"></td>
                        <td><input class='dateform' name="dateform[0]" type="text" size='10' maxlength='10' ></td>
                        <td><input name="archivo[0]" type="file" size="70" style="background-color:#FFFFFF; "></td>
                        <td>
							<select  name="tipo[0]" title="">
							<option value="" selected ></option>
							<option value="1">Actas Consejo Facultad</option>
							<option value="2">Actas Comite Curriculo</option>
                            <option value="3">Actas Comite Contadur&iacute;a P&uacute;blica</option>
                            <option value="8">Actas Comite Administraci&oacute;n de Empresas</option>
                            <option value="4">Actas Maestria Adm Empresas</option>
                            <option value="5">Actas Dep Contabilidad Finanzas</option>
                            <option value="6">Actas Dep Administracion Organizacion</option>
                            <option value="7">Actas De Claustro De Facultad</option>
                            <option value="9">Actas De Comit&eacute; De Posgrados</option>
							</select>
						</td>
                        <td></td>
					</tr>
                    
				</table>
				<div align="left">
					<input type="button" onClick="agregarAccion()"value="A&ntilde;adir Otro" >
				</div>
				<br>
				<br>
				<div>		
						<input type="submit" name="guardar" value="Guardar" id="guardar">
						<input  type="reset" name="limpiar" value="Limpiar" id="limpiar">
				</div>
			</form>
			</div>
			<?
}


?>