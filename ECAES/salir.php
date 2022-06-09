<?
	session_start();
	
	if(!isset($_SESSION['ecaes']))
	{
		header("Location: /");
		die();
	}
	
	require '../../functions.php';
	$rootPath = '../../';
	
	unset($_SESSION['ecaes']);
	header("Location: /");
	die();
?>