<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock">
            <form action="" method="post">
                <table class="form">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $name = $_POST['name'];
                        if (empty($name)) {
                            $result = "<span style='color:red;font-size:20px'>Field must not be empty</span>";
                        } else {
                            $query = "insert into tbl_category(name) values('$name')";
                            $insert = $db->insert($query);
                        

                        if ($insert) {
                            echo "<span style='color:green;font-size:20px'>Category Added Successfully</span>";
                        } else {
                            echo "<span style='color:red;font-size:20px'>Insertion Failed</span>";
                        }
                    }
                    } ?>
                    <tr>
                        <td>
                            <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>