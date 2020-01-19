<?php ob_start();     ?>
<?php include "../include/db.php"; ?>

<?php include "include/admin_header.php"; ?>

<div id="wrapper">

    <?php

    ?>



    <!-- Navigation -->
    <?php include "include/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo $_SESSION['username'];  ?></small>
                    </h1>

                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM posts";
                                    $result = mysqli_query($connection, $query);
                                    if (!$result) {
                                        die("Query feiled" . mysqli_error($connection));
                                    }
                                    $counter_post = 0;
                                    foreach ($result as $key) {
                                        $counter_post++;
                                    }
                                    ?>


                                    <div class='huge'><?php echo $counter_post  ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments";
                                    $result = mysqli_query($connection, $query);
                                    if (!$result) {
                                        die("Query feiled" . mysqli_error($connection));
                                    }
                                    $counter_comment = 0;
                                    foreach ($result as $key) {
                                        $counter_comment++;
                                    }
                                    ?>
                                    <div class='huge'><?php echo $counter_comment  ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $result = mysqli_query($connection, $query);
                                    if (!$result) {
                                        die("Query feiled" . mysqli_error($connection));
                                    }
                                    $counter_user = 0;
                                    foreach ($result as $key) {
                                        $counter_user++;
                                    }
                                    ?>
                                    <div class='huge'><?php echo $counter_user  ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM category";
                                    $result = mysqli_query($connection, $query);
                                    if (!$result) {
                                        die("Query feiled" . mysqli_error($connection));
                                    }
                                    $counter_category = 0;
                                    foreach ($result as $key) {
                                        $counter_category++;
                                    }
                                    ?>

                                    <div class='huge'><?php echo $counter_category  ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php
            $query = "SELECT * FROM posts WHERE post_status='published'";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("Query failed" . mysqli_error($connection));
            }
            $counter_published = mysqli_num_rows($result);




            $query = "SELECT * FROM posts WHERE post_status='draft'";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("Query failed" . mysqli_error($connection));
            }
            $counter_draft = mysqli_num_rows($result);

            $query = "SELECT * FROM comments WHERE comment_status='unapproved'";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("Query failed" . mysqli_error($connection));
            }
            $counter_unapproved = mysqli_num_rows($result);

            $query = "SELECT * FROM users WHERE user_role='subscriber'";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("Query feiled" . mysqli_error($connection));
            }
            $counter_subscriber = mysqli_num_rows($result);
            ?>
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Date', 'Count'],
                            <?php
                            $elements_text = ['All Posts', 'Active Posts', 'Draft Post', 'Categories', 'Users', 'Subscriber', 'Comments', 'Comments_unapproved'];
                            $elements_count = [$counter_post, $counter_published, $counter_draft, $counter_category, $counter_user, $counter_subscriber, $counter_comment, $counter_unapproved];
                            for ($i = 0; $i < 8; $i++) {

                                echo "['{$elements_text[$i]}'" . "," . "{$elements_count[$i]}],";
                            ?>

                            <?php } ?>
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>




        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php"  ?>