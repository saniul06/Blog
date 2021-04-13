<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php if (!isset($_GET['messageid']) || $_GET['messageid'] == null || isset($_POST['submit'])) {
    echo "<script>window.location = 'inbox.php'</script>";
} else {
    $msgid = $_GET['messageid'];
}
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php
                    $query = "select * from tbl_contact where id = '$msgid'";
                    $result = $db->select($query);
                    if ($result) {
                        while ($data = $result->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="title" value="<?php echo $data['firstname'] . ' ' . $data['lastname']; ?>" class="medium" readonly />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $data['email']; ?>" class="medium" readonly />
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Message Body</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body" readonly>
                                <?php echo $data['body']; ?>
                            </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Date</label>
                                </td>
                                <td>
                                    <input type="text" name="tag" value="<?php echo $data['date']; ?>" class="medium" readonly />
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