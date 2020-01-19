<div class="col-md-4">



    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input name="searchinput" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="searchbtn" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>

        <!-- /.input-group -->
    </div>


    <!-- Login Well -->
    <div class="well">
        <h4>Login</h4>
        <form action="include/login.php" method="POST">
            <div class="form-group">
                <input placeholder="Enter Username" name="username" type="text" class="form-control">
            </div>
            <div class="form-group">
                <input placeholder="Enter Password" name="password" type="password" class="form-control">
            </div>
            <div class="form-group">
                <input value="Login" name="login" type="submit" class="btn btn-primary">
            </div>
        </form>

        <!-- /.input-group -->
    </div>


    <!-- Blog Categories Well -->


    <div class="well">

        <?php
        $query = "SELECT * FROM category";
        $resultcat = mysqli_query($connection, $query);


        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    foreach ($resultcat as $key) {
                        $cat_id = $key['cat_id'];
                    ?>
                        <li><a href="category.php?category=<?php echo $cat_id ?>"><?php echo $key['cat_title'] ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>



    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>