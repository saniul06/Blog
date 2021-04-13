<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!Session::get('userRole') == 0) {
    echo "<script>window.location = 'index.php'</script>";
}
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block">
            <form action="" method="post">
                <table class="form">
                    <?php
                    $folder = "uploads/";
                    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
                        $name = $fm->validation($_POST['name']);
                        $name = mysqli_real_escape_string($db->link, $_POST['name']);
                        $username = $fm->validation($_POST['username']);
                        $username = mysqli_real_escape_string($db->link, $_POST['username']);
                        $password = $fm->validation($_POST['password']);
                        $password = mysqli_real_escape_string($db->link, md5($_POST['password']));
                        $role = $fm->validation($_POST['role']);
                        $role = mysqli_real_escape_string($db->link, $_POST['role']);

                        if ($username == "" || $password == "" || $role == "") {
                            echo "<span class='error'>Field must not be empty</span>";
                        }  else {
                            $query = "INSERT INTO tbl_user(name,username,password,role) values( '$name','$username','$password','$role')";
                            $result = $db->insert($query);

                            if ($result) {
                                echo "<span style='color:green;font-size:20px'>User Created Successfully</span>";
                            } else {
                                echo "<span style='color:red;font-size:20px'>User Creation Failed</span>";
                            }
                        }
                    }
                    ?>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" placeholder="Enter User Name.." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter User Name.." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input type="text" name="password" placeholder="Enter password..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Role</label>
                        </td>
                        <td>
                            <select id="select" name="role">
                                <option disabled>Select Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Add User" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>