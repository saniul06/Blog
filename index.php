<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/slider.php'; ?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<!-- pagination calculation start -->
		<?php
		$post_per_page = 3;
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
			$start_from = ($page - 1) * $post_per_page;
		} else $start_from = 0;
		?>
		<!-- pagination calculation end -->
		<?php $query = "select * from tbl_post order by id desc limit $start_from, $post_per_page";
		$post = $db->select($query);
		if ($post) {
			while ($result = $post->fetch_assoc()) {
		?>
				<div class="samepost clear">
					<h2><a href="post.php?postid=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
					<h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
					<a href="admin/uploads/<?php echo $result['image']; ?>"><img src="admin/uploads/<?php echo $result['image']; ?>" alt="post image" width=342 height=147 /></a>
					<p>
						<?php echo $fm->textShorten($result['body']); ?>
					</p>
					<div class="readmore clear">
						<a href="post.php?postid=<?php echo $result['id']; ?>">Read More</a>
					</div>
				</div>
			<?php } ?>
			<!--end while -->
			<!-- pagination start -->
			<?php
			$query = 'select * from tbl_post';
			$result = $db->select($query);
			$total_rows = mysqli_num_rows($result);
			$total_page = ceil($total_rows / $post_per_page); ?>
			<span class="pagination">
				<a href="index.php?page=1"> start </a>
				<?php
				for ($i = 2; $i < $total_page; $i++) { ?>
					<a href="index.php?page=<?php echo $i; ?>"> <?php echo $i - 1; ?> </a>

				<?php } ?>
				<a href="index.php?page=<?php echo $total_page; ?>"> End </a>
			</span>
			<!-- pagination end -->
		<?php } else {
			header("location: 404.php");
		} ?>

	</div>

	<?php include_once 'inc/sidebar.php'; ?>
	<?php include_once 'inc/footer.php'; ?>