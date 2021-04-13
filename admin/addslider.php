<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Slide</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php
                    $folder = "../images/slideshow/";
                    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
                        //IMAGE START
                        $permited = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = mysqli_real_escape_string($db->link, $_FILES['image']['name']);
                        $file_size = $_FILES['image']['size'];
                        $file_tmp_name = $_FILES['image']['tmp_name'];

                        $div = explode('.', $file_name);
                        $ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10) . "." . $ext;

                        if ($file_name == "") {
                            echo "<span class='error'>Field must not be empty</span>";
                        } elseif ($file_size > 1048576) {
                            echo "<span class='error'>Image size should less than 1M</span>";
                        } elseif (in_array($ext, $permited) === false) {
                            echo "<span class='error'>Only " . implode(", ", $permited) . " format allowed</span>";
                        } else {
                            move_uploaded_file($file_tmp_name, $folder . $unique_image);

                            //IMAGE END

                            $query = "INSERT INTO tbl_slider(image) values('$unique_image')";
                            $result = $db->insert($query);

                            if ($result) {
                                echo "<span style='color:green;font-size:20px'>Post Insert Successfully</span>";
                            } else {
                                echo "<span style='color:red;font-size:20px'>Post Insertion Failed</span>";
                            }
                        }
                    }
                    ?>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Add Image" />
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