<?
  include "functions.php";
  $rootPath = '.';
  
  NoDefaultDivision();
  PageInit("Mapa del Sitio", "correo.php", 0, 'center');
?>

<? SectionInit("Mapa del Sitio") ?>
   <?
/* Sitemap version 2.0 (C) copyright Metalhead 2003
 * Página web: http://www.metalhead.ws/phpbin/
 * Este script se distribuye bajo los términos de la
 * Licencia Pública General GNU (GNU GPL)
 * Una copia de la GPL ha sido incluída con el script. */
/* Sección de Configuración */
$showsize = 1; /* Mostrar el tamaño de los archivos? 1 = sí, 0 = no */
/* Array de tipos de archivos visualizados y sus respectivos iconos.
 * Sintaxis: $display[filetype] = "picture"; */
$display[php] = "php.gif";
$display[html] = "html.gif";
$display[htm] = "html.gif";
$display[shtml] = "html.gif";
/* Array de directorios que no deben ser visualizados.
 * Sintaxis: $excludedir[] = "directory"; */
$excludedir[] = "temp";
$excludedir[] = "Actas";
$excludedir[] = "pagina web";
$excludedir[] = "o1c2u3l4t5oz";
$excludedir[] = "phpmailer";
$excludedir[] = "googleCalendar";
$excludedir[] = "soaking";
$excludedir[] = "AsignacionAuditorio";
$excludedir[] = "tmp";
$excludedir[] = "WebCalendar";
$excludedir[] = "WebCalendar-admin";
$excludedir[] = "thumbnail generator";
$excludedir[] = "PostNuke";
$excludedir[] = "php-scripts";
$excludedir[] = "phpPgAdmin-saltaren";
$excludedir[] = "Nuke";
$excludedir[] = "langela";
$excludedir[] = "Intranet";
$excludedir[] = "lib";
$excludedir[] = "install";
$excludedir[] = "Inventario";
$excludedir[] = "Soporte";
$excludedir[] = "AsignacionSalas";
$excludedir[] = "ControlUsuarios";
$excludedir[] = "Profesores";
$excludedir[] = "Pedidos";
$excludedir[] = "Copia de ircecali";
$excludedir[] = "Docentes";
$excludedir[] = "pg";
$excludedir[] = "cendofa";
$excludedir[] = "Software";
$excludedir[] = "Encuentroascolfa";
$excludedir[] = "Estadisticas";
$excludedir[] = "Acreditacion";
$excludedir[] = "Acreditacion1";
$excludedir[] = "archivos";
$excludedir[] = "jpgraph";
$excludedir[] = "Recursos";
$excludedir[] = "admin";
$excludedir[] = "solar";
$excludedir[] = "Files";
$excludedir[] = "source";
$excludedir[] = "web";
$excludedir[] = "estarbienspa";
$excludedir[] = "educacioninternacional";
$excludedir[] = "FLASH";
$excludedir[] = "VIDEO";
$excludedir[] = "cuadernos";
$excludedir[] = "extras";
$excludedir[] = "libros";
$excludedir[] = "pliegos";
$excludedir[] = "readme";
$excludedir[] = "RegistroPostgrado";
$excludedir[] = "ProgramacionAcademica";
$excludedir[] = "Asignaturas";
$excludedir[] = "Documentos administracion";
$excludedir[] = "Pensums";
$excludedir[] = "resultadosPruebasProfesionales";
$excludedir[] = "MaterialProgramas";
$excludedir[] = "MaterialMaestria2";
$excludedir[] = "Material_magisadm";
$excludedir[] = "notas";
$excludedir[] = "Diplomados";
$excludedir[] = "Especializaciones";
$excludedir[] = "Maestrias";
$excludedir[] = "Pregrados";
$excludedir[] = "uploads";
$excludedir[] = "BITACORA";
$excludedir[] = "BoletinEspefinanzas";
$excludedir[] = "Seminario";
$excludedir[] = "Images";
$excludedir[] = "Memorias";
$excludedir[] = "Test";
$excludedir[] = "Encuentro";
$excludedir[] = "Agenda";
$excludedir[] = "Comite Curriculo"; 
$excludedir[] = "Comite_contabilidad_finanzas"; 
$excludedir[] = "Consejo Facultad"; 
$excludedir[] = "Contaduria"; 
$excludedir[] = "MaAdmon"; 
$excludedir[] = "Noticias"; 
/* Array de archivos que no serán visualizados. */
$excludefile[] = "index.php";
$excludefile[] = "Autenticate.php";
$excludefile[] = "authentication.php";
$excludefile[] = "cerrar-foro.php";
$excludefile[] = "egresados.txt";
$excludefile[] = "FotoCampus.jpg";
$excludefile[] = "FramesForo.php";
$excludefile[] = "indexComunidad.php";
$excludefile[] = "mainmenu.php";
$excludefile[] = "Material";
$excludefile[] = "indexComunidad.php";
$excludefile[] = "menu.php";
$excludefile[] = "Bitacora.php";
$excludefile[] = "blank.php";
$excludefile[] = "contador.php";
$excludefile[] = "functions.php";
$excludefile[] = "index1.php";
$excludefile[] = "index_anterior.php";
$excludefile[] = "install.php";
$excludefile[] = "interna.php";
$excludefile[] = "nedstat.htm";
$excludefile[] = "parser.php";
$excludefile[] = "pestanas.php";
$excludefile[] = "phpinfo.php";
$excludefile[] = "registroDiplomados.php";
$excludefile[] = "section.php";
$excludefile[] = "SendMailAuth.php";
$excludefile[] = "sisinfo.sdr";
$excludefile[] = "swapImages.js";
$excludefile[] = "WebCalendar.tgz";
$excludefile[] = "grant.php";
$excludefile[] = "Autenticar.php";
$excludefile[] = "inicioPrivado.php";
$excludefile[] = "manipPrivado.php";
$excludefile[] = "validar.php";
$excludefile[] = "EraseFile.php";
$excludefile[] = "adicionar_programa.php"; 
$excludefile[] = "administrar.php"; 
$excludefile[] = "info.php"; 
$excludefile[] = "www.php"; 
$excludefile[] = "salir.php"; 
$excludefile[] = "noticias.php"; 
$excludefile[] = "menu.php"; 
$excludefile[] = "operaciones.php";
$excludefile[] = "correo.php"; 
$excludefile[] = "correo-uv.php";
$excludefile[] = "formulario.php";
$excludefile[] = "evento.php";
$excludefile[] = "VistaPrevia.php";
$excludefile[] = "preinscripcion.php";
$excludefile[] = "listadoPreinscritos.php";
$excludefile[] = "cuadernos.php";
$excludefile[] = "detalleLibros.php";
$excludefile[] = "indexPublicaciones.php";
$excludefile[] = "inicio.php";
$excludefile[] = "libros.php";
$excludefile[] = "libros1.php";
$excludefile[] = "pliegos.php";
$excludefile[] = "indexProgramas.php";
$excludefile[] = "menuProgramacion.php";
$excludefile[] = "FormatoConsulta.php";
$excludefile[] = "FormatoRegistro.php";
$excludefile[] = "access.php";
$excludefile[] = "autenticacion.php"; 
$excludefile[] = "FormatoMPP.php"; 
$excludefile[] = "preregistro.php"; 
$excludefile[] = "bitacora.php"; 
$excludefile[] = "conversationClub.php"; 
$excludefile[] = "creditos.php"; 
$excludefile[] = "revisar.php"; 
$excludefile[] = "sesiones.php"; 
$excludefile[] = "Authenticate.php"; 
$excludefile[] = "pagAnterior.php"; 
$excludefile[] = "cambiar.php"; 
$excludefile[] = "indexold.php"; 
?>
<html><head><title>Mapa del sitio web</title></head>
<body>
<b>Mapa del sitio web</b><p>
<?
$stime = gettimeofday();
/* prueba inicial... */
$root = getcwd();
$pre = explode("/", $REQUEST_URI);
array_pop($pre);
$prefix = join("/", $pre);
/* Si el script se encuentra en un subdirectorio, descomenta las
 * siguientes dos lineas para generar el árbol de todos los
 * archivos y directorios del servidor web */
//$root = str_replace($prefix, "", $root);
//$prefix = "";
$root .= "/";
/* Visualiza el nombre del servidor y el directorio */
echo "<table cellspacing=0 cellpadding=0 border=0>\n";
echo "<tr><td><img align=absmiddle src=Images/mapaPag/server.gif> http://$SERVER_NAME";
echo "$prefix/";
echo "</td></tr><tr><td><img align=absmiddle src=Images/mapaPag/vertical.gif></td></tr>\n";
function get_extension($name)
{
   $array = explode(".", $name);
   $retval = strtolower(array_pop($array));
   return $retval;
}
/* Rekurencja... */
function list_dir($chdir)
{
   /* algunas variables globales y un poco de orden */
   global $root, $prefix, $PHP_SELF, $SERVER_NAME, $showsize, $display, $excludedir, $excludefile;
   unset($sdirs);
   unset($sfiles);
   chdir($chdir);
   $self = basename($PHP_SELF);
  /* abrimos el directorio actual */
  $handle = opendir('.');
  /* leemos el directorio. Si el objeto
  * es un directorio lo introducimos a
  * $sdirs, si se trata de un archivo
  * que nos interesa (exceptuando el
  * que contiene este script), lo colocamos
  * en $sfiles */
  while ($file = readdir($handle))
  {
    if(is_dir($file) && $file !=
       "." && $file != ".."
       && !in_array($file,
         $excludedir))
    { $sdirs[] = $file; }
    elseif(is_file($file)
      && $file != "$self"
      && array_key_exists(
        get_extension($file),
          $display)
      && !in_array($file,
        $excludefile))
    { $sfiles[] = $file; }
  }
   /* contamos las barras para saber la profundidad a la que estamos
    * o en la estructura de directorios y cuántos segmentos debemos
    * usar de la rama en la que estamos */
   $dir = getcwd();
   $dir1 = str_replace($root, "", $dir."/");
   $count = substr_count($dir1, "/") + substr_count($dir1, "\\");
   /* mostramos por pantalla los nombres y obtenemos la lista recursiva de los
    * directorios */
   if(is_array($sdirs)) {
      sort($sdirs);
      reset($sdirs);
      for($y=0; $y<sizeof($sdirs); $y++) {
         echo "<tr><td>";
         for($z=1; $z<=$count; $z++)
         { echo "<img align=absmiddle src=Images/mapaPag/vertical.gif>&nbsp;&nbsp;&nbsp;"; }
         if(is_array($sfiles))
         { echo "<img align=absmiddle src=Images/mapaPag/verhor.gif>"; }
         else
         { echo "<img align=absmiddle src=Images/mapaPag/verhor1.gif>"; }
         echo "<img align=absmiddle src=Images/mapaPag/folder.gif>
               <a href=\"http://$SERVER_NAME$prefix/$dir1$sdirs[$y]\">$sdirs[$y]</a>";
         list_dir($dir."/".$sdirs[$y]);
      }
   }
   chdir($chdir);
   /* visitamos cada uno de los elementos del array de archivos
    * y los imprimimos */
   if(is_array($sfiles)) {
      sort($sfiles);
      reset($sfiles);
      $sizeof = sizeof($sfiles);
      /* ¿qué tipos de ficheros deben ser visualizados? */
      for($y=0; $y<$sizeof; $y++) {

         echo "<tr><td>";
         for($z=1; $z<=$count; $z++)
         { echo "<img align=absmiddle src=Images/mapaPag/vertical.gif>&nbsp;&nbsp;&nbsp;"; }
         if($y == ($sizeof -1))
         { echo "<img align=absmiddle src='Images/mapaPag/verhor1.gif'>"; }
         else
         { echo "<img align=absmiddle src=Images/mapaPag/verhor.gif>"; }
         echo "<img align=absmiddle src=Images/mapaPag/";
         echo $display[get_extension($sfiles[$y])].">";
         echo "<a href=\"http://$SERVER_NAME$prefix/$dir1$sfiles[$y]\">$sfiles[$y]</a>";
         if($showsize) {
            $fsize = @filesize($sfiles[$y])/1024;
            printf(" (%.2f kB)", $fsize);
         }
         echo "</td></tr>";
         echo "<tr><td>";
      }
      echo "<tr><td>";
      for($z=1; $z<=$count; $z++)
      { echo "<img align=absmiddle src=Images/mapaPag/vertical.gif>&nbsp;&nbsp;&nbsp;"; }
      echo "</td></tr>\n";
   }
}
list_dir($root);
echo "</table>\n";
/* ¿Cuánto tiempo nos llevó? */
$ftime = gettimeofday();
$time = round(($ftime[sec] + $ftime[usec] / 1000000) - ($stime[sec] + $stime[usec] / 1000000), 5);
echo "<center>Tiempo de generación de la página: $time segundos</center>\n";
?>
</body></html>
<?
   PageEnd();
?>
   <p>&nbsp;</p>
  <p>&nbsp;</p>
