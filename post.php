<?php include_once 'inc/header.php'; ?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<?php
		$real = mysqli_real_escape_string($db->link, $_GET['postid']);
		if (!isset($real) || $real == null) {
			header('location: 404.php');
		} else {
			$id = $real;
		}
		$sql = "select * from tbl_post where id = $id";
		$post = $db->select($sql);
		if ($post) {
			$result = $post->fetch_assoc();
		?>
			<div class="about">
				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
				<img src="admin/uploads/<?php echo $result['image']; ?>" alt="post image" />
				<p><?php echo $result['body']; ?></p>
			<?php  } else {
			header("location: 404.php");
		} ?>
			<div class="relatedpost clear">
				<h2>Related articles</h2>
				<?php
				$category = $result['cat'];
				$query_category = "select * from tbl_post where cat = $category order by rand() limit 6";
				$related_post = $db->select($query_category);
				if ($related_post) {
					while ($result_related = $related_post->fetch_assoc()) {
				?>
						<a href="post.php?postid=<?php echo $result_related['id']; ?>"><img src="admin/uploads/<?php echo $result_related['image']; ?>" alt="post image" /></a>
				<?php
					}
				} else {
					echo 'no related post available';
				}
				?>
			</div>
			</div>
	</div>
	<?php include_once 'inc/sidebar.php'; ?>
	<?php include_once 'inc/footer.php'; ?>