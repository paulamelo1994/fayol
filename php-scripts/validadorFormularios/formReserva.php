	<script language="JavaScript" type="text/JavaScript" src='<?= $rootPath?>/php-scripts/scripts/jquery.validate.min.js'></script>	
	<script type="text/javascript">
		
				$(function(){
					$("#reserva2").validate({
							rules: {
									'profesor': "required",
									'tema':"required",
									'protocolo': "required",
									'tipo_reserva':"required",
									'hora_fin':"required"
							},
							messages: {
									'profesor': " * Por favor ingrese el nombre de profesor",
									'tema':" * Por favor ingrese el tema",
									'protocolo': " * Por favor ingrese los protocolos",
									'tipo_reserva':" * Seleccione el tipo de la reserva",
									'hora_fin':" * Seleccione la hora de finalización"
							}
						}),
						$("#reserva3").validate({
							rules: {
									'observaciones': "required"
									},
							messages: {
									'observaciones': " * Este campo es necesario para realizar la cancelacion"
									
							}
						}),
						$("#reserva4").validate({
							rules: {
									'Login': "required",
									'Password': "required"
									},
							messages: {
									'Login': " <br>* Este campo es necesario",
									'Password': "<br>* Este campo es necesario"
									
							}
						}),
						$("#estaadisticas").validate({
							rules: {
									'sala': "required",
									'fecha1': "required",
									'fecha2': "required"
									},
							messages: {
									'sala': "<br> * Este campo es necesario",
									'fecha1': " <br>* Este campo es necesario",
									'fecha2': " <br>* Este campo es necesario"
									
							}
						}),
						$("#estaadisticas2").validate({
							rules: {
									'tipo': "required",
									'sala': "required",
									'desde': "required",
									'hasta': "required"
									},
							messages: {
									'tipo': "<br> * Este campo es necesario",
									'sala': "<br>* Este campo es necesario",
									'desde': "<br>* Este campo es necesario",
									'hasta': "<br>* Este campo es necesario"
									
							}
						})
						
				});
	</script>