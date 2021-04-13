<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$real = mysqli_real_escape_string($db->link, $_GET['pageid']);
if (!isset($real) || $real == NULL) {

    // $pageid = "";
    header("location: index.php");
    // echo "<script>window.location = 'index.php'</script>";
} else {
    $pageid = $real;
} ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Edit Page</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);

            if ($name == "" || $body == "") {
                echo "<span class='error'>Field must not be empty</span>";
            } else {


                $query = "update tbl_page set name = '$name', body = '$body' where id = '$pageid'";
                $result = $db->update($query);

                if ($result) {
                    echo "<span style='color:green;font-size:20px'>Page Successfully Updated</span>";
                } else {
                    echo "<span style='color:red;font-size:20px'>Page Update Failed</span>";
                }
            }
        }
        ?>
        <div class="block">
            <form action="" method="post">
                <table class="form">
                    <?php $query = "select * from tbl_page where id = '$pageid'";
                    $result = $db->select($query);
                    if ($resnameult) {
                        while ($data = $result->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $data['name']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body">
                                    <?php echo $data['body']; ?>"
                                    </textarea>
                                </td>
                            </tr>
                  
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                            <span><a class="actiondel" href="deletepage.php?pageid=<?php echo $data['id']; ?>">Delete</a></span>
                        </td>
                    </tr>
                    <?php   }
                    } ?>
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