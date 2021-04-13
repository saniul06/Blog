<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php if (!isset($_GET['messageid']) || $_GET['messageid'] == null) {
    echo "<script>window.location = 'inbox.php'</script>";
} else {
    $msgid = $_GET['messageid'];
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Reply Mail</h2>
        <?php
        if (isset($_POST['submit'])) {
            $toemail = $fm->validation($_POST['toemail']);
            $toemail = mysqli_real_escape_string($db->link, $toemail);
            $fromemail = $fm->validation($_POST['fromemail']);
            $fromemail = mysqli_real_escape_string($db->link, $fromemail);
            $subject = $fm->validation($_POST['subject']);
            $subject = mysqli_real_escape_string($db->link, $subject);
            $body = $fm->validation($_POST['body']);
            $body = mysqli_real_escape_string($db->link, $body);
            $send = mail($toemail, $subject, $body, $fromemail);
            echo $toemail;
            if ($send) {
                echo '<span class="success">Email Send Successfully</span>';
            } else {
                echo '<span class="error">Email Sending Failed</span>';
            }
        }
        ?>
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
                                    <label>To</label>
                                </td>
                                <td>
                                    <input type="text" name="toemail" value="<?php echo $data['email']; ?>" class="medium" readonly />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>From</label>
                                </td>
                                <td>
                                    <input type="text" name="fromemail" value="Enter your email" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Subject</label>
                                </td>
                                <td>
                                    <input type="text" name="subject" value="Enter subject" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Message Body</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body">
                            </textarea>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Send" />
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