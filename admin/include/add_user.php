<?php if (isset($_POST['create_user'])) {
    global $connection;

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));


    $query = "INSERT INTO users(user_firstname,user_lastname
    ,user_role,username,user_email,user_password) ";
    $query .=
        " VALUES('$user_firstname','$user_lastname','$user_role'
    ,'$username','$user_email','$user_password') ";
    $result = mysqli_query($connection, $query);

    comfirmQuery($result);
    echo "User Created: " . "" . "<a href='users.php'>View Users</a>";
}




?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastnmae</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>
        <select class="form-control" name="user_role" id="user_role">
            <option value="subscriber">select option</option>
            <option value="admin">admin</option>
            <option value="subscriber">subscriber</option>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div> -->
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Add User" name="create_user">
    </div>
</form>