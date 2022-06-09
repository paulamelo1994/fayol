<?
require "../functions.php";
$rootPath = "..";
pageInit("Proyecto Intranet!!", "menu.php");
?>
<!-- Mostrar la imagen solo si estan dentro de la U -->
<?
if (strstr(getIP(), "192.168."))
// echo '<table class="background_table" width="100%" border="0"><TR><TD HEIGHT="350">';
    echo '<table width="100%" border="0"><TR>';
else
    echo '<TABLE WIDTH="100%" BORDER=0><TR><TD HEIGHT="390">';
?>
<!-- <CENTER>
 <H1 style="color: red;">&iexcl; Nuestra Comunidad !</H1>
 <H2 style="color: red;">Facultad de Ciencias de la Administraci&oacute;n</H2>
 <br>
 <div align="justify"><H3>
 Esta p&aacute;gina esta destinada al acceso exclusivo de estudiantes, docentes y personal administrativo. El acceso a algunos sitios estar&aacute; restringido a estos usuarios y su clave y nombre de usuario (login) pueden ser requeridos.
 </H3></div>
 <H3 align="right" style="color: red;">
 Gracias.
 </H3>
 </CENTER>
 </TD></TR></TABLE> 
-->
<script language="javascript" type="text/JavaScript">
    var nImage = 0;
    var imagenes = new Array 
    (
    "Imagenes/comunidad_01.jpg"
<?
$dir = opendir('Imagenes/');
while ($file = readdir($dir)) {
    if ($file[0] != '.' && $file != 'default.jpg' && (strstr($file, '.jpg') !== false || strstr($file, '.gif') !== false)) {
	echo ", \"Imagenes/$file\"";
    }
}
?>
	      );
	
		  function imageCycle()
		  {
		      nImage = Math.floor(Math.random()*imagenes.length);
		      document["laImagen"].src = imagenes[nImage];
		  }
	
		  setInterval("imageCycle()", 8000);
</script>
<Table>
    <tr>
	<td><H1 style="color: red;" align="center">Informaci&oacute;n financiera y presupuestal</H1>
	    <H2 style="color: red;" align="center">2011 - 2015</H2>
	    <ul>
	      <li><a href="Informacion-Financiera/1.Informe Financiero y Presupuestal_Vigencia 2011.pdf" target="_blank">2011</a></li>
	      <li><a href="Informacion-Financiera/2.Informe Financiero y Presupuestal_Vigencia  2012.pdf" target="_blank">2012</a></li>
	      <li><a href="Informacion-Financiera/3.Informe Financiero y Presupuestal_Vigencia 2013.pdf" target="_blank">2013</a></li>
	      <li><a href="Informacion-Financiera/4.Informe Financiero y  Presupuestal_Vigencia 2014.pdf" target="_blank">2014</a></li>
	      <li><a href="http://fayol.univalle.edu.co/bannerhtml5/Informe%20Pptal_Financiero_Vig_2015.pdf" target="_blank">2015</a><br>
		  <li><a href="#" target="_blank">2018:</a><br>
		  </li>
		  <br>
		  &nbsp;&nbsp;-<a href="http://fayol.univalle.edu.co/bannerhtml5/Informe Gestion Decano 2018vDef.docx
" target="_blank">Informe de Gestion Decano (2018)</a><br><br>
		  &nbsp;&nbsp;-<a href="http://fayol.univalle.edu.co/bannerhtml5/INFORME DE GESTION VICEDECANATURA ACADEMICA 2018 Def.docx" target="_blank">Informe de Gestion Vicedecanatura (2018)</a><br><br>
		  &nbsp;&nbsp;-<a href="http://fayol.univalle.edu.co/bannerhtml5/INFORME DE GESTION VICE INVESTIGACIONES  2016-2018.docx" target="_blank">Informe de Gestion Vicedecanatura de Investigaciones y Posgrados (2018)</a><br><br>
	        </CENTER>
         
      </ul></td>
	</tr>
</table>


</TD>
</TR>
</TABLE>
<?
pageEnd();
?>
