<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php if (!isset($_GET['userId']) || $_GET['userId'] == null || isset($_POST['submit'])) {
    echo "<script>window.location = 'userlist.php'</script>";
} else {
    $userId = $_GET['userId'];
}
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php
                    $query = "select * from tbl_user where id = '$userId'";
                    $result = $db->select($query);
                    if ($result) {
                        while ($data = $result->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <label>Username</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $data['username']; ?>" class="medium" readonly />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $data['email']; ?>" class="medium" readonly />
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Message Body</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" readonly>
                                <?php echo $data['details']; ?>
                            </textarea>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Ok" />
                                </td>
                            </tr>
                    <?php       }
                    } else {
                        echo "Nothing Found";
                    }
                    ?>
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