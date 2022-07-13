<?
if(getIP()==IP_ANGELA or getIP()==IP_GUILLERMO)
{
	MakeMenu("Menu");
		MakeMenuItem("Lista de Banners", "http://administracion.univalle.edu.co/Banners/cambiar.php?item=1", false, $_GET['item']==1 or $_GET['item']==5 or !isset($_GET['item']) or !isset($_SESSION['noticias']));
		if(isset($_SESSION['banners']))
			MakeMenuItem("Divulgar un Banner", "http://administracion.univalle.edu.co/Banners/cambiar.php?item=3", false, $_GET['item']==3);
	EndMenu();
}
?>