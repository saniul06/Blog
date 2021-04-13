<?php include_once 'inc/header.php'; ?>
<?php
$real = mysqli_real_escape_string($db->link, $_GET['pageid']);
if (!isset($real) || $real == null) {
	header('location: 404.php');
	// echo "<script>window.location = 'index.php'</script>";
} else {
	$pageid = $real;
} ?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<?php $query = "select * from tbl_page where id = '$pageid'";
			$result = $db->select($query);
			if ($result) {
				while ($data = $result->fetch_assoc()) { ?>
					<h2><?php echo $data['name']; ?></h2>

					<?php echo $data['body']; ?>
			<?php   }
			} else header("locaiton: 404.php"); ?>
		</div>

	</div>
	<?php include_once 'inc/sidebar.php'; ?>
	<?php include_once 'inc/footer.php'; ?>