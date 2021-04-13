<?php include_once 'inc/header.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$firstname = $fm->validation($_POST['firstname']);
	$firstname = mysqli_real_escape_string($db->link, $firstname);
	$lastname = $fm->validation($_POST['lastname']);
	$lastname = mysqli_real_escape_string($db->link, $lastname);
	$email = $fm->validation($_POST['email']);
	$email = mysqli_real_escape_string($db->link, $email);
	$body = $fm->validation($_POST['body']);
	$body = mysqli_real_escape_string($db->link, $body);
	$error = "";
	if (empty($firstname)) {
		$errorf = "First name must not be empty";
	}
	if (empty($lastname)) {
		$errorl = "Last name must not be empty";
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errore = "Invalid email address";
	}
	if (empty($body)) {
		$errorb = "Body must not be empty";
	} else {

		$query = "insert into tbl_contact(firstname, lastname, email, body) values('$firstname', '$lastname', '$email', '$body')";
		$result = $db->insert($query);
		if ($result) {
			$msg = "Message Sent Successfully";
		} else{
			$error = "Message Sending Failed";
		}
	}
}
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>
			<?php
			if (isset($msg)) {
				echo "<span style='color:green'> $msg</span>";
			}
			if (isset($error)) {
				echo "<span style='color:green'> $error</span>";
			}
			?>
			<form action="" method="post">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<input type="text" name="firstname" placeholder="Enter first name" />

						</td>

					</tr>
					<tr>
						<td></td>
						<td>
							<?php
							if (isset($errorf)) {
								echo "<span style='color:red'> $errorf</span>";
							}
							?>
						</td>
					</tr>
					</td>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<input type="text" name="lastname" placeholder="Enter Last name" />
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php
							if (isset($errorl)) {
								echo "<span style='color:red'> $errorl</span>";
							}
							?>
						</td>
					</tr>

					<tr>
						<td>Your Email Address:</td>
						<td>
							<input type="text" name="email" placeholder="Enter Email Address" />
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php
							if (isset($errore)) {
								echo "<span style='color:red'> $errore</span>";
							}
							?>
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="body"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php
							if (isset($errorb)) {
								echo "<span style='color:red'> $errorb</span>";
							}
							?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Submit" />
						</td>
					</tr>
				</table>
				<form>
		</div>

	</div>
	<?php include_once 'inc/sidebar.php'; ?>
	<?php include_once 'inc/footer.php'; ?>