<?php
include 'inc/header.php';
$action="";
// if($user['u_level']==1){
	if(isset($_GET['action'])) $action = $_GET['action'];
	if($action=="sup"){
		@mysqli_query($con,"DELETE FROM post WHERE p_id={$_GET['p_id']}");
	}
	if($action=="pub"){
		@mysqli_query($con,"UPDATE post SET p_stat=4 WHERE p_id={$_GET['p_id']}");
	}
// }
?>
<div class="container">
	<div class="content">
		<div class="title_page">
			<h3>les nouveaux sujets :</h3>
		</div>
		<br>
		<table border='0' cellspacing='0' cellpadding='0' width='100%' id="NewPostTable">
			<tr class="tr">
				<td align=center width="30px">#</td>
				<td width="100px">sujets</td>
				<td width="100px">Auteur</td>
				<td width="200px">forum</td>
				<td width="100px">date</td>
				<td align=center width="30px">afficher</td>
				<td align=center width="30px">publier</td>
				<td align=center width="30px">suprimmer</td>
			</tr>
		</table>
		<div style="height: 600px;overflow: scroll;">
		<table border='0' cellspacing='0' cellpadding='0' width='100%' id="NewPostTable">
		<?php
			if($user['u_level']==1){
				$select_posts = mysqli_query($con,"SELECT p_id,p_title,p_date,u_pseudo,f_nom FROM post INNER JOIN forum ON post.f_id=forum.f_id INNER JOIN user ON post.u_id=user.u_id WHERE post.p_stat=0 ORDER BY post.p_id DESC");
			}else{
				$select_posts = mysqli_query($con,"SELECT p_id,p_title,p_date,u_pseudo,f_nom FROM post INNER JOIN forum ON post.f_id=forum.f_id INNER JOIN user ON post.u_id=user.u_id WHERE post.p_stat=0 and forum.u_id=$u_id ORDER BY post.p_id DESC");
			}
			$n_post = mysqli_num_rows($select_posts);
			$i = 0;
			while ($post = mysqli_fetch_array($select_posts)) {
				if($i%2==0) $color='tr1';
				else $color='tr2';
				echo "
					<tr class=$color>
						<td align=center width='30px'><b>{$post['p_id']}</b></td>
						<td width='100px'>{$post['p_title']}</td>
						<td width='100px'>{$post['u_pseudo']}</td>
						<td width='200px'>{$post['f_nom']}</td>
						<td width='100px'><small>{$post['p_date']}</small></td>
						<td align=center width='30px'><a href='#' target='_blanck'><img src='images/show.png'></a></td>
						<td align=center width='30px'><a href='newSujets.php?action=pub&p_id={$post['p_id']}'><img src='images/green.png'></a></td>
						<td align=center width='30px'><a href='newSujets.php?action=sup&p_id={$post['p_id']}'><img src='images/delete.png'></a></td>
					</tr>
				";
				$i++;
			}
		?>
		</table>
		</div>
	</div>
</div>
<?php
include 'inc/footer.php';
?>