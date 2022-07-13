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
<table style="width: 100%;" class="centrado" id="tableComunidad">
    <tr >
	<td colspan="2">
            <H1 style="color: red;">&iexcl; Nuestra Comunidad !</H1>
            <H2 style="color: red;">Facultad de Ciencias de la Administraci&oacute;n</H2>
            <p>
                Esta p&aacute;gina esta destinada al acceso exclusivo de estudiantes, docentes y personal administrativo.
                El acceso a algunos sitios estar&aacute; restringido a estos usuarios y su clave y nombre de usuario (login)
                pueden ser requeridos.
            </p>
            <!--
            <br><br>
            http://www.plataformastreaming.com/universidaddelvalle/
            -->	    
            <H3 align="right" style="color: red;">
                Gracias.
            </H3>
        </td>
	<!-- <td><IMG SRC="Imagenes/comunidad-18.jpg" name="Imagen" ALT=""></td> -->
    </tr>
    <tr> 
        <td colspan="2"><hr></td>
    </tr>
    <tr>
        <td>
            
            <table class="centrado">
                <!-- tr>
                    <td colspan="2">Lo que sucede en tu Cede</td>
                    
                </tr --> 
                <tr>
                    <td style="width: 25%">
                        <a href="http://administracion.univalle.edu.co/Comunidad/himnos.php">
                            <img src="../Images/icono_himno.png" style="width: 29%; height: 39%;" />
                            <br>Himnos
                        </a>
                    </td>
                    <td style="width: 25%">
                        <a href="https://www.youtube.com/user/UnivalleCanalFCA" target="_blank">
                            <img src="../Images/icono_video.png" style="width: 45%; height: 40%;" />
                            <br>Videos
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        <a href="http://administracion.univalle.edu.co/Comunidad/galeria.php">
                            <img src="../Images/icono_foto.png" style="width: 35%; height: 40%;" />
                            <br>Fotos
                        </a>
                    </td>
                    <td style="width: 25%">
                        <a href="http://administracion.univalle.edu.co/Comunidad/Streaming.php">
                            <img src="../Images/icono_streaming.png" style="width: 35%; height: 40%;" />
                            <br>Eventos en Vivo - Streaming
                        </a>
                    </td>
                </tr>
            </table>
        </td>
        
        <td><!-- la letra de estos iconos es arial black a 18 -->
            <a href="http://administracion.univalle.edu.co/Comunidad/actasdocumentos.php">
                <img src="../Images/icono_actasTexto.jpg" style="width: 85%; height: 80%;" />
            </a>
        </td>
    </tr>
    <tr>
        <td> <!-- la letra de estos iconos es arial black a 22 --> 
            <a href="http://administracion.univalle.edu.co/Comunidad/Egresados/archivos.php">
                <img src="../Images/icono_egresadosTexto.png" style="width: 70%; height: 65%"  />
            </a>
        </td>
        
        <td> <!-- la letra de estos iconos es arial black a 22 -->
            <a href="http://administracion.univalle.edu.co/Comunidad/BolsaEmpleos/index.php">
                <img src="../Images/icono_bolsaEmpleoTexto.png" style="width: 80%; height: 75%" />
            </a>
        </td>
        
    </tr>
    <tr>
        <td colspan="2">
            Administracion (Salas, Auditorios, Salones)
        </td>      
    </tr>
</table>


</TD>
</TR>
</TABLE>
<?
pageEnd();
?>
