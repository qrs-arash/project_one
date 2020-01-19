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

            <?php
            $per_page = 3;
            if (isset($_GET['page'])) {


                $page = $_GET['page'];
            } else {
                $page = "";
            }
            if ($page == "" || $page == 1) {

                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }



            $post_query_count = "SELECT * FROM posts";
            $result_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($result_count);
            $count = ceil($count / $per_page);





            $query = "SELECT * FROM posts ORDER BY post_id ASC LIMIT  $page_1,$per_page ";
            $queryres = mysqli_query($connection, $query);
            foreach ($queryres as $key) {
                $post_id = $key['post_id'];
                $post_title = $key['post_title'];
                $post_author = $key['post_author'];
                if(empty($key['post_author'])){
                    $post_author = $key['post_user'];
                }
                $post_date = $key['post_date'];
                $post_image = $key['post_image'];
                $post_content = substr($key['post_content'], 0, 100);
                $post_status = $key['post_status'];
                if ($post_status !== 'published') {
                } else {

            ?>



                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title  ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php $postdate = date_create($post_date);
                                                                                echo date_format($postdate, "F j, Y, g:i a") ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id ?>">
                        <img class="img-responsive" src="<?php echo 'images/' . $post_image  ?>" alt="">

                    </a>
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                    <!-- Pager -->
                    <ul class="pager">
                        <li class="previous">
                            <a href="#">&larr; Older</a>
                        </li>
                        <li class="next">
                            <a href="#">Newer &rarr;</a>
                        </li>
                    </ul>
            <?php
                }
            }


            ?>









        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "include/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>
    <ul class="pager">

        <?php
        for ($i = 1; $i <= $count; $i++) {
            if ($i == $page) {
                echo "
                <li>
                <a class='active_link' href='index.php?page={$i}'>$i</a>
                </li>";
            } else {
                echo "
                <li>
                <a href='index.php?page={$i}'>$i</a>
                </li>";
            }
        }


        ?>


    </ul>
    <!-- Footer -->

    <?php include "include/footer.php"; ?>