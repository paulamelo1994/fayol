<?php if(isset($_SESSION["user_id"])):?>
<div class="row">
<div class="col-md-12">
<h1>Gestion de salones Univalle - San Fernando</h1>
<p><b>Guía de uso</b> de sistema de reserva de salones  </p>
<h4> Reservación de Salones</h4>
<ul>
<p>En el apartado de Salones junto a los salones listados</p> 
<p>se encuentran las acciones para reservar salones y visualizar sus reservas realizadas. </p>
<P>al dar click en "Reservar" se redigirá al formulario de reserva, </p>
<P>el usuario deberá gestionar todos los campos obligatorios marcados con un asterísco (*) </p>
<P>para poder guardar la reserva. En caso de la reserva ya haberse realizado</p>
<P>o haber un cruce de horarios con otra reserva anteriormente realizada</p>
<P>el sistema no guardará dicha reserva. </p>
</ul>
<h4> Disponibilidad de Salones</h4>
<ul>
<p>En caso de que el usuario desee consultar los salones disponibles en determinada fecha y horario</p>
<p>podra dirigirse al apartado de Disponibilidad en el que tendrá que ingresar las horas y la fecha</p>
<p>en los campos solicitados y dar click en buscar para obtener el listado de los salones disponibles</p>
<p>en la fecha y horarios solicitados.</p>    
	
</ul>
<h4> Gestión de Reservas</h4>
<ul>
<p>En el apartado de Reservas encontraremos en listado de todas las reservas realizadas por el usuario</p>
<p>y sus respectivas acciones de eliminación y edición, también encontraremos la función de búsqueda </p>
<p>con la cual se podrán filtrar las reservas que el usuario desee consultar.</p>
<p>La consulta se puede realizar ingresando el nombre del docente, tipo de reserva o asignaruta en el primer campo</p>  
<p>o ingresando el salon así como también la fecha en los campos contiguos y después haciendo click </p>
<p>en el botón de "Buscar".</p>	
	
</ul>
<footer><p>Desarrollado por <b>Johan David Mera</b> - Universidad del Valle &copy; 2018</p> </footer> 

</div>
</div>
<?php endif;?>