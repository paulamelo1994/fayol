<script> 
	$(document).ready(function() {
		window.styleApply = function(){
			 $( ".dateform" ).datepicker({
										  dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
										  monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
										  dateFormat: 'yy-mm-dd' }) 
	     
		}
		 window.applyIntervalId = setInterval("styleApply()",1000/16);

	 }); 
</script>