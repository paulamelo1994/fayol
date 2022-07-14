<?php
 //include("core/controller/Database.php");
if(Session::getUID()=="") {
$user = $_POST['mail'];
$pass = sha1(md5($_POST['password']));

$base = new Database();
$con = $base->connect();
 $sql = "select * from public.user where (email= '".$user."' or username= '".$user."') and password= '".$pass."' and is_active=1";
//print $sql;
$query = pg_query($con, $sql);
$found = false;
$userid = null;
while($r = pg_fetch_array($query)){
	$found = true ;
	$userid = $r['id'];
}
if($found==true) {
//	print $userid;
	$_SESSION['user_id']=$userid ;
//	setcookie('userid',$userid);
//	print $_SESSION['userid'];
	print "Cargando ... $user";
	print "<script>window.location='index.php?view=home';</script>";
}else {
	print "<script>window.location='index.php?view=login';</script>";
}

}else{
	print "<script>window.location='index.php?view=home';</script>";
	
}
?>