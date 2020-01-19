<?php
if (isset($_GET['edit_user'])) {
    $user_id_edit = escape($_GET['edit_user']);
    $query = "SELECT *  FROM users WHERE user_id='$user_id_edit'";
    $result = mysqli_query($connection, $query);
    foreach ($result as $key) {
        $user_firstname = $key['user_firstname'];
        $user_lastname = $key['user_lastname'];
        $user_role = $key['user_role'];
        $username = $key['username'];
        $user_email = $key['user_email'];
        $user_password = $key['user_password'];


?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="user_firstname">First Name</label>
                <input value='<?php echo $user_firstname ?>' type="text" class="form-control" name="user_firstname">
            </div>
            <div class="form-group">
                <label for="user_lastname">Lastnmae</label>
                <input value='<?php echo $user_lastname ?>' type="text" class="form-control" name="user_lastname">
            </div>

            <div class="form-group">
                <label for="user_role">User Role</label>
                <select class="form-control" name="user_role" id="user_role">

                    <option value="<?php echo $user_role; ?>"><?php echo $user_role ?></option>
                    <?php
                    if ($user_role == 'subscriber') {
                        echo '<option value="admin">admin</option>';
                    } else {
                        echo '<option value="subscriber">subscriber</option>';
                    }

                    ?>






                </select>
            </div>

            <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div> -->
            <div class="form-group">
                <label for="username">Username</label>
                <input value='<?php echo $username ?>' type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="user_email">Email</label>
                <input value='<?php echo $user_email ?>' type="email" class="form-control" name="user_email">
            </div>
            <div class="form-group">
                <label for="user_password">Password</label>
                <input value='<?php echo $user_password ?>' type="password" class="form-control" name="user_password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Edit User" name="edit_user">
            </div>
        </form>

<?php  }
} ?>





<?php
if (isset($_POST['edit_user'])) {
    global $connection;

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    if (!empty($user_password)) {
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
    }




    $query = "UPDATE users SET ";
    $query .= "user_firstname='$user_firstname', ";
    $query .= "user_lastname='$user_lastname', ";
    $query .= "user_role='$user_role', ";
    $query .= "username='$username', ";
    $query .= "user_email='$user_email', ";
    $query .= "user_password='$user_password' ";
    $query .= "WHERE user_id='$user_id_edit' ";
    $result = mysqli_query($connection, $query);
    comfirmQuery($result);
    echo "user updated!" . "<a href='users.php'>view users</a>";
}




?>