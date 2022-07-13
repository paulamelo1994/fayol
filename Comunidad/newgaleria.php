<?
$idImagen=$_GET['id'];

	if($idImagen==0){
		header("Location: /Images/NuevosEventos/ESCUELA_INTERNACIONAL_DE_VERANO.pdf");
		die();
		
	}
	if($idImagen==1){
	
	?>
	<TD ALIGN="CENTER" VALIGN="MIDDLE">
				<IMG BORDER="0"  SRC="/Images/NuevosEventos/EXPLORARTE2.jpg" width="700">
	</TD>
				
	<?
	}
	
?>