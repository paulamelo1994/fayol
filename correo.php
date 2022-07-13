<?
   require_once "functions.php";
?>
<form name=form action="/correo-uv.php" method=POST>
<TABLE WIDTH="130" BORDER="0" CELLPADDING="0" CELLSPACING="1" BGCOLOR="#CC6666">
<TR>
	<TD COLSPAN="3" ALIGN="CENTER" BGCOLOR="#cc6666"><IMG SRC="/Images/plantilla/correo-normal.gif" WIDTH="120" HEIGHT="20" ALT=""></TD>
	</TR>
<TR>
	<TD COLSPAN="3" BGCOLOR="#f2f2f2"><TABLE WIDTH="130" BORDER="0" ALIGN="CENTER">
		<TR>
			<TD ALIGN="CENTER"><B>Login</B></TD>
			</TR>
		<TR>
			<TD ALIGN="CENTER"><INPUT NAME="login_username"  TYPE="text" SIZE="10" STYLE="text-align:center;"></TD>
			</TR>
		<TR>
			<TD ALIGN="CENTER"><B>Password</B></TD>
			</TR>
		<TR>
			<TD ALIGN="CENTER"><INPUT NAME="secretkey" TYPE="PASSWORD" SIZE="10" STYLE="text-align:center;"></TD>
			</TR>
		<TR>
			<TD ALIGN="CENTER"><INPUT NAME="submit" TYPE="submit" VALUE="Entrar"></TD>
			</TR>
		<tr><td align="center"><a href="correo/src/login.php">Correo Fayol</a></td></tr>
		</TABLE>
	</TD>
</TR>
</TABLE>

</form>
