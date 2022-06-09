<?
/********************************************************
	Aplicacion: Asignacion Salas
	Archivo: calendReserva.php
	Objetivo: Este archivo muestra el horario semanal de las salas, las horas libres y las reservadas.
			  Permite solo visualizacion del calendario
	Autor: Oliver Felipe Idarraga.
	Año: 2011
	*********************************************************/
	
	session_start();
	
	/*
	 * opcion= 1 (reserva), opcion=2 (reservar), opcion=3 (cancelar)
	 */
		
	if(!isset($_GET['opcion'])){
		$opcion=1;
	}else{
		$opcion=$_GET['opcion'];
	}
	
	if((!isset($_SESSION['adminSalas'])) && ($opcion != 1))
	{
		header("Location: /Comunidad/Informatica/AsignacionSalas/Formularios/ingresar.php");
		die();
	}
	
	
	$root_path = "../../..";
	require '../../../functions.php';
	
	//Variables usadas en todos los casos
	$num_dias = 7;
		if(isset($_POST['sala']))
			$id_sala = $_POST['sala'];
		else if($_GET['sala'])
			$id_sala = $_GET['sala'];
		else
			$id_sala = '1';
			
		if(!isset($_GET['fecha'])){
			$fecha = date('Y')."-".date('m')."-".date('d');
		}else {
			$fecha = $_GET['fecha'];
                        $mes_anterior = pg_escape_string(monthTransform($fecha, 'before'));
		}
		
	
	if((!isset($_SESSION['adminSalas'])) && ($opcion == 1)){
		PageInit("Horario : Sala $id_sala", "../../menu.php");
	}else{
		PageInit("Horario : Sala $id_sala", "menu.php");
	}
	/*
	 * Script para tooltip
	 */
	?>
	<script src="<?= $rootPath?>/php-scripts/scripts/jquery.bgiframe.js" type="text/javascript"></script>
	<script src="<?= $rootPath?>/php-scripts/scripts/jquery.dimensions.js" type="text/javascript"></script>
	<script src="<?= $rootPath?>/php-scripts/scripts/jquery.tooltip.js" type="text/javascript"></script>
	<script src="<?= $rootPath?>/php-scripts/scripts/chili-1.7.pack.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function() {
			$('.pretty').tooltip({ 
				track: true, 
				delay: 0, 
				showURL: false, 
				showBody: " - ", 
				extraClass: "pretty", 
				fixPNG: true, 
				opacity: 0.95, 
				left: -100 
			});
			$('.fancy').tooltip({
				track: true,
				delay: 0,
				showURL: false,
				fixPNG: true,
				showBody: " - ",
				extraClass: "pretty fancy",
				top: -15,
				left: 5
			});
		});
	</script>
	<?
	$_GET['submenu_asignacion'] = true;
        
        $dia_tmp = date("l", mktime(0, 0, 0, splitDate($fecha, 'month'), splitDate($fecha, 'day'), splitDate($fecha, 'year')));
        if($dia_tmp != 'Sunday')
            $inicio_semana = date("Y-m-d", strtotime("last Sunday", strtotime($fecha)));
        else
            $inicio_semana = $fecha;
        $fin_semana = date("Y-m-d", strtotime("this Saturday", strtotime($fecha)));
        $nombre_dia = date("l", mktime(0, 0, 0, splitDate($fecha, 'month'), splitDate($fecha, 'day'), splitDate($fecha, 'year')));
        $semana_anterior = date("Y-m-d", strtotime("last $nombre_dia", strtotime($fecha)));
        $semana_siguiente = date("Y-m-d", strtotime("next $nombre_dia", strtotime($fecha)));

        $titulo=tituloHorario($opcion);		
        ?>
        <form name="horario" method="post" enctype="multipart/form-data" action="">
         <table align="center" border="0" cellspacing="2" width="100%"> 
                <tr>
                        <td>
                        <div class="tipReserva">
                        <table align="center" border="0" cellspacing="2">
                        <tr>
                                <td colspan="8" valign="middle" align="left"><a href="calendarioMensual.php?opcion=<? echo $opcion; ?>&sala=<? echo $id_sala;?> ">
                                <img border="1" src="<?=$root_path?>/Images/iconoMes.png" name="volver_mes" title="Volver a modo mes!" width="30" height="30" alt=""></a>
                                <h1 class="shiny"><? echo $titulo." Sala ";?><SELECT ONCHANGE="location = this.options[this.selectedIndex].value;">
                <OPTION VALUE="calendReserva.php?opcion=<? echo $opcion;?>&sala=1" <? if($id_sala=='1'){echo "selected";}?> >1
                <OPTION VALUE="calendReserva.php?opcion=<? echo $opcion;?>&sala=2" <? if($id_sala=='2'){echo "selected";}?>>2
                <OPTION VALUE="calendReserva.php?opcion=<? echo $opcion;?>&sala=3" <? if($id_sala=='3'){echo "selected";}?>>3
                <OPTION VALUE="calendReserva.php?opcion=<? echo $opcion;?>&sala=4" <? if($id_sala=='4'){echo "selected";}?>>4
                <OPTION VALUE="calendReserva.php?opcion=<? echo $opcion;?>&sala=Idiomas" <? if($id_sala=='Idiomas'){echo "selected";}?>>Idiomas
                <OPTION VALUE="calendReserva.php?opcion=<? echo $opcion;?>&sala=CUSE" <? if($id_sala=='CUSE'){echo "selected";}?>>CUSE
                        </SELECT></h1><br>
                                </td>
                        </tr>
                        <tr>
                                <td colspan="8" bgcolor="#FFFFFF" height="10px" style="padding-bottom:5px; ">
                                                                                                                                <div style=" float:left; padding-left:10px; padding-top:5px; "><a href="calendReserva.php?opcion=<? echo $opcion; ?>&fecha=<?=$semana_anterior?>&sala=<? echo $id_sala; ?>"><img src="<?=$root_path?>/Images/iconosSalas/boton_atras_sin_sombra.png" name="semana_atras" title="Semana Anterior"  alt=""></a></div>
                                                                                                                                <div align="center" style=" float:left; color:#770000; position:static; width:80%; "><br>Semana del:<br><?=makeDate($inicio_semana);?><b> - </b><?=makeDate($fin_semana);?><br></div>
                                                                                                                                <div style=" float:right; padding-right:10px; padding-top:5px; "><a href="calendReserva.php?opcion=<? echo $opcion; ?>&fecha=<?=$semana_siguiente?>&sala=<? echo $id_sala; ?>"><img src="<?=$root_path?>/Images/iconosSalas/boton_siguiente_sin_sombra.png" name="semana_siguiente" title="Semana Siguiente" alt=""></a></div>

                                </td>
                        </tr>
                        <tr > <td colspan="8"> </td></tr>
                        <tr>
                                <th width="55" STYLE="background-color: #F7F7F7;"></th>
                                <th width="55" scope="col">DOM</th>
                                <th width="55" scope="col">LUN</th>
                                <th width="55" scope="col">MAR</th>
                                <th width="55" scope="col">MIE</th>
                                <th width="55" scope="col">JUE</th>
                                <th width="55" scope="col">VIE</th>
                                <th width="55" scope="col">SAB</th>
                        </tr>

                        <?

                        DBConnect('controlsalas');
                        $consulta = "SELECT distinct on (hora, fecha) * from horario_salas where id_sala = '$id_sala' and estado='No Disponible' and fecha BETWEEN '".$inicio_semana."' and '".$fin_semana."' order by hora, fecha asc";
                        $fechaDia; //=splitDate($inicio_semana, 'day')
                        $rs = db_query($consulta);
                        $obj;
                        $estado;
                        //echo pg_num_rows($rs);
                        
                        if(pg_num_rows($rs)!=0)
                        {
                            $obj = pg_fetch_object($rs);
                            $estado=$obj->estado;
                            //echo $obj->hora.' '.$obj->fecha;
                        }
                        else
                        {
                            $estado='Disponible';
                        }
/*######################################################################################################################################*/                        
                        for($index=7; $index<22; $index++)
                        {
                            if($index<10)
                                $horaI='0'.$index;
                            else
                                $horaI=$index;
                        
                            $aux=0;
                            //echo splitDate($inicio_semana, 'day');
                            $iniciom=(int)splitDate($inicio_semana, 'day');
                            if($iniciom>splitDate($fin_semana, 'day'))
                                $iniciom=splitDate($fin_semana, 'day')-7;
                                
                            $finsemana=splitDate($fin_semana, 'day');
                            
                            for($inicio=0; $inicio<7; $inicio++)
                            {                                
                                //echo $inicio.' ';
                                if($inicio+aux<10)
                                {
                                    $f=$inicio;
                                    $fechaDia='0'.$f;
                                }
                                else
                                    $fechaDia=$inicio;
                                
                                
                                if($aux==0 && $estado=='No Disponible')
                                {
                                    $horaF=(int)$horaI;
                                    $horas1=$horaF+1;
                                    if($horas1<10)
                                    {
                                        $horas="0".$horas1;
                                        }
                                        else
                                        {
                                            $horas="".$horas1;
                                        }
                                        ?> <tr>
                                        <td align="center" height="20" bgcolor="#F0F0F0"> <? echo $horaI."-".$horas; ?></td><?
                                }
                                
                                if($aux==0 && $estado!='No Disponible')
                                {
                                    if($index<10)
                                        $horaI='0'.$index;
                                    else
                                        $horaI=$index;
                                    
                                    $horaF=(int)$horaI+1;
                                    $horas1=$horaF;
                                    if($horas1<10)
                                    {
                                        $horas="0".$horas1;
                                    }
                                    else
                                    {
                                        $horas="".$horas1;
                                    }
                                    ?> <tr>
                                    <td align="center" height="20" bgcolor="#F0F0F0"> <? echo $horaI."-".$horas; ?></td><?
                                }
                                 
                                if(($obj->hora) == ($horaI.':00:00') && ($obj->fecha) == dateplus($inicio_semana, $inicio))
                                {
                                    DBConnect('controlsalas');
                                    $rs1 = db_query("SELECT * from head_reserva natural join body_reserva where sala = '$id_sala' and fecha_reserva = '$obj->fecha' and hora_inicio<='$obj->hora'and hora_final > '$obj->hora' and estado = 'activo'");
                                    $obj1 = pg_fetch_object($rs1);
                                    DBConnect('profesores');
                                    $rsprof = db_query("select nombre from profesores where cedula='$obj1->docente'");
                                    $objprof = pg_fetch_object($rsprof);

                                    if(($obj->hora) == $index.':00:00')
                                    { ?>
                                        <td class="pretty" id="pretty" width="80" bgcolor="<?=$obj->color?>" align="center" valign="middle" title="<? echo makeDate($obj->fecha)." <br> Docente: ".$objprof->nombre." <br> Asignatura: ".$obj1->asignatura."<br> Grupo: ".$obj1->grupo." <br><br> Hora Inicio: ".substr($obj1->hora_inicio,0,-3)." <br> Hora Finalizacion: ".substr($obj1->hora_final,0,-3); ?>">
                                        <? 
                                        if($opcion==3)
                                        {?>
                                            <a href="/Comunidad/Informatica/AsignacionSalas/Formularios/cancelar.php?id=<? echo $obj1->id_body; ?>&opc=2">
                                            <font color="#FFFFFF"><?=$obj1->asignatura?></font></b>
                                            </a> <?
                                        }
                                        else
                                        {
                                            if(isset($_SESSION['adminSalas']))
                                            {
                                                ?><a href="vistaReserva.php?id2=<? echo $obj1->id_body;?>"><font color="#FFFFFF"><?=$obj1->asignatura;?></font></a><?
                                            }
                                            else
                                            {
                                                ?><font color="#FFFFFF"><?=$obj1->asignatura?></font><?
                                            }
                                        }?>
                                        </td>

                                        <?
                                    }
                                    else
                                    {?>							
                                        <td  height="20" bgcolor="<? echo $obj->color; ?>" valign="middle" title="No Disponible"  align="center"></td> <?
                                    }
                                    
                                    $obj=pg_fetch_object($rs);
                                    $estado=$obj->estado;
                                    
                               }
                               else //--------------------------------------------AQUI---------------------------------------------------------------------
                               {?>
                                        <td height="20" bgcolor="" align="center" valign="middle" title="<?=makeDate(dateplus($inicio_semana, $inicio))?>. Disponible">
                                    <? 
                                    if($opcion==2)
                                    {
                                        ?><a href="/Comunidad/Informatica/AsignacionSalas/Formularios/reservar.php?fecha_sel=<? echo ''.  dateplus($inicio_semana, $inicio); ?>&hora=<? echo ''.$index; ?>&sala=<? echo $id_sala; ?>">.</a> <?
                                    }?></td><?
                               }
                               $aux=$aux+1;
                               if($aux==7)
                               {
                                    ?> </tr> <?
                                    $aux=0;
                               }
                            }
                        }

/*####################################################################################################################################*/


                        ?>
                        <td></td>
                        </tr>
                        <tr><td colspan="8"><br></td></tr>
                        <tr>
                        <td align="center" colspan="8">
                                        <table border="0" width="70%" align="center">
                                        <tr>
                                                <td align="center" colspan="5" class="titulosContenidoInterno">Convenciones:</td>
                                        </tr>
                                        <tr>
                                                <td width="18%"></td>
                                                <td width="9%" bgcolor="#3399CC"></td>
                                                <td width="5%" align="center"><b>:</b></td>
                                                <td width="50%">Capacitaci&oacute;n</td>
                                                <td width="18%"></td>
                                        </tr>
                                        <tr>
                                                <td width="18%"></td>
                                                <td width="9%" bgcolor="#FFCC66"></td>
                                                <td width="5%" align="center"><b>:</b></td>
                                                <td width="50%">Clase Unica</td>
                                                <td width="18%"></td>
                                        </tr>
                                        <tr>
                                                <td></td>
                                                <td bgcolor="#FF8000"></td>
                                                <td align="center"><b>:</b></td>
                                                <td>Clase Diplomado</td>
                                                <td></td>
                                        </tr>
                                        <tr>
                                                <td></td>
                                                <td bgcolor="#B97BC4"></td>
                                                <td align="center"><b>:</b></td>
                                                <td>Practica Dirigida</td>
                                                <td></td>
                                        </tr>
                                        <tr>
                                                <td></td>
                                                <td bgcolor="#99CC00"></td>
                                                <td align="center"><b>:</b></td>
                                                <td>Clase Postgrado</td>
                                                <td></td>
                                        </tr>
                                        <tr>
                                                <td></td>
                                                <td bgcolor="#006699"></td>
                                                <td align="center"><b>:</b></td>
                                                <td>Taller</td>
                                                <td></td>
                                        </tr>
                                        <tr>
                                                <td></td>
                                                <td bgcolor="#FF6666"></td>
                                                <td align="center"><b>:</b></td>
                                                <td>Clase Inform&aacute;tica</td>
                                                <td></td>
                                        </tr>
                                </table>
                        </td>
                </tr>
        </table>
        </div>
  </td>
  </tr>
 </table>
</form>
	
