<?
/*
 * Script para crear las fechas del formulario reservSalas dinamicamente
 */
?>
<script language="javascript" type="text/javascript"> 
		var posicionCampo=1;
		
		function agregarFecha(){
		
			nuevaFila = document.getElementById("otra_fecha").insertRow(-1);
			
			nuevaFila.id=posicionCampo;
			
			nuevaCelda=nuevaFila.insertCell(-1);			
			nuevaCelda.innerHTML="<td></td>";
			
			
			nuevaCelda=nuevaFila.insertCell(-1);			
			nuevaCelda.innerHTML="<td colspan='2'><input class='dateform' name='dateform["+posicionCampo+"]' type='text' size='10' maxlength='10' ></td><input type='button' name='eliminarFecha' value='Eliminar' onclick='eliminarAccion(this)'></td>";
			
			posicionCampo++;


		
		}
		
		function eliminarAccion(obj){
		
		var oTr = obj;
		
		while(oTr.nodeName.toLowerCase()!='tr'){
		
		oTr=oTr.parentNode;
		
		}
		
		var root = oTr.parentNode;
		
		root.removeChild(oTr);
		
		}
		
	</script>