<?php
include 'inc/header.php';
if(!isset($_GET['id']))
	echo "<meta http-equiv='refresh' content='0; url=index.php'/>";
$user_id = $_GET['id'];

// edite profile
if(isset($_POST['editer'])) {
	$img_user 		= $_POST['img_user'];
	$pseudo 		= $_POST['pseudo'];
	$nom 			= $_POST['nom'];
	$prenom 		= $_POST['prenom'];
	$sex 			= $_POST['sex'];
	$type			= strrchr($_FILES['img_user']['name'],'.');
	if($_FILES['img_user']['name']!=""){
		move_uploaded_file($_FILES['img_user']['tmp_name'],"images/users/avatar/".$user_id.$type);
		if(mysqli_query($con,"UPDATE user SET u_nom='$nom',u_prenom='$prenom',u_pseudo='$pseudo',u_sex='$sex',u_avatar='$user_id$type' WHERE u_id=$user_id")){
			echo "<meta http-equiv='refresh' content='0; url=user.php?id=$user_id'/>";
		}
	}else{
		if(mysqli_query($con,"UPDATE user SET u_nom='$nom',u_prenom='$prenom',u_pseudo='$pseudo',u_sex='$sex' WHERE u_id=$user_id")){
			echo "<meta http-equiv='refresh' content='0; url=user.php?id=$user_id'/>";
		}
	}
}
// end edite profile

$select_profile = mysqli_query($con,"SELECT * FROM user WHERE u_id=$user_id");
if(mysqli_num_rows($select_profile)<=0)
	die("user non trouver");
$profile = mysqli_fetch_array($select_profile);
$level = 'member';
if(isset($user['u_level']))
if($user['u_level']==1) $level = 'supper Admin';
$result_post = mysqli_query($con,"SELECT * FROM post WHERE u_id=$user_id");
$n_post = mysqli_num_rows($result_post);
?>
<div class="container">
	<div class="content">
		<form method="post" enctype="multipart/form-data">
			<table cellspacing="0" cellpadding="0" width="100%" id="profile_table">
				<tr>
					<td rowspan="4" align="center">
						<div class="div_img">
							<img id="usr_img" src='images/users/avatar/<?=$profile['u_avatar']?>'>
							<?php
								if($u_id==$user_id){
									echo "<input type=file accept='image/*' name=img_user>";
								}
							?>
						</div><br>
						<table>
							<tr>
								<td>level :</td>
								<td><b><?=$level?></b></td>
							</tr>
							<tr>
								<td>posts :</td>
								<td><b><?=$n_post?></b></td>
							</tr>
						</table>
					</td>
					<td>
						<table>
							<tr>
								<td width="100px">id :</td>
								<td>
									<b><?=$profile['u_id']?></b>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table>
							<tr>
								<td width="100px">Pseudo :</td>
								<td>
									<b>
									<?php
										if(isset($u_id))
										if($u_id==$user_id)
											echo "
												<input name='pseudo' class=tt value='{$profile['u_pseudo']}'>
											";
										else echo $profile['u_pseudo'];
									?>
									</b>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table>
							<tr>
								<td width="100px">Nom :</td>
								<td>
									<?php
										if($u_id==$user_id)
											echo "
												<input name='nom' class=tt value='{$profile['u_nom']}'>
											";
										else echo "<b>{$profile['u_nom']}</b>";
									?>
								</td>
								<td width="100px">Prenom :</td>
								<td>
									<?php
										if($u_id==$user_id)
											echo "
												<input name='prenom' class=tt value='{$profile['u_prenom']}'>
											";
										else echo "<b>{$profile['u_prenom']}</b>";
									?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table>
							<tr>
								<td width="100px">sex :</td>
								<td>
									<?php
										echo "<input name=sex type=radio value='homme' ";

										if($profile['u_sex']=='homme')echo "checked> homme ";
										else echo "> homme "; 

										echo "<input name=sex type=radio value='famme' ";

										if($profile['u_sex']=='famme') echo "checked> famme";
										else echo "> femme "; 
									?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input class="btn1" name='editer' type="submit"></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<style type="text/css">
	table{
		border: 0;
	}
</style>
<?php
include 'inc/footer.php';
?>