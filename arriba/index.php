<html>  
<head>  
<script type="text/javascript">  
var num=1;  
function contador() {  
  num--;  
  if(num==0) location='http://administracion.univalle.edu.co';  
  document.getElementById('seg').innerHTML=num;  
}  
</script>  
</head>  
<body onload="setInterval('contador()',1000)">  
<p>Redirigiendo a <a href="http://administracion.univalle.edu.co">http://administracion.univalle.edu.co <a> en <span id="seg">10</span> segundos.</p>  
</form>  
</body>  
</html> 