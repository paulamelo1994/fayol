<?php
require "../functions.php";
$rootPath = "..";
pageInit("Actas y Documentos", "menu.php");
?>

<?
if (strstr(getIP(), "192.168."))
// echo '<table class="background_table" width="100%" border="0"><TR><TD HEIGHT="350">';
    echo '<table width="100%" border="0"><TR>';
else
    echo '<TABLE WIDTH="100%" BORDER=0><TR><TD HEIGHT="390">';
?>

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
<table style="width: 75%;" class="centrado" id="tablaActas">
    <tr>
        <td colspan="3">
            <H2> Actas de La Facultad </H2>
        </td>
    </tr>
    <tr >
	<td >
            <a href="http://administracion.univalle.edu.co/Comunidad/Actas/Consejo%20Facultad/index.php">
                <img src="../Images/folder-actas.jpg" style="width: 25%; height: 15%;" /><br>
                Actas del Consejo de Facultad
            </a>
        </td>
        <td >
            <a href="http://administracion.univalle.edu.co/Comunidad/Actas/Comite%20Curriculo/index.php">
                <img src="../Images/folder-actas.jpg" style="width: 25%; height: 15%;" /><br>
                Actas del Comit&eacute; de Curr&iacute;culo
            </a>
        </td>
        <td >
            <a href="http://administracion.univalle.edu.co/Comunidad/Actas/Contaduria/index.php">
                <img src="../Images/folder-actas.jpg" style="width: 25%; height: 15%;" /><br>
                Actas del Comit&eacute; de Contadur&iacute;a P&uacute;blica
            </a>
        </td>
    </tr>
    <tr >
	<td >
            <a href="http://administracion.univalle.edu.co/Comunidad/Actas/MaAdmon/index.php">
                <img src="../Images/folder-actas.jpg" style="width: 25%; height: 15%;" /><br>
                Actas de la Maestr&iacute;a en Administraci&oacute;n de Empresas y Ciencias de la Organizaci&oacute;n
            </a>
        </td>
        <td >
            <a href="http://administracion.univalle.edu.co/Comunidad/Actas/Comite_contabilidad_finanzas/index.php">
                <img src="../Images/folder-actas.jpg" style="width: 25%; height: 15%;" /><br>
                Actas del comit&eacute; del Departamento de Contabilidad y Finanzas
            </a>
        </td>
        <td >
            <a href="http://administracion.univalle.edu.co/Comunidad/Actas/DepAdminOrgan/index.php">
                <img src="../Images/folder-actas.jpg" style="width: 25%; height: 15%;" /><br>
                Actas del Departamento de Administraci&oacute;n y Organizaciones
            </a>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <H2> Documentos </H2>
        </td>
    </tr>
    <tr >
        <td></td>
	<td >
            <a href="http://administracion.univalle.edu.co/Comunidad/Actas/Juridico/index.php">
                <img src="../Images/icono_documento.png" style="width: 35%; height: 25%;" /><br>
                Normas y Conceptos Jur&iacute;dicos de Inter&eacute;s
            </a>
        </td>
        
        <td></td>
    </tr>
</table>


</TD>
</TR>
</TABLE>
<?
pageEnd();
?>