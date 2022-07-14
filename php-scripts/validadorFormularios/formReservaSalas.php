
	<script language="JavaScript" type="text/JavaScript" src='<?= $rootPath?>/php-scripts/scripts/jquery.validate.min.js'></script>	
	<script type="text/javascript">
		
				$(function(){
					$("#reservaSalas").validate({
							rules: {
									'hora_ini': "required",
									'tipo_software': "required",
									'tipo_programa': "required",
									'asignatura': "required",
    								'no_estudiantes': "required",
									'grupo': "required",
									'contenido': "required",
									'profesor': "required",
									'tipo_reserva':"required",
									'hora_fin':"required",
									'submitHandler':"required"
							},
							messages: {
									'tipo_software': " <br> * Seleccione el tipo de software",
									'tipo_programa': "<br> *Seleccione el tipo de programa ",
									'asignatura': " <br>* Por favor ingrese la asignatura",
									'no_estudiantes':"<br> * Por favor ingrese la cantidad de estudiantes",											
									'grupo': "<br> * Por favor ingrese el grupo",
									'contenido': "<br> * Por favor ingrese el contenido",
									'profesor': "<br> * Por favor ingrese el nombre del docente",
									'tipo_reserva':"<br>  * Seleccione el tipo de la reserva",
									'hora_fin':"<br> * Seleccione la hora de finalización",
									'submitHandler':"<br> * No se ha validado la disponibilidad de la sala"
							},
							submitHandler: function(form) {
							   	if($('#disponible').val()== 'true'){
									form.submit();
								}else{
									$.post("reservar.php", $('#reservaSalas').serialize(true),function (data){
										if(data=='reservar'){
											$('#disponible').attr('value','true');
											form.submit();
										}else{	
											$('#ocultoMensDisp').html(data).show();
											if(($("#tipo_reserva").val()=='Taller')||($("#tipo_reserva").val()=='Clase Informatica')){
												$('#disponible').attr('value','true');
												$('#aceptar').attr('value','Enviar de todas formas');
											}
										}
															
									}, "json");	
								}
	
							},
							debug: true
					});
				});
	</script>