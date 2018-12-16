<?php
include 'inc/header.php';
if (!isset($_COOKIE['u_id'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php'/>";
}
$forum_id = $_GET['f_id'];
$select_forum = mysqli_query($con,"SELECT * FROM forum WHERE f_id=$forum_id");
$forum = mysqli_fetch_array($select_forum);
if(isset($_POST['add'])){
	if (empty($_POST['title']) or empty($_POST['content'])) {
		$msg = "<div class=error>entrer touts les informations</div>";
	}else{
		$title = htmlentities(addslashes(trim($_POST['title'])));
		if(isset($_POST['stat'])) $stat = (int)$_POST['stat'];
		else $stat = 0;
		if($user['u_level']!=1 or ($forum['u_id']!=$u_id and $user['u_level']!=1)){
			$stat = 0;
		}
		if($forum['u_id']==$u_id) $stat = (int)$_POST['stat'];
		if($user['u_level']==1) $stat = (int)$_POST['stat'];

		$content = htmlentities(addslashes(trim($_POST['content'])));
		$strings   = array("\r\n", "\n", "\r");
		$content = str_replace($strings,'<br/>', $content);
		$dt = date('Y/m/d H:m:s');
		$f_id = $_GET['f_id'];
		if(mysqli_query($con,"INSERT INTO post (p_title,p_content,f_id,u_id,p_date,p_stat) VALUES ('$title','$content',$f_id,$u_id,'$dt',$stat)")){
			echo "<meta http-equiv='refresh' content='0; url=forum.php?id=$f_id'/>";
		}else{
			$msg = "<div class=error>error</div>";
		}
	}
}
?>
<div class="container">
	<div class="content">
		<div class="title_page">
			<h3>ajouter dans: <?=$forum['f_nom']?></h3>
		</div>
		<form method="post">
			<table border="1" cellspacing="0" cellpadding="0" width="100%" id="addPostTable">
				<tr>
					<td>le titre</td>
					<td><input type="text" placeholder="le titre ..." name="title"></td>
				</tr>
				<?php
				if ($forum['u_id']==$u_id or $user['u_level']==1) {
					echo "
					<tr>
						<td></td>
						<td><input type=radio checked name=stat value=4> normal <input type=radio name=stat value=2> fixeé <input type=radio name=stat value=3> caché</td>
					</tr>
					";
				}
				?>
				<tr>
					<td valign="top">le contenue</td>
					<td>
						<textarea name="content">le contenu ...</textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="submit" value="publier" name="add"></td>
				</tr>
			</table>
		</form>
		<?=$msg?>
	</div>
</div>
<?php
include 'inc/footer.php';
?>