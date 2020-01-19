<?php include "include/db.php"; ?>
<?php include "include/header.php";
// Navigation //
include "include/navigation.php";

?>




<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>
            <?php
            if (isset($_GET['author'])) {
                $post_id_num = $_GET['p_id'];
                $post_author_name = $_GET['author'];
            }
            $query = "SELECT * FROM posts WHERE post_author='{$post_author_name}' OR post_user='{$post_author_name}'";
            $queryres = mysqli_query($connection, $query);
            if (!$queryres) {
                die("Query Failed" . mysqli_error($connection));
            }
            foreach ($queryres as $key) {
                $post_id = $key['post_id'];
                $post_title = $key['post_title'];
                $post_author = $key['post_author'];
                if (empty($key['post_author'])) {
                    $post_author = $key['post_user'];
                }
                $post_date = $key['post_date'];
                $post_image = $key['post_image'];
                $post_content = $key['post_content'];
            ?>
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title  ?></a>
                </h2>
                <p class="lead">
                    All Post By <?php echo $post_author  ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php $postdate = date_create($post_date);
                                                                            echo date_format($postdate, "F j, Y, g:i a") ?></p>
                <hr>

                <img class="img-responsive" src="<?php echo 'images/' . $post_image  ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>


                <hr>
            <?php } ?>

            <!-- Blog Comments -->
            <?php
            if (isset($_POST['creat_comment'])) {
                $post_id_num = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                    $query = "INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) VALUES
                    ($post_id_num,'$comment_author','$comment_email','$comment_content','unapproved',now())";
                    $result = mysqli_query($connection, $query);
                    if (!$result) {
                        die('QUERY FAILED' . mysqli_error($connection));
                    }
                    $query = "UPDATE posts SET post_comment_count=post_comment_count + 1 
                    WHERE post_id=$post_id_num";
                    $result = mysqli_query($connection, $query);
                } else {
                    echo "<script>
                    alert('Fields cannot be empty');
                    </script>";
                }
            }
            ?>




            <!-- Comments Form -->


            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id=$post_id_num AND comment_status='approved' ";
            $query .= "ORDER BY comment_id DESC";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die('query failed' . mysqli_error($connection));
            }

            foreach ($result as $key) {
                $comment_date = $key['comment_date'];
                $comment_content = $key['comment_content'];
                $comment_author = $key['comment_author'];



            ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

            <?php  } ?>












            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "include/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->

    <?php include "include/footer.php"; ?>