<?php

    require_once('functions.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd" >
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html">
	<TITLE>Facultad de Ciencias de la Administraci&oacute;n</TITLE>
	<LINK HREF="estilos.css" TYPE="TEXT/CSS" REL="STYLESHEET">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
        
        <script type="text/javascript" src="php-scripts/scripts/jquery.js"></script>

	<!-- scripts fader banners de nuevos eventos -->
	<script type="text/javascript" src="php-scripts/scripts/jquery.animated.innerfade/js/jquery.animated.innerfade_temp.js"></script> 
	<script type="text/javascript" src="JScriptsTemp.js">
	</script>
	<!-- fin scripts banners -->
	<!--Google Analytics-->
	<script type="text/javascript">

	      var _gaq = _gaq || [];
	      _gaq.push(['_setAccount', 'UA-2179266-1']);
	      _gaq.push(['_setDomainName', '.univalle.edu.co']);
	      _gaq.push(['_trackPageview']);

	      (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	      })();

	</script>
	<!--Fin Google Analytics-->
        
    </head>
    <body>
        <map name="barrasuperior" id="barrasuperior">
            <area shape="rect" coords="548,3,618,18" href="http://biblioteca.univalle.edu.co/" TARGET="_blank" alt="Consultar en la Biblioteca" title="Consultar en la Biblioteca" >
            <area shape="rect" coords="478,3,543,18" href="Directorio/" alt="Tel&eacute;fonos de las Facultades" title="Tel&eacute;fonos de las Facultades">
            <area shape="rect" coords="426,3,473,18" href="http://www.univalle.edu.co/busquedas.html" TARGET="_blank" alt="Buscar en Univalle" title="Buscar en Univalle">
        </map>
        <map name="logo_univalle">
            <area shape="rect" coords="8,10,285,52" href="http://www.univalle.edu.co/" target="_top" alt="Portal de la Universidad del Valle">
        </map>
        <div id="contenedorGlobal">
            <div id="header">
                <img id="logo" SRC="Images/plantilla/logounivalle.jpg" ALT="Logo Univalle" WIDTH="348" HEIGHT="54" BORDER="0" USEMAP="#logo_univalle">
                <img id="image" src="http://www.univalle.edu.co/cgi-bin/cabezote-aleatorio.pl" width="411" height="54" border="0" alt="Foto">
            </div>
            <div id="barraCabezote">
                <img src="Images/plantilla/barra-cabezote.gif" alt="Barra Cabezote" width="760 px" height="19" border="0" USEMAP="#barrasuperior">
            </div>
            <div class="title">
                Facultad de Ciencias de la Administraci&oacute;n
            </div>
            <div class="tabber" id="tabs">
		<? PutHeader(1) ?>
	    </div>
            
            <div id="bannerTabsGrande" class="centrado" >
                <div class="cajaBanners centrado" >
		    <ul id="eventos" class="listaBanner centrado">
			<?
			    $ruta = "Images/NuevosEventosGrandes/";
			    $conexion = @DBConnect('new_fayol');
			    if($conexion)
			    {
				$rs = db_query("SELECT * FROM banner_grande_eventos WHERE activo='true' order by fecha desc");
				$numrows = pg_num_rows($rs);
				while($r = pg_fetch_row($rs))
				{
                                    if(!strpos($r[1],".swf")){
                                        if($r[2]!='')
                                        {
                                            echo '<li class="centrado eventosNuevo">
                                                <a href="'.$r[2].'" target="_blank">';
                                        }
                                        else
                                        {
                                            echo '<li class="centrado eventosNuevo">
                                                <a href="'.$r[1].'" target="_blank">';
                                        }
                                        echo '<img src="'.$ruta.$r[1].'" width="740px" height="190px" ALT="'.$r[4].'" title="De click para ver mas informacion">
                                                </a> </li>';
                                    }else{
                                    ?>
                                        <li class="centrado">
                                            <object type="application/x-shockwave-flash" data="<?=$ruta.$r[1]?>" width="740px" height="190px">
                                                <param name="movie" value="<?=$ruta.$r[1]?>" >
                                                <param name="quality" value="high" >
                                            </object>
                                        </li>
                                    <?    
                                    }
                                }
			    }
			?>
		    </ul>
		    <?
			if(getIP()==IP_GUILLERMO || getIP()==IP_ANGELA || getIP()==IP_NELSON)
			{
			    echo '<a href="bannersManager/autenticar.php">actualizar</a>';
			}
			else
			{
			    //echo 'De click para mas informaci&oacute;n';
			}
		    ?>
		</div>
	    </div>
	    <div id="panelIzquierdo">
                <div id="PruebaMenuPrincipalLateral" class="centrado" style="width: 130px; margin-bottom: 14px; margin-top: 0px">
                    <?
                        include "menuPrincipalLateral.php" 
                    ?>
		</div>
                <!--  Se pasa a panel Izquierdo
		<div class="cen
                trado" style="width: 130px;">
		    <div class="esquinaRedonda"></div>
		    <div class="tituloCajaRoja">Correo Electr&oacute;nico</div>
		    <div class="esquinaCuadrada"></div>
		    <div class="cajaContenido" style="text-align: center;">
			<a href="http://www.univalle.edu.co/correo/index.html">
			    <img class="centrado" alt="Correo" style="margin-top: 7px;" width="45" height="35" src="Images/plantilla/correo.jpg">
			</a>
		    </div>
		</div>
                -->
                <div class="centrado" style="width:130px;">
		    <div class="esquinaRedonda"></div>
		    <div class="tituloCajaRoja">Campus Virtual</div>
		    <div class="esquinaCuadrada"></div>
		    <div class="cajaContenido centrado">
                        <a href="http://campusvirtual.univalle.edu.co/" target="_black">
			    Campus Virtual
			</a>
		    </div>
		</div>
                
                <div class="centrado" style="width:130px;">
		    <div class="esquinaRedonda"></div>
		    <div class="tituloCajaRoja">Cont&aacute;ctenos</div>
		    <div class="esquinaCuadrada"></div>
		    <div class="cajaContenido centrado">
			<a href="http://administracion.univalle.edu.co/comentarios.php?ComeFrom=/index.php">
			    Contacte las dependencias de la Facultad
			</a>
		    </div>
		</div>
		<div class="centrado" style="width:130px;">
		    <div class="esquinaRedonda"></div>
		    <div class="tituloCajaRoja">Cr&eacute;ditos</div>
		    <div class="esquinaCuadrada"></div>
		    <div class="cajaContenido centrado">
			<a href="http://administracion.univalle.edu.co/creditos.php">
			    Cr&eacute;ditos del desarrollo de este Portal Web
			</a>
		    </div>
		</div>
		<div class="centrado" style="width:130px;">
		    <div class="esquinaRedonda"></div>
		    <div class="tituloCajaRoja">Bit&aacute;cora</div>
		    <div class="esquinaCuadrada"></div>
		    <div class="cajaContenido centrado">
			<a href="http://administracion.univalle.edu.co/Noticias/BITACORA/">
			    Bolet&iacute;n Informativo de la Facultad
			</a>
		    </div>
		</div>
                
                <div class="centrado" style="width:130px;">
		    <div class="esquinaRedonda"></div>
                    <div class="tituloCajaRoja">Calendario</div>
		    <div class="esquinaCuadrada"></div>
		    <div class="cajaContenidoCalendario centrado">
			<? include "Calendario.php" ?>
		    </div>
		</div>
		<div class="centrado">
		    <a href="http://gicuv.univalle.edu.co/index.html" target="_blank">
			<img width="100" height="93" alt="Universidad del Valle, 60 años" src="Images/calidadInstitucional.png">
		    </a>
		</div>

	    </div>
	    <div id="panelCentral">
                <div class="slideRojo titulos centrado"> Noticias y Eventos </div>
                <div class="cajaBanners centrado"> </div>
                <div class="cajaBanners sinScroll" id="noticiasTemp">
		    <div id="internoNoticiasTemp">
			<? include "noticiasTemp.php" ?>
		    </div>
		</div>
                <!--
		<div class="slideGris centrado titulos">
		    Calidad Institucional
		</div>
		<div class="cajaBanners centrado">
                    -->
		    <?  /*
			try {
			    $conexion = DBConnect('fayol');
			}  catch (Exception $exc)
			{
			    echo $exc;
			}
			if($conexion)
			{
			    $rs = db_query("SELECT * FROM banners WHERE visible='t'");
			    $numrows = pg_num_rows($rs);

			    srand (time());
			    $numero_aleatorio = rand(1,$numrows);
			    for($i = 0; $i < $numero_aleatorio; $i++ )
				    $con = pg_fetch_object($rs);
                            */
			    ?>
                    <!--
			    <object type="application/x-shockwave-flash" data="Banners1/<?= $con->ubicacion?>" width="360" height="120">
				<param name="movie" value="Banners1/<?= $con->ubicacion?>" />
				<param name="quality" value="high" />
				<!--<img src="Images/plantilla/inscripciones.png" width="320" height="60" alt="<?=$con->titulo?>" /> -- >
			    </object>
                    -->
			    <?/*
                            
			}
			// echo 'Descargar informaci&oacute;n en <a target="_blank" href="Banners/informacion/agenda.pdf">pdf</a>';

			if(getIP()==IP_ANGELA or getIP()==IP_GUILLERMO OR getIP() == '192.168.220.173' )
			{
				echo '<br><a href="Banners1/cambiar.php">cambiar</a>';
			}
                        */
		    ?> <!--
		</div> -->
                 
                <!-- Banner Novedades -->
		
                <!--div class="slideGris centrado titulos">
		    Novedades
		</div -->
                                
		
		<div class="slideGris centrado titulos">Mayor Informaci&oacute;n</div>
		<div class="centrado bordeGris">
		    <p class="masInfo centrado">
		    FACULTAD DE CIENCIAS DE LA ADMINISTRACI&Oacute;N<br>
		    UNIVERSIDAD DEL VALLE<br>
		    Sede San Fernando, Edificio 124<br>
		    PBX +57 2 3212100 FAX 5542470 A.A. 25360<br>
		    Calle 4B No 36-00, Cali - Colombia <br>
		    <B>&Uacute;ltima actualizaci&oacute;n: </B>
		    <?= ultima_actualizacion() ?>
		    </p>
		</div>
	    </div>
	    <div id="panelDerecho">
                <!-- 
                <div  class="centrado">
		    <div class="esquinaRedonda"></div>
		    <div class="tituloCajaRoja">Correo Electr&oacute;nico</div>
		    <div class="esquinaCuadrada"></div>
		    <div class="cajaContenido" style="text-align: left; width: 220px; margin-top: 5px">
			<a href="http://www.univalle.edu.co/correo/index.html">
			    <img class="centrado" alt="Correo" style="margin-top: 7px; margin-left: 40px" width="160" height="55" src="Images/plantilla/correoTempManuel.jpg">
			</a>
		    </div>
		</div>
                -->
                
                <div class="centrado">
                    <div class="esquinaRedonda"></div>
                    <div class="tituloCajaRoja" style="width: 190px">Comunidad Universit&aacute;ria</div>
                    <div class="cajaContenido" style="width: 189px;">
                    <table id="MallaIndex" align="center" width="200px" style="border-collapse:collapse;" >
                            <tr>
                                <td colspan="5">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td height="25px"> 
                                    <a href="http://www.facebook.com/administracionunivalle" target="black">
                                        <img title="Facebook" alt="Facebook" src="Images/plantilla/iconosIndex/facebook_15x15.gif" style="padding-left: 0px;">
                                    </a>
                                </td>
                                <td height="25px"> 
                                    <a href="http://www.twitter.com/admonunivalle" target="black" >
                                        <img title="Twitter" alt="Twitter" src="Images/plantilla/iconosIndex/twitter_20x15.gif" style="width: 20px; height: 15px;">
                                    </a>
                                </td>
                                <td height="25px">
                                    <a href="https://www.youtube.com/user/UnivalleCanalFCA" target="black">
                                        <img title="Cuenta YouTube" alt="Cuenta YouTube" src="Images/plantilla/iconosIndex/youtube_15x15.gif">
                                    </a>
                                </td>
                                <td height="25px">
                                    <a href="http://www.univalle.edu.co/correo/index.html" target="black">
                                        <img title="Correo Univalle" alt="Correo Univalle" src="Images/plantilla/iconosIndex/Mail15x11.gif" style="height: 11px;">
                                    </a>
                                </td>
                                <td height="25px"> 
                                    <a href="http://administracion.univalle.edu.co/Comunidad/galeria.php" target="black" >
                                        <img title="Galeria de Fotos" alt="Galeria de Fotos" src="Images/plantilla/iconosIndex/fotos_15x15.gif" style="padding-right: 0px;">
                                    </a>
                                </td>
                            </tr>
                            <!-- tr>
                                <td width="100px" height="80px">
                                    <a href="https://www.youtube.com/user/UnivalleCanalFCA" target="black">
                                        <img alt="Cuenta YouTube" src="Images/plantilla/iconosIndex/you_tube_UV.png">
                                    </a>
                                </td>
                                <td width="100px" height="80px"> 
                                    <a href="http://administracion.univalle.edu.co/Comunidad/galeria.php" target="black">
                                        <img alt="Galeria de Fotos" src="Images/plantilla/iconosIndex/Instagram_UV.png">
                                    </a>
                                </td>
                                
                            </tr>
                            <tr>
                                <td width="100px" height="80px"> 
                                    <a href="http://www.facebook.com/administracionunivalle" target="black">
                                        <img alt="Twitter" src="Images/plantilla/iconosIndex/facebook_UV.png">
                                    </a>
                                </td>
                                <td width="100px" height="80px"> 
                                    <a href="http://www.twitter.com/admonunivalle" target="black">
                                        <img alt="Twitter" src="Images/plantilla/iconosIndex/twitter_UV.png">
                                    </a>
                                </td>                                
                            </tr-->                          
                        </table> 
                    </div>
                </div>
                
                <!-- div>
                    <a href="http://quejasyreclamos.univalle.edu.co" target="black" >
                        <img alt="Preguntas Quejas Reclamos Sugerencias" src="Images/plantilla/iconosIndex/pqrs_hor.png" style="padding-bottom: 10px; width: 100px; height: 20px;">
                    </a>
                </div -->
		
		<?
		    if(getIP()==IP_DANIEL or getIP()==IP_GUILLERMO or getIP()==IP_MELENDEZ || getIP()==IP_NELSON)
		    {
		?>
		    <div class="slideRojo titulos"> 
			<a class="shylink" style="color:white;" href="Noticias/divulgar.php">
			    <b>Adicionar Noticia</b>
			</a>
		    </div>
		<?
		    }
		    if(getIP()==IP_DANIEL or getIP()==IP_GUILLERMO || getIP()==IP_NELSON) //or getIP()=='192.168.220.105')
		    {
		?>
		    <div class="slideRojo titulos"><a class="shylink" style="color:white;" href="EventoCalendario/divulgar.php"><b> Adicionar Evento/Noticia al Calendario </b></a></div>
		<?
		    }
		?>
		<div class="slideRojo titulos"><a class="shylink" style="color:white;" href="eventos/divulgar.php"><b> Divulgue su Evento </b></a></div>
		<div class="slideRojo titulos"><a class="shylink" style="color:white;" href="Estadisticas/estadisticas.php"><b> Estad&iacute;sticas </b></a></div>
		<div class="slideRojo titulos"><a class="shylink" style="color:white;" href="mapa.php"><b> Mapa de la P&aacute;gina </b></a></div>
		<? if( getIP()==IP_DANIEL || getIP()==IP_GUILLERMO || getIP()==IP_NELSON){ ?>
		    <div class="slideRojo titulos"><a class="shylink" style="color:white;" href="Bitacora/Bitacora.php"><b> Bit&aacute;cora </b></a></div>
		<? } ?>
                <div class="centrado">
                    <div  style="width: 190px;">
                        <table id="MallaIndex2" align="center" width="200px" style="border-collapse:collapse;" >
                           <tr><td></td></tr>
                           <tr>
                               <td>
                                    <a href="http://quejasyreclamos.univalle.edu.co" target="black" >
                                        <img alt="Preguntas Quejas Reclamos Sugerencias" src="Images/plantilla/iconosIndex/pqrs_hor.png" style=" padding-top: 3px; padding-bottom: 3px; width: 130px; height: 30px;">
                                    </a>
                                </td>
                           </tr>
                            <tr>
                                <td colspan="2">
                                    <a target="_blank" href="http://cuse.univalle.edu.co/">
                                        <img alt="Cuse"  border="0" src="Images/logo_Cuse.png" style="padding-top: 2px; width: 130px; height: 30px;">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a target="_blank" href="http://cuse.univalle.edu.co/evaluacionCursosV2/web/index.php">
                                        <img alt="Evaluación" width="130" src="Images/Logo_Evaluar.png" style="width: 130px; height: 40px;">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a target="_blank" href="http://www.gobiernoenlinea.gov.co">
                                        <img alt="Gobierno en linea" width="130" src="Images/Logo_Gov_en_Linea.png" title="Gobierno en Linea" style="padding-top: 2px; width: 130px; height: 40px;">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="centrado" style="width: 130px;">
		    <div class="centrado">
			<a href="http://validator.w3.org/check?uri=referer">
                        <img src="Images/plantilla/w3cSmallHtml.png" alt="Valid HTML 4.01 Transitional" >
                    </a>
		    </div>
		    <div class="centrado">
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
                        <img src="Images/plantilla/w3cSmallCss.png"
                        alt="CSS Válido">
                    </a>
		    </div>
		</div>
	    </div>
            <div id="footer">

            </div>
        </div>
    </body>
</html>