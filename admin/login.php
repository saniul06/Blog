<?php include_once '../lib/session.php';
Session::start();
Session::checkLogin();
?>
<?php include_once '../config/config.php'; ?>
<?php include_once '../lib/Database.php'; ?>
<?php include_once '../helpers/format.php'; ?>
<?php
$db = new Database;
$fm = new Format;
?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>

	<div class="container">
		<section id="content">
			<form action="" method="post">
				<?php
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					$name = $fm->validation($_POST['name']);
					$password = $fm->validation(md5($_POST['password']));
					$password = mysqli_real_escape_string($db->link, $password);
					//	$password = md5($password);
					$query = "select * from tbl_user where name='$name' and password='$password'";
					$result = $db->select($query);
					if ($result != false) {
						//	$value = $result->fetch_assoc();
						$value = mysqli_fetch_array($result);
						Session::start();
						Session::set("login", true);
						Session::set("name", $value['name']);
						Session::set("username", $value['username']);
						Session::set("userid", $value['id']);
						Session::set("userRole", $value['role']);
						header("location: index.php");
					} else {
						echo "<span style='color:red;font-size:20px'>username or password do not match</span>";
					}
				}
				?>
				<h1>Admin Login</h1>
				<div>
					<input type="text" placeholder="Name" required="" name="name" />
				</div>
				<div>
					<input type="password" placeholder="Password" required="" name="password" />
				</div>
				<div>
					<input type="submit" value="Log in" />
				</div>
				<div>
					<a href="forgetpassword.php">Forget password?</a>
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="#">Training with live project</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>

</html>