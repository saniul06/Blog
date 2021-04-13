<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Change Password</h2>
        <?php if (isset($_POST['submit'])) {
            $oldpassword = $fm->validation($_POST['oldpassword']);
            $oldpassword = mysqli_real_escape_string($db->link, md5($_POST['oldpassword']));
            $newpassword = $fm->validation($_POST['newpassword']);

            if (empty($oldpassword) || empty($newpassword)) {
                echo "<span class='error'>Field must not be empty</span>";
            } else {
                $id = Session::get('userid');
                $newpassword = mysqli_real_escape_string($db->link, md5($_POST['newpassword']));
                $query = "select password from tbl_user where password = '$oldpassword' and id = '$id'";
                $result = $db->select($query);
                if ($result) {
                    $query = "update tbl_user set password = '$newpassword' where id = '$id'";
                    $result = $db->update($query);
                    if ($result) {
                        echo "<span class='success'>Password Change Successfully</span>";
                    } else {
                        echo "<span class='error'>Could not change password</span>";
                    }
                } else {
                    echo "<span class='error'>Password doesn't exists</span>";
                }
            }
        }
        ?>
        <div class="block">
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Old Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter Old Password..." name="oldpassword" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>New Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter New Password..." name="newpassword" class="medium" />
                        </td>
                    </tr>


                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>