<?
	/********************************************************
	Aplicacion: Control Salas
	Archivo: asignarEquipo.php
	Objetivo: Modulo que permite la asignacion de los equipos disponibles a los diversos usuarios de las salas.
				Inicialmente el monitor debe digitar el codigo del usuario para que el modulo le liste los datos
				del usuario.
				Las opciones de equipos disponibles son listadas en el panel derecho (botones!) donde se debe 
				seleccionar el equipo deseado.
				El tipo de uso sera seleccionado a continuacion de acuerdo a las siguientes opciones:
				- Clase
				- Practica
	Autor: Angela Benavides
	A&ntilde;o: 2006
	*********************************************************/
	session_start();
	
	//print_r($_POST);
	//print_r($_SESSION);
	
	if(!isset($_SESSION['monitor']))
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/control.php");
		die();
	}
	
	$rootPath = '../../..';
	require '../../../functions.php';
	date_default_timezone_set('GMT-4'); //Establece zona horari, evita los desfaces 
	$_GET['submenu_control'] = true;
	
	$sala = $_SESSION['idsala'];
	
	if( $sala == 'auditorio')
	{
		header("Location: /Comunidad/Informatica/ControlUsuarios/salir.php");
	}
	
	if($_POST['buscar'])
	{
		if(!empty($_POST['codigo']))
		{
			$conexion = DBConnect('controlsalas');
			
			if(!conexion)
					echo("<td>No se pudo lograr la conexi&oacute;n con la BD.</td>");
			else
			{
				$codigo=pg_escape_string($_POST['codigo']);
				$rs = db_query("select * from estudiantes where codigo = '$codigo'");
				
				if($obj = pg_fetch_object($rs))
				{
					$codigo = $obj->codigo;
					$nombres = $obj->nombres;
					$apellidos = $obj->apellidos;
					$tipodoc = $obj->tipodoc;
					$nodoc = $obj->nodoc;
					$codplan = $obj->codplan;
					$rs1 = db_query("select * from planes where codigo = '$codplan'");
					$obj1 = pg_fetch_object($rs1);
					$nomplan = $obj1->nombre;
				}
				else
				{
					?>
					<script language="javascript">
					location.href="asignarEquipo.php?noEncontro=true";
					</script>
					<?
				}
			}
		}
	}
	
	if($_POST['limpiar'])
	{
		$codigo = "";
		$nombres = "";
		$apellidos = "";
		$tipodoc = "";
		$nodoc = "";
		$codplan = "";
		$nomplan = "";
	}
	
	if($_POST['aceptar'])
	{
		if(empty($_POST['nombres']) || empty($_POST['equipo']) || empty($_POST['tipouso']))
			$_GET['camposVacios'] = true;
		else if($_SESSION['idsala'] == 'idiomas' && $_POST['diadema'] == 'SI' && empty($_POST['diadema_noinv']))
			$_GET['diadema'] = true;
		else
		{
			$conexion = DBConnect('controlsalas');
			
			if(!$conexion)
				echo("<td>No se pudo lograr la conexi&oacute;n con la BD.</td>");
			else
			{
				$fallo = false;
				
				//OJO CON ESTO AL PARECER HAY UNA HORA DE MAS CON RESPECTO A LA HORA DEL SISTEMA
				$fecha = date(Y)."-".date(n)."-".date(d);
				$desface = 1; //1 hora
				$horaing = date(G)  .":".date(i).":".date(s);
				$horasal = date(G) + 1 .":".date(i).":".date(s);
				
				if($_SESSION['idsala'] == 'idiomas'){
					$horasal = (date(G)+2) .":".(date(i)+0) .":".(date(s)+00);
				}
								
				db_query('begin');
				
				$rs = db_query("select * from monitor where login = '$_SESSION[monitor]'");
				
				//echo "select * from monitor where login = '$monitor'";
				
				$obj = pg_fetch_object($rs);
				//$idmonitor = $obj->codigo;
				$idmonitor = $obj->indice;
				//$idmonitor='0747558';
				$tipouso = $_POST['tipouso'];
				
				$query =  "insert into registro (codigoestudiante, plan, sala, equipo, fecha, horaing, horasal, sesion, monitor, tipouso";
				if($_SESSION['idsala'] == 'idiomas')
					$query .= ", diadema, diadema_noinv)";
				else
					$query .= ")";
				
				if($horaing < '08:00:00')
					$horaing='08:00:00';
				
				//$query .= " values ('$codigo', '$codplan', '$sala', '$equipo', '$fecha', '$horaing', '$horasal', 'En proceso', $idmonitor, '$tipouso'";
				$query .= " values ('$_POST[codigo]', '$_POST[codplan]', '$sala', '$_POST[equipo]', '$fecha', '$horaing', '$horasal', 'En proceso', '$idmonitor', '$tipouso'";
				if($_SESSION['idsala'] == 'idiomas')
					$query .= ", '$_POST[diadema]', '$_POST[diadema_noinv]')";
				else
					$query .= ")";
							
				$rs = db_query($query);
				if(!rs){
				    $fallo = true;
				}else{
				    $rs = db_query("update computador set disponible = 'false' where codigopc = '$_POST[equipo]' and codigosala = '$sala'");
				}
				if(!rs) $fallo = true;
				
				if($fallo)
				{
					db_query('rollback');
					?>
						<script language="javascript">
						alert("Ha ocurrido un error al procesar el registro.");
						history.back(1)
						</script>
					<?
				}
				else
				{
					db_query('commit');
					$_GET['asignado'] = true;
					$codigo = "";
					$nombres = "";
					$apellidos = "";
					$tipodoc = "";
					$nodoc = "";
					$codplan = "";
					$nomplan = "";
				}
			}
		}
	}
	
	$fechaGuardada = $_SESSION['ultimoAcceso'];
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
	
	 if($tiempo_transcurrido >= 900 and getIP() != '192.168.221.63')
	 {
		session_destroy();
		header("Location: control.php");
	}
	
	else
	{
		PageInit("Asignar Equipo Sala $sala", "menu.php");
		?>
		<h4 align="right">&nbsp;</h4>
		
		<form method="post"  name="asignarFormulario" action="asignarEquipo.php" enctype="multipart/form-data">
		<table width="100%" border="0" align="center">
		<tr>
			<td width="65%" valign="top">
			<table width="100%" border="0">
			<tr>
				<td class="titulosContenidoInterno" width="30%">Codigo:</td>
				<td width="70%">
				<input name="codigo" type="text" value="<?=$codigo?>">
				&nbsp;
				<input name="buscar" type="submit" value="..." title="Consultar Usuario!">
				</td>
			</tr>
			<tr><td><br></td></tr>
			<tr><td class="normal">Datos usuario:</td></tr>
			<tr>
				<td class="titulosContenidoInterno">Nombres:</td>
				<td><input type="text" name="nombres" readonly size="30" value="<?=$nombres?>"></td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">Apellidos:</td>
				<td><input type="text" name="apellidos" readonly size="30" value="<?=$apellidos?>"></td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">Tipo Doc:</td>
				<td><input type="text" name="tipodoc" readonly size="10" value="<?=$tipodoc?>"></td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">No. Documento:</td>
				<td><input type="text" name="nodoc" readonly size="30" value="<?=$nodoc?>"></td>		
			</tr>
			<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">Codigo Plan:</td>
				<td><input type="text" name="codplan" readonly size="30" value="<?=$codplan?>"></td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">Nombre Plan:</td>
				<td><input type="text" name="nomplan" readonly size="30" value="<?=$nomplan?>"></td>
			</tr>
			<tr><td><br></td></tr>
			<tr><td class="normal">Datos equipo:</td></tr>
			<tr>
				<td class="titulosContenidoInterno">Equipo:</td>
				<td>
				<input readonly type="text" name="equipo" id="equipo"  size="10" maxlength="10" value="" title="Seleccione un equipo disponible del lado derecho!">
				</td>
			</tr>
			<tr><td><br></td></tr>
			<tr><td class="normal">Datos de Uso:</td></tr>
			<tr><td><br></td></tr>
			<tr>
				<td class="titulosContenidoInterno">Tipo uso:</td>
				<td>
				<select name="tipouso">
				<option selected>&nbsp;</option>
				<option>Clase</option>
				<option>Practica</option>
				<option>Investigacion</option>
				<option>MonitorInv</option>
				</select>
				</td>
			</tr>
			<tr><td><br></td></tr>
			<?
			if($_SESSION['idsala'] == 'idiomas')
			{
				?>
				<tr><td class="normal" colspan="2">Elementos prestados:</td></tr>
				<tr><td><br></td></tr>
				<tr>
					<td class="titulosContenidoInterno">Diadema:</td>
					<td>
					<select name="diadema">
					<option selected>&nbsp;</option>
					<option>SI</option>
					<option>NO</option>
					</select>
					</td>
				</tr>
				<tr><td><br></td></tr>
				<tr>
					<td class="titulosContenidoInterno">No de inventario diadema:</td>
					<td>
					<input type="text" name="diadema_noinv" title="Si se presto diadema, el n&uacute;mero de inventario es obligatorio.">
					</td>
				</tr>
				<?
			}
			?>
			<tr><td><br></td></tr>
			<tr valign="bottom" align="center">
				<td colspan="2" valign="bottom" height="50">
				<input type="submit" name="aceptar" value="Aceptar">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" name="limpiar" value="Limpiar">
				</td>
			</tr>
			</table>
			</td>
			<td width="35%" valign="top">
			<table width="100%" border="1" cellpadding="0">
			<tr>
				<?
					$conexion = DBConnect('controlsalas');
					if(!conexion)
						echo("<td>No se pudo lograr la conexi&oacute;n con la BD.</td>");
					else
					{
					    //echo("<td>select * from computador where codigosala = '$sala' order by codigopc</td>");
					
						$rs = db_query("select * from computador where codigosala = '$sala' order by codigopc");
						$tmp = 1;
						$i = 0;
						while($obj = pg_fetch_object($rs))
						{
							?>
							<td align="center" valign="middle">
							<?
							$codigo = $obj->codigopc;
							$indice = $obj->indice;
							
							if($obj->disponible == 't')
							{
								?>
								<button title="Disponible" name="pc" type="button" onClick="javascript:llenarEquipo('<?=$codigo?>');" value="<?=$codigo?>">
								<img src="../../../Images/computador.jpg" width="17" height="17" alt="">
								</button><br><?=$codigo?>
								<?
							}	
							else if($obj->disponible == 'f')
							{
								?>
								<img title="No Disponible" width="18" height="18" src="../../../Images/computador.jpg" alt=""><br><?=$codigo?>
								<?
							}
							?>
							</td>
							<?
							if($i == $tmp)
							{
								?>
			  </tr>
								<tr>
								<?
								$tmp += 2;
							}
							$i++;
						}
					}
				?>
				<td colspan="2"></td>
			</tr>
			</table>
			</td>
		</tr>
		</table>
		</form>
<?
	}
	
	if(isset($_GET['noEncontro']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("No se encontro usuario con el codigo ingresado.");
		</script>
		<?
	}
	
	if(isset($_GET['camposVacios']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se requieren llenos todos los campos!");
		</script>
		<?
	}
	
	if(isset($_GET['asignado']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Se ha asignado al usuario.");
		</script>
		<?
	}
	if(isset($_GET['diadema']))
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Debe ingresar el n&uacute;mero de inventario de la diadema prestada.");
		</script>
		<?
	}
	
	PageEnd();
	
?>