<?php if (isset($_POST['create_post'])) {
    global $connection;

    $post_title = escape($_POST['post_title']);
    // $post_author = $_POST['post_author'];
    $post_user=escape($_POST['post_user']);
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);

    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES['image']['tmp_name']);

    $post_tags = escape($_POST['post_tags']);
  $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
    // $post_comment_count = 4;


    move_uploaded_file($post_image_temp, "../images/$post_image");


    $query = "INSERT INTO posts(post_category_id,post_title,post_user
    ,post_date,post_image,post_content,post_tags,post_status)
    VALUES('$post_category_id','$post_title','$post_user',now()
    ,'$post_image','$post_content','$post_tags','$post_status') ";
    $result = mysqli_query($connection, $query);

    comfirmQuery($result);
    $post_id = mysqli_insert_id($connection);
    echo "<p>Post Created. <a href='../post.php?p_id=$post_id'>View Post</a> or <a href='posts.php'>Edit More</a></p>";
}




?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
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
    <!-- <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div> -->



    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="">
            <option value="draft">select Options</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>




    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10" id="body" style="resize: unset"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Publish Post" name="create_post">
    </div>
</form>