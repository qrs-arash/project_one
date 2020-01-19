<?php include "include/db.php"; ?>
<?php include "include/header.php";
// Navigation //
include "include/navigation.php";

?>
<?php
if (isset($_POST['searchinput'])) {
    $search = $_POST['searchinput'];
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("result of search none");
    } else {
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
                    $query = "SELECT * FROM posts";
                    $queryres = mysqli_query($connection, $query);
                    foreach ($result as $key) {
                        $post_title = $key['post_title'];
                        $post_author = $key['post_author'];
                        $post_date = $key['post_date'];
                        $post_image = $key['post_image'];
                        $post_content = $key['post_content'];
                    ?>
                        <h2>
                            <a href="#"><?php echo $post_title  ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php $postdate = date_create($post_date);
                                                                                    echo date_format($postdate, "F j, Y, g:i a") ?></p>
                        <hr>

                        <img class="img-responsive" src="<?php echo 'images/'. $post_image  ?>" alt="">
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

    <?php
    }
}


    ?>