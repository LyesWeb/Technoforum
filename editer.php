<?php
include 'inc/header.php';
if (!isset($_COOKIE['u_id'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php'/>";
}
$P_id = (int)$_GET['id'];
$msg='';
if(isset($_POST['editer'])){
	if(empty($_POST['title']) or empty($_POST['content'])){
		$msg = '<div class=error>entrer touts les informations</div>';
	}else{
		$Titre = htmlentities(addslashes(trim($_POST['title'])));
		$Content = htmlentities(addslashes(trim($_POST['content'])));
		$strings   = array("\r\n", "\n", "\r");
		$Content = str_replace($strings,'<br/>',$Content );
		if(mysqli_query($con,"UPDATE post SET p_title='$Titre',p_content='$Content' WHERE p_id=$P_id")){
			echo "<meta http-equiv='refresh' content='0; url=post.php?id=$P_id'/>";
		}
	}
}
$Presult = mysqli_query($con,"SELECT * FROM post WHERE p_id=$P_id");
$post = mysqli_fetch_array($Presult);
$content = str_replace("<br/>","\n", $post['p_content']);
?>
<div class="container">
	<div class="content">
		<div class="title_page">
			<h3>Editer le sujet : <?=$post['p_title']?></h3>
		</div>
		<form method="post">
			<table border="1" cellspacing="0" cellpadding="0" width="100%" id="addPostTable">
				<tr>
					<td>le titre</td>
					<td><input type="text" value="<?=$post['p_title']?>" name="title"></td>
				</tr>
				<tr>
					<td valign="top">le contenue</td>
					<td>
						<textarea name="content"><?=$content?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="submit" value="editer" name="editer"></td>
				</tr>
			</table>
			<?=$msg?>
		</form>
	</div>
</div>
<?php
include 'inc/footer.php';
?>