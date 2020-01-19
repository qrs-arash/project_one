<?php ob_start();     ?>
<?php include "../include/db.php"; ?>

<?php include "include/admin_header.php"; ?>
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


                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Author
                                </th>
                                <th>
                                    Comment
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    In Response to
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Approve
                                </th>
                                <th>
                                    unapprove
                                </th>
                                <th>
                                    Delete
                                </th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM comments WHERE comment_post_id=" . mysqli_real_escape_string($connection, $_GET['id']) . " ";
                            $result = mysqli_query($connection, $query);
                            if (!$result) {
                                die("Query Failed" . mysqli_error($connection));
                            }
                            foreach ($result as $key) {

                                $comment_id = $key['comment_id'];
                                $comment_post_id = $key['comment_post_id'];
                                $comment_author = $key['comment_author'];
                                $comment_email = $key['comment_email'];
                                $comment_content = $key['comment_content'];
                                $comment_status = $key['comment_status'];
                                $comment_date = $key['comment_date'];


                                echo "<tr>";
                                echo "<td>$comment_id</td>";
                                echo "<td>$comment_author</td>";
                                echo "<td>$comment_content</td>";

                                // $query = "SELECT * FROM category WHERE cat_id='$comment_post_id'";
                                // $catresult = mysqli_query($connection, $query);
                                // foreach ($catresult as $row) {
                                //     $cat_title=$row['cat_title'];
                                //     echo "<td>$cat_title</td>";
                                // }





                                echo " <td>$comment_email</td>";
                                echo "<td>$comment_status</td>";

                                $query_post_id = "SELECT * FROM posts WHERE post_id=$comment_post_id";
                                $result_post_id = mysqli_query($connection, $query_post_id);
                                foreach ($result_post_id as $key) {
                                    $post_id = $key['post_id'];
                                    $post_title = $key['post_title'];
                                    echo "<td><a href='../post.php?p_id=$post_id' >$post_title</a></td>";
                                }





                                echo "<td>$comment_date</td>";


                                echo "<th>
                      <a href='comments.php?approve=$comment_id'>Approve</a>
                  </th>";


                                echo " <th>
                       <a href='comments.php?unapprove=$comment_id'>Unapprove</a>
                   </th>";


                                echo " <th>
                       <a href='post_comments.php?delete=$comment_id & id=$comment_post_id'>Delete</a>
                   </th>";
                                if (isset($_GET['delete'])) {
                                    $comment_id_delete = $_GET['delete'];
                                    $query_delete = "DELETE FROM comments WHERE comment_id=$comment_id_delete";
                                    $result = mysqli_query($connection, $query_delete);
                                    header("location:comments.php");
                                }



                                echo "</tr>";
                            }

                            ?>

                        </tbody>
                    </table>

                    <?php
                    if (isset($_GET['unapprove'])) {
                        $the_comment_id = $_GET['unapprove'];
                        $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id='$the_comment_id'";
                        $result = mysqli_query($connection, $query);
                        comfirmQuery($result);
                        header('location:comments.php');
                    }
                    if (isset($_GET['approve'])) {
                        $the_comment_id = $_GET['approve'];
                        $query = "UPDATE comments SET comment_status='approved' WHERE comment_id='$the_comment_id'";
                        $result = mysqli_query($connection, $query);
                        comfirmQuery($result);
                        header('location:comments.php');
                    }
                    if (isset($_GET['delete'])) {
                        $comment_id_delete = $_GET['delete'];
                        $query = "DELETE FROM comments WHERE comment_id=$comment_id_delete";
                        $result = mysqli_query($connection, $query);
                        comfirmQuery($result);

                        if (!empty($comment_post_id)) {
                            header("location:post_comments.php?id={$comment_post_id}");
                        }
                    }


                    ?>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include "include/admin_footer.php" ?>