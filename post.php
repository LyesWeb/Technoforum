<?php
include 'inc/header.php';
$post_id = (int)$_GET['id'];
$result = mysqli_query($con,"SELECT * FROM post INNER JOIN forum ON post.f_id=forum.f_id INNER JOIN user ON post.u_id=user.u_id WHERE p_id=$post_id");
$s_forum = mysqli_query($con,"SELECT forum.u_id uid FROM forum INNER JOIN post ON post.f_id=forum.f_id INNER JOIN user ON post.u_id=user.u_id WHERE p_id=$post_id");
$s_forum=mysqli_fetch_array($s_forum);
if(mysqli_num_rows($result)<=0){
	die("post not found");
}else{
	$post = mysqli_fetch_array($result);
}
$vus = $post['p_vus']+1;
@mysqli_query($con,"UPDATE post SET p_vus=$vus WHERE p_id=$post_id");
//
if (isset($_COOKIE['u_id'])) {
	if (isset($_GET['action'])) {
		$action = $_GET['action'];
		if($action=='sup'){
			if(isset($_GET['c_id'])){
				$c_id = $_GET['c_id'];
				if(mysqli_query($con,"DELETE FROM comment WHERE c_id=$c_id"))
					echo "<meta http-equiv='refresh' content='0; url=post.php?id=$post_id'/>";
			}
		}
	}
}
#####
# suprimmer le poste et touts les commentaires de post
#####
if(isset($_COOKIE['u_id']) and isset($_GET['action'])){
	if($user['u_level']==1 or $post['u_id']==$u_id or $s_forum['uid']==$u_id){
		if($_GET['action']=="sup_p"){
			$FID = $post['f_id'];
			@mysqli_query($con,"DELETE FROM comment WHERE p_id={$_GET['id']}");
			@mysqli_query($con,"DELETE FROM post WHERE p_id={$_GET['id']}");
			echo "<meta http-equiv='refresh' content='0; url=forum.php?id=$FID'/>";
		}
	}
}
?>
<div class="container">
	<div class="content">
		<div class="chemin">
			<p><a href="index.php">Acceuil</a> > <a href="forum.php?id=<?php echo $post['f_id'];?>"><?php echo $post['f_nom'];?></a> > <?php echo $post['p_title'];?></p>
		</div>
<?php
#################### pagination ####################
if(isset($_GET['page'])) $CurrentPage = intval($_GET['page']);
else $CurrentPage = 1;
$NumSize = 5;
$Start = ($CurrentPage - 1) * $NumSize;
$result = mysqli_query($con,"SELECT * FROM comment WHERE p_id=$post_id");
$totalRows = mysqli_num_rows($result);
$result = mysqli_query($con,"SELECT * FROM comment WHERE p_id=$post_id LIMIT $Start, $NumSize");
$lastPage = ceil($totalRows/$NumSize);
#################### pagination ####################
?>
<?php
$next_page = $CurrentPage+1;
$prev_page = $CurrentPage-1;
	echo "<div class=pagination_post>";
	if($CurrentPage!=1) echo "<a href='post.php?id=$post_id&page=$prev_page'><</a>";
		for ($i=1; $i <= $lastPage; $i++) {
			if($i==$CurrentPage)
				echo "<a class='active_page'>$i</a>";
			else
				echo "<a href='post.php?id=$post_id&page=$i'>$i</a>";
		}
	if($CurrentPage<$lastPage) echo "<a href='post.php?id=$post_id&page=$next_page'>></a>";
	echo "</div>";
?>
		<table border="0" cellspacing="0" cellpadding="0" width="100%" id="PostTable">
			<tr id="post_author">
				<td width="200px" class="post_member" valign="top">
					<div class="member_pic author_pic">
						<img src="images/users/avatar/<?php echo $post['u_avatar']; ?>">
						<div class="author_pseudo">
							<span id="after"></span>
							<div class="author_nom"><a href="user.php?id=<?php echo $post['u_id']; ?>"><?php echo $post['u_pseudo']; ?></a></div>
							<span id="beffor"></span>
						</div>
					</div>
				</td>
				<td id="post_content" valign="top">
					<div class="post_info_top">
						<?php
							if(isset($user['u_level']) and isset($post['u_id']) and isset($s_forum['uid']))
							if($user['u_level']==1 or $post['u_id']==$u_id or $s_forum['uid']==$u_id){
								echo "
									<div class='p_tools'>
										<a href='editer.php?id={$post['p_id']}'><img width='16px' src='images/add_new.png' title='editer'></a>
										<a href='post.php?id={$_GET['id']}&action=sup_p'><img src='images/delete.png' title='suprimmer'></a>
									</div>
								";
							}
						?>
						<div class="post_title"><h2><?php echo $post['p_title']; if($post['p_stat']==1) echo " <img title='resolue' src='images/yes.png'>"; ?></h2></div>
						<div class="post_date"><a href="user.php?id=<?php echo $post['u_id']; ?>"><?php echo $post['u_pseudo']; ?></a> le <?php echo $post['p_date']; ?></div>
					</div>
					<div class="theContent">
						<?php echo $post['p_content']; ?>
					</div>
				</td>
			</tr>
		</table>
		<?php
			$c_result = mysqli_query($con,"SELECT * FROM comment INNER JOIN user ON user.u_id=comment.u_id WHERE p_id=$post_id LIMIT $Start, $NumSize");
			while ($com = mysqli_fetch_array($c_result)) {
				$tools = '';
				if(isset($user['u_level']) and isset($com['u_id']) and isset($s_forum['uid']))
				if($user['u_level']==1 or $com['u_id']==$u_id or $s_forum['uid']==$u_id) $tools="<div class=CommentTools><a href='post.php?id={$_GET['id']}&action=sup&c_id={$com['c_id']}'><img src='images/delete.png'></a></div>";
				echo "
		          <table border='0' cellspacing='0' cellpadding='0' width='100%' id='CommentsTable'>
					<tr>
						<td width='200px' class='post_member' valign='top'>
							<div class='member_pic author_pic'>
								<img src='images/users/avatar/{$com['u_avatar']}'>
								<div class='author_pseudo'>
									<span id='after'></span>
									<div class='author_nom'><a href='user.php?id={$com['u_id']}'>{$com['u_pseudo']}</a></div>
									<span id='beffor'></span>
								</div>
							</div>
						</td>
						<td id='post_content' valign='top'>
							<div class='post_info_top'>
								<div class='post_date'><a href='user.php?id={$com['u_id']}'>{$com['u_pseudo']}</a> le {$com['c_date']}</div>
								$tools
							</div>
							<div class='theContent'>
								{$com['c_content']}
							</div>
						</td>
					</tr>
				</table>
				";
			}
		?>
<!-- 		<div class="pagination_post">
			<a href="#prev"><</a>
			<a class="active_page">1</a>
			<a href="#">2</a>
			<a>...</a>
			<a href="#">5</a>
			<a href="#">6</a>
			<a href="#next">></a>
		</div>  -->
		<?php
			if (isset($u_id) and $post['p_stat']!=1 and $post['p_stat']!=3 and $post['p_stat']!=2){
				echo "
					<table border='0' cellspacing='0' cellpadding='0' width='100%' id='comment_form'>
						<tr>
							<td width='200px' class='post_member' style='padding: 15px;background-image:url(images/comment2.png);background-repeat:no-repeat;background-position: center;' valign='top'></td>
							<td class='comment_input'>
								<form method='post'>
									<textarea name='comment' placeholder='votre commentaire ici ...'></textarea>
									<input type='submit' value='commenter' name='commenter'>
									<div class='comment_pic'><img src='images/users/avatar/{$user['u_avatar']}'><span id='comment_after'></span></div>
								</form>
							</td>
						</tr>
					</table>
				";
				if(isset($_POST['commenter'])){
					$dt = date('Y/m/d H:m:s');
					$content = htmlentities(addslashes(trim($_POST['comment'])));
					$strings   = array("\r\n", "\n", "\r");
					$content = str_replace($strings,'<br/>', $content);
					if(!mysqli_query($con,"INSERT INTO comment (u_id,p_id,c_date,c_content) VALUES ($u_id,$post_id,'$dt','$content')")){
						echo "<div class=error>error</div>";
					}else{
						echo "<meta http-equiv='refresh' content='0; url=post.php?id=".$post_id."'/>";
					}
				}
			}
		?>
	</div>
</div>
<?php
include 'inc/footer.php';
?>