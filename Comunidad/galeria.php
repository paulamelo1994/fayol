<?
	require "../functions.php";
	$rootPath = "..";
	
	PageInit('Galer&iacute;a de Fotos');
	?>
	<h1 class="shiny"><IMG SRC="/Images/galeria.gif" alt=""> Galer&iacute;a de fotos</h1>
	<P>De click en una foto para verla en su tama&ntilde;o original</P>
	<?
  
	$dir = opendir("$rootPath/Images/Galeria/Thumbnails");
	
	#Numero de fotos por fila de la tabla 
	$photosPerRow = 4;
	$numFoto = 0;
	?>
	<TABLE BORDER="0">
	<?
	# Para todas las fotos
	while($image = readdir($dir))
	{
		if($image=='.' || $image=='..')
			continue;
	
		#Si la imagen de destino existe, hagale un link con este thumbnail
		if(@file("$rootPath/Images/Galeria/Fotos/$image"))
		{
			if(!$numFoto) echo "<TR>";
			
			//Con esto hago el link ala pagina de encientro ascolfa, q es la imagen 2
			if ($image=="diplomados.jpg")
			{
			?>			
				<TD ALIGN="CENTER" VALIGN="MIDDLE">
				<A HREF="../Programas/diplomados.php">
				<IMG BORDER="0"    SRC="/Images/Galeria/Thumbnails/<?=$image?>" alt=""></A>
				</TD>
			<?
			}
			else
			{
			?>
				<TD ALIGN="CENTER" VALIGN="MIDDLE">
				<A HREF="/Images/Galeria/Fotos/<?=$image?>">
				<IMG BORDER="0"  SRC="/Images/Galeria/Thumbnails/<?=$image?>" alt=""></A>
				</TD>
			<?
			}
			
			$numFoto++;
			if($numFoto==$photosPerRow) echo "</TR>";
			$numFoto %= $photosPerRow;
		}
	}
	?>
	</TABLE>
	<?

  PageEnd();
?>