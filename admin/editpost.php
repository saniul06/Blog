<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$folder = "uploads/";
if (!isset($_GET['postid']) || $_GET['postid']  == NULL) {
    echo '<script>window.location = "postlist.php"</script>';
} else {
    $postid = mysqli_real_escape_string($db->link, $_GET['postid']);
} ?>
<div class="grid_10">

    <div class="box round first grid">
        <?php
        //EDIT POST
        if (isset($_POST['update'])) {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            $keywords = mysqli_real_escape_string($db->link, $_POST['keywords']);
            $author = mysqli_real_escape_string($db->link, $_POST['author']);
            $cat = $_POST['cat'];
            $id = $postid;

            if (!empty($_FILES['image']['name'])) {
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

                    $query = "update tbl_post set cat = '$cat', title = '$title',body = '$body', image = '$unique_image', keywords = '$keywords',author = '$author' where id = '$id'";
                    $result = $db->insert($query);

                    if ($result) {
                        echo "<span style='color:green;font-size:20px'>Post Updated Successfully</span>";
                    } else {
                        echo "<span style='color:red;font-size:20px'>Post Update Failed</span>";
                    }
                }
            } else {
                if ($title == "" || $body == "" || $cat == "" || $author == "" || $keywords == "") {
                    echo "<span class='error'>Field must not be empty</span>";
                } else {

                    $query = "update tbl_post set cat = '$cat', title = '$title',body = '$body',keywords = '$keywords',author = '$author' where id = '$id'";
                    $result = $db->update($query);
                    if ($result) {
                        echo "<span style='color:green;font-size:20px'>Post Updated Successfully</span>";
                    } else {
                        echo "<span style='color:red;font-size:20px'>Post Update Failed</span>";
                    }
                }
            }
        }
        ?>
        <h2>Edit Post</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php
                    //SHOWING OLD DATA
                    $query = "select * from tbl_post where id = '$postid'";
                    $result = $db->select($query);
                    if ($result) {
                        $data = $result->fetch_assoc();
                    }
                    ?>
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $data['title'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cat">
                                <?php
                                $query = "select * from tbl_category";
                                $result = $db->select($query);
                                if ($result) {
                                    while ($value = $result->fetch_assoc()) {
                                        if ($data['cat'] == $value['id']) {
                                            $selected = "selected = 'selected'";
                                        } else {
                                            $selected = "";
                                        }

                                ?>
                                        <option <?php echo $selected; ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
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
                            <img src="uploads/<?php echo $data['image'] ?>" alt=""><br />
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body">
                            value="<?php echo $data['body'] ?>"
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Keywords</label>
                        </td>
                        <td>
                            <input type="text" name="keywords" value="<?php echo $data['keywords'] ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo $data['author'] ?>" class="medium" />

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