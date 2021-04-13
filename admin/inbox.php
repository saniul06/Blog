<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['messageid'])) {
	$msgid = $_GET['messageid'];
	$query = "update tbl_contact set status = 1 where id = '$msgid'";
	$result = $db->update($query);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<?php
		if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['deleteid'])) {
			$deleteid = $_GET['deleteid'];
			$query = "delete from tbl_contact where id = '$deleteid'";
			$result = $db->update($query);
			if ($result) {
				echo '<span class="success">Message Deleted Successfully</span>';
			} else {
				echo '<span class="error">Failed to Delete Message</span>';
			}
		}
		?>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Name</th>
						<th>email</th>
						<th>Message</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$query = "select * from tbl_contact where status = 0 order by id desc";
					$result = $db->select($query);
					if ($result) {
						while ($data = $result->fetch_assoc()) { ?>
							<tr class="odd gradeX">
								<td><?php echo $i++; ?></td>
								<td><?php echo $data['firstname'] . ' ' . $data['lastname']; ?></td>
								<td><?php echo $data['email']; ?></td>
								<td><?php echo $fm->textShorten($data['body']); ?></td>
								<td><?php echo $fm->formatDate($data['date']); ?></td>
								<td><a href="viewmessage.php?messageid=<?php echo $data['id']; ?>">View</a> || <a href="replymessage.php?messageid=<?php echo $data['id']; ?>">Reply</a> || <a href="?messageid=<?php echo $data['id']; ?>">Seen</a></td>
							</tr>
					<?php	}
					}
					?>
				</tbody>
			</table>
		</div>
		<h2>Seen Message</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Name</th>
						<th>email</th>
						<th>Message</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$query = "select * from tbl_contact where status = 1 order by id desc";
					$result = $db->select($query);
					if ($result) {
						while ($data = $result->fetch_assoc()) { ?>
							<tr class="odd gradeX">
								<td><?php echo $i++; ?></td>
								<td><?php echo $data['firstname'] . ' ' . $data['lastname']; ?></td>
								<td><?php echo $data['email']; ?></td>
								<td><?php echo $fm->textShorten($data['body']); ?></td>
								<td><?php echo $fm->formatDate($data['date']); ?></td>
								<td><a onclick="return confirm('Are you want to delete')" href="?deleteid=<?php echo $data['id']; ?>">Delete</a></td>
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