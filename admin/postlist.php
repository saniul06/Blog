<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
//DELETE POST
$folder = "uploads/";
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['deletePost'])) {
	$id = $_GET['deletePost'];
	$q1 = "select image from tbl_post where id = '$id'";
	$r = $db->select($q1);
	if ($r) {
		$s = $r->fetch_assoc();
		$img = $s['image'];
		$query = "delete from tbl_post where id = '$id'";
		unlink($folder . $img);
		$result = $db->delete($query);
		if ($result) {
			echo "<span style='color:green;font-size:20px'>Post Deleted Successfully</span>";
		} else {
			echo "<span style='color:red;font-size:20px'>Post Deletion Failed</span>";
		}
	}
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width='3%'>No</th>
						<th width='9%'>Category</th>
						<th width='17%'>Title</th>
						<th width='20%'>Body</th>
						<th width='9%'>Image</th>
						<th width='7%'>Author</th>
						<th width='13%'>Keywords</th>
						<th width='9%'>Date</th>
						<th width='13%'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id";
					$result = $db->select($query);
					if ($result) {
						while ($data = $result->fetch_assoc()) { ?>
							<tr class="odd gradeX">
								<td><?php echo $i++; ?></td>
								<td><?php echo $data['name']; ?></td>
								<td><?php echo $data['title']; ?></td>
								<td class="center"><?php echo $fm->textShorten($data['body'], 30); ?></td>
								<td class="center"><img width=50 height=30 src="uploads/<?php echo $data['image']; ?>" /></td>
								<td class="center"><?php echo $data['author']; ?></td>
								<td class="center"><?php echo $data['keywords']; ?></td>
								<td class="center"><?php echo $fm->formatDate($data['date']); ?></td>
								<td>
									<a href="viewpost.php?postid=<?php echo $data['id']; ?>">View </a>
									<?php
									if (Session::get('userid') == $data['userid'] || Session::get('userRole') == 0) {
									?>

										|| <a href="editpost.php?postid=<?php echo $data['id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete');" href="?deletePost=<?php echo $data['id']; ?>">Delete</a>
									<?php } else echo '<td></td>'; ?>
								</td>
							</tr>

					<?php	}
					}
					?>
				</tbody>
			</table>

		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>