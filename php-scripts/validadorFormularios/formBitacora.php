		<script language="JavaScript" type="text/JavaScript" src='<?= $rootPath?>/php-scripts/scripts/jquery.validate.min.js'></script>	
		<script type="text/javascript">
		   	$(function(){
					
				$("#bitacora").validate({
					event: "blur",
					rules: {
							'periodo':"required",
							'dateform': "required",
							'accion':"required"
					},
					messages: {
							'periodo':" * Es necesario este campo",
							'dateform': " * Es necesario este campo",
							'accion':" * Es necesario este campo"
					}
				})
				
			});

		</script>
