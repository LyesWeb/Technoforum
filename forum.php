<?php
include 'inc/header.php';
$forum_id = (int)$_GET['id'];
$result = mysqli_query($con,"SELECT * FROM forum WHERE f_id=$forum_id");
if(mysqli_num_rows($result)<=0){
	die("forum not found");
}else{
	$forum = mysqli_fetch_array($result);
}
$action="";
if(isset($forum['u_id']) and isset($user['u_level']))
if($forum['u_id']==$u_id or $user['u_level']==1){
	if(isset($_GET['action'])) $action = $_GET['action'];
	if($action=="delete"){
		@mysqli_query($con,"DELETE FROM post WHERE p_id={$_GET['p_id']}");
		@mysqli_query($con,"DELETE FROM comment WHERE p_id={$_GET['p_id']}");
	}
	if($action=="fixed"){
		@mysqli_query($con,"UPDATE post SET p_stat=2 WHERE p_id={$_GET['p_id']}");
	}
	if($action=="unfixed"){
		@mysqli_query($con,"UPDATE post SET p_stat=4 WHERE p_id={$_GET['p_id']}");
	}
	if($action=="hidden"){
		@mysqli_query($con,"UPDATE post SET p_stat=3 WHERE p_id={$_GET['p_id']}");
	}
	if($action=="unhidden"){
		@mysqli_query($con,"UPDATE post SET p_stat=4 WHERE p_id={$_GET['p_id']}");
	}
	if($action=="resolu"){
		@mysqli_query($con,"UPDATE post SET p_stat=1 WHERE p_id={$_GET['p_id']}");
	}
	if($action=="nonresolu"){
		@mysqli_query($con,"UPDATE post SET p_stat=4 WHERE p_id={$_GET['p_id']}");
	}
}
?>
<div class="container">
	<div class="content">
		<div class="chemin">
			<p><a href="index.php">Acceuil</a> > <?=$forum['f_nom']?></p>
		</div>
		<?php
		if (isset($_COOKIE['u_id'])) {
			echo "
				<div class='addpost r'>
					<a href='addpost.php?f_id=$forum_id'>ajouter sujet</a>
				</div>
			";
		}
		?>
		<div class="forum_admin">
			<?php
				$select_user = mysqli_query($con,"SELECT u_pseudo FROM user WHERE u_id={$forum['u_id']}");
				$select_user = mysqli_fetch_array($select_user);
			?>
			<h3>l'admin : <a href="user.php?id=<?=$forum['u_id']?>"><u><?=$select_user['u_pseudo']?></u></a></h3>
		</div>
		<div class="c"></div>
		<table border="0" cellspacing="0" cellpadding="0" width="100%" id="mainTable">
			<tr class="tr">
				<td width="30px"></td>
				<td width="600px" align="center">Sujets</td>
				<td align="center">Pages</td>
				<td align="center">Auteur</td>
				<td align="center">Reponses</td>
				<td align="center">Vus</td>
				<td align="center">Derniere envoi</td>
				<?php
					if (isset($_COOKIE['u_id']) and ($_COOKIE['u_id']==$forum['u_id'] or $user['u_level']==1)) {
						echo "<td width='55px' align=center>Action</td>";
					}
				?>
			</tr>
			<?php
$result_posts = mysqli_query($con,"SELECT * FROM post INNER JOIN user ON post.u_id=user.u_id WHERE post.f_id=$forum_id ORDER BY p_id DESC");
while ($fetch_posts = mysqli_fetch_array($result_posts)) {

#################
# dernierenvoi ## 
#################
$Derniere_envoi = mysqli_query($con,"SELECT c_date,u_pseudo,user.u_id as u_id FROM user INNER JOIN comment ON user.u_id=comment.u_id WHERE comment.p_id={$fetch_posts['p_id']} ORDER BY c_date DESC");
$Derniere_envoi = mysqli_fetch_array($Derniere_envoi);


	if($fetch_posts['p_stat']!=0){
		$n_comment = mysqli_query($con,"SELECT c_id FROM comment WHERE p_id={$fetch_posts['p_id']}");
		$n_comment = mysqli_num_rows($n_comment);
		$n_page = ceil($n_comment/5);
		$pages_html='';
		for($i=1;$i<=$n_page; $i++){
			$pages_html .= "<option value='post.php?id={$fetch_posts['p_id']}&page=$i'>$i</option>";
		}
		$stat_img = 'how2';
		$stat_post = '';
		if($fetch_posts['p_stat']==1) $stat_img = 'how3';
		if($fetch_posts['p_stat']==2){$stat_post = 'fixed';$stat_img = 'fixed';}
		if($fetch_posts['p_stat']==3){$stat_post = 'hidden';$stat_img = 'red';}
		if((!isset($_COOKIE['u_id']) and $fetch_posts['p_stat']==3) or ($fetch_posts['p_stat']==3 and $forum['u_id']!=$u_id and $user['u_level']!=1)){}
		else
		echo "
			<tr class='tr1 $stat_post'>
				<td align='center'><img src='images/$stat_img.png'></td>
				<td align='left'>
					<h3 class='sujet_title'><a href='post.php?id={$fetch_posts['p_id']}'>{$fetch_posts['p_title']}</a></h3>
				</td>
				<td align='center'><select onchange='window.location=this.value;'>$pages_html</select></td>
				<td align='center'><a href='user.php?id={$fetch_posts['u_id']}'>{$fetch_posts['u_pseudo']}</a></td>
				<td align='center'>$n_comment</td>
				<td align='center'>{$fetch_posts['p_vus']}</td>
				<td align='center'>
					{$Derniere_envoi['c_date']}<br><a href='user.php?id={$Derniere_envoi['u_id']}'><small>{$Derniere_envoi['u_pseudo']}</small></a>
				</td>
		";
		if (isset($_COOKIE['u_id']) and ($_COOKIE['u_id']==$forum['u_id'] or $user['u_level']==1)) {
			echo "
				<td align=center>
					<a href='forum.php?id=$forum_id&action=delete&p_id={$fetch_posts['p_id']}' title='suprimer'><img src='images/delete.png'></a>
					";
			if($fetch_posts['p_stat']!=2){
				echo "<a href='forum.php?id=$forum_id&action=fixed&p_id={$fetch_posts['p_id']}' title='fixee'><img src='images/fixed.png'></a>";
			}
			if ($fetch_posts['p_stat']==2) {
				echo "<a href='forum.php?id=$forum_id&action=unfixed&p_id={$fetch_posts['p_id']}' title='fixee'><img src='images/unfixed.png'></a>";
			}
			if ($fetch_posts['p_stat']!=3) {
				echo "<a href='forum.php?id=$forum_id&action=hidden&p_id={$fetch_posts['p_id']}' title='chache'><img src='images/red.png'></a>";
			}
			if ($fetch_posts['p_stat']==3) {
				echo "<a href='forum.php?id=$forum_id&action=unhidden&p_id={$fetch_posts['p_id']}' title='chache'><img src='images/green.png'></a>";
			}
			if ($fetch_posts['p_stat']!=1) {
				echo "<a href='forum.php?id=$forum_id&action=resolu&p_id={$fetch_posts['p_id']}' title='resolu'><img src='images/yes.png'></a>";
			}
			if ($fetch_posts['p_stat']==1) {
				echo "<a href='forum.php?id=$forum_id&action=nonresolu&p_id={$fetch_posts['p_id']}' title='resolu'><img src='images/no.png'></a>";
			}
			echo "
				</td>
			</tr>
			";
		}
	}
}
			?>
		</table>
	</div>
</div>
<?php
include 'inc/footer.php';
?>