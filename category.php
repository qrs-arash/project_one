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
            if(isset($_GET['category'])){
                $cat_id_list=$_GET['category'];
            }
            $query = "SELECT * FROM posts WHERE post_category_id=$cat_id_list";
            $queryres = mysqli_query($connection, $query);
            foreach ($queryres as $key) {
                $post_id = $key['post_id'];
                $post_title = $key['post_title'];
                $post_author = $key['post_author'];
                $post_date = $key['post_date'];
                $post_image = $key['post_image'];
                $post_content = substr($key['post_content'],0,100);
            ?>
                <h2>
                <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title  ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php $postdate = date_create($post_date);
                                                                            echo date_format($postdate, "F j, Y, g:i a") ?></p>
                <hr>

                <img class="img-responsive" src="<?php echo 'images/'.$post_image  ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php

            }


            ?>




          

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