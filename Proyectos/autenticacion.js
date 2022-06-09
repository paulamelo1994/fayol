
Ext.onReady(function(){
    Ext.QuickTips.init();
 
    var login = new Ext.FormPanel({ 
		width:300,
        labelWidth:60,
        url:'autenticacion.php', 
        frame:true, 
        title:'Autentiaci&oacute;n', 
        defaultType:'textfield',
		monitorValid:true,

			items:[{ 
                fieldLabel:'Login', 
                name:'login', 
                allowBlank:false 
            },{
                fieldLabel:'Password', 
                name:'password', 
                inputType:'password', 
                allowBlank:false
            }],
 
	       buttons:[{ 
                text:'Ingresar',
                formBind: true,	 
                handler:function(){
                    login.getForm().submit({ 
                        method:'POST', 
                        waitTitle:'Connecting', 
                        waitMsg:'Sending data...',

						success:function(){
							
                        	Ext.Msg.alert('Status', 'Actualizaci&oacute;n Satisfactoria!', function(btn, text){
				   				if (btn == 'ok'){
		                        	var redirect = 'proyectos.php'; 
		                        	window.location = redirect;
                                }
			        		});
                 		},
 
                        failure:function(form, action){ 
                            if(action.failureType == 'server'){ 
                                obj = Ext.util.JSON.decode(action.response.responseText);
                                Ext.Msg.alert('Login Failed!', obj.errors.reason);
                            }else{
                                Ext.Msg.alert('Warning!', 'No se ha podid actualizar el proyecto : ' + action.response.responseText);
                            }
							
                            login.getForm().reset(); 
                        } 
                    }); 
                } 
            }] 
    });
	
	login.render ( 'autenticacion' );
});