<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$userid = Session::get('userid');
$userRole = Session::get('userRole');
?>
<div class="grid_10">

    <div class="box round first grid">
        <?php
        //EDIT POST
        if (isset($_POST['update'])) {
            $name = $fm->validation($_POST['name']);
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $email = $fm->validation($_POST['email']);
            $email = mysqli_real_escape_string($db->link, $_POST['email']);
            $details = $fm->validation($_POST['details']);
            $details = mysqli_real_escape_string($db->link, $_POST['details']);

            if ($name == "" || $email == "" || $details == "") {
                echo "<span class='error'>Field must not be empty</span>";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<span style='color:red;font-size:20px'>Invalid Email Address</span>";
            } else {
                $query = "select email from tbl_user where email = '$email'";
                $result = $db->select($query);
                if ($result) {
                    echo "<span style='color:red;font-size:20px'> Email Address Already Exists</span>";
                } else {

                    $query = "update tbl_user set name = '$name', email = '$email',details = '$details' where id = '$userid' and role = '$userRole'";
                    $result = $db->update($query);
                    if ($result) {
                        echo "<span style='color:green;font-size:20px'>Updated Successfully</span>";
                    } else {
                        echo "<span style='color:red;font-size:20px'>Update Failed</span>";
                    }
                }
            }
        }
        ?>
        <h2>Edit User Details</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php
                    //SHOWING OLD DATA
                    $query = "select * from tbl_user where id = '$userid' and role='$userRole'";
                    $result = $db->select($query);
                    if ($result) {
                        $data = $result->fetch_assoc();
                    }
                    ?>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $data['username'] ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" value="<?php echo $data['email'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea rows="4" cols="40" name="details"><?php echo $data['details'] ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="update" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- load tiny mce -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker("date-picker");
        $("input[type='checkbox']").fancybutton();
        $("input[type='radio']").fancybutton();
    });
</script>
<?php include 'inc/footer.php'; ?>