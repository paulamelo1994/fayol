<html>
<head>
    <title>Confirmaci�n de env�o de formulario</title>
<script language="JavaScript">
function pregunta(){
    if (confirm('�Estas seguro de enviar este formulario?')){
       document.tuformulario.submit()
    }
}
</script>
</head>

<body>
<form name=tuformulario action="http://www.desarrolloweb.com">
<input type="text" name="cualquiercampo">
<input type=button onclick="pregunta()" value="Enviar">
</form>

</body>
</html>