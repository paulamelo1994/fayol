
<?
	session_start();

	$root_path = "../..";
	require '../../functions.php';
	

?>


<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>

<html>
<title>Buscar Plan</title>
<style type="text/css">
<!--
.Estilo2 {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo3 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
<body>
<form action="" method="get">
<table width="600" border="1" bordercolor="#FF0000">
<tr bgcolor="#cc6666"><td width="591" height="28" align="center" ><span class="Estilo2">Items</span></td>
</tr>
<tr><td>
<table>
	<?

	$buscar= "%".$_GET['texto']."%";
		
	DBConnect('inventario');
	$consulta = "SELECT * from catalogo where codmaterial like '$buscar';";
	
	$rs = db_query($consulta);
	if(pg_num_rows($rs) != 0)
	{
		while($obj = pg_fetch_object($rs))
		{
		?>
			
<tr><td width="600"><pre> <input name="" type="radio" size="24" maxlength="24" value="<?= $obj->codmaterial?>"
  onChange="self.opener.document.forms[0].codMaterial.value = this.value" ><?= $obj->tipocodmaterial?> |	<?= $obj->codmaterial?><br>
  <textarea  cols="70"><?= $obj->titulo?></textarea>
		</pre></td>
		</tr>

		<?		
		}
	}

?>
</td></tr>
</table>
<tr><td height="39" align="center">
<INPUT TYPE="button" VALUE="Aceptar" onClick="window.close()">
</td></tr>
</table>
</form>

</body>
</html>
