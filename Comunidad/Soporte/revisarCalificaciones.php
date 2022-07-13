<?
require '../../functions.php';
   $root_path = "../..";

		$con= @DBConnect('fayol');
	
			if(!empty($con)){
									
				$consulta=db_query("select solicitud from fichaatencionsoporte where estado='t' and fecha>='2010-09-01'
							except
							select numsolicitud from calificacionsoporte;");
				
				while( $obj = pg_fetch_object($consulta)){
				$id = $obj->solicitud;
				
				
				$email=db_query("select email from solicitudSoporte where numsolicitud='$id';");
				$obj1 = pg_fetch_object($email);
				$correo = $obj1->email;
				
		
				$mensaje = "Porfavor llenar el formulario de calificacion de Soporte tecnico, que se encuentra en el siguiente \n enlace: http://administracion.univalle.edu.co/Comunidad/Soporte/formularioEvaluacion.php?id_peticion=$id
						Gracias";
					if(!empty($email))
					{
						//mail("$correo", "Calificacion Soporte Tecnico", "\n$mensaje\n\n", "From: Soporte Tecnico Facultad Administracion");
						//mail("webwoman@univalle.edu.co", "Calificacion Soporte Tecnico", "\n$mensaje\n\n", "From: Soporte Tecnico Facultad Administracion");
						
					}
					mail("jhonjcm2@gmail.com", "Calificacion Soporte Tecnico", "\n$mensaje\n\n", "From: Soporte Tecnico Facultad Administracion");
					mail("dalatinrofrau@gmail.com", "Calificacion Soporte Tecnico", "\n$mensaje\n\n", "From: Soporte Tecnico Facultad Administracion");
			     }
		   }

?>