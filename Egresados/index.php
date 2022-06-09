<?
	require '../../functions.php';
	$rootPath = '../../';
	
	$valign = 'top';
	$_GET['egresados'] = true;
	
	PageInit('Formulario para egresados', '../menu.php');
   
   
function validarEgresado ($id_validar)
{
	$encontro = false;
	$archivo= fopen("egresados.txt" , "r");

	if ($archivo) 
	{
		while (!feof($archivo) && !$encontro ) 
		{
			$identificacion=fgets($archivo, 255);

			if(trim($identificacion) == trim($id_validar)){	$encontro = true; }

		}
	}
	fclose ($archivo);
	
	return $encontro;
}
   
	echo '<br>';
	//Cell('Formulario para egresados de la Facultad');
	?>
	<h1 class="shiny">Formulario para egresados de la Facultad</h1>
	<?
   
   if( isset($_POST['Submit']) && ($_POST['plan']=='NoOne' || !$_POST['documento'] || !$_POST['anno'] || !$_POST['mes'] || !$_POST['nombre'] || !$_POST['sexo'] ||
		!$_POST['direccionpersonal'] || !$_POST['telefonopersonal'] || !$_POST['ciudad'] || !$_POST['barrio'] ||
		!$_POST['email']) )
	{
   		echo '<BR>';
		Failed("Todo los campos son obligatorios, excepto los referentes al lugar donde labora");
		unset($_POST['Submit']);
	}
	

	
   if(isset($_POST['Submit']))
   {
	   if(!validarEgresado ($_POST['documento'] ))
	   {
			echo '<BR>';
			Failed("El documento de identidad no se encuentra registrado en el sistema de egresados. Por favor Intente nuevamente.");
			echo "<br><P ALIGN='CENTER'><A HREF='index.php'>Llenar el formulario de nuevo</A></P>";
			echo "<P ALIGN='CENTER'><A HREF='/'>Volver a la p&aacute;gina Inicial</A></P>";
			
			unset($_POST['Submit']);
		}
		else
		{
	
   		echo '<BR>';
		Succeded("La informaci&oacute;n ha sido enviada de manera exitosa.<BR>Gracias");
		echo "<P ALIGN='CENTER'><A HREF='index.php'>Llenar el formulario de nuevo</A></P>";
		echo "<P ALIGN='CENTER'><A HREF='/'>Volver a la p&aacute;gina Inicial</A></P>";
		
		mail('admegresados@univalle.edu.co', 'Informacion de egresado', "
			Plan:          	 $_POST[plan]
			No Documento:   $_POST[documento]
			Año/Mes Graduacion: $_POST[anno]/$_POST[mes]
			Nombre:         $_POST[nombre]
			Sexo:           $_POST[sexo]
			
			Datos personales:
			Direccion:  $_POST[direccionpersonal]
			Telefono:   $_POST[telefonopersonal]
			Ciudad:     $_POST[ciudad]
			Barrio:     $_POST[barrio]
			Email:      $_POST[email]
			
			Datos laborales:
			Direccion:  $_POST[direccionlaboral]
			Telefono:   $_POST[telefonolaboral]
			Empresa:    $_POST[empresa]
			Cargo:
			$_POST[cargo]
			", "From:$_POST[email]") ;
		}
	}
   else
   {
		?>
		<P>
		Este es el formulario que debe llenar si es egresado de nuestra Facultad para actualizar sus datos en 
		nuestras bases de datos. Si usted es egresado de varias carreras por favor llene este formulario una vez 
		para cada carrera de la que se gradu&oacute; (despu&eacute;s de enviar el formulario se le 
		preguntar&aacute; si desea llenarlo de nuevo). <B>Todos los campos, excepto los de informaci&oacute;n 
		sobre la empresa donde labora, son obligatorios.</B>
		</P>
		<BR>
		<FORM METHOD="POST" action="">
		<TABLE BORDER="0" ALIGN="CENTER">
		<TR>
			<TD VALIGN="TOP"><B>Doc.Identidad</B></TD>
			<TD COLSPAN="3">
			<INPUT NAME="documento" TYPE="text" ID="documento" VALUE="<?= $_POST['documento'] ?>" SIZE="32">
			</TD>
		</TR>
		<TR>
			<TD VALIGN="TOP"><B>Plan de Estudio</B></TD>
			<TD COLSPAN="3">
			<SELECT NAME="plan" ID="plan">
			<OPTION VALUE='NoOne' SELECTED>--</OPTION>
			<OPTION VALUE='ContDiur'>Contaduria Diurno</OPTION>
			<OPTION VALUE='ContNoct'>Contaduria Nocturno</OPTION>
			<OPTION VALUE='AdmiDiur'>Administracion Diurno</OPTION>
			<OPTION VALUE='AdmiNoct'>Administracion Nocturno</OPTION>
			<OPTION VALUE='Comercio'>Comercio Exterior</OPTION>
			<OPTION VALUE='NoOne' SELECTED>--</OPTION>
			<OPTION VALUE='MaAdmon'>Maestria en Administracion</OPTION>
			<OPTION VALUE='MaOrgan'>Maestria en Ciencias de la Organizacion</OPTION>
			<OPTION VALUE='MaPolit'>Maestria en Politicas Publicas</OPTION>
			<OPTION VALUE='NoOne' SELECTED>--</OPTION>
			<OPTION VALUE='EsFinan'>Espec. Finanzas</OPTION>
			<OPTION VALUE='EsMarke'>Espec. Marketing Estrategico</OPTION>
			<OPTION VALUE='EsAdmTo'>Espec. Administracion Total de la Calidad y la Productividad</OPTION>
			<OPTION VALUE='EsAdmPu'>Espec. Administracion Publica</OPTION>
			<OPTION VALUE='EsPolit'>Espec. Politica Publica y Gestion Publica</OPTION>
			</SELECT></TD>
		</TR>
		<TR>
			<TD VALIGN="TOP"><B>Fecha Grado</B></TD>
			<TD>A&ntilde;o: 
			<SELECT NAME="anno" ID="anno">
			<?
			for( $i=1990 ; $i!=2011; $i++ )
			echo "<OPTION VALUE='$i'>$i</OPTION>";
			?>
			</SELECT> 
			Mes: 
			<SELECT NAME="mes" ID="mes">
			<OPTION VALUE='Enero'>Enero</OPTION>
			<OPTION VALUE='Febrero'>Febrero</OPTION>
			<OPTION VALUE='Marzo'>Marzo</OPTION>
			<OPTION VALUE='Abril'>Abril</OPTION>
			<OPTION VALUE='Mayo'>Mayo</OPTION>
			<OPTION VALUE='Junio'>Junio</OPTION>
			<OPTION VALUE='Julio'>Julio</OPTION>
			<OPTION VALUE='Agosto'>Agosto</OPTION>
			<OPTION VALUE='Septiembre'>Septiembre</OPTION>
			<OPTION VALUE='Octubre'>Octubre</OPTION>
			<OPTION VALUE='Noviembre'>Noviembre</OPTION>
			<OPTION VALUE='Diciembre'>Diciembre</OPTION>
			</SELECT></TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
		</TR>
		<TR>
			<TD VALIGN="TOP"><B>Nombre y Apellidos </B></TD>
			<TD><INPUT NAME="nombre" TYPE="text" ID="nombre" VALUE="<?= $_POST['nombre'] ?>" MAXLENGTH="40"></TD>
			<TD><B>Sexo</B></TD>
			<TD><SELECT NAME="sexo" ID="sexo">
			<OPTION VALUE='M'>M</OPTION>
			<OPTION VALUE='F'>F</OPTION>
			</SELECT></TD>
		</TR>
		<TR>
			<TD COLSPAN="4"><HR></TD>
		</TR>
		<TR>
			<TD VALIGN="TOP"><B>Direcci&oacute;n personal </B></TD>
			<TD><INPUT NAME="direccionpersonal" TYPE="text" ID="direccionpersonal" VALUE="<?= $_POST['direccionpersonal'] ?>" MAXLENGTH="40"></TD>
			<TD><B>Tel&eacute;fono</B></TD>
			<TD><INPUT NAME="telefonopersonal" TYPE="text" ID="telefonopersonal" VALUE="<?= $_POST['telefonopersonal'] ?>" MAXLENGTH="40"></TD>
		</TR>
		<TR>
			<TD VALIGN="TOP"><B>Barrio</B></TD>
			<TD><INPUT NAME="barrio" TYPE="text" ID="barrio" VALUE="<?= $_POST['barrio'] ?>" MAXLENGTH="40"></TD>
			<TD><B>Ciudad</B></TD>
			<TD><INPUT NAME="ciudad" TYPE="text" ID="ciudad" VALUE="<?= $_POST['ciudad'] ?>" MAXLENGTH="40"></TD>
		</TR>
		<TR>
			<TD VALIGN="TOP"><B>E-mail</B></TD>
			<TD COLSPAN="3"><INPUT NAME="email" TYPE="text" ID="email" VALUE="<?= $_POST['email'] ?>" SIZE="40" MAXLENGTH="50"></TD>
		</TR>
		<TR>
			<TD COLSPAN="4"><HR></TD>
		</TR>
		<TR>
			<TD VALIGN="TOP"><B>Nombre Empresa donde labora </B></TD>
			<TD COLSPAN="3"><INPUT NAME="empresa" TYPE="text" ID="empresa" VALUE="<?= $_POST['empresa'] ?>" SIZE="40" MAXLENGTH="50"></TD>
		</TR>
		<TR>
			<TD VALIGN="TOP"><B>Direcci&oacute;n laboral </B></TD>
			<TD><INPUT NAME="direccionlaboral" TYPE="text" ID="direccionlaboral" VALUE="<?= $_POST['direccionlaboral'] ?>" MAXLENGTH="40"></TD>
			<TD><B>Tel&eacute;fono</B></TD>
			<TD><INPUT NAME="telefonolaboral" TYPE="text" ID="telefonolaboral" VALUE="<?= $_POST['telefonolaboral'] ?>" MAXLENGTH="40"></TD>
		</TR>
		<TR>
			<TD VALIGN="TOP"><B>Cargo</B></TD>
			<TD COLSPAN="3"><TEXTAREA NAME="cargo" COLS="50" ROWS="5" ID="cargo"><?= $_POST['cargo'] ?></TEXTAREA></TD>
		</TR>
		<TR>
			<TD COLSPAN="4" ALIGN="CENTER" VALIGN="TOP"><INPUT TYPE="submit" NAME="Submit" VALUE="Enviar información"></TD>
		</TR>
		</TABLE>
		</FORM>
		<?
	}
	
	PageEnd();
?>