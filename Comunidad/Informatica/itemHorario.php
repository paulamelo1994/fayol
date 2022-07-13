<?php
require "../../functions.php";


	if(!isset($_SESSION['profesor']))
	{
		$_GET['submenu_informatica'] = true;
	}
	else
	{
		$_GET['submenu_informatica'] = null;
		$_GET['submenu_asignacion'] = true;
	}
	
	$rootPath = "..";
	
	PageInit("Comunidad","../menu.php");
	
	  
	if($_GET['item']==0)
	{
	switch( $_GET['pagina'] )
		{
			case 1:
				Titulo("Salas de computo"); ?>
				<iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;mode=WEEK&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=qbkc91p7bbqeahkor753dch1f0%40group.calendar.google.com&amp;color=%232F6309&amp;src=pslfphruu39h4jr60b015ckrbo%40group.calendar.google.com&amp;color=%23B1365F&amp;src=jednbeesnruj3klj5m43te5en8%40group.calendar.google.com&amp;color=%235229A3&amp;src=s03bm6g0avcsgbe7e8nd2ct4uk%40group.calendar.google.com&amp;color=%23875509&amp;src=br1jo4o2vle6h8dj7kl7f02qr4%40group.calendar.google.com&amp;color=%23B1440E&amp;src=0h5abdc1d6galdafdt1a6ar8gs%40group.calendar.google.com&amp;color=%2362e79a&amp;src=1hnr5ddm463d4baqgd2pr00f2s%40group.calendar.google.com&amp;color=%23182C57&amp;ctz=America%2FBogota" style="border:solid 1px #777" width="600" height="600" frameborder="0" scrolling="no"></iframe>
				<?
				break;				
		}
	
	}
?>