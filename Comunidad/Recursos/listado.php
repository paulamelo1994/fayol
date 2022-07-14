<?
   require '../../functions.php';
   $rootPath = '../../';
   
   session_start();
   
   $_GET['submenu_recursos'] = true;
   
   DBConnect('fayol');
	
	if(isset ($_POST['editar']))
	{
		if( $_GET['id'] != 0)
		{
			$conexion= @DBConnect('fayol');
			if( ($conexion)) //Si hay conexion
			{
				db_query('update inventario set espacio=\''.$_POST[espacio].
				'\', responsable=\''.$_POST[responsable].
				'\', inventario=\''.$_POST[inventario].
				'\', elemento=\''.$_POST[elemento].
				'\', modelo=\''.$_POST[modelo].
				'\', marca=\''.$_POST[marca].
				'\', comentario=\''.$_POST[comentario].
			 	'\', serie=\''.$_POST[serie].
				'\', ip=\''.$_POST[ip].
				'\', mac=\''.$_POST[mac].
				'\' where id='.$_GET['id'].'');
				
				header("Location: listado.php");
				
			}
			else
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.En el momento no es posible publicar la noticia solicitada, por favor intentelo m&aacute;s tarde.</p>";
			}	
		}
		
   	}

   PageInit('Listado del Inventario de Recursos', '../menu.php');
   
   
   
   ?> <h1 class="shiny">Listado del Inventario</h1> 

	   <BR>
	   <TABLE WIDTH="90%" BORDER="0" align="center">
	   <TR>
		   <TD width="8%" ALIGN="CENTER" STYLE="color:white; background-color:#CC0000;"><B>Espacio</B></TD>
		   <TD width="13%" ALIGN="CENTER" STYLE="color:white; background-color:#CC0000;"><B>Responsable</B></TD>
		   <TD width="12%" ALIGN="CENTER" STYLE="color:white; background-color:#CC0000;"><B>No. Inventario</B></TD>
		   <TD width="11%" ALIGN="CENTER" STYLE="color:white; background-color:#CC0000;"><B>Elemento</B></TD>
		   <TD width="8%" ALIGN="CENTER" STYLE="color:white; background-color:#CC0000;"><B>Modelo</B></TD>
		   <TD width="7%" ALIGN="CENTER" STYLE="color:white; background-color:#CC0000;"><B>Marca</B></TD>
		   <TD width="5%" ALIGN="CENTER" STYLE="color:white; background-color:#CC0000;"><B>Serie(TAG)</B></TD>
		   <TD width="3%" ALIGN="CENTER" STYLE="color:white; background-color:#CC0000;"><B>IP</B></TD>
		   <TD width="6%" ALIGN="CENTER" STYLE="color:white; background-color:#CC0000;"><B>MAC</B></TD>
		    <TD width="15%" ALIGN="CENTER" STYLE="color:white; background-color:#CC0000;"><B>Observaciones</B></TD>
		  <TD width="12%" ALIGN="CENTER" STYLE="color:white; background-color:#CC0000;"><B>Opciones</B></TD>

		     </TR>
	   <?
	
	  $rs = db_query("select * from inventario order by id desc");
	  $count = 0;
	   while( $obj = pg_fetch_object($rs) )
	   {
	   		
	   		$color = ($color=='#FCFCFC')? '#D0DEE9' : '#FCFCFC';
			if($_GET['id'] == $obj->id)
			{
				echo "<TR BGCOLOR='$color'>";?>
				
				<FORM METHOD="POST" enctype="multipart/form-data" action="">
				<td b><input name="espacio" type="text" value="<?=$obj->espacio?>" size=4 ></td>
				<td><textarea name="responsable" cols="10" rows="2"><?=$obj->responsable?>
				</textarea></td>
				<td><input name="inventario" type="text" value="<?=$obj->inventario?>" size=6></td>
				<td><input name="elemento" type="text" value="<?=$obj->elemento?>" size=8 ></td>
				<td><input name="modelo" type="text" value="<?=$obj->modelo?>" size=8></td>
				<td><input name="marca" type="text" value="<?=$obj->marca?>" size=6 ></td>
				<td><input name="serie" type="text" value="<?=$obj->serie?>" size=8 ></td>
				<td><input name="ip" type="text" value="<?=$obj->ip?>" size=12></td>
				<td><input name="mac" type="text" value="<?=$obj->mac?>" size=15></td>
				<td><textarea name="observaciones" cols="14" wrap="OFF" width="12"><?=$obj->observaciones?>
				</textarea></td>
				
				<td ><input name="editar" type="submit" value="Editar"></td>
				
				</FORM></TR><?
			}
		  	else
			{
				echo "
				<TR BGCOLOR='$color'>
				<TD>$obj->espacio</TD>
				<TD>$obj->responsable</TD>
				<TD>$obj->inventario</TD>
				<TD>$obj->elemento</TD>
				<TD>$obj->modelo</TD>
				<TD>$obj->marca</TD>
				<TD>$obj->serie</TD>
				<TD>$obj->ip</TD>
				<TD>$obj->mac</TD>
				<TD>$obj->observaciones</TD>
				<TD><a href=\"listado.php?id=$obj->id\">editar</a></TD>
			  </TR>";
		  }
	   }
	   ?>
	   </TABLE>
	<?
  
   PageEnd();
?>
