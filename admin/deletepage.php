<?php include '../lib/session.php';
Session::start();
Session::checkSession();
include '../config/config.php';
include '../lib/Database.php';
$db = new Database; ?>

<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
    header("location: index.php");
} else {
    $pageid = $_GET['pageid'];
    $query = "delete from tbl_page where id = '$pageid'";
    $result = $db->delete($query);
    if ($result) {
        echo "<script>alert('Page Deleted Successfully')</script>";
        echo "<script>window.location = 'index.php'</script>";
    } else {
        echo "<script>alert('Page Deletion Failed')</script>";
        header("location: index.php");
    }
}
