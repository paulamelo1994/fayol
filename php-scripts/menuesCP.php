<?
# Con esta variable cambio automaticamente el color del segundo menu que se dibuje en
# cada pagina a gris
$primermenu = true;
$misMenues = array();
function MakeMenu($title = 'Men&uacute;', $esSub = '', $prog= false)
{
	$title=parseHtml($title);
	global $primermenu;
	if(strpos($title,"Men")===false)
		$primermenu = false;
	else
		$primermenu = true;

	
?>
<TABLE WIDTH="130" BORDER="0" CELLPADDING="0" CELLSPACING="0" class="<?= $primermenu? 'tMain' : 'menuesD' ?>" title="<?PHP echo $title;?>">
<TR>
	<TD WIDTH="9" VALIGN="TOP" BGCOLOR="<? if($prog==true){echo '#999999';}else{ echo '#CC0000';} ?>">
		<IMG SRC="/Images/plantilla/esquina<? if($prog==true){echo 'gris.gif';}else{ echo 'roja.jpg';} ?>" WIDTH="9" HEIGHT="14" ALT="" >
	</TD>
	<TD ALIGN="CENTER" BGCOLOR="<? if($prog==true){echo '#999999';}else{ echo '#CC0000';} ?>" CLASS="titulos"><?= $title ?></TD>
	<TD WIDTH="9" BGCOLOR="<? if($prog==true){echo '#999999';}else{ echo '#CC0000';} ?>"></TD>
</TR>
<TR>
	<TD COLSPAN="3" BGCOLOR="#f2f2f2">
	<TABLE WIDTH="130" BORDER="0" ALIGN="CENTER" BGCOLOR="<? if($prog==true){echo '#999999';}else{ echo '#CC0000';} ?>" CELLPADDING="0" CELLSPACING="1">
	<TR><TD>
	<TABLE WIDTH="100%" BORDER="0" ALIGN="CENTER" BGCOLOR="#f2f2f2" CELLPADDING="0" CELLSPACING="1">
<?php
	
	//$primermenu = false;	
}

function MakeMenuItem($topic, $link, $target=false, $on=NULL, $mDest = '',$auxp=false)
{
	# Convierto las tildes en html valido
	$link = preg_replace('/&/', '&amp;', $link);
	$topic = parseHtml($topic);
	# Decido si este item debe estar seleccionado si no me lo dicen explicitamente
	if ($on===NULL)
		$on = $_SERVER['PHP_SELF']==$link;
	$on = NULL;
?>		
		<style type="text/css">
			.newtr{
				 font-size:12pt;
			}
			.newtr:hover{
				font-weight:800;
				font-size:10px;
				 /*background-color:#C5C5C5;*/
				 background-color:#FFFFFF;
			}
			
			.dMenu{
				color:#cc3300;
			}
			.dMenu:hover{
				/*color:#535353;*/
				font-weight:800;
				font-size:10px;
				
			}
		</style>
		 
			<TR><TD WIDTH="20" VALIGN="TOP" ALIGN="CENTER" ><IMG SRC="/Images/plantilla/triangulo<? if($auxp==true){echo 'gris';}else{ echo 'rojo';} ?>.gif" ALT=""></TD>
			<TD ALIGN="LEFT" class="newtr"><?
				if( !$on )
				{
					echo "<A class='dMenu' rel='$mDest' HREF='$link'";
					if($target)
						echo "TARGET='$target'";
					echo " STYLE='text-decoration:none;'>$topic</A>";
				}
				else
				{
					echo "<B>$topic</B>";
				}
				?></TD></TR>
<?
}

/*function MakeMenuItemX($topic, $link, $target=false, $on=NULL)
{
	# Convierto las tildes en html valido
	$link = ereg_replace('&', '&amp;', $link);
	$topic = parseHtml($topic);
	# Decido si este item debe estar seleccionado si no me lo dicen explicitamente
	if ($on===NULL)
		$on = $_SERVER['PHP_SELF']==$link;
?>
			<TR><TD WIDTH="20" VALIGN="TOP" ALIGN="CENTER"><IMG SRC="/Images/plantilla/triangulo<?= $on? 'rojo' : 'gris' ?>.gif" ALT=""></TD>
			<TD ALIGN="LEFT" STYLE='font-size: 13px;'><?
				if( !$on )
				{
					echo "<A HREF='$link'";
					if($target)
						echo "TARGET='$target'";
					echo " STYLE='font-size: 13px; text-decoration:none;'>$topic</A>";
				}
				else
				{
					echo "<B>$topic</B>";
				}
				?></TD></TR>
<?
}*/


function EndMenu()
{

?>
	</TABLE>
	</TD></TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<?
}

?>