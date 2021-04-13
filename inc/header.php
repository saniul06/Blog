<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath . '/../config/config.php';
include_once $filePath . '/../lib/Database.php';
include_once $filePath . '/../helpers/format.php';
$db = new Database;
$fm = new Format; ?>
<!DOCTYPE html>
<html>

<head>
	<?php
	if (isset($_GET['pageid'])) {
		$pageid = $_GET['pageid'];
		$query = "select name from tbl_page where id = '$pageid'";
		$result = $db->select($query);
		if ($result) {
			while ($data = $result->fetch_assoc()) {
				echo '<title>' . $data['name'] . ' - ' . title . '</title>';
			}
		}
	} else if (isset($_GET['id'])) {
		$postid = $_GET['id'];
		$query = "select title from tbl_post where id = '$postid'";
		$result = $db->select($query);
		if ($result) {
			while ($data = $result->fetch_assoc()) {
				echo '<title>' . $data['title'] . ' - ' . title . '</title>';
			}
		}
	} else {
		echo '<title>' . $fm->title() . ' - ' . title . '</title>';
	}
	?>

	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<!-- <meta name="keywords" content="blog,cms blog"> -->

	<?php
	if (isset($_GET['id'])) {
		$postid = $_GET['id'];
		$query = "select keywords from tbl_post where id = '$postid'";
		$result = $db->select($query);
		if ($result) {
			while ($data = $result->fetch_assoc()) {
				echo '<meta name="keywords" content="' . $data['keywords'] . '">';
			}
		}
	} else {
		echo '<meta name="keywords" content="' . KEYWORDS . '">';
	}
	?>

	<meta name="author" content="Delowar">
	<?php include 'scripts/css.php'; ?>
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(window).load(function() {
			$('#slider').nivoSlider({
				effect: 'random',
				slices: 10,
				animSpeed: 500,
				pauseTime: 5000,
				startSlide: 0, //Set starting Slide (0 index)
				directionNav: false,
				directionNavHide: false, //Only show on hover
				controlNav: false, //1,2,3...
				controlNavThumbs: false, //Use thumbnails for Control Nav
				pauseOnHover: true, //Stop animation while hovering
				manualAdvance: false, //Force manual transitions
				captionOpacity: 0.8, //Universal caption opacity
				beforeChange: function() {},
				afterChange: function() {},
				slideshowEnd: function() {} //Triggers after all slides have been shown
			});
		});
	</script>
</head>

<body>
	<div class="headersection templete clear">
		<?php
		$query = 'select * from title_slogan where id = 1';
		$result = $db->select($query);
		$data = $result->fetch_assoc();
		?>
		<a href="#">
			<div class="logo">
				<img src="admin/uploads/<?php echo $data['logo']; ?>"  />
				<h2><?php echo $data['title']; ?></h2>
				<p><?php echo $data['slogan']; ?></p>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<?php $query = "select * from tbl_social";
				$result = $db->select($query);
				if ($result) {
					while ($data = $result->fetch_assoc()) { ?>
						<a href="<?php echo $data['facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
						<a href="<?php echo $data['twitter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
						<a href="<?php echo $data['linkedin']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
						<a href="<?php echo $data['googleplus']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php   }
				} ?>
			</div>
			<div class="searchbtn clear">
				<form action="search.php" method="get">
					<input type="text" name="search" placeholder="Search keyword..." />
					<input type="submit" name="submit" value="Search" />
				</form>
			</div>
		</div>
	</div>
	<div class="navsection templete">
		<ul>
			<li><a <?php $title = $_SERVER['SCRIPT_FILENAME'];  //HIGHLIGHT CURRENT PAGE IN MENU
					$title = basename($title, '.php');
					if ($title == 'index') {
						echo 'id="active"';
					}
					?> href="index.php">Home</a></li>

			<?php $query = "select * from tbl_page";
			$result = $db->select($query);
			if ($result) {
				while ($data = $result->fetch_assoc()) { ?>
					<li><a <?php if (isset($_GET['pageid'])) { //HIGHLIGHT CURRENT PAGE IN MENU FROM DATABASE
								if ($data['id'] == $_GET['pageid']) {
									echo 'id="active"';
								}
							} ?> href="page.php?pageid=<?php echo $data['id']; ?>"><?php echo $data['name']; ?></a></li>
			<?php   }
			} ?>
			<li><a <?php $title = $_SERVER['SCRIPT_FILENAME'];
					$title = basename($title, '.php');
					if ($title == 'contact') echo 'id="active"';
					?> href="contact.php">Contact</a></li>
		</ul>
	</div>