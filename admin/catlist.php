<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<div class="block">
		<?php
		if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['deleteId'])) {
			$id = $_GET['deleteId'];
			$query = "delete from tbl_category where id = '$id'";
			$result = $db->delete($query);
		
		if ($result) {
                        echo "<span style='color:green;font-size:20px'>Category Deleted Successfully</span>";
                    } else{
                        echo "<span style='color:red;font-size:20px'>Category Deletion Failed</span>";
                    } } ?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Category Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = 'select * from tbl_category';
					$result = $db->select($query);
					if ($result) {
						while ($data = mysqli_fetch_array($result)) {
					?>
							<tr class="odd gradeX">
								<td><?php echo $data['id']; ?></td>
								<td><?php echo $data['name']; ?></td>
								<td><a href="editcat.php?id=<?php echo $data['id']; ?>&name=<?php echo $data['name']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete');" href="?deleteId=<?php echo $data['id']; ?>">Delete</a></td>
							</tr>
					<?php }
					} ?>
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