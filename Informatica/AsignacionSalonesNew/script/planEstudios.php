<script>
	$(function() {
		$( "#plan" ).autocomplete({
			source: "../Formularios/searchPlanEst.php",
			minLength: 1
		});
	});
</script>