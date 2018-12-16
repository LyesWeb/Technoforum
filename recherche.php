<?php
include 'inc/header.php';
$_GET['key']='';
?>
<div class="container">
	<div class="content">
		<div class="title_page">
			<h3>recherche : <?php if(isset($_GET['key'])) echo $_GET['key'];?></h3>
		</div>
		<br>
		<?php
			$recherche_result = mysqli_query($con,"SELECT * FROM forum INNER JOIN post ON forum.f_id=post.f_id INNER JOIN user ON post.u_id=user.u_id WHERE post.p_title LIKE '%".$_GET['key']."%'");
			if(mysqli_num_rows($recherche_result)<=0){
				echo "<div class=error>Aucun resulta trouver avec '<u><b>{$_GET['key']}</b></u>'</div>";
			}else{
				echo "
				<table border='0' cellspacing='0' cellpadding='0' width='100%' id=NewPostTable>
					<tr class=tr>
						<td align=center>#</td>
						<td>sujets</td>
						<td>Auteur</td>
						<td>forum</td>
						<td>date</td>
					</tr>
				";
				while ($row = mysqli_fetch_array($recherche_result)) {
					echo "
						<tr>
							<td>{$row['p_id']}</td>
							<td><a href='post.php?id={$row['p_id']}'>{$row['p_title']}</a></td>
							<td>{$row['u_pseudo']}</td>
							<td>{$row['f_nom']}</td>
							<td><small>{$row['p_date']}</small></td>
						</tr>
					";
				}
				echo "</table>";
			}
		?>
	</div>
</div>
<?php
include 'inc/footer.php';
?>