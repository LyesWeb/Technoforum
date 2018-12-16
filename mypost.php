<?php
include 'inc/header.php';
if (!isset($_COOKIE['u_id'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php'/>";
}
?>
<div class="container">
	<div class="content">
		<div class="title_page">
			<h3>mes sujets :</h3>
		</div>
		<br>
		<?php
			$my_result = mysqli_query($con,"SELECT * FROM post INNER JOIN forum ON post.f_id=forum.f_id WHERE post.u_id=$u_id");
				echo "
				<table border='0' cellspacing='0' cellpadding='0' width='100%' id=NewPostTable>
					<tr class=tr>
						<td align=center>#</td>
						<td>sujets</td>
						<td>forum</td>
						<td>date</td>
					</tr>
				";
				while ($row = mysqli_fetch_array($my_result)) {
					echo "
						<tr>
							<td>{$row['p_id']}</td>
							<td><a href='post.php?id={$row['p_id']}'>{$row['p_title']}</a></td>
							<td>{$row['f_nom']}</td>
							<td><small>{$row['p_date']}</small></td>
						</tr>
					";
				}
				echo "</table>";
		?>
	</div>
</div>
<?php
include 'inc/footer.php';
?>