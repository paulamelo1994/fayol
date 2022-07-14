<?PHP
require_once "captcha.php";
		session_start();
		$_SESSION['tmptxt'] = randomText(6);
		$captcha = imagecreatefromgif("bgcaptcha.gif");
		$colText = imagecolorallocate($captcha, 0, 0, 0);
		imagestring($captcha, 5, 16, 7, $_SESSION['tmptxt'], $colText);
		header("Content-type: image/gif");
		imagegif($captcha);
		file_put_contents("captcha.log",date("Y-m-d H:i:s")." - ".$_SESSION['tmptxt']." - ".$_SERVER['HTTP_REFERER']."\r\n",FILE_APPEND);
		
?>