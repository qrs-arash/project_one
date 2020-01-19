<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>
                Id
            </th>
            <th>
                Username
            </th>
            <th>
                Firstname
            </th>
            <th>
                Lastname
            </th>
            <th>
                Email
            </th>
            <th>
                Role
            </th>



        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $result = mysqli_query($connection, $query);
        foreach ($result as $key) {

            $user_id = $key['user_id'];
            $username = $key['username'];
            $user_password = $key['user_password'];
            $user_firstname = $key['user_firstname'];
            $user_lastname = $key['user_lastname'];
            $user_email = $key['user_email'];
            $user_image = $key['user_image'];
            $user_role = $key['user_role'];

            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
            echo " <td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";

            // $query = "SELECT * FROM category WHERE cat_id='$comment_post_id'";
            // $catresult = mysqli_query($connection, $query);
            // foreach ($catresult as $row) {
            //     $cat_title=$row['cat_title'];
            //     echo "<td>$cat_title</td>";
            // }



            // $query_post_id = "SELECT * FROM posts WHERE post_id=$comment_post_id";
            // $result_post_id = mysqli_query($connection, $query_post_id);
            // foreach ($result_post_id as $key) {
            //     $post_id = $key['post_id'];
            //     $post_title = $key['post_title'];
            //     echo "<td><a href='../post.php?p_id=$post_id' >$post_title</a></td>";
            // }
            echo "<td><a href='users.php?change_to_admin=$user_id'>admin</a></td>";
            echo "<td><a href='users.php?change_to_sub=$user_id'>subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
            echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
            echo "</tr>";
        }
        if (isset($_GET['delete'])) {
            if (isset($_SESSION['user_role'])) {
                if ($_SESSION['user_role'] == 'admin') {
                    $user_id_delete = mysqli_real_escape_string($connection, $_GET['delete']);
                    $query = "DELETE FROM users WHERE user_id='$user_id_delete'";
                    $result = mysqli_query($connection, $query);
                    comfirmQuery($result);
                    header('location:users.php');
                }
            }
        }
        if (isset($_GET['change_to_admin'])) {
            $user_id_admin = $_GET['change_to_admin'];
            $query = "UPDATE users SET user_role='admin' WHERE user_id='$user_id_admin'";
            $result = mysqli_query($connection, $query);
            comfirmQuery($result);
            header('location:users.php');
        }
        if (isset($_GET['change_to_sub'])) {
            $user_id_sub = $_GET['change_to_sub'];
            $query = "UPDATE users SET user_role='subscriber' WHERE user_id='$user_id_sub'";
            $result = mysqli_query($connection, $query);
            comfirmQuery($result);
            header('location:users.php');
        }
        ?>

    </tbody>
</table>

<?php
// if (isset($_GET['unapprove'])) {
//     $the_comment_id = $_GET['unapprove'];
//     $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id='$the_comment_id'";
//     $result = mysqli_query($connection, $query);
//     comfirmQuery($result);
//     header('location:comments.php');
// }
// if (isset($_GET['approve'])) {
//     $the_comment_id = $_GET['approve'];
//     $query = "UPDATE comments SET comment_status='approved' WHERE comment_id='$the_comment_id'";
//     $result = mysqli_query($connection, $query);
//     comfirmQuery($result);
//     header('location:comments.php');
// }



?>