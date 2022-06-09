<?
  require "../../functions.php";
  require "functions.php";
  $rootPath = "..";
  session_start();
  
  $_GET['submenu_agenda'] = true;
  
  DBConnect('agenda');

  $_GET[item];
	
  if(!isset($_SESSION[mes]) || !isset($_SESSION[ano]))
    list(,$_SESSION[mes],$_SESSION[ano]) = FechaHoy();
	
  # Si tratan de atrasar/adelantar con las flechas el calendario
  if(isset($_GET[vorheriger]))
  {
    list($_SESSION[mes],$_SESSION[ano]) = MesAnterior($_SESSION[mes],$_SESSION[ano]);
	if($_GET[agregar])
		header("Location: VerMes.php?item=2&agregar=true");
	else if($_GET[editar])
		header("Location: VerMes.php?item=2&editar=true");
	else	
		header("Location: VerMes.php?item=2");
	die();
  }

  if(isset($_GET[nachster]))
  {
    list($_SESSION[mes],$_SESSION[ano]) = MesSiguiente($_SESSION[mes],$_SESSION[ano]);
	header("Location: VerMes.php?item=2");
	die();
  }

  $valign = 'TOP';
  
 

  	$_GET['sub_administrar'] = true;
  	PageInit("Agenda", "../menu.php", 7);

	if($_GET[editar])
		echo Titulo("Programación por meses<br>Editar Evento");
	else if ($_GET[agregar])
		echo Titulo("Programación por meses<br>Agregar Evento");
	else
 		echo Titulo("Programación por meses");
	 
  echo '<TABLE BORDER="0" CELLSPACING="3"><TR>'.
       '<TD><A HREF="VerMes.php?item=2&vorheriger"><IMG SRC="FlechaIzquierda.gif" BORDER=0></A></TD><TD WIDTH="10">&nbsp;</TD><TD>';
	
	if( $_GET[editar])
	{
		DibujarMes($_SESSION[mes], $_SESSION[ano], true, false);
		echo '</TD><TD WIDTH="10">&nbsp;</TD><TD><A HREF="VerMes.php?item=2&nachster&editar=true"><IMG SRC="FlechaDerecha.gif" BORDER=0></A></TD>'.
       '</TR></TABLE>';
	}
	else if( $_GET[agregar])
	{	
		DibujarMes($_SESSION[mes], $_SESSION[ano], false, true);
		echo '</TD><TD WIDTH="10">&nbsp;</TD><TD><A HREF="VerMes.php?item=2&nachster&agregar=true"><IMG SRC="FlechaDerecha.gif" BORDER=0></A></TD>'.
       '</TR></TABLE>';
	}
	else
	{	
		DibujarMes($_SESSION[mes], $_SESSION[ano], false, false);
		echo '</TD><TD WIDTH="10">&nbsp;</TD><TD><A HREF="VerMes.php?item=2&nachster"><IMG SRC="FlechaDerecha.gif" BORDER=0></A></TD>'.
       '</TR></TABLE>';
	}	
  
	?><table width="203">
				<td><tr>
				<td width="8%"></td>
				<td width="16%" bgcolor="#0099cc"></td>
				<td width="6%" align="center"><b></b></td>
				<td width="65%">Fecha con Evento(s)</td>
				<td width="2%"></td>
			    <td width="3%"></td></tr></td>
				
				<td><tr>
				<td width="8%"></td>
				<td width="16%" bgcolor="#ffb68e"></td>
				<td width="6%" align="center"><b></b></td>
				<td width="65%">D&iacute;a lleno</td>
				<td width="2%"></td>
			    <td width="3%"></td></tr></td>
				
				<td><tr>
				<td width="8%"></td>
				<td width="16%" bgcolor="#CCD0E1"></td>
				<td width="6%" align="center"><b></b></td>
				<td width="65%">Fecha Actual</td>
				<td width="2%"></td>
			    <td width="3%"></td></tr></td>
				
				</table><?
  PageEnd();
?>