<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: creditos.php
	Objetivo: Creditos de la sala de idiomas.
	Autor: Angela Benavides
	Año: 2007
	*********************************************************/
	
	session_start();
	
	require '../../functions.php';
	$root_path = "../..";
	
	$_GET['submenu_idiomas'] = true;
	
	PageInit("Cr&eacute;ditos", "../menu.php");
?>
<h1 class="shiny">Cr&eacute;ditos</h1>
<table width="80%" border="0" align="center">
<tr>
	<td valign="top" class="titulosContenidoInterno">Direcci&oacute;n y elaboraci&oacute;n:</td>
	<td valign="top">Adm. Luis Guillermo Pe&ntilde;a Rodriguez</td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td valign="top" class="titulosContenidoInterno">Implementaci&oacute;n y metodolog&iacute;a:</td>
	<td valign="top">Lic. Nelson Alexander Mu&ntilde;oz Rivera
		<br>
		Lic. Andr&eacute;s Orlando Blanco Mar&iacute;n</td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr>
	<td valign="top" class="titulosContenidoInterno">Sistemas de informaci&oacute;n:</td>
	<td valign="top">Tec. Angela Maria Benavides</td>
</tr>
</table>
<?	
	PageEnd();
?>