<?php include 'inc/header.php'; ?>
<?php
$real = mysqli_real_escape_string($db->link, $_GET['id']);
$r = mysqli_real_escape_string($db->link, $_GET['name']);
if (!isset($real) || $real == null) {
    header("location: catlist.php");
    //echo "<script>window.location = 'catlist.php';</script>";
} else {
    $id = $real;
    $name = $r;
} ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock">
            <form action="" method="post">
                <table class="form">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $name = $_POST['name'];
                        if (empty($name)) {
                            $result = "<span style='color:red;font-size:20px'>Field must not be empty</span>";
                        } else {
                            $query = "update tbl_category set name = '$name' where id = $id";
                            $result = $db->update($query);
                        }

                        if ($result) {
                            echo "<span class='success'>Category Updated Successfully</span>";
                        } else {
                            echo "<span class='error'>Category Update Failed</span>";
                        }
                    } ?>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $name; ?>" name="name" placeholder="Enter Category Name..." class="medium" />
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