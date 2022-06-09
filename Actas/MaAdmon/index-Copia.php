<?
   require '../../../functions.php';
   $rootPath = '../../../';
   
   $valign = 'top';
   $centrar_contenido = false;
   //$_GET['submenu_actas'] = true;
   $_GET['actas_MaAdmon'] = true;
   
   //PageInit('Actas de la Maestr&iacute;a de Administraci&oacute;n y Ciencias de la Organizaci&oacute;n', '../../menu.php', 'left', 'top');
?>
<H2 STYLE="color:black;">
  <?= IMAGEN_ACTAS_MINI ?>
A&ntilde;o 2004:</H2>

<table width="100%">
<tr>
<td width="30">&nbsp;</td>
<td>
	<table width="100%" border="0">
	<tr>
		<td width="25%"><A href="<?=makeURL("Acta No 01-04.pdf")?>" target="actas">Acta 1. Mar 3 </a></td>
		<td width="25%"><a href="<?=makeURL("Acta No 02-04.pdf")?>" target="actas">Acta 2. Abr 16 </a></td>
		<td width="25%"><a href="<?=makeURL("Acta No 03-04.pdf")?>" target="actas">Acta 3. May 4 </a></td>
		<td width="25%"><a href="<?=makeURL("Acta No 04-04.pdf")?>" target="actas">Acta 4. Jun 2 </a></td>
	</tr>
	<tr>
		<td><a href="<?=makeURL("Acta No 05-04.pdf")?>" target="actas">Acta 5. Jun 29</a></td>
	</tr>
	</table>
	</td>
</tr>
</table>
<? 
   //PageEnd();
?>