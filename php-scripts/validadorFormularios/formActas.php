
		<script language="JavaScript" type="text/JavaScript" src='<?= $rootPath?>/php-scripts/scripts/jquery.validate.min.js'></script>	
		<script type="text/javascript">
		   	$(function(){
					
				$("#actas").validate({
					event: "blur",
					rules: {
							n_acta:{
										required:true
									  },
							dateform:{
										required:true
									  },
							archivo:{
										required:true
									  },
							tipo:{
										required:true
									  }
					},
					messages: {
							n_acta:{
										required:" * Es necesario este campo"
									  },
							dateform:{
										required:" * Es necesario este campo"
									  },
							archivo:{
										required:" * Es necesario este campo"
									  },
							tipo:{
										required:" * Es necesario este campo"
									  }
					}
				})
				
			});

		</script>
