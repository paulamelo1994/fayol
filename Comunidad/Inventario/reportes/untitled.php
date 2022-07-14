<?php
            

echo '<head>
            

              <title>'.$_SERVER[PHP_SELF].'</title>
            

      </head>
            

      <html>
            

      <body>';
echo '<script languaje="JavaScript">
            

      var varjs="variable en JavaScript ";
            

</script>';
if (! isset($_POST[variable_php]))
            

{
            

      echo '<form action="'.$_SERVER[PHP_SELF].'" method=post name=pasar>
            

              <input type=hidden name=variable_php></form>';
            

      echo '<script languaje="JavaScript">
            

              document.pasar.variable_php.value=varjs;
            

              document.pasar.submit();
            

</script>';   
            

}     
            

      echo "Valor de la variable en PHP: $_POST[variable_php] <br>"; 
            

echo "<a href=$_SERVER[PHP_SELF]>Recargar la Página</a>";
            

echo '</body>
            

      </html>';
?>
            