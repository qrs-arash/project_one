<?php

if (isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id='$post_id'";
    $result = mysqli_query($connection, $query);
    foreach ($result as $key) {
        $post_id = $key['post_id'];
        $post_author = $key['post_author'];
        $post_user = $key['post_user'];
        $post_title = $key['post_title'];
        $post_category_id = $key['post_category_id'];
        $post_status = $key['post_status'];
        $post_image = $key['post_image'];
        $post_tags = $key['post_tags'];
        $post_comment_count = $key['post_comment_count'];
        $post_date = $key['post_date'];
        $post_content = $key['post_content'];
    }
    if (isset($_POST['update_post'])) {
        $post_title = $_POST['post_title'];
       
        $post_user = $_POST['post_user'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        move_uploaded_file($post_image_temp, "../images/$post_image");
        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id='$post_id'";
            $result = mysqli_query($connection, $query);
            comfirmQuery($result);
            foreach ($result as $key) {
                $post_image = $key['post_image'];
            }
        }



        $query = "UPDATE posts SET ";
        $query .= "post_title='$post_title',";
        $query .= "post_category_id='$post_category_id',";
        $query .= "post_date=now(),";
        $query .= "post_user='$post_user',";
        $query .= "post_status='$post_status',";
        $query .= "post_tags='$post_tags',";
        $query .= "post_content='$post_content',";
        $query .= "post_image='$post_image'";
        $query .= "WHERE post_id=$post_id";

        $result = mysqli_query($connection, $query);
        comfirmQuery($result);

        echo "<p>Post Update. <a href='../post.php?p_id=$post_id'>View Post</a> or <a href='posts.php'>Edit More</a></p>";
    }
}


?>



<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title;  ?>" type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category" id="post_category">
            <br>
            <?php
            $query = "SELECT * FROM category";
            $result = mysqli_query($connection, $query);
            comfirmQuery($result);
            foreach ($result as $key) {
                $cat_id = $key['cat_id'];
                $cat_title = $key['cat_title'];
                echo "<option value='$cat_id'>$cat_title</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">

        <label for="post_user">Users</label>
        <select name="post_user" id="post_user">
            <br>
            <?php
            $query = "SELECT * FROM users";
            $result = mysqli_query($connection, $query);
            comfirmQuery($result);
            foreach ($result as $key) {
                $user_id = $key['user_id'];
                $username = $key['username'];
                echo "<option value='$username'>$username</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
    <label for="post_status">Status</label>
        <select name="post_status" id="">

            <option value='<?php echo $post_status; ?>'><?php echo $post_status ?></option>
            <?php
            if ($post_status == 'draft') {
                echo " <option value='published'>published</option>";
            } else {
                echo "  <option value='draft'>draft</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img width="100" src="../images/<?php echo $post_image ?>" alt="">
        <input value="<?php echo $post_image; ?>" placeholder="$post_image" type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags;  ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10" id="body" style="resize: unset"><?php echo $post_content ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update Post" name="update_post">
    </div>
</form>