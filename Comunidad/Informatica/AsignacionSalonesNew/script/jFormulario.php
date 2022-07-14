<?
/*
 * Script para listas dinamicas en el formulario reservaSalas
 */
 $root_path = "../../../..";
 require_once '../../../../php-scripts/JSON.php';
?>
<script type="text/javascript">
	$(function(){
		$("#tipo_reserva").bind("change", function(elem){
			var value1 = $("#tipo_reserva").val();
			if(value1=='Taller'){
				$("#ocultoTalleres").fadeIn("slow");
			}else{
				$("#ocultoTalleres").fadeOut("slow");
			}
			
			if(value1=='Clase Informatica'){
				$("#ocultoInformatica").fadeIn("slow");
			}else{
				$("#ocultoInformatica").fadeOut("slow");
			}
			
			//Para que el campo de planes de estudio no sea editable en caso de que sea una Capacitacio, un Diplomado o una Practica dirijida
			if((value1== 'Clase Diplomado' )|| (value1== 'Capacitacion' )|| (value1== 'Practica Dirigida' )){
				$('#plan').attr('readonly',true);
			}else{
				$('#plan').attr('readonly',false);
			}
			
			$.post("reservar.php", {ajax:'true', traer_h: 'true',fecha: $('#fecha_reserva').val(), hora:$('#hora_ini').val(), sala: $('#sala').val() },function (data) {
				$('#hora_fin').removeOption(/./);
				if((value1== 'Taller' )|| (value1== 'Clase Unica' )|| (value1== 'Clase Informatica' )){
					$('#hora_fin').attr('disabled',false);
					$('#hora_fin').addOption('','Seleccione una');
					var i=0;
					$.each(data, function(i, val) {
						if(i<=3){
							$('#hora_fin').addOption(val.id, val.name);     
						}
						i=i+1;
					});
					$("#hora_fin").val('');
				}

                if((value1== 'Clase Postgrado' )|| (value1== 'Clase Diplomado' )|| (value1== 'Capacitacion' )|| (value1== 'Practica Dirigida' )){	
					$('#hora_fin').attr('disabled',false);
					$('#hora_fin').addOption('','Seleccione una');
					$.each(data, function(i, val) {
						$('#hora_fin').addOption(val.id, val.name);     
					});
					$("#hora_fin").val('');
				}   
			}, "json");
			if(value1==""){
				$('#hora_fin').attr('disabled',true);
			}
		});
		// Para cuando hay cambios en cualquiera de los campos o listas del formulario para validar de nuevo la disponibilidad
		$("#tipo_reserva,#fecha_reserva,#hora_ini,#dateform,#dateform2,#hora_fin").bind("change", function(){
			$('#disponible').attr('value',false);
			$('#aceptar').attr('value','Evaluar/Enviar');
		});
		
	});
	</script>