<?
	require '../../functions.php';
   $rootPath = '../../';
	
	DBConnect('fayol');
	
	$rs = db_query("select numFicha, numSolicitud,espacio,extension,responsable,email,inventario,elemento,estado, descripcionFalla,SolicitudSoporte.fecha,SolicitudSoporte.hora, FichaAtencionSoporte.fecha as fechaAtencion,FichaAtencionSoporte.hora as horaAtencion,  motivoEstado, tipoTrabajo,trabajoRealizado,causaFalla,intervencion,garantia,observaciones 
	  				from SolicitudSoporte,FichaAtencionSoporte  
					where solicitud=numsolicitud and numsolicitud= '$_GET[numpeticion]' and numficha = '$_GET[numficha]'");

?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
	<meta name="keywords" content="tutorial,acessibilidade,css,css menu,estilo,folhas estilo,layout css,layout sites,menu css,paginas web,tutorial css,web design,web standards,webdesign,tableless" />
	<meta name="description" content=" Tutoriais, macetes, dicas sobre uso das CSS para projetar sites." />
	<meta name="author" content="Nick Rigby" />
	<meta name="MSSmartTagsPreventParsing" content="true" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta name="robots" content="all" />
	<meta name="language" content="pt-br" />
	<meta name="ICBM" content="-22.975781,-43.193082" />
	<meta name="DC.title" content="CSS para Web Design" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Reporte Atenci&oacute;n Solicitud de Soporte No. <?=$_GET['numpeticion']?></title>
	<body onLoad="window.print()">
	<h2 align="center"> Reporte Atenci&oacute;n Solicitud de Soporte No. <?=$_GET['numpeticion']?></h2>

<?
	$obj = pg_fetch_object($rs);
	

		
	if(pg_num_rows($rs) != 0)
	{	

		?>
		
		<h3> Informaci&oacute;n de la Solicitud </h3>
		
		<table width="70%" border="1">
		<tr>
			<td width="30%"><b>Hora/Fecha Solicitud:</b></td>
			<td><?=$obj->hora?> / <?=$obj->fecha?></td>
		</tr>
		<tr> 
			<td width="30%"><b>Solicitud N&uacute;mero:</b></td>
			<td><?=$obj->numsolicitud?></td>
		</tr>
		<tr> 
			<td width="30%"><b>Responsable</b></td>
			<td><?=$obj->responsable?></td>
		</tr>
		<tr> 
			<td width="30%"><b>Elemento:</b></td>
			<td><?=$obj->elemento?></td>
		</tr>
		<tr> 
			<td width="30%"><b>N&uacute;mero de Inventario:</b></td>
			<td><?=$obj->inventario?></td>
		</tr>
		<tr> 
			<td width="30%"><b>Descripci&oacute;n Problema:</b></td>
			<td><?=$obj->descripcionfalla?></td>
		</tr>
		</table>
		
		<br />
		<h3> Informaci&oacute;n del Mantenimiento Realizado</h3>
		
		<table width="70%" border="1">
			<tr>
				<td width="30%"><b>Hora/Fecha Atenci&oacute;n:</b></td>
				<td><?=$obj->horaatencion?> / <?=$obj->fechaatencion?></td>
			</tr>
		<?
		
		//Estado
		$estado = $obj->estado;
		$descripcionEstado ="\n\n"."Estado: ";			
		if($estado =='e')
		{
			$descripcionEstado  ="Aún no atendida";
		}
		else if($estado =='p')
		{
			$descripcionEstado  ="Pendientes ";
		}
		else if($estado =='t')
		{
			$descripcionEstado  = "Ya fue atendida";
		}			
		?>
			<tr>
				<td width="30%"><b>Estado:</b></td>
				<td><?=$descripcionEstado?></td>
			</tr>
		<?
		if($estado =='p')
		{
		?>
			<tr>
				<td width="30%"><b>Motivo(Estado Pendiente):</b></td>
				<td><?=$obj->motivoestado?></td>
			</tr>
		<?
		}		
		
		//Tipo Trabajo
		$tipoTrabajo =$obj->tipotrabajo;
		
		if($tipoTrabajo =='s')
		{
			$tipoTrabajoDescripcion = "Soporte";
		}
		else if($tipoTrabajo =='p')
		{
			$tipoTrabajoDescripcion ="Preventivo";
		}
		else if($tipoTrabajo =='f')
		{
			$tipoTrabajoDescripcion ="Falla (Correctivo)";
		}
		?>
			<tr>
				<td width="30%"><b>Tipo:</b></td>
				<td><?=$tipoTrabajoDescripcion?></td>
			</tr>		
			
			<tr>
				<td><b>Descripci&oacute;n Soporte Realizado:</b></td>
				<td><?=$obj->trabajorealizado?></td>
			</tr>	
		<?		
					
		//Causa Falla
		$causaFalla = $obj->causaFalla;
		if( $causaFalla =='t')
		{
			$causaFallaDescripcion ="Tecnica";
		}
		else if($causaFalla =='u')
		{
			$causaFallaDescripcion = "Usuario";
		}		
		?>
			<tr>
				<td width="30%"><b>Causa Problema:</b></td>
				<td><?=$causaFallaDescripcion?></td>
			</tr>			
		<?
		
					
		//Intervencion
		$intervencion = $obj->intervencion;
		
		if( $intervencion =='r')
		{
			$intervencionDescripcion = "Reparación";
		}
		else if($intervencion=='c')
		{
			$intervencionDescripcion ="Cambio";
		}
		else if($intervencion=='b')
		{
			$intervencionDescripcion = "Baja";
		}
		
		else if($intervencion=='a')
		{
			$intervencionDescripcion = "Actualización";
		}
		
		else if($intervencion=='co')
		{
			$intervencionDescripcion = "Correción";
		}
		else if($intervencion=='is')
		{
			$intervencionDescripcion = "Instalación Software";
		}
		
		?>		
			<tr>
				<td width="30%"><b>Intervenci&oacute;n:</b></td>
				<td><?=$intervencionDescripcion?></td>
			</tr>					
		<?		
		
		//Garantia
		$garantia = $obj->garantia;
		if( $garantia =='s')
		{
			$garantiaDescripcion = "Si";
		}
		else if($garantia =='n')
		{
			$garantiaDescripcion = "No";
		}
		
		?>
			<tr>
				<td width="30%"><b>Garantia:</b></td>
				<td><?=$garantiaDescripcion?></td>
			</tr>	
			
			<tr>
				<td width="30%"><b>Observaciones:</b></td>
				<td><?=$obj->observaciones?></td>
			</tr>		

		</table>
		
		
		<br><br>
		<table border="0">
		<tr>
			<td><b>T&eacute;cnico:</b></td>
			<td> &mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td><b>Responsable:</b></td>
			<td> &mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</td>
		</tr>
		</table>

		
		
<?
	}
	else
	{
		echo " La solicitud que desea consultar no se encuentra registrada en el sistema.";
	}
?>
</body>
</html>
