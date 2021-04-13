<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <?php
        if (isset($_POST['submit'])) {
            $facebook = mysqli_real_escape_string($db->link, $_POST['facebook']);
            $facebook = $fm->validation($facebook);
            $twitter = mysqli_real_escape_string($db->link, $_POST['twitter']);
            $twitter = $fm->validation($twitter);
            $linkedin = mysqli_real_escape_string($db->link, $_POST['linkedin']);
            $linkedin = $fm->validation($linkedin);
            $googleplus = mysqli_real_escape_string($db->link, $_POST['googleplus']);
            $googleplus = $fm->validation($googleplus);
            if ($facebook == "" || $twitter == "" || $linkedin == "" || $googleplus == "") {
                echo "<span class='error'>Field must not be empty</span>";
            } else {
                $query = "update tbl_social set facebook = '$facebook', twitter = '$twitter', linkedin = '$linkedin', googleplus = '$googleplus' where id = 1";
                $result = $db->update($query);
                if ($result) {
                    echo "<span style='color:green;font-size:20px'>Updated Successfully</span>";
                } else {
                    echo "<span style='color:red;font-size:20px'>Update Failed</span>";
                }
            }
        }

        ?>
        <h2>Update Social Media</h2>
        <div class="block">
            <?php $query = "select * from tbl_social";
            $result = $db->select($query);
            if ($result) {
                while ($data = $result->fetch_assoc()) { ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Facebook</label>
                                </td>
                                <td>
                                    <input type="text" name="facebook" value="<?php echo $data['facebook']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Twitter</label>
                                </td>
                                <td>
                                    <input type="text" name="twitter" value="<?php echo $data['twitter']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>LinkedIn</label>
                                </td>
                                <td>
                                    <input type="text" name="linkedin" value="<?php echo $data['linkedin']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Google Plus</label>
                                </td>
                                <td>
                                    <input type="text" name="googleplus" value="<?php echo $data['googleplus']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php   }
            } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>