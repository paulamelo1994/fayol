<?
   session_start();
   if( isset($_GET['cerrar']) )
   {
	   unset( $_SESSION['UserName'], $_SESSION['UserEmail'] );
	   header("Location: /Comunidad/");
	   die();
   }
?>
<HTML>
<BODY>
<CENTER><A HREF="cerrar-foro.php?cerrar=true" STYLE="color:red; font-weight:bold;" TARGET="_TOP">Cerrar Foro</A></CENTER>
</BODY>
</HTML>
