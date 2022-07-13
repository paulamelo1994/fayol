<?
session_start();
	require "../../functions.php";
	$rootPath = "../..";
	$editar_id = 0;
	
	PageInit("Documentos Claustro", "../menu.php");

		
			?> <h1 class="shiny">Lista de Documentos Claustro</h1> <?
			
			$con = @DBConnect('fayol');
			
			if(!empty($con))//Si hay conexion
			{
				$res = db_query("SELECT * FROM documentoclaustro where visible='t' order by id;");
				$numrows = pg_num_rows($res);
				
				if($numrows != 0)
				{
					?>
					<table width="100%" cellspacing="2" align="center">
					<tr>
						<th>NOMBRE DOCUMENTO</th>
						<th>FECHA</th>
					</tr>
					<?
				
					for($i = ($numrows - 1); $i >=  0; $i--)
					{
						$obj = pg_fetch_object($res);
						echo "<tr bgcolor=".($i%2? '"#bcbcbc">' : '"#dfdfdf">');
						?>
							<td align="center"><a href="<?=makeURL($obj->ubicacion)?>" target="_blank"><?=$obj->titulo?></a></td>
							<td align="center"><?=$obj->fecha?></td>
						</tr>
						<?
					}
				?>
				</table>
				<?
				}
				
				else echo "No hay Documentos publicados";
			}
			else
			{
				echo" <p><font color=red>Error:</font> No se pudo realizar la conexi&oacute;n con la base de datos.No es posible listar los documentos de claustro en el momento, por favor intentelo m&aacute;s tarde.</p>";
			}
			
				
?>