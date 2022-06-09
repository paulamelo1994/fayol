<?php

session_start();

require "../../functions.php";
$rootPath = "../..";

PageInit("Proyectos 2010 - 2011", "../menu.php");

$flat = true;

if(isset($_POST['sumit']))
{
	$conexion= @DBConnect('new_fayol');
	
	if(!empty($conexion)) //Si hay conexion
	{
		db_query( "UPDATE proyecto SET nombre = '$_POST[nombre]', descripcion = '$_POST[descripcion]', asunto_estrategico = '$_POST[asunto_estrategico]', programa_estrategico = '$_POST[programa_estrategico]', acciones = '$_POST[acciones]' WHERE noproyecto = $_SESSION[noproyecto]" );
		
		
		$_SESSION['etapas'] = true;
		
		
		?>
        
		<script language="JavaScript">
        location.href='./etapas.php?id=<?=$_SESSION[noproyecto]?>';
        </script>
        <?
		
	}
	else
		echo '<strong>Error en la conexion a la base de datos</strong>';
}


if ( isset($_SESSION['proyectos']) and isset( $_GET['id'] ) )
{
	$conexion= @DBConnect('new_fayol');

	$_SESSION['noproyecto'] = $_GET[id];
	
	$result = db_query ("SELECT * FROM proyecto WHERE noproyecto = $_SESSION[noproyecto]");

	$proy = pg_fetch_object($result, 0);

	?>
<form name="form1" method="post" action="">
  <table width="79%" border="0">
    <tr>
      <td width="10%">Nombre</td>
      <td width="90%"><textarea name="nombre" id="nombre" cols="45" rows="5"><?=$proy->nombre?></textarea></td>
    </tr>
    <tr>
      <td>Descripci&oacute;n</td>
      <td><textarea name="descripcion" id="descripcion" cols="45" rows="5"><?=$proy->descripcion?></textarea></td>
    </tr>
    <tr>
      <td>Asunto Estrategico</td>
      <td><textarea name="asunto_estrategico" id="asunto_estrategico" cols="45" rows="5"><?=$proy->asunto_estrategico?></textarea></td>
    </tr>
    <tr>
      <td>Programa Estrategico</td>
      <td><textarea name="programa_estrategico" id="programa_estrategico" cols="45" rows="5"><?=$proy->programa_estrategico?></textarea></td>
    </tr>
    <tr>
      <td>Acciones</td>
      <td><textarea name="acciones" id="acciones" cols="45" rows="5"><?=$proy->acciones?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><center><input type="submit" name="sumit" id="sumit" value="Guardar">
      <input type="button" value="Cancelar" onClick="location.href='./administrar.php'" )'></center></td>
    </tr>
  </table>
</form>
<?
}
else
{
	?>
    <strong>No tiene acceso a esta p&aacute;gina</strong>
    <?
}

PageEnd();
?>