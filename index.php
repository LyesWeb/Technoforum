<?php
include 'inc/header.php';
$result = mysqli_query($con,"SELECT u_id FROM user");
$num_members = mysqli_num_rows($result);
$result = mysqli_query($con,"SELECT p_id FROM post WHERE p_stat!=3");
$num_posts = mysqli_num_rows($result);
$result2 = mysqli_query($con,"SELECT c_id FROM comment");
$num_comm = mysqli_num_rows($result2);
if(isset($user['u_level'])) if($user['u_level']==1){
	if (isset($_GET['action'])) $action=$_GET['action'];
	if (isset($action) and $action=="delete"){
		$_rs = mysqli_query($con,"SELECT p_id FROM post WHERE f_id={$_GET['f_id']}");
		while ($_Fetch = mysqli_fetch_array($_rs))
			@mysqli_query($con,"DELETE FROM comment WHERE p_id={$_Fetch['p_id']}");
		@mysqli_query($con,"DELETE FROM post WHERE f_id={$_GET['f_id']}");
		@mysqli_query($con,"DELETE FROM forum WHERE f_id={$_GET['f_id']}");
		
	}
	// $s_posts = mysqli_query($con,"SELECT * FROM post WHERE p_stat=0");
	// $n_post_0 = mysqli_num_rows($s_posts);
}
?>
<div class="container">
	<div class="content">
		<div class="stats full">
			<div class="box box1">
				<h5>les members inscrits:</h5>
				<h6><?=$num_members?></h6>
			</div>
			<div class="box box2">
				<h5>Les connectes:</h5>
				<h6>1</h6>
			</div>
			<div class="box box3">
				<h5>Les sujets:</h5>
				<h6><?=$num_posts?></h6>
			</div>
			<div class="box box4">
				<h5>Les posts:</h5>
				<h6><?=$num_comm?></h6>
			</div>
			<div class="c"></div>
		</div>
	</div>
</div>
<div class="container">
	<div class="content">
		<?php
		if(isset($user['u_level']))
			if($user['u_level']==1){
				echo "<div class='addpost'><a href='addforum.php'>ajouter forum</a></div><br>";
			}
		?>
		<table border="0" cellspacing="0" cellpadding="0" width="100%" id="mainTable">
			<tr class="tr">
				<td width="30px"></td>
				<td width="600px" align="center">Forum</td>
				<td align="center">Sujets</td>
				<td align="center">Post</td>
				<td align="center">Dernier envoi</td>
				<?php
					if(isset($user['u_level']))
					if($user['u_level']==1){
						echo "<td align=center>Action</td>";
					}
				?>
			</tr>
			<?php
			$result = mysqli_query($con,"SELECT * FROM forum ORDER BY f_id DESC");
			while ($forum = mysqli_fetch_array($result)) {
				$num_sujet_in_forum = mysqli_query($con,"SELECT count(p_id) as n FROM post WHERE f_id={$forum['f_id']} and p_stat!=3");
				$num_sujet_in_forum = mysqli_fetch_array($num_sujet_in_forum);

				$num_comment_in_forum = mysqli_query($con,"SELECT count(c_id) as n FROM comment INNER JOIN post ON post.p_id=comment.p_id WHERE post.f_id={$forum['f_id']}");
				$num_comment_in_forum = mysqli_fetch_array($num_comment_in_forum);
				echo "
					<tr class='tr1'>
						<td align='center'><img src='images/comment.png'></td>
						<td align='left'>
							<h2><a href='forum.php?id={$forum['f_id']}'>{$forum['f_nom']}</a></h2>
							<p>{$forum['f_desc']}.</p>
						</td>
						<td align='center'>{$num_sujet_in_forum['n']}</td>
						<td align='center'>{$num_comment_in_forum['n']}</td>
						<td align='center'>
							2017-01-22 23:01:18<br>
							ilyassking
						</td>
				";
				if(isset($user['u_level']))
				if($user['u_level']==1){
					echo "
						<td align=center>
						<a href='index.php?action=delete&f_id={$forum['f_id']}' title='suprimer'><img src='images/delete.png'>
						</td>
					</tr>
					";
				}
			}
			?>
		</table>
	</div>
</div>


<?php
include 'inc/footer.php';
?>