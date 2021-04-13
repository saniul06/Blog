<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">

    <div class="box round first grid">
        <?php if (isset($_POST['submit'])) {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $title = $fm->validation($title);
            $slogan = mysqli_real_escape_string($db->link, $_POST['slogan']);
            if ($title == "" || $slogan == "") {
                echo "<span class='error'>Field must not be empty</span>";
            } else {
                if (!empty($_FILES['logo']['name'])) {
                    $file_name = $_FILES['logo']['name'];
                    $file_size = $_FILES['logo']['size'];
                    $file_tmp_name = $_FILES['logo']['tmp_name'];
                    $permited = array('jpg', 'png', 'jpeg', 'gif');
                    $div = explode('.', $file_name);
                    $ext = strtolower(end($div));
                    $check = in_array($ext, $permited);
                    $unique_image = 'logo' . '.' . $ext;
                    if ($file_size > 1048576) {
                        echo "<span class='error'>Image size should less than 1M</span>";
                    } elseif ($check === false) {
                        echo "<span class='error'>Only " . implode(", ", $permited) . " format allowed</span>";
                    } else {
                        $query = "update title_slogan set title = '$title', slogan = '$slogan', logo = '$unique_image' where id = 1";
                        move_uploaded_file($file_tmp_name, 'uploads/' . $unique_image);
                        $result = $db->update($query);
                        if ($result) {
                            echo "<span style='color:green;font-size:20px'>Updated Successfully</span>";
                        } else {
                            echo "<span style='color:red;font-size:20px'>Update Failed</span>";
                        }
                    }
                } else {
                    $query = "update title_slogan set title = '$title', slogan = '$slogan' where id = 1";
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
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock">
            <?php $query = "select * from title_slogan";
            $result = $db->select($query);
            if ($result) {
                while ($data = $result->fetch_assoc()) { ?>


                    <div class="left">
                        <form action="" method="post" enctype="multipart/form-data">
                            <table class="form">
                                <tr>
                                    <td>
                                        <label>Website Title</label>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo $data['title']; ?>" name="title" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Website Slogan</label>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo $data['slogan']; ?>" name="slogan" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Upload Logo</label>
                                    </td>
                                    <td>
                                        <input type="file" name="logo" />
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
                    <div class="right">
                        <h2>Logo</h2>
                        <img src="uploads/<?php echo $data['logo']; ?>" width=100 height=100 />
                    </div>
            <?php   }
            } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>