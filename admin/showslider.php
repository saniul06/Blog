<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Edit Post</h2>
        <?php
        //EDIT POST
        if (isset($_POST['image'])) {
            $image = $_POST['image'];
            foreach ($image as $value) {
                unlink("../images/slideshow/" . $value);
                $query = "delete from tbl_slider where image = '$value'";
                $result = $db->delete($query);
            }
            if ($result) {
                echo "<span class='success'>Deleted Successfully</span>";
            } else {
                echo "<span class='error'>Deletion Failed</span>";
            }
        }
        ?>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">




                <?php
                //SHOWING OLD DATA

                $query = "select * from tbl_slider";
                $result = $db->select($query);
                if ($result != false) {
                    while ($data = $result->fetch_assoc()) {


                ?>
                        <input type="checkbox" id="<?php echo $data['id']; ?>" name="image[]" value="<?php echo $data['image'] ?>">
                        <label for="<?php echo $data['id']; ?>"><img src="../images/slideshow/<?php echo $data['image'] ?>" alt="" width=100 height=100></label>



                    <?php } ?>
                    <br /> <input type="submit" name="delete" Value="Delete" />
                <?php   } else {echo "Nothing To Show";} ?>
                <br />


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