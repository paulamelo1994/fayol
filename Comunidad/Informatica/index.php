<?
	require '../../functions.php';
	$rootPath = '../..';
	
	$_GET['submenu_informatica'] = true;
	
	
  if($_GET['item']==0)
	{
	switch( $_GET['pagina'] )
		{
			case 1:
				Titulo("Salas de computo");
				@include "http://administracion.univalle.edu.co/~luispena/directorio/horarios_salas.html";
				break;				
		}
	
	}
	
	PageInit('Informaci&oacute;n General', '../menu.php');
	 
	?>
	<h1 class="shiny"><IMG SRC="/Images/informacion.gif" alt=""> Informaci&oacute;n General</h1>
	<P>El Grupo de Soporte de Aulas Inform&aacute;ticas se encarga de dar el soporte inform&aacute;tico, tanto en 
	recursos humanos como materiales, para facilitar en la medida de lo posible la labor docente de los profesores, 
	en lo que tiene que ver con sus necesidades inform&aacute;ticas docentes, y dotar a los alumnos que cursan sus 
	estudios en nuestra Universidad de unos puestos inform&aacute;ticos que supongan un apoyo fundamental en su 
	formaci&oacute;n.
	<br><br>
	Contamos con 4 salas de sistemas en nuestra Facultad, 2 dedicadas a estudiantes de pregrado (salas 1 y 2), 1 a 
	estudiantes de posgrado (sala 4) y 1 laboratorio contable (sala 3). Para ingresar a nuestras salas necesita 
	presentar su carnet renovado de la Universidad, o en caso de haberlo perdido, se consultar&aacute; su tabulado 
	de matricula y debe presentar documento de identidad. El acceso a la sala 4 es totalmente exclusivo para los 
	estudiantes de postgrado.
	<br><br>
	Las aulas inform&aacute;ticas permanecen abiertas  de lunes a viernes de  7AM a 1PM y 2PM a 9:30PM, y los 
	s&aacute;bados de 7AM a 1PM y 2PM a 6PM.</P>
	<?
	PageEnd();
?>	  