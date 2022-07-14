		<script language="JavaScript" type="text/JavaScript" src='<?= $rootPath?>/php-scripts/scripts/jquery.validate.min.js'></script>	
		<script type="text/javascript">
		   	$(function(){
					
				$("#consultaEst").validate({
					event: "blur",
					rules: {
							'codigoEst': "required"
					},
					messages: {
							'codigoEst': " * Es necesario el código del estudiante"
					},
				})
				
				$("#datosEst").validate({
					event: "blur",
					rules: {
							'nombreEst': "required",
							'apellidoEst':"required",
							'tipodoc':"required",
							'numDoc':"required",
							'codigoPlan':"required",
							'login':"required",
							'passEst':"required"
					},
					messages: {
							'nombreEst': " * Este campo es obligatorio",
							'apellidoEst':"* Este campo es obligatorio",
							'tipodoc':"* Este campo es obligatorio",
							'numDoc':"* Este campo es obligatorio",
							'codigoPlan':"* Este campo es obligatorio",
							'login':"* Este campo es obligatorio",
							'passEst':"* Este campo es obligatorio"
					},
				})
			});

		</script>