<?

function enviarPreinscripcion($direccionDeEmail)
{
	$codDiplomado="DGP";
	
	if($_POST['NombreDiplomado'] =='Diplomado en Gestión de Proyectos')
	{
		$codDiplomado='DGP';
	}
	else if($_POST['NombreDiplomado'] =='Diplomado en Gerencia del Capital Humano')
	{
		$codDiplomado='DGCH';
	}
	else if($_POST['NombreDiplomado'] =='Diplomado en Formulación, Preparación y Evaluación de Proyectos')
	{
		$codDiplomado='DFPEP';
	}
	else if($_POST['NombreDiplomado'] =='Diplomado en Alta Gerencia')
	{
		$codDiplomado='DAG';
	}
	else if($_POST['NombreDiplomado'] =='Diplomado en Gerencia Tributaria')
	{
		$codDiplomado='DGT';
	}
	else if($_POST['NombreDiplomado'] =='Diplomado en Gerencia de Ventas')
	{
		$codDiplomado='DGV';
	}
	else if($_POST['NombreDiplomado'] =='Diplomado en Gerencia de Mercadeo')
	{
		$codDiplomado='DGM';
	}
	else if($_POST['NombreDiplomado'] =='Diplomado en Gerencia Financiera')
	{
		$codDiplomado='DGF';
	}
	else if($_POST['NombreDiplomado'] =='Diplomado en Competencias Directivas')
	{
		$codDiplomado='DCD';
	}
	else if($_POST['NombreDiplomado'] =='Diplomado en Revisoría Fiscal')
	{
		$codDiplomado='DRF';
	}
	
	else if($_POST['NombreDiplomado'] =='Diplomado en Gerencia para la Acreditación de la Calidad en Salud Decreto 011/2006 NTC GP 1000')
	{
		$codDiplomado='DS';
	}
	else if($_POST['NombreDiplomado'] =='Diplomado en Gerencia de Sistemas de Calidad, Norma ISO 9000, versión 2000')
	{
		$codDiplomado='DI9000';
	}
	else if($_POST['NombreDiplomado'] =='Diplomado en Diseño y Desarrollo de Herramientas Metodológicas para Implementar el Modelo de Gestión por Competencias')
	{
		$codDiplomado='DGC';
	}
	
	$message_body = "
	DATOS PERSONALES:
	   Primer Apellido: $_POST[Apellido1]
	   Segundo Apellido: $_POST[Apellido2]
	   Nombre: $_POST[Nombre]
	   Tipo Doc Identidad: $_POST[DocumentoId]
	   Numero Documento: $_POST[NumDocId]
	   Expedido en: $_POST[ExpedidaEn]   
	   Sexo: $_POST[Sexo]
	
	
	DIPLOMADO AL CUAL ASPIRA INGRESAR
	   Nombre: $codDiplomado - $_POST[NombreDiplomado] 

	
	INFORMACION RESIDENCIA
	   Direccion: $_POST[Direccion]
	   Comuna: $_POST[Comuna]
	   Estrato: $_POST[Estrato]
	   Barrio: $_POST[Barrio]
	   Lugar Residencia: $_POST[NombreCiudad] ($_POST[LugarResi])
	   Pais: $_POST[Pais]
	   Departamento: $_POST[Depto]
	   Telefono: $_POST[Telefono]
	   Email: $_POST[Email]
	   Celular: $_POST[Celular]
	   
	INFORMACIÓN LABORAL
	
	   Nombre de la empresa: $_POST[NombreDeLaEmpresa]
	   Cargo: $_POST[Cargo]
	   Direccion: $_POST[DireccionDeLaEmpresa]
	   Telefono: $_POST[TelefonoDeLaEmpresa]
	
	ANTECEDENTES ACADEMICOS
	   Nombre Institucion: $_POST[Pre1NombreInstitucion]
	   Titulo: $_POST[Pre1Titulo]

	";

	//mail('wwwmngr@administracion.univalle.edu.co', 'Formato Preinscripcion Web', $message_body);
	mail($direccionDeEmail, "Preinscripción para $codDiplomado", $message_body);

	echo "<br>";
	//Succeded("Su preinscripcion se ha realizado con éxito");
	echo "<br>";
	/*
	$error = false;
	$mensajeError ="";
	if(empty($_POST['Apellido1']) || empty($_POST['Apellido2']) || $_POST['Nombre']) || empty($_POST['DocumentoId']) || $_POST['ExpedidaEn']) || empty($_POST['Sexo']))
	{
		$error =true;
		$mensajeError ="Por favor ingrese todos sus datos personales.Por favor intentelo nuevamente.";
	}
	else if(empty($_POST['NombreDiplomado']))
	{
		$error =true;
		$mensajeError ="Por favor ingrese el diplomado al cual desea aspirar.Por favor intentelo nuevamente.";
	}
	else if(empty($_POST['Direccion']) || empty($_POST['Comuna']) || $_POST['Estrato']) || empty($_POST['Barrio']) || $_POST['NombreCiudad']) || empty($_POST['Pais'])|| $_POST['Telefono']) || empty($_POST['Email']) || empty($_POST['Celular']))
	{
		$error =true;
		$mensajeError ="Por favor ingrese todos los datos de su residencia.Por favor intentelo nuevamente.";
	}
	else if(empty($_POST['NombreDeLaEmpresa']) || empty($_POST['Cargo']) || $_POST['DireccionDeLaEmpresa']) || empty($_POST['TelefonoDeLaEmpresa']))
	{
		$error =true;
		$mensajeError ="Por favor ingrese todos los datos sobre su información laboral.Por favor intentelo nuevamente.";
	}
	else if(empty($_POST['Pre1NombreInstitucion']) || empty($_POST['Pre1Titulo']))
	{
		$error =true;
		$mensajeError ="Por favor ingrese todos los datos sobre su información academica. Por favor intentelo nuevamente.";
	}
	
	if($error)
	{
		echo"
		<script language='javascript' type='text/javascript'>
		alert(".$mensajeError.");
		location.href='catalogo.php';
		</script>
		";
	}
	else
	{
		$conexion = DBConnect('fayol');
			
		if(!conexion)
					echo("<td>No se pudo lograr la conexi&oacute;n con la BD.</td>");
		else
		{
			$values = $_POST['Nombre']) .",". $_POST['Apellido1'] ." ".$_POST['Apellido2']).",".$_POST['DocumentoId'].",";
			$rs = db_query("insert into preisncripcion_diplomados (nombre,apellidos,tipoDocId,docId,expedidoEn,sexo,codDiplomado,direccion,comuna,estracto,barrio,ciudad,pais,telefono,email,celular, nombreEmpresa,cargoEmpresa,direccionEmpresa,telefonoEmpresa,nombreInstitucion,titulo) values  ($values)");
		}
				
	}
	*/
	
}

enviarPreinscripcion("deisy386@gmail.com");

function formularioPreregistro($nombreDelPrograma)
{	
?>
	<FORM method="post" ACTION="<?= $nombreDelPrograma?>.php?what=12">
	<TABLE WIDTH="80%"  BORDER="0" ALIGN="CENTER" CELLPADDING="5">
	<TR>
		<TD>
		<H2 ALIGN="CENTER">1. DATOS PERSONALES</H2>
		<TABLE width="100%" border="1">
        <TBODY>
		<TR bgcolor="#cccccc" valign="top">
			<TD width="37%"><P><FONT size="-1"><B>1.1 APELLIDOS Y NOMBRE</B></FONT></P></TD>
			<TD colspan="2"><FONT size="-1"><B>1.2 DOCUMENTO DE IDENTIDAD</B></FONT></TD>
			<TD width="21%"><FONT size="-1"><B>1.3 SEXO</B></FONT></TD>
		</TR>
		<TR valign="top">
			<TD>
				<TABLE width="100%" border="0" align="center">
					<TBODY>
						<TR>
							<TD><FONT size="-1">Primer Apellido</FONT></TD>
							<TD><INPUT name="Apellido1" value="<?=$_POST['Apellido1']?>" size="25" MAXLENGTH="100"></TD>
						</TR>
						<TR>
							<TD><FONT size="-1">Segundo Apellido</FONT></TD>
							<TD><INPUT name="Apellido2" size="25" MAXLENGTH="50" value="<?=$_POST['Apellido2']?>"></TD>
						</TR>
						<TR>
							<TD><FONT size="-1">Nombres</FONT></TD>
							<TD><INPUT name="Nombre" size="25" MAXLENGTH="50" value="<?=$_POST['Nombre']?>"></TD>
						</TR>
					</TBODY>
				</TABLE>
			</TD>
			<TD colspan="2">
				<TABLE align="center" border="0" width="100%">
					<TBODY>
						<TR>
							<TD height="11" width="7%">
								<FONT size="-1">
								<INPUT name="DocumentoId" type="radio" value="Cedula" MAXLENGTH="100" <? if($_POST['DocumentoId']=='Cedula') echo 'CHECKED' ?>>
								C&eacute;dula de Ciudadan&iacute;a
								</FONT>								
							</TD>
							
							<TD width="7%" height="23">
								<FONT size="-1">
								<INPUT name="DocumentoId" type="radio" value="Pasaporte" MAXLENGTH="100" <? if($_POST['DocumentoId']=='Pasaporte') echo 'CHECKED' ?>>
								Pasaporte
								</FONT>								
							</TD>
						</TR>
						<TR>
							<TD height="23" width="13%">
								<FONT size="-1">
								<INPUT name="DocumentoId" type="radio" value="CdExtranjeria" MAXLENGTH="100" <? if($_POST['DocumentoId']=='CdExtranjeria') echo 'CHECKED' ?>>
								C&eacute;dula de Extranjer&iacute;a
								</FONT>
							</TD>
							<TD >&nbsp;</TD>							
						</TR>
					</TBODY>
				</TABLE>
				<TABLE align="center" border="0" width="100%">
					<TBODY>
						<TR>
							<TD height="28" width="44%"><FONT size="-1">N&uacute;mero</FONT></TD>
							<TD height="28" width="56%"><INPUT name="NumDocId" size="25" MAXLENGTH="100" value="<?=$_POST['NumDocId']?>"></TD>
						</TR>
						<TR>
							<TD width="44%"><FONT size="-1">Expedida en</FONT></TD>
							<TD width="56%"><INPUT name="ExpedidaEn" size="25" MAXLENGTH="100" value="<?=$_POST['ExpedidaEn']?>"></TD>
						</TR>
					</TBODY>
				</TABLE>
			</TD>
			
			<TD>
				<TABLE align="center" border="0" width="100%">
				<TBODY>
					<TR>
						<TD colspan="2" width="100%"><P><FONT size="-1">
						<INPUT name="Sexo" type="radio" value="Femenino" <? if($_POST['Sexo']=='Femenino') echo 'CHECKED' ?>>
						Femenino</FONT></P></TD>
					</TR>
					<TR>
						<TD colspan="2" width="100%"><FONT size="-1">
						<INPUT name="Sexo" type="radio" value="Masculino"  <? if($_POST['Sexo']=='Masculino') echo 'CHECKED' ?>>
						Masculino</FONT></TD>
					</TR>
				</TBODY>
				</TABLE>
			</TD>
		</TR>
		</TBODY>
		</TABLE>
		</TD>
	</TR>
	<TR>
	
	</TR>
    <TR>
		<TD>
		<H2 ALIGN="CENTER">2. DIPLOMADO AL CUAL ASPIRA INGRESAR</H2>
		<TABLE width="100%" border="1">
		<TBODY>
		<TR bgColor="#cccccc" vAlign="top">
			<TD width="37%"><P><FONT size="-1"><B>2.1  DIPLOMADO </B></FONT></P></TD>
		</TR>
		</TBODY>
		</TABLE>
		<TABLE width="100%" border="1">
		<TBODY>
			<TR>
				<TD>
					<TABLE align="center" border="0" width="100%">
					<TBODY>
					<TR>
						<TD><FONT size="-1">Nombre</FONT></TD>
						<TD><FONT size="-1">								
							<select name="NombreDiplomado" id="NombreDiplomado">
							<option>Seleccione...</option>
							<option<? if($_POST['NombreDiplomado'] == 'DGP') echo " selected "; ?>>Diplomado en Gesti&oacute;n de Proyectos</option>
							<option<? if($_POST['NombreDiplomado'] == 'DGCH') echo " selected "; ?>>Diplomado en Gerencia del Capital Humano</option>
							<option<? if($_POST['NombreDiplomado'] == 'DFPEP') echo " selected "; ?>>Diplomado en Formulaci&oacute;n, Preparaci&oacute;n y Evaluaci&oacute;n de Proyectos</option>
							<option<? if($_POST['NombreDiplomado'] == 'DAG') echo " selected "; ?>>Diplomado en Alta Gerencia</option>
							<option<? if($_POST['NombreDiplomado'] == 'DGT') echo " selected "; ?>>Diplomado en Gerencia Tributaria</option>
							<option<? if($_POST['NombreDiplomado'] == 'DGV') echo " selected "; ?>>Diplomado en Gerencia de Ventas</option>
							<option<? if($_POST['NombreDiplomado'] == 'DGM') echo " selected "; ?>>Diplomado en Gerencia de Mercadeo</option>
							<option<? if($_POST['NombreDiplomado'] == 'DGF') echo " selected "; ?>>Diplomado en Gerencia Financiera</option>
							<option<? if($_POST['NombreDiplomado'] == 'DCD') echo " selected "; ?>>Diplomado en Competencias Directivas</option>
							<option<? if($_POST['NombreDiplomado'] == 'DRF') echo " selected "; ?>>Diplomado en Revisor&iacute;a Fiscal</option>
							<option<? if($_POST['NombreDiplomado'] == 'DS') echo " selected "; ?>>Diplomado en Gerencia para la Acreditaci&oacute;n de la Calidad en Salud Decreto 011/2006 NTC GP 1000</option>
							<option<? if($_POST['NombreDiplomado'] == 'DI9000') echo " selected "; ?>>Diplomado en Gerencia de Sistemas de Calidad, Norma ISO 9000, versi&oacute;n 2000</option>
							<option<? if($_POST['NombreDiplomado'] == 'DGC') echo " selected "; ?>>Diplomado en Dise&ntilde;o y Desarrollo de Herramientas Metodol&oacute;gicas para Implementar el Modelo de Gesti&oacute;n por Competencias</option>
							</select>
							</FONT>										
						</TD>
					</TR>
					</TBODY>
					</TABLE>
				</TD>
			</TR>
		</TBODY>
        </TABLE>
		</TD>
	</TR>	
	<TR>
	</TR>		
	<TR>
		<TD>
		<H2 ALIGN="CENTER">3. RESIDENCIA</H2>
		<TABLE border="1" width="100%">
		<TBODY>
		<TR bgColor="#cccccc" vAlign="top">
			<TD width="37%"><P><FONT size="-1"><B>3.1 RESIDENCIA</B></FONT></P></TD>
		</TR>
		<TR>
		<TD><TABLE align="center" border="0" width="100%">
		<TBODY>
		<TR>
			<TD width="9%"><FONT size="-1">Direcci&oacute;n</FONT></TD>
			<TD COLSPAN="3"><INPUT name="Direccion" size="60" MAXLENGTH="100" value="<?= $_POST['Direccion'] ?>"></TD>
		</TR>
		<TR>
			<TD><FONT size="-1">Comuna</FONT></TD>
			<TD><INPUT name="Comuna" ID="Comuna" size="30" MAXLENGTH="100" value="<?= $_POST['Comuna'] ?>"></TD>
			<TD><font size="-1">Estrato</font></TD>
			<TD WIDTH="40%"><FONT size="-1">
			<INPUT name="Estrato" ID="Estrato"  value="<?= $_POST['Estrato'] ?>" size=8 MAXLENGTH="25">
			</FONT></TD>
		</TR>
		<TR>
			<TD><FONT SIZE="-1">Barrio</FONT></TD>
			<TD><FONT size="-1"><input name="Barrio" value="<?= $_POST['Barrio'] ?>" size="30" MAXLENGTH="100"></FONT></TD>
			<TD><FONT size="-1">Ciudad: </FONT></TD>
			<TD><FONT size="-1"><input name="NombreCiudad" ID="NombreCiudad"  value="<?= $_POST['NombreCiudad'] ?>" size="30" MAXLENGTH="100"></FONT></TD>
		</TR>
		<TR>
			<TD width="9%">&nbsp;</TD>
			<TD width="43%"><FONT size="-1">
			<INPUT NAME="LugarResi" TYPE="radio" VALUE=Ciudad  <? if($_POST['LugarResi']=='Ciudad') echo 'CHECKED' ?>>
			Municipio
			<INPUT NAME="LugarResi" TYPE="radio" VALUE=Corregimiento <? if($_POST['LugarResi']=='Corregimiento') echo 'CHECKED' ?>>
			Corregimiento<BR>
			<INPUT NAME="LugarResi" TYPE="radio" VALUE=Vereda <? if($_POST['LugarResi']=='Vereda') echo 'CHECKED' ?>>
			Vereda </FONT></TD>
			<TD width="8%"><FONT size="-1">Depto:</FONT></TD>
			<TD><FONT size="-1"><INPUT name="Depto" size="30" MAXLENGTH="100" value="<?= $_POST['Depto'] ?>"></FONT></TD>
		</TR>
		<TR>
			<TD width="9%"><FONT size="-1">Pais</FONT></TD>
			<TD width="43%"><INPUT name="Pais" ID="Pais" value="<?= $_POST['Pais'] ?>" size="30" MAXLENGTH="50"></TD>
			<TD width="8%"><FONT size="-1">E-mail:</FONT></TD>
			<TD><FONT size="-1"><INPUT name="Email" ID="Email" size="30" MAXLENGTH="100" value="<?= $_POST['Email'] ?>"></FONT></TD>
		</TR>
		<TR>
			<TD width="9%"><FONT size="-1">Tel&eacute;fono</FONT></TD>
			<TD width="43%"><FONT size="-1">
			<INPUT name="Telefono"  value="<?= $_POST['Telefono'] ?>" size="10" MAXLENGTH="50"></FONT></TD>
			<TD width="8%"><FONT size="-1">Celular</FONT></TD>
			<TD><FONT size="-1">
			<? //TODO: Quite de "Celular" el atributo ID="Email" ?>
			<INPUT name="Celular" size="30" MAXLENGTH="50" value="<?= $_POST['Celular'] ?>"></FONT></TD>
		</TR>
		</TBODY>
		</TABLE>
		</TD>
	</TR>
	</TBODY>
	</TABLE>
	<p>&nbsp;</p>
	<H2 ALIGN="CENTER">4. INFORMACI&Oacute;N LABORAL </H2>
	<TABLE border="1" width="100%">
	<TBODY>
	<TR bgColor="#cccccc" vAlign="top">
		<TD width="37%"><P><FONT size="-1"><B>4.1 INFORMACIÓN LABORAL</B></FONT></P></TD>
	</TR>
	<TR>
		<TD><TABLE align="center" border="0" width="100%">
		<TBODY>
		<TR>
			<TD width="16%"><font size="-1">Nombre de la empresa </font></TD>
			<TD width="32%"><INPUT name="NombreDeLaEmpresa" ID="NombreDeLaEmpresa" size="30" MAXLENGTH="100" value="<?= $_POST['NombreDeLaEmpresa'] ?>"></TD>
			<TD width="12%"><FONT SIZE="-1">Cargo</FONT></TD>
			<TD WIDTH="40%"><FONT size="-1">
			<INPUT name="Cargo" ID="Cargo"  value="<?= $_POST['Cargo'] ?>" size="30" MAXLENGTH="100"></FONT></TD>
		</TR>
		<TR>
			<TD><FONT SIZE="-1">Direcci&oacute;n</FONT></TD>
			<TD><FONT size="-1">
			<input name="DireccionDeLaEmpresa" value="<?= $_POST['DireccionDeLaEmpresa'] ?>" size="30" MAXLENGTH="100">
			</FONT></TD>
			<TD><FONT SIZE="-1">Teléfono</FONT></TD>
			<TD><FONT size="-1">
			<INPUT name="TelefonoDeLaEmpresa" ID="TelefonoDeLaEmpresa"  value="<?= $_POST['TelefonoDeLaEmpresa'] ?>" size="30" MAXLENGTH="100"></FONT></TD>
		</TR>
		</TBODY>
		</TABLE>
		</TD>
	</TR>
	</TBODY>
	</TABLE>
	<p><BR></p>
	<H2 ALIGN="CENTER">5. ANTECEDENTES ACAD&Eacute;MICOS</H2>
	<TABLE border="1" width="100%">
	<TBODY>
	<TR bgColor="#cccccc">
		<TD><P><FONT size="-1"><B>5.1 ESTUDIOS PROFESIONALES DE PREGRADO</B></FONT></P></TD>
	</TR>
	<TR>
		<TD><TABLE align="center" border="0" width="100%">
		<TBODY>
		<TR>
			<TD width="32%"><FONT size="-1">Instituci&oacute;n</FONT></TD>
			<TD colSpan="3"><FONT size="-1">
			<INPUT name="Pre1NombreInstitucion" size="40" MAXLENGTH="100" value="<?= $_POST['Pre1NombreInstitucion'] ?>"></FONT></TD>
		</TR>
		<TR>
			<TD><FONT SIZE="-1">T&iacute;tulo Obtenido</FONT></TD>
			<TD colSpan="3"><FONT SIZE="-1">
			<INPUT NAME="Pre1Titulo"  value="<?= $_POST['Pre1Titulo'] ?>" SIZE="40" MAXLENGTH="100"></FONT></TD>
		</TR>
		</TBODY>
		</TABLE>
		</TD>
	</TR>
	</TBODY>
	</TABLE>
	<TR>
		<TD><CENTER>
		<BR>
		<TABLE  BORDER="0">
		<TR>
			<TD><INPUT NAME="Submit" TYPE="submit" VALUE="Registrar preinscripci&oacute;n"></TD>
			<TD><INPUT TYPE="reset" VALUE="Borrar formulario"></TD>
		</TR>
		</TABLE>
		<BR>
		</CENTER></TD>
	</TR>
	</TABLE>
	</FORM>
<?


}


?>
