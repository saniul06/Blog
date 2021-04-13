<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php if (!isset($_GET['postid']) || $_GET['postid'] == null || isset($_POST['submit'])) {
    echo "<script>window.location = 'postlist.php'</script>";
} else {
    $postid = $_GET['postid'];
}
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php
                    $query = "select * from tbl_post where id = '$postid'";
                    $result = $db->select($query);
                    if ($result) {
                        while ($data = $result->fetch_assoc()) { ?>
                          

                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input value="<?php echo $data['title']; ?>" class="medium" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <?php
                                        $query = "select * from tbl_category";
                                        $r = $db->select($query);
                                        if($r){
                                            while($d = $r->fetch_assoc()){
                                                if($d['id'] == $data['cat']){
                                        
                                    ?>
                                    <input value="<?php echo $d['name']; ?>" class="medium" readonly />
                                    <?php }}}?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Image</label>
                                </td>
                                <td>
                                    <img src="uploads/<?php echo $data['image']; ?>" class="medium" width=200 height=200 readonly />
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Message Body</label>
                                </td>
                                <td>
                                    <textarea rows=10 cols=80 readonly><?php echo $data['body']; ?>
                            </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                    <input value="<?php echo $data['author']; ?>" class="medium" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Keywords</label>
                                </td>
                                <td>
                                    <input value="<?php echo $data['keywords']; ?>" class="medium" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Date</label>
                                </td>
                                <td>
                                    <input value="<?php echo $fm->formatDate($data['date']); ?>" class="medium" readonly />
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