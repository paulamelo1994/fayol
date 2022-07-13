<?
   require_once "functions.php";

   	
	PageInit("Correo Servidor Fayol");
?>
<form name=form action="/correo-fayol.php" method=POST>
<div align="center">
<pre ><B>Login</B>    <INPUT NAME="login_username"  TYPE="text" SIZE="10" STYLE="text-align:center;"><br>
<B>Password </B><INPUT NAME="secretkey" TYPE="PASSWORD" SIZE="10" STYLE="text-align:center;"><br>
<INPUT NAME="submit" TYPE="submit" VALUE="Entrar"></TD>
</pre></div>
</form>

<?
  PageEnd();
?>
