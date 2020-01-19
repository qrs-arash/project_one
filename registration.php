<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>


<!-- Navigation -->

<?php include "include/navigation.php"; ?>
<?php
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));



    if (!empty($username) && !empty($email) && !empty($password)) {

        // $query = "SELECT randSalt FROM users";
        // $result_rand = mysqli_query($connection, $query);
        // if (!$result_rand) {
        //     die("Querry failed" . mysqli_error($connection));
        // }


        // foreach ($result_rand as $sand) {
        //     $salt = $sand['randSalt'];
        // }
        // $password = crypt($password, $salt);

        $query = "INSERT INTO users (username,user_email,user_password,user_role)";
        $query .= "VALUES ('$username','$email','$password','subscriber')";
        $result_insert = mysqli_query($connection, $query);
        if (!$result_insert) {
            die("Query feiled" . mysqli_error($connection));
        }
        $message = "your registration has been submitted";
    } else {
        $message = "Fields cannot be empty";
    }
}


?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <h6 class="text-center"><?php if (!empty($message)) {
                                                    echo $message;
                                                } ?></h6>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "include/footer.php"; ?>