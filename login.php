<?php
if (isset($_COOKIE['u_id'])) {
	header("location: index.php");
}
include 'inc/header.php';
if (isset($_POST['entrer'])){
	if(empty($_POST['pass']) OR empty($_POST['pseudo'])){
		$msg = "<font color=red>entrer touts les informations</font>";
	}else{
		$pass = $_POST['pass'];
		$pseudo = $_POST['pseudo'];
		$le_temp = 0;
		if(isset($_POST['rester'])){
			if($_POST['rester']) $le_temp = time()+24*60*60;
		}
		$result = mysqli_query($con,"SELECT u_id FROM `user` WHERE u_password='$pass' AND u_pseudo='$pseudo'");
		if(mysqli_num_rows($result)<=0){
			$msg = "<font color=red>les information est incorrect</font>";
		}else{
			$user = mysqli_fetch_array($result);
			setcookie("u_id",$user['u_id'],$le_temp);
			echo "<meta http-equiv='refresh' content='0; url=index.php'/>";
		}
	}
}
?>
<div class="container">
	<div class="content">
		<h2 class="login_titre">S'identifier</h2><hr class="line">
		<div class="form_login">
			<form method="post">
				<fieldset>
		    		<legend>S'identifier</legend>
		    		<p class="contact"><label for="name">Pseudo</label></p> 
		    		<input id="name" name="pseudo" placeholder="pseudo/e-mail" required="" type="text">
		    		<br>
		    		<br>
					<p class="contact"><label for="pass">Mot de pass</label></p> 
		    		<input id="pass" name="pass" required="" type="password">
		    	</fieldset>
		    	<fieldset class="tblFooters">
		        	<p>	
		    			<input type="submit" value="entrer" name="entrer">
		    		</p>
		    		<?=$msg?>
		    	</fieldset>
			</form>

		</div>
	</div>	
</div>

<?php
include 'inc/footer.php';
?>