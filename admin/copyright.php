<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
    <?php
        if (isset($_POST['submit'])) {
            $copyright = mysqli_real_escape_string($db->link, $_POST['copyright']);
            $copyright = $fm->validation($copyright);
            if ($copyright == "") {
                echo "<span class='error'>Field must not be empty</span>";
            } else {
                $query = "update tbl_footer set copyright = '$copyright' where id = 2";
                $result = $db->update($query);
                if ($result) {
                    echo "<span style='color:green;font-size:20px'>Updated Successfully</span>";
                } else {
                    echo "<span style='color:red;font-size:20px'>Update Failed</span>";
                }
            }
        }

        ?>
        <h2>Update Copyright Text</h2>
        <div class="block copyblock">
        <?php $query = "select * from tbl_footer";
            $result = $db->select($query);
            if ($result) {
                while ($data = $result->fetch_assoc()) { ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $data['copyright']; ?>" name="copyright" class="large" />
                        </td>
                    </tr>

                    <tr>
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