<script>
	$(function() {
		$( "#profesor" ).autocomplete({
			source: "../Formularios/searchDocentes.php",
			minLength: 1
		});
	});
</script>
