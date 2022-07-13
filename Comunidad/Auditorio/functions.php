<style type="text/css">

body {
	font-family: arial, helvetica, serif;
}

ul { /* all lists */
	padding: 0;
	margin: 0;
	list-style: none;
}

li { /* all list items */
	float: left;
	position: relative;
	width: 7em;
	
}

li ul { /* second-level lists */
	display: none;
	position: absolute;
	top: 1em;
	left: 0;
	background-color:#ffffff;
	
	
}

li>ul { /* to override top and left in browsers other than IE, which will position to the top right of the containing li, rather than bottom left */
	top: auto;
	left: auto;
}

li:hover ul, li.over ul { /* lists nested under hovered list items */
	display: block;
}

#content {
	clear: left;
	
}

</style>

<script type="text/javascript"><!--//--><![CDATA[//><!--
startList = function() {
	if (document.all&&document.getElementById) {
		navRoot = document.getElementById("nav");
		for (i=0; i<navRoot.childNodes.length; i++) {
			node = navRoot.childNodes[i];
			if (node.nodeName=="LI") {
				node.onmouseover=function() {
					this.className+=" over";
				}
				node.onmouseout=function() {
					this.className=this.className.replace(" over", "");
				}
			}
		}
	}
}
window.onload=startList;

//--><!]]></script>

<?
	
	$meses = array('', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO',
                 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');

  function MonthFromIndex($index)
  {
    global $meses;
    return ucwords(strtolower($meses[$index]));
  }

  function DibujarMes($mes, $ano, $mod, $nuevoEvento)
  {
  	
	global $meses;
	 
	 # Constantes para los dias
	 $DOMINGO = 0; # Primer dia a mostrar en el calendario
	 $SABADO  = 6; # Ultimo dia a mostrar en el calendario

     # Nombre del mes
     $NombreMes = $meses[$mes];
	 # Numero de dias del mes
	 $NumDias = NumeroDias($mes, $ano);

	 # Domingo -> 0, Lunes -> 1 ... Sabado -> 6
	 # Tomo el dia que cae el 1 de este mes
	 $DiaMes = date('w', mktime(0, 0, 0, $mes, 1, $ano));
	 
	 # Tomo el dia, mes y año actuales
	 $time = time();
	 list($diaActual, $mesActual, $anoActual) = FechaHoy();

	 echo '<TABLE WIDTH="476" height=380 BORDER="0" BGCOLOR=#cf5656><TR><TD>';
	 echo '<TABLE WIDTH="476" height=380 BORDER="0" BGCOLOR=WHITE>';
	 echo "<TR><TD ALIGN=CENTER COLSPAN=7 BGCOLOR=#cf5656><FONT COLOR=WHITE><B>$NombreMes del $ano</B></FONT></TD></TR>";
	 echo '<TR BGCOLOR="#CCD0E1"><TD WIDTH=68><center>Domingo</center></TD>
	 <TD WIDTH=68><center>Lunes</center></TD>
	 <TD WIDTH=68><center>Martes</center></TD>
	 <TD WIDTH=68><center>Miercoles</center></TD>
	 <TD WIDTH=68><center>Jueves</center></TD>
	 <TD WIDTH=68><center>Viernes</center></TD>
	 <TD WIDTH=68><center>Sábado</center></TD></TR>';

	 # El calendario siempre debe tener 6 semanas para que sean del mismo tamaño
	 $numeroSemanas = 0;

	 # Llenar con espacios los primeros dias de la semana que correponden al mes anterior
	 if( $DiaMes!=$DOMINGO )
	 {
	   $numeroSemanas++;
	   echo "<TR>";
	   echo "<TD COLSPAN=$DiaMes align=center >&nbsp;</TD>";
	 }
	 
     # Imprimo todos los dias del mes deseado
	 for($dia=1; $dia<=$NumDias; $dia++)
	 {
	   if( $DiaMes==$DOMINGO )
	   {
		 $numeroSemanas++;
	     echo '<TR>';
	   }
		
		$rs = db_query("SELECT * FROM auditorio WHERE fecha='$ano-$mes-$dia'");
		$n = pg_num_rows($rs);
  		$obj = pg_fetch_object($rs);
  		
		
	   # El dia actual va dibujado con un color diferente
	   if($anoActual==$ano && $mesActual==$mes && $diaActual==$dia)
	   	{
		
			
			if($mod)
	     	 	echo "<TD BGCOLOR='#CCD0E1' align=center WIDTH=65><A HREF='VerDia.php?dia=$dia&mes=$mes&ano=$ano&editar=true' 
				STYLE='color:black; text-decoration:none;' A> <font color='#FF0000 >$dia</font></TD>";
			else if($nuevoEvento)
	     	 	echo "<TD BGCOLOR='#CCD0E1' align=center WIDTH=65><A HREF='inicioPrivado.php?item=3&dia=$dia&mes=$mes&ano=$ano&agregar=true' 
				STYLE='color:black; text-decoration:none;' A>$dia</TD>";
			else
				echo "<TD  BGCOLOR='#CCD0E1' align=center WIDTH=65><A HREF='VerDia.php?dia=$dia&mes=$mes&ano=$ano' 
				STYLE='color:black; text-decoration:none;' > $dia</A></TD>";
				
			
	   }
	   else
	   {
	   		if( $DiaMes==$DOMINGO )
	     		echo "<TD align=center>$dia</TD>";
			else
			{
				echo "<TD align=center  width=65 ";
				
				if ( pg_numrows($rs)!=0)
				{
					if($n == 4)
						echo "BGCOLOR='#ffb68e' >";
					else
						echo "BGCOLOR='#0099CC' >";
					
					echo "<ul id='nav'>
						<li><center><A STYLE='color:black; text-decoration:none;'";
					if($mod)
						echo " HREF='VerDia.php?dia=$dia&mes=$mes&ano=$ano&editar=true' >$dia</A></center>";
					else if($nuevoEvento)
						echo " HREF='inicioPrivado.php?item=3&dia=$dia&mes=$mes&ano=$ano&agregar=true' >$dia</A></center>";
					else
						echo " HREF='VerDia.php?dia=$dia&mes=$mes&ano=$ano' >$dia</A></center>";
					echo '<ul>';
					
					do {
					
					   	 if ($obj->tipo_evento == 'conf') echo '<li><center>Conferencia</center></li>';  
						 if ($obj->tipo_evento == 'vcon') echo '<li><center>Video Conferencia</center></li>';  
						 if ($obj->tipo_evento == 'chal') echo '<li><center>Charla</center></li>';
						 if ($obj->tipo_evento == 'foro') echo '<li><center>Foro</center></li>';
						 if ($obj->tipo_evento == 'cfor') echo '<li><center>Cine Foro</center></li>';
						 if ($obj->tipo_evento == 'peli') echo '<li><center>Pelicula</center></li> ';
						 if ($obj->tipo_evento == 'semi') echo '<li><center>Seminario</center></li> ';

					 } while( $obj = pg_fetch_object($rs) );
					 echo "</ul></li></ul>";
					
					?> </TD><?

					 
				}	
				else 
				{
					echo "><A ";
					if($mod)
						echo " HREF='VerDia.php?dia=$dia&mes=$mes&ano=$ano&editar=true' >$dia</A></TD>";
					else if($nuevoEvento)
						echo " HREF='inicioPrivado.php?item=3&dia=$dia&mes=$mes&ano=$ano&agregar=true' >$dia</A></TD>";
					else
						echo " HREF='VerDia.php?dia=$dia&mes=$mes&ano=$ano' >$dia</A></TD>";
				}
				
			}
	 	}
	   if( $DiaMes==$SABADO )
	     echo '</TR>';

	   $DiaMes = ($DiaMes+1)%7;
	 }
	 
	 if( $DiaMes!=$DOMINGO )
	   echo "<TD COLPSAN=".($SABADO-$DiaMes)." align=center>&nbsp;</TD></TR>";
	 
	 # Si falta imprimir alguna de las 6 semanas que se imprimen del mes
	 if($numeroSemanas<=4)
		echo "<TR><TD COLSPAN=7 align=center>&nbsp;</TD></TR>";
	 if($numeroSemanas<=5)
		echo "<TR><TD COLSPAN=7 align=center>&nbsp;</TD></TR>";

	 echo '</TABLE>';
	 echo '</TD></TR></TABLE>';
  }
  
  function NumeroDias($mes, $ano)
  {
     // El desgraciado febrero:
	 if($mes==2)
	    return ((($ano % 4 == 0) && ($ano % 100 != 0)) || ($ano % 400 == 0)) ? 29 : 28;

     if( $mes%2 == 1 )
	 {
	    if( $mes > 7)
	       return 30;
	    else
	       return 31;
	 }
	 else
	 {
	    if( $mes < 7)
	       return 30;
	    else
	       return 31;
	 }
  }
  
  # Devuelve (mes actual, ano actual)
  function FechaHoy()
  {
     return array(date('j', time()), date('n', time()), date('Y', time()));
  }
  
  # Devuelve (mes siguiente, su respectivo año)
  function MesSiguiente($mes, $ano)
  {
     $mes++;
     if($mes==13)
	 {
	    $mes = 1;
		$ano++;
	 }
	 
	 return array($mes, $ano);
  }
  
  # Devuelve (mes anterior, su respectivo año)
  function MesAnterior($mes, $ano)
  {
     $mes--;
     if($mes==0)
	 {
	    $mes = 12;
		$ano--;
	 }
	 
	 return array($mes, $ano);
  }

  function getDia($fecha)
  {
  	$array_date = split('[-]', $fecha);
	return $array_date[2];
  }
?>