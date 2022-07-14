<?	
	session_start();
	
	if(!isset($_SESSION['monitor']))
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/control.php");
		die();
	}
	
	$root_path = "../../..";
	require '../../../functions.php';
	PageInit("Consultar Estudiante", "menu.php");
	include "../../../php-scripts/validadorFormularios/formConsultaEst.php";
	
	if(isset($_POST['buscar'])){
		
			
		$conexion = DBConnect("controlsalas");
		if(!$conexion){
			echo "Error al conectarse con la BD.";
		}else{
			$codigo=pg_escape_string($_POST['codigoEst']);
			
			$rs = db_query("select * from estudiantes where codigo = '$codigo'");
			
			if(pg_num_rows($rs) == 0 )
			{
				?>
					<script language="javascript" type="text/javascript">
					if (confirm("El estudiante no se encuentra registrado. Desea registrarlo?")) {
						location.href="/Comunidad/Informatica/ControlUsuarios/registrarEstudiante.php";
					}else{
						location.href="/Comunidad/Informatica/ControlUsuarios/consultaEstudiantes.php?opc=1";
					}					
					</script>
				<?
			}
				$obj = pg_fetch_object($rs);
				
				
			?>
			<div align="center">
			<br>
			<br>
			<form id="datosEst" name="datosEst" action="../ControlUsuarios/modificarEst.php" method="post">
				<table>
					<tr>
						<td class="titulosContenidoInterno">C&oacute;digo:</td>
						<td>
						<input readonly id="codigoEst" type="text" name="codigoEst" value="<? echo $obj->codigo;?>"></td>
					</tr>
					<tr>
						<td class="titulosContenidoInterno">Nombre:</td>
						<td><input id="nombreEst" type="text" name="nombreEst" value="<? echo $obj->nombres;?>"></td>
					</tr>
					<tr>
						<td class="titulosContenidoInterno">Apellido:</td>
						<td><input id="apellidoEst" type="text" name="apellidoEst" value="<? echo $obj->apellidos;?>"></td>
					</tr>
					<tr>
						<td class="titulosContenidoInterno">Tipo Documento:</td>
						<td>
							<select name="tipodoc" title="Tipo Documento">
							<option value="" ></option>
							<option value="C.C" <? if($obj->tipodoc == 'C.C') echo "selected"; ?>>C.C</option>
							<option value="C.R" <? if($obj->tipodoc == 'C.R') echo "selected"; ?>>C.R</option>
							<option value="T.I" <? if($obj->tipodoc == 'T.I') echo "selected"; ?>>T.I</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="titulosContenidoInterno">No Documento:</td>
						<td><input id="numDoc" type="text" name="numDoc" value="<? echo $obj->nodoc;?>"></td>
					</tr>
					<tr>
					    <td class="titulosContenidoInterno">C&oacute;digo Plan:</td>
						<td><input id="codigoPlan" type="text" name="codigoPlan" value="<? echo $obj->codplan;?>"></td>
					</tr>
					<tr>
						<td class="titulosContenidoInterno">E-mail:</td>
						<td><input id="emailEst" type="text" name="emailEst" value="<? echo $obj->correo_electronico;?>"></td>
					</tr>
					<tr>
						<td class="titulosContenidoInterno">Login:</td>
						<td><input readonly id="loginEst" type="text" name="loginEst" value="<? echo $obj->login;?>"></td>
					</tr>
					<tr>
						<td class="titulosContenidoInterno">Password:</td>
						<td><input readonly id="passEst" type="text" name="passEst" value="<? echo $obj->password;?>"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
						<input type="submit" name="guardar" value="Guardar" id="guardar">
						<input type="button" name="Atras" value="Atras" onClick="location.href='/Comunidad/Informatica/ControlUsuarios/consultaEstudiantes.php?opc=1'" />
						</td>
					</tr>
				</table>
			</form>
			</div>
			<?
				
		
	}
}


if($_GET['opc']==1){

?>	<div align="center">
	<br>
	<br>
	<br>
	<form id="consultaEst" action="consultaEstudiantes.php" method="post">
		<table>
			<tr>
				<td class="titulosContenidoInterno">Codigo Estudiante:</td>
				<td><input id="codigoEst" type="text" name="codigoEst"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="buscar" value="Buscar" id="buscar"></td>
			</tr>
		</table>
	
	</form>
	</div>
<?
}
?>