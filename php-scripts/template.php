<?PHP
$primera_division = true;


function NoDefaultDivision()
{
	global $withDivisions;
	$withDivisions = true;
}

/*New PageInit*/ 
function PageInit($title, $menuFile='menu.php', $halign='left', $valign='top', $add = 'null')
{
	global $rootPath, $withDivisions, $menu_info, $page_title;
	$withDivisions = ($with_divisions || $withDivisions);
    	$page_title = $title = parseHtml($title);
	
	if (preg_match("/^(.*)$/", "$rootPath", $regs))
	{
		$rootPath = $regs[1];
	}

	# Miro cual de las pestañas es la que debe estar activa:
	preg_match('/[[:alpha:]]+[^\.|\/]/', $_SERVER['PHP_SELF'], $regs);
//	var_dump($regs);
	//var_export($regs);
	switch ($regs[0]) 
	{
		case 'Comunidad':		$tabOn = 7; break;
		case 'Publicaciones':           $tabOn = 6; break;
		case 'GruposInv':		$tabOn = 5; break;
		case 'Docentes':		$tabOn = 4; break;
		case 'Programas':		$tabOn = 3; break;
		case 'Facultad':		$tabOn = 2; break;
		case 'asignaturas':		$tabOn = 2; break;
		default:                        $tabOn = 1; break;
	}
	?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<HTML>
	<HEAD>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
		<TITLE><?= $title ?> :: Facultad de Ciencias de la Administraci&oacute;n</TITLE>
		<LINK HREF="/estilos.css" TYPE="TEXT/CSS" REL="STYLESHEET">
		<LINK HREF="../estilos.css" TYPE="TEXT/CSS" REL="STYLESHEET">
		<style type="text/css">
			.menuesD{
				display:none;
			}
			
		</style>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link type="text/css" rev="stylesheet" rel="stylesheet" href="/Docentes/WebPages/scripts/css/ui-lightness/jquery-ui-1.8.8.custom.css" />
		<style type="text/css">
		a.ui-dialog-titlebar-close{
		display:none;
		}
		</style>
		<script language="JavaScript" type="text/JavaScript" SRC="/swapImages.js"></script>
		<script language="JavaScript" type="text/javascript" src="<?= $rootPath?>/php-scripts/scripts/jquery-1.4.4.min.js"></script>
		<script language="JavaScript" type="text/JavaScript" src="<?= $rootPath?>/php-scripts/functionsJS.js"></script> 
		<script language="JavaScript" type="text/JavaScript" src='<?= $rootPath?>/php-scripts/functionsAJAX.js'></script>		
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		<script language="JavaScript" type="text/javascript" src="<?= $rootPath?>/php-scripts/scripts/jquery-ui-1.8.8.custom.min.js"></script>
		<script language="JavaScript" type="text/javascript" src="<?= $rootPath?>/php-scripts/scripts/jquery.selectboxes.min.js"></script>
		
		
		<script language="JavaScript" type="text/javascript" src="<?= $rootPath?>/php-scripts/scripts/jquery_validate_RegistroEstudiante.js"></script>
		<script language="JavaScript" type="text/javascript" src="<?= $rootPath?>/php-scripts/scripts/jquery.validate.min.js"></script>
		
		
		<script type="text/javascript">
		   	$(function(){
		  
		  /*
		   * Para ventanas modales
		   */ 
					$("#ventanaCorreo1").dialog({
						height: 200,
						width: 400,
						modal: true,
						title: "Registro correo electronico"
					});
					$("#ventanaPass1").dialog({
						height: 220,
						width: 500,
						modal: true,
						title: "Cambio contraseña"
					});
					$("#ventanaReserva").dialog({
						height: 500,
						width: 500,
						modal: true,
						title: "Confirmacion Reserva"
					});
		
		
		
		/*
		 * El siguiente script se encarga de los menus desplegables de todas las paginas
		 */
				$(".dMenu").bind("click",function(e){
					var destino = $(this).attr("rel");
					if(destino == '')
						return;
					e.preventDefault();//no hace click
					var tabla1 = $("table.tMain");
					var selector = "table [title='"+destino+"']";
					var tabla2 = $(selector);
					var menu = $(this);//el a que fue clickeado
					if(tabla2.length == 1)
					{
						var tr = menu.parent().parent().next();
						if((tr.find("td").attr("id") == "subMenu_"+destino) && (tr.css("display") != "none")){
							tr.hide();
						}
						else if((tr.find("td").attr("id") == "subMenu_"+destino) && (tr.css("display") == "none")){
							tr.show();
							//tr.slideToggle('medium');
						}
						else
						{
							menu.parent().parent().after("<tr><td id='subMenu_"+destino+"' colspan=2></td></tr>");
							tabla2.find("tr").eq(0).remove();
							tabla2.find("tr").find("td").attr("bgcolor","#e2e2e2");
							 tabla2.find("tr").each(function(index,elem)
												   {
														  $(this).children("td").find("img").attr("src","http://fayol.univalle.edu.co/Images/plantilla/puntogris.gif").parent().before("<td class='mytab'>");
														   $(".mytab").html(" ").css("width","3px");//ancho del tab  
														   $(".mytab").html(" ").css("background-color","#e2e2e2");
														   															 
												   });
							
							menu.parent().parent().next().find("td").append(tabla2);
							tabla2.show();
						}
					}
					else
					{
						//alert("no se encontro la tabla desplegable");
					}
			});
			
			$(".dMenu").trigger("click");
			$(".dMenu").trigger("click");
			$("td[id^=subMenu] a").each(function(index,elem){
				var enlace = $(this).attr("href");
				var actual = document.location.href;
				try{
					console.log("Buscando "+enlace+" dentro de "+actual);
				}catch(e){
				
				}
				if(actual.indexOf(enlace)!=-1)
					$(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().							parent().prev().children().eq(1).children().trigger("click");
			});
			
			var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-21039242-2']);
		  _gaq.push(['_trackPageview']);
		
		  
		  
		});
		</script>
		
	</HEAD>
	<?
	    include_once("analytics.php");
	//
	if($add == 'ajax')
	{
		?>
		<BODY align="center" bgcolor="#FFFFFF" <? preg_match('/[a-z_0-9]+\.php/i', $_SERVER['PHP_SELF'], $registros); $PAGE_NAME = $registros[0];?> onLoad="crearAjax();">
		<?
	}
	else
	{
		?>
		<BODY align="center" bgcolor="#FFFFFF" <? preg_match('/[a-z_0-9]+\.php/i', $_SERVER['PHP_SELF'], $registros); $PAGE_NAME = $registros[0];?>>
		<?
	}
        //echo $PAGE_NAME;
	?>
        <div id="contenedorGlobal">
	<map name="barrasuperior">
		<area shape="rect" coords="548,3,618,18" TARGET="_BLANK" href="http://biblioteca.univalle.edu.co/" alt="Consultar en la Biblioteca" title="Consultar en la Biblioteca" >
		<area shape="rect" coords="478,3,543,18" href="/Directorio/" alt="Tel&eacute;fonos de las Facultades" title="Tel&eacute;fonos de las Facultades">
		<area shape="rect" coords="426,3,473,18" TARGET="_BLANK" href="http://www.univalle.edu.co/busquedas.html" alt="Buscar en Univalle" title="Buscar en Univalle">
	</map>
	<map name="logo_univalle">
	  <area shape="rect" coords="8,10,285,52" href="http://www.univalle.edu.co/" target="_top" alt="Portal de la Universidad del Valle">
	</map>
	<TABLE WIDTH="760" BORDER="0" CELLPADDING="0" CELLSPACING="0">
	<TR>
		<TD><IMG SRC="/Images/plantilla/logounivalle.jpg" WIDTH="348" HEIGHT="54" BORDER="0" USEMAP="#logo_univalle" ALT=""></TD>
		<TD><img src="http://www.univalle.edu.co/cgi-bin/cabezote-aleatorio.pl" width="411" height="54" border="0" alt="Foto"></TD>
	</TR>
	<TR>
		<TD COLSPAN="2"><img src="/Images/plantilla/barra-cabezote.gif" alt="Barra Cabezote" width="760" height="19" border="0" USEMAP="#barrasuperior"></TD>
	</TR>
	<TR>
		<TD COLSPAN="2">
		<table border="0" cellpadding="0" cellspacing="0" width="760">
		<tr>
		   <td COLSPAN="3"><DIV CLASS="title">Facultad de Ciencias de la Administraci&oacute;n</DIV></td>
		</tr>
		<tr>
		   <td WIDTH="10">&nbsp;</td>
		   <td><? PutHeader($tabOn) ?></td>
		   <td WIDTH="10">&nbsp;</td>
		</tr>
		</table>
		</TD>
	</TR>
	<TR>
		<TD COLSPAN="2">
		<TABLE WIDTH="760" BORDER="0" CELLPADDING="0" CELLSPACING="0">
		<TR>
			<TD>
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="3" CELLSPACING="0">
			<TR>
				<TD WIDTH="130" ALIGN="CENTER" VALIGN="TOP" style="padding-top: 4px">
				<!-- BEGIN --><? include($menuFile) ?><!-- END --></TD>
				<TD COLSPAN="2" VALIGN="TOP" width="630">
				<?
				if( !$withDivisions )
				{
					SectionInit($title, $halign, $valign, 300);
				}
}

function PageDivide($titulo, $halign='left', $valign='top', $height=NULL)
{
	SectionInit($titulo, $halign, $valign, $height);
	if(IP_DANIEL==getIP()){
		?><script language='javascript'>alert('use sectioninit instead')</script><?
	}
}

function SectionInit($titulo=NULL, $halign='left', $valign='top', $height=NULL)
{
	global $primera_division, $page_title;
	
	if ($titulo===NULL)
	{
		$titulo = $page_title;
	}
	
	if( !$primera_division ):
	?>
					</TD>
				</TR>
				</TABLE>
				</TD>
			</TR>
			</TABLE>
			</TD>
		</TR>
		</TABLE><BR>
	<? endif ?>
	<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0">
	<TR>
		<?
		echo '<TD WIDTH="9" VALIGN="TOP" BGCOLOR="#999999"><IMG SRC="/Images/plantilla/esquinagris.gif" WIDTH="9" HEIGHT="14" ALT=""></TD>';
		?>
		<TD COLSPAN="2" ALIGN="CENTER" BGCOLOR="#999999" CLASS="titulos"><?= $titulo ?></TD>
	</TR>
	<TR>
		<TD COLSPAN="3" BGCOLOR="#d0d0d0">
		<TABLE WIDTH="100%" CELLPADDING="1" CELLSPACING="0" BORDER="0">
		<TR>
			<TD>
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="10" CELLSPACING="0" BGCOLOR="#f9f9f9">
			<TR>
				<TD VALIGN="<?= $valign ?>" ALIGN="<?= $halign ?>" <? if($height!==NULL) echo "HEIGHT='$height'" ?>>
				<?
				$primera_division = false;
}

function PageEnd($neds = -1)
{
	global $rootPath, $codigosNedStat, $withDivisions;
	?>
							</TD>
						</TR>
						</TABLE>
						</TD>
					</TR>
					</TABLE>
					</TD>
				</TR>
				<TR>
					<TD ALIGN="CENTER" VALIGN="TOP">&nbsp;</TD>
					<TD WIDTH="603" ALIGN="CENTER" VALIGN="TOP">&nbsp;</TD>
					<TD WIDTH="1" ALIGN="CENTER" VALIGN="TOP">&nbsp;</TD>
				</TR>
				<TR>
					<TD ALIGN="CENTER" VALIGN="TOP">&nbsp;</TD>
					<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="footer">						
					<a href="<?=makeURL("/comentarios.php?ComeFrom={$_SERVER['PHP_SELF']}")?>" onMouseOver="MM_swapImage('Image2','','/Images/plantilla/comentarios-over.gif',1)" onMouseOut="MM_swapImgRestore()">
					<IMG SRC="/Images/plantilla/comentarios.gif" ALT="Comentarios y Sugerencias" NAME="Image2" ID="Image2">
					</a>
					<br>
					FACULTAD DE CIENCIAS DE LA ADMINISTRACI&Oacute;N<br>
					UNIVERSIDAD DEL VALLE<br>
					Sede San Fernando, Edificio 124<br>
					PBX +57 2 3212100 FAX 5542470 A.A. 25360<br>
					Calle 4B No 36-00, Cali - Colombia<br>
					<BR>
					<B>&Uacute;ltima actualizaci&oacute;n: </B><?= ultima_actualizacion() ?><BR>
					<A HREF="/creditos.php" STYLE="text-decoration:underline;">Cr&eacute;ditos de desarrollo</A>
					</TD>
					<TD ALIGN="CENTER" VALIGN="TOP">&nbsp;</TD>
				</TR>
				<TR>
					<TD ALIGN="CENTER" VALIGN="TOP">&nbsp;</TD>
					<TD ALIGN="CENTER" VALIGN="TOP">&nbsp;</TD>
					<TD ALIGN="CENTER" VALIGN="TOP">&nbsp;</TD>
				</TR>
				</TABLE>
				</TD>
			</TR>
			</TABLE>
			</TD>
		</TR>
		</TABLE>
		</TD>
	</TR>
	</TABLE>
	<?
	# Si existe la variable $_GET['show_message'] es porque alguna pagina hace un llamado
	# a esta pagina para que se cargue y muestre un mensaje
	if (isset($_GET['show_message']))
	{
		echo '<SCRIPT LANGUAGE="JAVASCRIPT1.4" TYPE="TEXT/JAVASCRIPT">';
		switch ($_GET['show_message'])
		{
			case 1:
				echo "alert('Su correo fue enviado exitosamente')";
				break;
			default:
				echo "alert('Ojo, el codigo de mensaje especificado no corresponde a ningun mensaje conocido')";
		}
		echo '</SCRIPT>';
	}
	?>
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
	</script>
	<script type="text/javascript">
	try {
	_uacct = "UA-957230-1"; 
	urchinTracker();
	} catch(err) {}</script>
        </div>
	</BODY>
	</HTML>
<?
}

function PutTab($tabOn, $thisTab)
{
	if($tabOn==$thisTab)
	{
		echo '<td bgcolor="#ffffff" height="1"></td>';
	}
	else
	{
		echo '<td height="1" valign="bottom"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="100%"></td>';
	}
}

function PutHeader($tabOn)
{
	?>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
	<tr><!-- PESTA&Ntilde;A 1: Linea Vertical Izquierda -->		
		<? /* TODO: Cuestion del height, ponerlo a 30.*/ ?>
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<!-- PESTA&Ntilde;A 1: Linea Horizontal Arriba -->
		<td height="1" valign="top"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="100%"></td>
		<!-- PESTA&Ntilde;A 1: Linea Vertical Derecha -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>                        
		<!-- VALLE INTERPESTA&Ntilde;AS -->
		<td rowspan="3" height="100%" valign="bottom" width="5"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="5"></td>
		<!-- PESTA&Ntilde;A 2 -->
		<!-- Linea Vertical Izquierda -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<!-- Linea Horizontal Arriba -->
		<td height="1" valign="top"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="100%"></td>
		<!-- Linea Vertical Derecha -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<!-- FIN  PESTA&Ntilde;A 2 -->                        
		<!-- VALLE INTERPESTA&Ntilde;AS -->
		<td rowspan="3" height="100%" valign="bottom" width="5"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="5"></td>
		<!-- PESTA&Ntilde;A 3 -->
		<!-- Linea Vertical Izquierda -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<!-- Linea Horizontal Arriba -->
		<td height="1" valign="top"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="100%"></td>
		<!-- Linea Vertical Derecha -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<!-- FIN  PESTA&Ntilde;A 3 -->                        
		<!-- VALLE INTERPESTA&Ntilde;AS -->
		<td rowspan="3" height="100%" valign="bottom" width="5"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="5"></td>
		<!-- PESTA&Ntilde;A 4 -->
		<!-- Linea Vertical Izquierda -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<!-- Linea Horizontal Arriba -->
		<td height="1" valign="top"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="100%"></td>
		<!-- Linea Vertical Derecha -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<td rowspan="3" height="100%" valign="bottom" width="5"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="5"></td>
		<!-- PESTA&Ntilde;A 5 -->
		<!-- Linea Vertical Izquierda -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<!-- Linea Horizontal Arriba -->
		<td height="1" valign="top"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="100%"></td>
		<!-- Linea Vertical Derecha -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<td rowspan="3" height="100%" valign="bottom" width="5"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="5"></td>
		<!-- PESTA&Ntilde;A 6 -->
		<!-- Linea Vertical Izquierda -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<!-- Linea Horizontal Arriba -->
		<td height="1" valign="top"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="100%"></td>
		<!-- Linea Vertical Derecha -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<!-- VALLE INTERPESTA&Ntilde;AS-->
		<td rowspan="3" height="100%" valign="bottom" width="5"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="5"></td>
		<!-- PESTA&Ntilde;A 7-->
		<!-- Linea Vertical Izquierda -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
		<!-- Linea Horizontal Arriba -->
		<td height="1" valign="top"><img src="/Images/plantilla/pixelGris.gif" alt="" height="1" width="100%"></td>
		<!-- Linea Vertical Derecha -->
		<td rowspan="3" height="100%" width="1"><img src="/Images/plantilla/pixelGris.gif" alt="" height="28" width="1"></td>
	</tr>
	<tr>
		<td class="pestana<?= $tabOn==1? 'On' : 'Off' ?>"><a href="/">Inicio</a></td>
		<td class="pestana<?= $tabOn==2? 'On' : 'Off' ?>"><a href="/Facultad/">La Facultad </a></td>
		<td class="pestana<?= $tabOn==3? 'On' : 'Off' ?>"><a href="/Programas/">Programas<br>Acad&eacute;micos </a></td>
		<td class="pestana<?= $tabOn==4? 'On' : 'Off' ?>"><a href="/Docentes/">Profesores</a></td>
		<td class="pestana<?= $tabOn==5? 'On' : 'Off' ?>"><a href="/GruposInv/">Grupos de<BR>Investigaci&oacute;n</a></td>
		<td class="pestana<?= $tabOn==6? 'On' : 'Off' ?>"><a href="/Publicaciones/">Publicaciones</a></td>
		<td class="pestana<?= $tabOn==7? 'On' : 'Off' ?>"><a href="/Comunidad/">Comunidad</a></td>
	</tr>
	<tr>
		<?
		PutTab($tabOn, 1);
		PutTab($tabOn, 2);
		PutTab($tabOn, 3);
		PutTab($tabOn, 4);
		PutTab($tabOn, 5);
		PutTab($tabOn, 6);
		PutTab($tabOn, 7);
		?>
	</tr>
	</tbody>
	</table>
	<?
}
?>
