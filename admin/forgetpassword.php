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
    <title>Forget Password</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>

    <div class="container">
        <section id="content">
            <form action="" method="post">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $email = $fm->validation($_POST['email']);
                    $email = mysqli_real_escape_string($db->link, $email);
                    //	$password = md5($password);
                    if (empty($email)) {
                        echo "<span style='color:red;font-size:20px'>Field must not be empty</span>";
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo "<span style='color:red;font-size:20px'>Invalid Email Address</span>";
                    } else {
                        $query = "select email from tbl_user where email = '$email'";
                        $result = $db->select($query);
                        if ($result == false) {
                            echo "<span style='color:red;font-size:20px'> Email Not Exists</span>";
                        } else {
                            $query = "select * from tbl_user where email = '$email'";
                            $result = $db->select($query);
                            if ($result) {
                                while ($data = $result->fetch_assoc()) {
                                    $userid = $data['id'];
                                    $username = $data['username'];

                                    $text = substr($email, 0, 3);
                                    $rand = rand(1000, 9999);
                                    $newpassword = $text . $rand;
                                    $password = md5($newpassword);
                                    $query = "update tbl_user set password = '$password' where id = '$userid'";
                                    $update = $db->update($query);

                                    $to = $email;
                                    $subject = "Recover your lost password";
                                    $message = "Your Username is : " . $username . " and Password is : " . $newpassword . " .Please visit the site to login";
                                    // Always set content-type when sending HTML email
                                    $headers = "MIME-Version: 1.0" . "\r\n";
                                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                                    // More headers
                                    $headers .= 'From: <saniul@gmail.com>' . "\r\n";
                                    $headers .= 'Cc: myboss@example.com' . "\r\n";

                                    $sendmail = mail($to, $subject, $message, $headers);
                                    if ($sendmail) {
                                        echo "<span style='color:green;font-size:20px'> Please check your email for new password</span>";
                                    } else {
                                        echo "<span style='color:red;font-size:20px'> Failed to Send Email</span>";
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
                <h1>Password Recovery</h1>
                <div>
                    <input type="text" placeholder="Enter your email" required="" name="email" />
                </div>
                <div>
                    <input type="submit" value="Send" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="#">Training with live project</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
    <div style="background: green;">
        <p><?php if (isset($newpassword)) echo $newpassword; ?></p>
        <p><?php if (isset($newpassword)) echo $password; ?></p>
    </div>
</body>

</html>