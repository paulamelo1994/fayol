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

	# Miro cual de las pesta√±as es la que debe estar activa:
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
		#contenedor table tr td table tr td table tr td table tbody tr td h6 a {
	font-family: open-sans;
	font-size:15px;
}
        #contenedor table tr td table tr td table tr td table tbody tr td h6 a {
	font-family: open-sans;
	font-size:15px;
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
						title: "Cambio contrase√±a"
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
        <div id="contenedor" style="width:610px;">
          <TABLE WIDTH="609" BORDER="0" CELLPADDING="0" CELLSPACING="0">
	<TR>
		<TD ROWSPAN="2">
		<TABLE WIDTH="609" BORDER="0" CELLPADDING="0" CELLSPACING="0">
		<TR>
			<TD>
			<TABLE WIDTH="609" BORDER="0" CELLPADDING="3" CELLSPACING="0">
			<TR>
				<TD WIDTH="128" ALIGN="CENTER" VALIGN="TOP" style="padding-top: 4px">
				<!-- BEGIN --><?// include($menuFile) ?><!-- END -->
                	<table style="height: 46px;" border="0" width="100%">
<tbody>
<tr>
  <td>
  <h3 style="text-align: center;">†<a href="http://fayol.univalle.edu.co/Docentes/index - Copia.php?item=1" target="_blank"><img src="http://administracion.univalle.edu.co/images/header-portal-WEB-FCA-02.jpg" alt="" /></a></h3>
  </td>
  <td align="center">
  †<a href="http://fayol.univalle.edu.co/Docentes/index - Copia.php?item=2" target="_blank"><img src="http://administracion.univalle.edu.co/images/header-portal-WEB-FCA-03.jpg" alt="" /></a>
  </td>
</tr>
<tr>
<td align="center">
<a href="http://fayol.univalle.edu.co/Docentes/index - Copia.php?item=1" target="_blank" style="font-size:15px; font-family:open-sans; color:#2A6496;">Docentes Tiempo Completo</a>
</td>
<td align="center">
<a href="http://fayol.univalle.edu.co/Docentes/index - Copia.php?item=2" target="_blank" style="font-size:15px; font-family:open-sans; color:#2A6496;">Docentes Hora Catedra</a>
</td>
</tr>
</tbody>
</table>
                </TD>
                <TR>
				<TD ROWSPAN="2" VALIGN="TOP" width="369"><table width="609" border="0" cellpadding="0" cellspacing="0">
				  <tr>
				    <tr>
				      <td colspan="3" bgcolor="#FFFFFF"><table width="100%" cellpadding="1" cellspacing="0" border="0">
				        <tr>
				          <td><table width="100%" border="0" cellpadding="10" cellspacing="0" bgcolor="#FFFFFF">
				            <tr>
				              <td valign="<?= $valign ?>" align="<?= $halign ?>" <? if($height!==NULL) echo "HEIGHT='$height'" ?>><?
				$primera_division = false;
}

function PageEnd($neds = -1)
{
	global $rootPath, $codigosNedStat, $withDivisions;
	?></td>
				              </tr>
				            </table></td>
				          </tr>
				        </table></td>
				      </tr>
				  <tr>
				    <td align="CENTER" valign="TOP">&nbsp;</td>
				    <td width="603" align="CENTER" valign="TOP">                
				    <tr>
				      <td colspan="2" align="center"><?
			$conexion = DBConnect('profesores');
if(!conexion)
{
	header("Location: ../Agenda");
	die();
}

$rs = db_query("SELECT serial,nombre,mail,minicurriculum,hojadevida FROM profesores");

$nombre = array();
$link = array();
$keys = array();
$showconten = array();

$contador = 0;

$filas = pg_num_rows($rs);
if($filas)
{
	$obj = pg_fetch_object($rs);
	while($obj = pg_fetch_object($rs))
	{
		//echo $contador;
		$nombre[$contador] = $obj->nombre;
		//echo $nombre[$contador];
		$link[$contador] = "http://administracion.univalle.edu.co/Docentes/WebPages/www.php?docente=".$obj->serial;
		$keys[$contador] = ''.$obj->nombre.' '.$obj->mail;
		$showcontent[$contador] = "Docente ".$obj->nombre." ".$obj->mail;
		$contador++; 
		
	}
}



echo '
<script language="Javascript" src="buscar/buscar.js"></script>
<script language="Javascript" >

	searchname = \'buscar.php\'
	usebannercode=true
	ButtonCode = "<img src=\'buscar/searchbutton.gif\' border=0>" 
	
	function templateBody() {
		document.write(\'<\'+
		\'script language="Javascript">\'+
		\'<\'+\'/\'+\'script\'+\'></head><body bgcolor="#ffffff" text="#000000" link="#000099" vlink="#996699" alink="#996699"><table border=0 width=690><tr><td>\');
	}

	function templateEnd() {
		document.write(\'</td></tr></table></font></center></body></html>\');
	}
	function bannerCode() {
	}	

var contador = "'.$contador.'";
var arreglonombre= new Array ("';
for($i=0; $i<$contador; $i=$i+1)
{echo $nombre[$i].'", "'; };
echo $nombre[$contador];
echo '");

var arreglolink= new Array ("';
for($i=0; $i<$contador; $i=$i+1)
{echo $link[$i].'", "'; };
echo $link[$contador];
echo '");

var arreglokeys= new Array ("';
for($i=0; $i<$contador; $i=$i+1)
{echo $keys[$i].'", "'; };
echo $keys[$contador];
echo '");

var arregloshowcontent= new Array ("';
for($i=0; $i<$contador; $i=$i+1)
{echo $showcontent[$i].'", "'; };
echo $showcontent[$contador];
echo '");


for(var j=0; j<=contador; j++) 
{
	add("<a href=\'"+arreglolink[j]+"\'>"+arreglonombre[j]+"</a>",
	""+arreglokeys[j]+"",
	""+arregloshowcontent[j]+""
	)
}	


</script>

<script language="Javascript">
	initXsearch();
</script>	
 '; ?>
				        <br>
				        <strong style="font-size:15px;">Escriba el o los nombres y/o apellidos del docente(s) a buscar.</strong><br></td>
				      </tr>
  <td width="1" align="CENTER" valign="TOP">&nbsp;</td>
  </tr>
  <tr>
    <td align="CENTER" valign="TOP">&nbsp;</td>
    <td align="RIGHT" valign="TOP" class="footer">&nbsp;</td>
    <td align="CENTER" valign="TOP">&nbsp;</td>
  </tr>
				  </table></TD>
				</TR>
			  </TABLE>
			</TD>
		  </TR>
		  </TABLE>
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
		?>
		<script language='javascript'>alert('use sectioninit instead')</script>
	  <?
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
	?>        </TD>
		</TR>
		</TABLE>
          <? endif ?>
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
	} catch(err) {}</script></div>
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
