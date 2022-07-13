<?php
function nombreServidor($login,$passwd) {

 $ldaphost = "ldap://fayolunivalle.edu.co/";  //calvin.univalle.edu.co
    $ds=ldap_connect("$ldaphost") or die( "Could not connect to {$ldaphost}" );
    if ($ds) {
        if (!ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3)) {
           echo "Failed to set LDAP Protocol version to 3, TLS not supported.<p>";
        }
        // Aqui es donde realmente se verifica la clave
        $bind=@ldap_bind($ds,"uid=$login,ou=Usuarios,dc=univalle,dc=edu,dc=co","$passwd");
        if (!$bind) {
		return "";
//            echo "La contrase\xf1a es incorrecta o no existe el usuario<p>";
        }
        // De aqui en adelante ya es hacer busquedas, etc, no es necesario
        $atributos = array("mail");
        $nombrediuser="$login";
        $result=@ldap_search($ds,"uid=$nombrediuser,ou=Usuarios,dc=univalle,dc=edu,dc=co","cn=*");
        $info = @ldap_get_entries($ds, $result);
        $email=$info[0]["mail"][0];
        list ($aliasLogin,$aliasServidor) = split("@",$email);
	return $aliasServidor;
    }
    ldap_close($ds);
}

	# Hasta aqui
$ifMafalda = nombreServidor($login_username,$secretkey);

$local=0;
$file = fopen('/etc/passwd','r');
while (!feof($file)) {
        $linea = fgets($file,1000);
        $datos = split(":",$linea);
        if($datos[0]==$login_username)
                $local=1;
}/*
if($local)
*/        header("Location: http://administracion.univalle.edu.co/correo/src/redirect.php?login_username=$login_username&secretkey=$secretkey&js_autodetect_results=0just_logged_in=1");
/*
else if ($ifMafalda == "mafalda.univalle.edu.co") 
	header("Location: https://correo.univalle.edu.co/index.php3?login_username=$login_username&login_password=$secretkey&login_server=mafalda&twig_session=a%3A1%3A%7Bs%3A7%3A%22mailbox%22%3Bs%3A5%3A%22INBOX%22%3B%7D&set_twig_authenticated=Entrar");
*//*
else*/
//	header("Location: https://swebse06.univalle.edu.co/correo/src/redirect.php?login_username=$login_username&secretkey=$secretkey&js_autodetect_results=0just_logged_in=1");
?>
