<?
  require '../../functions.php';
  require 'functions.php';
  $rootPath = '..';
  
   $_GET['submenu_agenda'] = true;
  
  session_start();
  $_GET['administrar'] = true;
  PageInit('Agenda de Noticias', '../menu.php', 7);
  
  

  $_GET[item];

  $dia;
  $mes;
  $ano;
  $m_fecha;
  if(($_GET[dia]))
  	$dia = $_GET[dia];
  if(($_GET[mes]))
  	$mes = $_GET[mes];
  if(($_GET[ano]))
  	$ano = $_GET[ano];
  
  $m_fecha = "".$ano."-".$mes."-".$dia;
  
  if($dia < 10 and $mes < 10)
  	$m_fecha = "".$ano."-0".$mes."-0".$dia;
  else if($dia > 10 and $mes < 10)
  	$m_fecha = "".$ano."-0".$mes."-".$dia;
  else if($dia < 10 and $mes > 10)
  	$m_fecha = "".$ano."-".$mes."-0".$dia;
  else
  	$m_fecha = "".$ano."-".$mes."-".$dia;
  
  
  if(($_GET[agregar]))
  {
  	header("Location: inicioPrivado.php?item=3");
  }
  
  
  # Si tratan de atrasar/adelantar con las flechas el calendario entonces atraso/adelanto solo el dia
  # no se permitira que pasado el primer dia del mes se siga retrocediendo, igualmente con el ultimo
  # dia del mes
  if(isset($_GET[vorheriger]))
  {
    $_SESSION[dia]--;
	if(($_GET[agregar]))
		header("Location: VerDia.php?agregar=true");
	else if(($_GET[editar]))
		header("Location: VerDia.php?editar=true");
	else
		header("Location: VerDia.php");
	die();
  }

  if(isset($_GET[nachster]))
  {
    $_SESSION[dia]++;
	if(($_GET[agregar]))
		header("Location: VerDia.php?agregar=true");
	else if(($_GET[editar]))
		header("Location: VerDia.php?editar=true");
	else
		header("Location: VerDia.php");
	die();
  }
  
  

//  $dia = $_SESSION[dia];
//  $mes = $_SESSION[mes];
//  $ano = $_SESSION[ano];
  
  $pg = DBConnect("fayol");
  
  $valign = 'TOP';

  $rs = pg_exec($pg, "SELECT * FROM video_conferencia WHERE fecha='$m_fecha' order by hora_inicio ");
  $obj = pg_fetch_object($rs);
  if($_GET[editar])
		echo Titulo("Programación de Eventos<BR>$dia de ".MonthFromIndex($mes)." de $ano <br>Editar Evento")."<BR>";
	else if ($_GET[agregar])
		echo Titulo("Programación de Eventos<BR>$dia de ".MonthFromIndex($mes)." de $ano <br>Agregar Evento")."<BR>";
	else
  		echo Titulo("Programación de Eventos<BR>$dia de ".MonthFromIndex($mes)." de $ano")."<BR>";
  
  if( $obj )
  {
     echo '<CENTER><BR><FONT COLOR=GREEN><B>Se encontro un total de '.pg_numrows($rs).' eventos</B></FONT><BR></CENTER><BR>';
  
     do {
	   BorderInit('#CCD0E1', '450');
	   echo "<TABLE BORDER=0>";
	   echo "<TR><TD WIDTH=150 BGCOLOR='#F0F0F0'>Tema:</TD><TD WIDTH=300>$obj->tema</TD></TR>";
	   echo "<TR><TD BGCOLOR='#F0F0F0'>Organizador:</TD><TD>$obj->solicitante</TD></TR>";
	   echo "<TR><TD BGCOLOR='#F0F0F0'>Hora:</TD>
	        <TD>$obj->hora_inicio</TD>
			<TD aling=center>";
		 echo "<TR><TD BGCOLOR='#F0F0F0'>Espacio:</TD>
	        <TD>$obj->espacio</TD>
			<TD aling=center>";
		if ($_SESSION['usuario']['permisos'] == 'total' || $_SESSION['usuario']['permisos'] == 'parcial')
		{
			if ($_GET[editar])
				echo "<A HREF='VerNoticia.php?id=$obj->indice&editar=true'>Ver<IMG SRC=\"/Images/mas.JPG\" BORDER=0 width=9 height=9></A>";
			else
				echo "<A HREF='VerNoticia.php?id=$obj->indice'>Ver<IMG SRC=\"/Images/mas.JPG\" BORDER=0 width=9 height=9></A>";
		}
		else
		{
			echo "<A HREF='VerNoticia.php?id=$obj->indice'>Ver<IMG SRC=\"/Images/mas.JPG\" BORDER=0 width=9 height=9></A>";
		}
	   echo "</TD></TR></TABLE>";
	   BorderEnd();
       echo "<BR>";
	 } while( $obj = pg_fetch_object($rs) );
  }
  else
  {
     echo "<CENTER><BR><FONT COLOR=GREEN><B>No se han reportado eventos para este dia</B></FONT><BR></CENTER>";
  }
  echo '<BR><CENTER>';
  if( $dia != 1 )
  {
  	if( $_GET[dia] ){}
	else
	{
		echo "<A HREF='VerDia.php?vorheriger'><IMG SRC='FlechaIzquierda.gif' ALIGN='MIDDLE' BORDER=0></A>";
	}
	if ($_GET[editar])
  		echo "<A HREF='VerMes.php?mes=$mes&ano=$ano&editar=true'>Volver a ver el calendario de este mes</A>";
	else  if ($_GET[agregar])
		echo "<A HREF='VerMes.php?mes=$mes&ano=$ano&agregar=true'>Volver a ver el calendario de este mes</A>";
	else
		echo "<A HREF='VerMes.php?mes=$mes&ano=$ano'>Volver a ver el calendario de este mes</A>";
	
  }
  if( NumeroDias($mes, $ano) != $dia )
  	if( $_GET[dia] ){}
	else
	{
    	echo "<A HREF='VerDia.php?nachster'><IMG SRC='FlechaDerecha.gif' ALIGN='MIDDLE' BORDER=0></A>";
	}
  echo '</CENTER><BR>';
  PageEnd();
?>