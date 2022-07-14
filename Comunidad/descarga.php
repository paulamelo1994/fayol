<?
	$name = $_GET['file'];
	header("Content-disposition: attachment; filename=$name");
	header("Content-type: application/octet-stream");
	readfile($name);

?>
