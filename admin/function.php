<?php

function users_online()
{
    if (isset($_GET['onlineusers'])) {
        global $connection;
        if (!$connection) {
            session_start();
            include("../include/db.php");
        }

        $session = session_id();
        $time = time();
        $time_out_in_second = 15;
        $time_out = $time - $time_out_in_second;
        $query = "SELECT * FROM user_online WHERE session='$session'";
        $result_time = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result_time);
        if ($count == NULL) {
            mysqli_query($connection, "INSERT INTO user_online(session,time) VALUES ('$session','$time')");
        } else {
            mysqli_query($connection, "UPDATE user_online SET time='$time' WHERE session='$session'");
        }
        $user_online = mysqli_query($connection, "SELECT * FROM user_online WHERE time > '$time_out'");
        $count_user = mysqli_num_rows($user_online);
        echo $count_user;
    }
}
users_online();


function comfirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("query failed! " . mysqli_error($connection));
    }
}
function insert_category()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cattitle = $_POST['cattitle'];
        if ($cattitle == "" || empty($cattitle)) {
            echo "this field should't be empty";
        } else {
            $query = "INSERT INTO category (cat_title) VALUES ('$cattitle')";
            $result = mysqli_query($connection, $query);
        }
    }
}

function delete_category()
{
    if (isset($_GET['delete'])) {
        global $connection;
        $cat_id_delete = $_GET['delete'];
        $query = "DELETE FROM category WHERE cat_id=$cat_id_delete";
        $result = mysqli_query($connection, $query);
        header("location:categories.php");
    }
}
function edit_category()
{
    if (isset($_GET['edit'])) {
        global $connection;
        $cat_title_id = $_GET['edit'];
        $query = "SELECT * FROM category";
        $result = mysqli_query($connection, $query);
        foreach ($result as $key) {
            $cat_id_compare = $key['cat_id'];
            $cat_title_compare = $key['cat_title'];
            if ($cat_title_id == $cat_id_compare) {
                echo "<input value='$cat_title_compare' type='text' class='form-control' name='cattitleedit'>";
                if (isset($_POST['update'])) {
                    $cat_title_edit = $_POST['cattitleedit'];
                    $cat_id_edit = $_GET['edit'];
                    $query = "UPDATE category SET cat_title='$cat_title_edit' WHERE cat_id='$cat_id_edit'";
                    $result = mysqli_query($connection, $query);
                    header("location:categories.php");
                }
            }
        }
    }
}
function show_category()
{
    $query = "SELECT * FROM category";
    global $connection;
    $result = mysqli_query($connection, $query);
    foreach ($result as $key) {
        $cat_id = $key['cat_id'];
        $cat_title = $key['cat_title'];
        echo "<tr><td>$cat_id</td>";
        echo "<td>$cat_title</td><td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
        echo "<td><a href='categories.php?edit=$cat_id'>edit</a></td></tr>";
    }
    delete_category();
}

function escape($string){
    global $connection;
 return mysqli_real_escape_string($connection,trim($string));

}