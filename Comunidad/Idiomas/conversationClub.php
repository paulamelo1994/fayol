<?
	/********************************************************
	Aplicacion: Inventario
	Archivo: conversationClub.php
	Objetivo: Archivo que lista las actividades programadas en la sala.
	Autor: Angela Benavides
	Año: 2007
	*********************************************************/
	
	session_start();
	
	require '../../functions.php';
	$root_path = "../..";
	
	$_GET['submenu_idiomas'] = true;
	
	PageInit("Conversation Club", "../menu.php");
?>
<h1 class="shiny">Conversation Club</h1>
<h3>Se han programado las siguientes reuniones para llevar a cabo el club de conversaci&oacute;n:</h3>
<br>
<ul>
	<li><b>Fecha:</b> <u>Febrero 23 de 2007</u>&nbsp;&nbsp;&nbsp;&nbsp;<b>Hora:</b> 1:00 pm. - 2:00 pm.&nbsp;&nbsp;&nbsp;&nbsp;<b>Idioma:</b> Ingl&eacute;s&nbsp;&nbsp;&nbsp;&nbsp;<br>
	<b>Tema:</b> Caso Nike<br>
	<b>Proponente:</b> Prof. Carlos Calle
	<br><br>
	</li>
	<li><b>Fecha:</b> <u>Marzo 02 de 2007</u>&nbsp;&nbsp;&nbsp;&nbsp;<b>Hora:</b> 1:00 pm. - 2:00 pm.&nbsp;&nbsp;&nbsp;&nbsp;<b>Idioma:</b> Ingl&eacute;s&nbsp;&nbsp;&nbsp;&nbsp;<br>
	<b>Tema:</b> Cesar y la caida de la republica.<br>
	<b>Proponente:</b> Lic. Nelson Alexander Mu&ntilde;oz Rivera
	<br><br>
	</li>
	<li><b>Fecha:</b> <u>Marzo 09 de 2007</u>&nbsp;&nbsp;&nbsp;&nbsp;<b>Hora:</b> 1:00 pm. - 2:00 pm.&nbsp;&nbsp;&nbsp;&nbsp;<b>Idioma:</b> Ingl&eacute;s&nbsp;&nbsp;&nbsp;&nbsp;<br>
	<b>Tema:</b> Introducing yourself.<br>
	<b>Proponente:</b> Joao Bolivar
	</li>
</ul>
<?	
	PageEnd();
?>