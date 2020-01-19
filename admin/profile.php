<?php ob_start();     ?>
<?php include "../include/db.php"; ?>


<?php include "include/admin_header.php"; ?>
<?php
if (isset($_SESSION['username'])) {
$username=$_SESSION['username'];
$query="SELECT * FROM users WHERE username='$username'";
$result=mysqli_query($connection,$query);
comfirmQuery($result);

foreach($result as $key){
    $user_id = $key['user_id'];
    $username = $key['username'];
    $user_password = $key['user_password'];
    $user_firstname = $key['user_firstname'];
    $user_lastname = $key['user_lastname'];
    $user_email = $key['user_email'];
    $user_image = $key['user_image'];
    $user_role = $key['user_role'];



}

}
?>

<?php
if (isset($_POST['edit_user'])) {
    global $connection;

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $user_date = date('d-m-y');
    // $post_comment_count = 4;


    // move_uploaded_file($post_image_temp, "../images/$post_image");


    $query = "UPDATE users SET ";
    $query .= "user_firstname='$user_firstname', ";
    $query .= "user_lastname='$user_lastname', ";
    $query .= "user_role='$user_role', ";
    $query .= "username='$username', ";
    $query .= "user_email='$user_email', ";
    $query .= "user_password='$user_password' ";
    $query .= "WHERE username='$username' ";
    $result = mysqli_query($connection, $query);
    comfirmQuery($result);
    header('location:users.php');
}




?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "include/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>author</small>
                    </h1>
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

                                <option value="$user_role"><?php echo $user_role ?></option>
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
                            <input type="submit" class="btn btn-primary" value="Update Profile" name="edit_user">
                        </div>
                    </form>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include "include/admin_footer.php" ?>