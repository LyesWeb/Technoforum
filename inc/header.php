<?php
include 'inc/config.php';
if (isset($_POST['entrer'])){
	$msg = "";
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
if(isset($_COOKIE['u_id'])){
	$isNotAdmin = false;
	$u_id = $_COOKIE['u_id'];
	$result = mysqli_query($con,"SELECT * FROM `user` WHERE u_id=$u_id");
	$user = mysqli_fetch_array($result);
	if($user['u_level']==1){
		$s_posts = mysqli_query($con,"SELECT * FROM post WHERE p_stat=0");
		$n_post_0 = mysqli_num_rows($s_posts);
	}else{
		// is admin of an forum ?
		$isAdmin = mysqli_query($con,"SELECT * FROM forum WHERE forum.u_id=$u_id");
		if(mysqli_num_rows($isAdmin)>0){
			$s_posts = mysqli_query($con,"SELECT * FROM post INNER JOIN forum ON forum.f_id=post.f_id WHERE p_stat=0 and forum.u_id=$u_id");
			$n_post_0 = mysqli_num_rows($s_posts);
		}else{
			$isNotAdmin = true;
		}
	}

}
$msg="";
?>
<!DOCTYPE html>
<html>
<head>
	<title>index</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="header">
	<div class="container">
		<div class="logo-login">
			<div class="logo l">
				<a href="index.php"><img alt="technoforum" src="images/technoforum.png"></a>
			</div>
			<div class="login r"  id="pan" <?php if(isset($user['u_level'])) if($user['u_level']==1) echo "style='background-image:url(images/liste.png);background-repeat: no-repeat; background-position: right;background-size: 30%;'"; ?>>
				<?php
					if(isset($_COOKIE['u_id'])){
						echo "
							<div onclick='_hide()' class='hide' id='hide'>hide</div>
							<div onclick='_show()' id='aff' class='show'>show</div>
						";
						$result = mysqli_query($con,"SELECT count(p_id) as num_sujet FROM post WHERE u_id=$u_id");
						$fetch = mysqli_fetch_array($result);
						$result2 = mysqli_query($con,"SELECT count(c_id) as num_comment FROM comment WHERE u_id=$u_id");
						$fetch2 = mysqli_fetch_array($result2);
						echo "
							<h4 class='l'>Bonjour, <b><a href='user.php?id={$user['u_id']}' title='{$user['u_nom']}'>{$user['u_nom']}</a></b></h4>
							<a href='#'><img id='pic' src='images/users/avatar/{$user['u_avatar']}'></a>
							<div class='c'></div>
							<p>
								{$fetch['num_sujet']} sujets, {$fetch2['num_comment']} commentaires
							</p>
							<br>
							<p>
								";if(!$isNotAdmin){echo "<img src='images/flag.png'> <a href='newSujets.php'>les nouveaux sujets (<b>$n_post_0</b>)</a>";}echo "
							</p>
							<br>
							<p>
								<a href='mypost.php'><img src='images/posts.png'> mes sujets</a>, <a href='user.php?id={$user['u_id']}'><img src='images/edite.png'> configuration</a>, <a href='logout.php'><img src='images/logout.png'> logout</a>
							</p>
						";
					}else{
						if(isset($_POST['rester'])) $checked = 'checked';
						else $checked = '';
						echo "
							<h4>S'identifier :</h4>
							<form method='post'>
								<input id='loginText' name='pseudo' type='text' placeholder='login'>
								<input id='loginPassword' name='pass' type='password' placeholder='password'>
								<input id='entrer' name='entrer' type='submit' value='entrer'>
								<br><br>
								<input type=checkbox $checked name='rester' value=1> rester connecter
								<br><br>
								$msg
							</form>
						";
					}
				?>
			</div>
			<div class="c"></div>
		</div>
		<div class="nav">
			<ul>
				<li><a href="index.php">Home</a></li>
				<?php
					if(!isset($_COOKIE['u_id'])){
				?>
				<li><a href="register.php">S'inscrire</a></li>
				<li><a href="login.php">S'identifier</a></li>
				<?php } ?>
				<li><a href="#">Aide</a></li>
				<li><a href="recherche.php">Recherche</a></li>
				<div class="recherche r">
					<form method="GET" action="recherche.php">
						<input type="text" name="key" placeholder="recherche">
						<input type="submit" name="chercher" value="">
					</form>
				</div>
				<div class="c"></div>
			</ul>
		</div>
	</div>
</div>
