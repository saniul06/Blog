<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Theme</h2>
        <?php
        if (isset($_POST['submit'])) {
            $theme = $_POST['theme'];
            $query = "update tbl_theme set theme = '$theme'";
            $result = $db->update($query);
            if ($result) {
                echo "<span class='success'>Theme Updated Successfully</span>";
            } else {
                echo "<span class='error>Theme Update Failed</span>";
            }
        } ?>
        <div class="block copyblock">
            <form action="" method="post">
                <table class="form">
                    <?php $query = "select * from tbl_theme";
                    $result = $db->select($query);
                    $data = $result->fetch_assoc();
                    ?>
                    <tr>
                        <td>
                            <input <?php if ($data['theme'] == 'default') echo " checked"; ?> type="radio" name="theme" value="default" /> Default
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input <?php if ($data['theme'] == 'green') echo "checked"; ?> type="radio" name="theme" value="green" /> Green
                        </td>
                    </tr>
                    <tr>
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