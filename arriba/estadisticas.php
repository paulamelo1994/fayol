<?
   require 'functions.php';
   $rootPath = './';
   
   PageInit('Estadisticas de uso del servicio de materiales de apoyo', 'correo.php');
   
   ?> <h1 class="shiny">Estadisticas de uso del servicio de materiales de apoyo<BR>Desde Enero 01 de 2006</h1> <?
   
   $con = @DBConnect("profesores");
   
   if(empty($con))//si no hay conexion
   {
   		echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no se encuentran disponibles las estadisticas, por favor intentelo m&aacute;s tarde.</p>";
   }
   else
   {
	   $rs = db_query("SELECT COUNT(DISTINCT login) AS howmany FROM registro WHERE tipo='E'");
	   $obj = pg_fetch_object($rs);
	   $estad[] = $obj->howmany;
	   # Cantidad de estudiantes que han usado el servicio en la ultima semana
	   $rs = db_query("SELECT COUNT(DISTINCT login) AS howmany FROM registro WHERE tipo='E' AND date(tiempo)>=date('now')-7");
	   $obj = pg_fetch_object($rs);
	   $estad[] = $obj->howmany;
	   # Cantidad de veces que ha sido usado por estudiantes
	   $rs = db_query("SELECT COUNT(*) AS howmany FROM registro WHERE tipo='E'");
	   $obj = pg_fetch_object($rs);
	   $estad[] = $obj->howmany;
	   # Cantidad de docentes que estan haciendo uso de el
	   $rs = db_query("SELECT COUNT(DISTINCT login) AS howmany FROM registro WHERE tipo='P'");
	   $obj = pg_fetch_object($rs);
	   $estad[] = $obj->howmany;
	   # Cantidad de docentes que han actualizado sus materiales en la &uacute;ltima semana
	   $rs = db_query("SELECT COUNT(DISTINCT login) AS howmany FROM registro WHERE tipo='P' AND date(tiempo)>=date('now')-7");
	   $obj = pg_fetch_object($rs);
	   $estad[] = $obj->howmany;
	   # Cantidad de veces que los docentes han entrado a actualizar sus archivos
	   $rs = db_query("SELECT COUNT(*) AS howmany FROM registro WHERE tipo='P'");
	   $obj = pg_fetch_object($rs);
	   $estad[] = $obj->howmany;
	   # Ultima actualizacion de documentos por parte de un docente
	   $rs = db_query("SELECT MAX(tiempo) AS howmany FROM registro WHERE tipo='P'");
	   $obj = pg_fetch_object($rs);
	   $tiempo = split(" ",$obj->howmany,2);
	   $estad[] = $tiempo[0];
	   # Ultima visita de un estudiante a los materiales de un docente
	   $rs = db_query("SELECT MAX(tiempo) AS howmany FROM registro WHERE tipo='E'");
	   $obj = pg_fetch_object($rs);
	   $tiempo = split(" ",$obj->howmany,2);
	   $estad[] = $tiempo[0];
	   
	   $indice = 0;
?>
		<BR />
	   <TABLE WIDTH="90%"  BORDER="0">
		<TR>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><IMG SRC="Images/BulletNaranja.gif" WIDTH="9" HEIGHT="9" alt=""></TD>
			<TD>Cantidad de estudiantes que lo han usado</TD>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><SPAN STYLE="color: #009966; font-weight: bold;">
				<?= $estad[$indice++] ?>
			</SPAN></TD>
		</TR>
		<TR>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><IMG SRC="Images/BulletNaranja.gif" WIDTH="9" HEIGHT="9" alt=""></TD>
			<TD>Cantidad de estudiantes que han usado el servicio en la &uacute;ltima semana </TD>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><SPAN STYLE="color: #009966; font-weight: bold;">
				<?= $estad[$indice++] ?>
			</SPAN></TD>
		</TR>
		<TR>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><IMG SRC="Images/BulletNaranja.gif" WIDTH="9" HEIGHT="9" alt=""></TD>
			<TD>Cantidad de veces que ha sido usado por estudiantes</TD>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><SPAN STYLE="color: #009966; font-weight: bold;">
				<?= $estad[$indice++] ?>
			</SPAN></TD>
		</TR>
		<TR>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><IMG SRC="Images/BulletNaranja.gif" WIDTH="9" HEIGHT="9" alt=""></TD>
			<TD>Cantidad de docentes que est&aacute;n haciendo uso de &eacute;l </TD>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><SPAN STYLE="color: #009966; font-weight: bold;">
				<?= $estad[$indice++] ?>
			</SPAN></TD>
		</TR>
		<TR>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><IMG SRC="Images/BulletNaranja.gif" WIDTH="9" HEIGHT="9" alt=""></TD>
			<TD>Cantidad de docentes que han actualizado sus materiales en la &uacute;ltima semana </TD>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><SPAN STYLE="color: #009966; font-weight: bold;">
				<?= $estad[$indice++] ?>
			</SPAN></TD>
		</TR>
		<TR>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><IMG SRC="Images/BulletNaranja.gif" WIDTH="9" HEIGHT="9" alt=""></TD>
			<TD>Cantidad de veces que los docentes han entrado a actualizar sus archivos </TD>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><SPAN STYLE="color: #009966; font-weight: bold;">
				<?= $estad[$indice++] ?>
			</SPAN></TD>
		</TR>
		<TR>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><IMG SRC="Images/BulletNaranja.gif" WIDTH="9" HEIGHT="9" alt=""></TD>
			<TD>&Uacute;ltima actualizaci&oacute;n de documentos por parte de un docente </TD>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><SPAN STYLE="color: #009966; font-weight: bold;">
				<?= $estad[$indice++] ?>
			</SPAN></TD>
		</TR>
		<TR>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><IMG SRC="Images/BulletNaranja.gif" WIDTH="9" HEIGHT="9" alt=""></TD>
			<TD>&Uacute;ltima visita de un estudiante a los materiales de un docente </TD>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><SPAN STYLE="color: #009966; font-weight: bold;">
				<?= $estad[$indice++] ?>
			</SPAN></TD>
		</TR>
<?
	   unset($estadisticas);
	   # Cantidad de visitas a la pagina de cada docente
	   $rs = db_query("SELECT howmany,nombre FROM (SELECT docente,COUNT(login) AS howmany FROM registro WHERE tipo='E' GROUP BY docente) AS a JOIN profesores ON a.docente=profesores.serial ORDER BY nombre");
	   while( $obj = pg_fetch_object($rs) )
		 $estadisticas[$obj->nombre][0] = $obj->howmany;
	   # Cantidad de veces que cada docente se ha loggeado
	   $rs = db_query("SELECT howmany,nombre FROM (SELECT login,COUNT(login) AS howmany FROM registro WHERE tipo='P' GROUP BY login) AS a JOIN profesores ON a.login=profesores.serial ORDER BY nombre");
	   while( $obj = pg_fetch_object($rs) )
		 $estadisticas[$obj->nombre][1] = $obj->howmany;
?>
		<TR>
			<TD ALIGN="CENTER" VALIGN="MIDDLE"><IMG SRC="Images/BulletNaranja.gif" WIDTH="9" HEIGHT="9" alt=""></TD>
			<TD COLSPAN="2">Cantidad de estudiantes que han usado el servicio por cada docente</TD>
		</TR>
		<TR>
		   <TD COLSPAN="3">
		   <BR>
			  <TABLE ALIGN="CENTER">
				 <TR>
					<TD STYLE="color: white; font-weight:bold;" BGCOLOR="#006600">Nombre Docente</TD>
					<TD STYLE="color: white; font-weight:bold;" BGCOLOR="#006600"># Estudiantes</TD>
					<TD STYLE="color: white; font-weight:bold;" BGCOLOR="#006600"># Actualizaciones</TD>
				</TR>
<?
		   foreach( $estadisticas as $login => $estadis )
			  echo "<TR><TD STYLE='color: #009966; font-weight: bold;'>$login</TD>
						<TD STYLE='text-align:center; color: #009966; font-weight: bold;'>".((int)$estadis[0])."</TD>
						<TD STYLE='text-align:center; color: #009966; font-weight: bold;'>".((int)$estadis[1])."</TD>
						</TR>"
?>
			  </TABLE>
			  <BR>
		   </TD>
		</TR>
	</TABLE>
<?
	}
   PageEnd();
?>