<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php
                    $folder = "uploads/";
                    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
                        $title = mysqli_real_escape_string($db->link, $_POST['title']);
                        $body = mysqli_real_escape_string($db->link, $_POST['body']);
                        $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
                        $author = mysqli_real_escape_string($db->link, $_POST['author']);
                        $keywords = mysqli_real_escape_string($db->link, $_POST['keywords']);
                        $userid = mysqli_real_escape_string($db->link, $_POST['userid']);
                        //IMAGE START
                        $permited = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = mysqli_real_escape_string($db->link, $_FILES['image']['name']);
                        $file_size = $_FILES['image']['size'];
                        $file_tmp_name = $_FILES['image']['tmp_name'];

                        $div = explode('.', $file_name);
                        $ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10) . "." . $ext;

                        if ($title == "" || $body == "" || $cat == "" || $author == "" || $keywords == "" || $file_name == "") {
                            echo "<span class='error'>Field must not be empty</span>";
                        } elseif ($file_size > 1048576) {
                            echo "<span class='error'>Image size should less than 1M</span>";
                        } elseif (in_array($ext, $permited) === false) {
                            echo "<span class='error'>Only " . implode(", ", $permited) . " format allowed</span>";
                        } else {
                            move_uploaded_file($file_tmp_name, $folder . $unique_image);

                            //IMAGE END

                            $query = "INSERT INTO tbl_post(title,body,cat,image,author,keywords,userid) values('$title','$body','$cat','$unique_image','$author','$keywords', '$userid')";
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
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cat">
                                <option>Select Category</option>
                                <?php
                                $query = "select * from tbl_category";
                                $result = $db->select($query);
                                if ($result) {
                                    while ($value = $result->fetch_assoc()) {

                                ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Keywords</label>
                        </td>
                        <td>
                            <input type="text" name="keywords" placeholder="Enter keywords..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo Session::get("username"); ?>" class="medium" />
                            <!-- THIS IS WILL BE USED TO CONTROL THE USERS VIEW / EDIT OPTION IN postlist.php file       -->
                            <input style="display:none" type="text" name="userid" value="<?php echo Session::get("userid"); ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Create Post" />
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