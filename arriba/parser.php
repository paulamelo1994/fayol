<?



/*
Este scrip simplemente cambia  las tildes y comillas del texto q este en la variables texto.
De hecho hay un fucion q hace esto en mis-funcion, pero lo saque aca para mayor comodida
*/

	$texto = '
El Cuse mediante el uso de simuladores y la aplicaci&oacute;n de la l&oacute;gica empresarial unida a la l&oacute;gica tecnol&oacute;gica permite a los estudiantes de pregrado y postgrado resolver problemas pr&aacute;cticos de las empresas en donde se aplique la tecnolog&iacute;a y haya un gran uso y apoyo en los sistemas de informaci&oacute;n 
';
	
	$texto = ereg_replace("á", "&aacute;", $texto);
	$texto = ereg_replace("é", "&eacute;", $texto);
	$texto = ereg_replace("í", "&iacute;", $texto);
	$texto = ereg_replace("ó", "&oacute;", $texto);
	$texto = ereg_replace("ú", "&uacute;", $texto);
	
	$texto = ereg_replace("Á", "&Aacute;", $texto);
	$texto = ereg_replace("É", "&Eacute;", $texto);
	$texto = ereg_replace("Í", "&Iacute;", $texto);
	$texto = ereg_replace("Ó", "&Oacute;", $texto);
	$texto = ereg_replace("Ú", "&Uacute;", $texto);
	
	$texto = ereg_replace("ñ", "&ntilde;", $texto);
	$texto = ereg_replace("Ñ", "&Ntilde;", $texto);
	
	$texto = ereg_replace('"', "&quot;", $texto);
	
	$texto = ereg_replace('“', "&quot;", $texto);
	
	$texto = ereg_replace(" & ", " &amp; ", $texto);
	
	$texto = ereg_replace("-", " &ndash; ", $texto);
	/*
	$texto = ereg_replace( "&aacute;", "á;",$texto);
	$texto = ereg_replace("&eacute;", "é", $texto);
	$texto = ereg_replace( "&iacute;", "&iacute;",$texto);
	$texto = ereg_replace( "&oacute;", "&oacute;",$texto);
	$texto = ereg_replace( "&uacute;", "&uacute;",$texto);
	
	$texto = ereg_replace( "&Aacute;", "Á",$texto);
	$texto = ereg_replace( "&Eacute;", "&Eacute;",$texto);
	$texto = ereg_replace( "&Iacute;","&Iacute;", $texto);
	$texto = ereg_replace( "&Oacute;", "&Oacute;",$texto);
	$texto = ereg_replace( "&Uacute;", "&Uacute;",$texto); 
	
	$texto = ereg_replace( "&ntilde;","&ntilde;", $texto);
	$texto = ereg_replace( "&Ntilde;", "&Ntilde;",$texto);

	$texto = ereg_replace( "&quot;", "''",$texto);
	$texto = ereg_replace( '"', "'",$texto);
	
	$texto = ereg_replace("&quot;", "''", $texto);
	
	$texto = ereg_replace("&amp;", " & ", $texto); ;
	
	$texto = ereg_replace( "&ndash;", " - ",$texto);
	
	$texto = ereg_replace( "&ordm;", "º",$texto);
	
	$texto = ereg_replace( "<p", 'mi_texto.text +=  "<p',$texto);
	$texto = ereg_replace( "</p>", '</p><br>";',$texto);
	
	$texto = ereg_replace( "<ul>", 'mi_texto.text +=  "<ul>";',$texto);
	$texto = ereg_replace( "</ul>", 'mi_texto.text +=  "</ul><br>";',$texto);
	$texto = ereg_replace( "<li>", 'mi_texto.text +=  "<li>',$texto);
	$texto = ereg_replace( "</li>", '</li>";',$texto);	
	$texto = ereg_replace( "<h1>", 'mi_texto.text +=  "<h1><b>',$texto);
	$texto = ereg_replace( "</h1>", '</b></h1><br><br>";',$texto);	
	$texto = ereg_replace( "<h3>", 'mi_texto.text +=  "<h3><b>',$texto);
	$texto = ereg_replace( "</h3>", '</b></h3><br><br>";',$texto);	
	$texto = ereg_replace( "<h2>", 'mi_texto.text +=  "<h2><b>',$texto);
	$texto = ereg_replace( "</h2>", '</b></h2><br>";',$texto);	
	$texto = ereg_replace( "strong", 'b',$texto);
	*/


	echo($texto);

?>