<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['deleteUser'])) {
            $id = $_GET['deleteUser'];
            $query = "delete from tbl_user where id = '$id'";
            $result = $db->delete($query);
            if ($result) {
                echo "<span style='color:green;font-size:20px'>User Deleted Successfully</span>";
            } else {
                echo "<span style='color:red;font-size:20px'>User Deletion Failed</span>";
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = "SELECT * FROM tbl_user";
                    $result = $db->select($query);
                    if ($result) {
                        while ($data = $result->fetch_assoc()) { ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data['name']; ?></td>
                                <td><?php echo $data['username']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $fm->textShorten($data['details'], 30); ?></td>
                                <td>
                                    <?php if ($data['role'] == 0) {
                                        echo "Admin";
                                    } elseif ($data['role'] == 1) {
                                        echo "Author";
                                    } elseif ($data['role'] == 2) {
                                        echo "Editor";
                                    }

                                    ?>
                                </td>
                                <td><a href="viewuser.php?userId=<?php echo $data['id']; ?>">View</a>
                                    <?php if (Session::get('userRole') == 0) { ?>
                                        || <a onclick="return confirm('Are you sure to delete');" href="?deleteUser=<?php echo $data['id']; ?>">Delete</a>
                                    <?php } ?>
                                </td>
                            </tr>

                    <?php    }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>