<?php
include 'inc/header.php';
if (isset($_COOKIE['u_id'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php'/>";
	exite;
}
if(isset($_POST['submit'])){
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$sex = $_POST['sex'];
	$birthday = $_POST['birthday'];
	$birthyear = $_POST['birthyear'];
	$birthmonth = $_POST['birthmonth'];
	$msg = "";
	if(empty($nom) or empty($prenom) or empty($username) or empty($email) or empty($password) or empty($password2) or empty($sex) or empty($birthyear) or empty($birthday) or empty($birthmonth)){
		$msg = "<div class=error>entrer touts les informations</div>";
	}else{
		if($password!=$password2){
			$msg = "<div class=error>mot de pass incorrect</div>";
		}else{
			if(mysqli_query($con,"INSERT INTO `user` (u_nom,u_prenom,u_pseudo,u_email,u_sex,u_password,u_birthday,u_level) VALUES ('$nom','$prenom','$username','$email','$sex','$password','$birthday/$birthmonth/$birthyear',0)")){
				$msg = "<div class=ok>is ok</div>";
			}else{
				$msg = "<div class=error>error</div>";
			}
		}
	}
}
?>
<div class="container">
	<div class="content">
	<h2 class="register_titre">S'inscrire</h2><hr class="line">
		<div  class="form">
		    <form id="contactform" method="post"> 
	    			<p class="contact"><label for="name">Nom</label></p> 
	    			<input id="name" name="nom" placeholder="Nom" tabindex="1" type="text"> 

					<p class="contact"><label for="name">Prenom</label></p>
	    			<input id="name" name="prenom" placeholder="Prenom"  tabindex="1" type="text"> 

					<br>
					<p class="contact"><label for="name">Sex</label></p>
					<select class="select-style gender" name="sex">
			            <option value="">Je suis</option>
			            <option value="homme">homme</option>
			            <option value="famme">famme</option>
		            </select><br><br>

	    			<p class="contact"><label for="email">E-mail</label></p> 
	    			<input id="email" name="email" placeholder="example@domain.com"  type="email"> 

	                <p class="contact"><label for="username">cree un pseudo</label></p> 
	    			<input id="username" name="username" placeholder="username"  tabindex="2" type="text"> 

	                <p class="contact"><label for="password">cree un password</label></p> 
	    			<input type="password" id="password" name="password"  type="text"> 
	                <p class="contact"><label for="repassword">Confirme votre password</label></p> 
	    			<input type="password" id="password" name="password2"  type="text"> 

	               <fieldset>
	                 <label>moi</label>
	                  <label class="month"> 
	                  <select class="select-style" name="birthmonth">
	                  <option value="">moi</option>
	                  <option  value="1">janvier</option>
	                  <option value="2">février</option>
	                  <option value="3">mars</option>
	                  <option value="4">avril</option>
	                  <option value="5">mai</option>
	                  <option value="6">juin</option>
	                  <option value="7">juillet</option>
	                  <option value="8">août</option>
	                  <option value="9">septembre</option>
	                  <option value="10">octobre</option>
	                  <option value="11">novembre</option>
	                  <option value="12">décembre</option>
	                  </label>
	                 </select>    
	                <label>Jour <input class="birthday" maxlength="2" name="birthday"  placeholder="Day" ></label>
	                <label>Annee <input class="birthyear" maxlength="4" name="birthyear" placeholder="Year" ></label>
	              </fieldset>

	            <br><br>

	            <input class="buttom" name="submit" id="submit" tabindex="5" value="S'inscrire!" type="submit"><br>
	            <?= $msg ?>
		   </form> 
		</div>
	</div>	
</div>

<?php
include 'inc/footer.php';
?>