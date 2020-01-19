<?php include "db.php"; ?>
<?php session_start();   ?>
<?php




?>
<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Querry Failed" . mysqli_error($connection));
    }
    foreach ($result as $key) {
        $db_user_id = $key['user_id'];
        $db_user_password = $key['user_password'];
        $db_username = $key['username'];
        $db_user_firstname = $key['user_firstname'];
        $db_user_lastname = $key['user_lastname'];
        $db_user_role = $key['user_role'];
    }
   
    
    if (password_verify($password,$db_user_password)) {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['password'] = $db_user_password;
        header("Location:../admin");
    } else {
        header("Location:../index.php");
    }
}
?>

