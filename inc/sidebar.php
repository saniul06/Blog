<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
				<?php $query = "select * from tbl_category";
		$post = $db->select($query);
		if ($post) {
			while ($result = $post->fetch_assoc()) {
		?>
					<ul>
						<li><a href="category.php?category=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
			<?php }} else echo '<li>no category found</li>'; ?>					
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
				<?php $query = "select * from tbl_post limit 5";
						$post = $db->select($query);
						if ($post) {
						while ($result = $post->fetch_assoc()) {
				?>
					<div class="popular clear">
						<h3><a href="post.php?postid=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
						<a href="post.php?postid=<?php echo $result['id']; ?>"><img src="admin/uploads/<?php echo $result['image']; ?>" alt="post image" /></a>
						<p><?php echo $fm->textShorten($result['body'], 80); ?></p>	
					</div>
					<?php }} else echo '<li>no category found</li>'; ?>	
			</div>
			
		</div>