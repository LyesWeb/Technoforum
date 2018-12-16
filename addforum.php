<?php
include 'inc/header.php';
if(isset($_POST['add'])){
	if (empty($_POST['title']) or empty($_POST['desc'])) {
		$msg = "<div class=error>entrer touts les informations</div>";
	}else{
		$FNOM = htmlentities(addslashes(trim($_POST['title'])));
		$Fdesc = htmlentities(addslashes(trim($_POST['desc'])));
		if(mysqli_query($con,"INSERT INTO forum (f_nom,f_desc,u_id) VALUES ('$FNOM','$Fdesc',{$_POST['admin_forum']})")){
			echo "<meta http-equiv='refresh' content='0; url=index.php'/>";
		}else{
			$msg = "<div class=error>error</div>";
		}
	}
}
?>
<div class="container">
	<div class="content">
		<div class="title_page">
			<h3>ajouter forum</h3>
		</div>
		<form method="post">
			<table border="1" cellspacing="0" cellpadding="0" width="100%" id="addPostTable">
				<tr>
					<td>le titre</td>
					<td><input type="text" placeholder="le titre ..." name="title"></td>
				</tr>
				<?php
					if($user['u_level']==1){
						echo "<tr><td>admin de forum</td><td><select name=admin_forum>";
						$u = mysqli_query($con,"SELECT u_pseudo,u_id FROM user");
						while($f = mysqli_fetch_array($u)){
							echo "<option value={$f['u_id']}>{$f['u_pseudo']}</option>";
						}
						echo "</select></td></tr>";
					}
				?>
				<tr>
					<td valign="top">le description</td>
					<td>
						<textarea name="desc" style="height: 40px;font-size: 14px;">le description ...</textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="submit" value="ajouter" name="add"></td>
				</tr>
			</table>
		</form>
		<?=$msg?>
	</div>
</div>
<?php
include 'inc/footer.php';
?>