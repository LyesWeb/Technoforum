<?php
if(isset($_COOKIE['u_id'])){
	setcookie("u_id",'');
	unset($_COOKIE['u_id']);
	echo "<meta http-equiv='refresh' content='0; url=index.php'/>";
}else{
	echo "<meta http-equiv='refresh' content='0; url=index.php'/>";
}
?>