/*
 * jQuery validation plug-in 1.7
 *
 * http://bassistance.de/jquery-plugins/jquery-plugin-validation/
 * http://docs.jquery.com/Plugins/Validation
 *
 * Copyright (c) 2012 -  Jhon cardona
 *
 * $Id: jquery.validate.js 6403 2009-06-17 14:27:16Z joern.zaefferer $
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

$(function(){
	$('#registrarEstudiante').validate({
		rules: {
		'nombre': 'required',
		'apellido': 'required',
		'codigo': { required: true, number: true },
		'nodoc': { required: true, number: true },
		'codplan': { required: true, number: true },
		//'email': { required: true, email: true },
		'tipodoc': 'required'//,
		//'deportes[]': { required: true, minlength: 1 }
		},
		messages: {
		'nombre': 'Debe ingresar el nombre',
		'apellido': 'Debe ingresar el apellido',
		'codigo': { required: 'Debe ingresar el codigo del estudiante', number: 'Debe ingresar un número' },
		'nodoc': { required: 'Debe ingresar el número de documento de identidad', number: 'Debe ingresar un número' },
		'codplan': { required: 'Debe ingresar el codigo del plan', number: 'Debe ingresar un número' },
		//'email': { required: 'Debe ingresar un correo electrónico', email: 'Debe ingresar el correo electrónico con el formato correcto. Por ejemplo: u@localhost.com' },
		'tipodoc': 'Debe seleccionar un Tipo de documento'//,
		//'deportes[]': 'Debe seleccionar mínimo un deporte'
		},
		debug: true,
		/*errorElement: 'div',*/
		//errorContainer: $('#errores'),
		submitHandler: function(form){
			alert('El formulario ha sido validado correctamente!');
		}
	});
});