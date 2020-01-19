<?php
if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $arr) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status='published' WHERE post_id=$arr";
                $update_to_published = mysqli_query($connection, $query);
                comfirmQuery($update_to_published);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status='draft' WHERE post_id=$arr";
                $update_to_draft = mysqli_query($connection, $query);
                comfirmQuery($update_to_draft);
                break;
            case 'deleteselect':
                $query_delete_post = "DELETE FROM posts WHERE post_id=$arr;";
                $delete_post = mysqli_query($connection, $query_delete_post);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id=$arr";
                $clone_post = mysqli_query($connection, $query);
                if (!$clone_post) {
                    die("Query Feild" . mysqli_error($connection));
                }
                foreach ($clone_post as $cln) {
                    $post_title = $cln['post_title'];
                    $post_category_id = $cln['post_category_id'];
                    $post_date = $cln['post_date'];
                    $post_author = $cln['post_author'];
                    $post_status = $cln['post_status'];
                    $post_image = $cln['post_image'];
                    $post_tags = $cln['post_tags'];
                    $post_content = $cln['post_content'];
                }
                $query = "INSERT INTO posts(post_category_id,post_title,post_author
                ,post_date,post_image,post_content,post_tags,post_status)
                VALUES('$post_category_id','$post_title','$post_author',now()
                ,'$post_image','$post_content','$post_tags','$post_status') ";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die("Querry Failed" . mysqli_error($connection));
                }
                break;
        }
    }
}




?>






<form action="" method="POST">






    <table class="table table-bordered table-hover">

        <div class="bulkOptionsContainer col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="deleteselect">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-primary" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>



        <thead>
            <tr>
                <th>
                    <input id="selectAllBoxes" type="checkbox">
                </th>
                <th>
                    Id
                </th>
                <th>
                    Author
                </th>
                <th>
                    Title
                </th>
                <th>
                    Category
                </th>
                <th>
                    Status
                </th>
                <th>
                    Image
                </th>
                <th>
                    Tags
                </th>
                <th>
                    Comments
                </th>
                <th>
                    Date
                </th>
                <th>
                    View Post
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
                <th>
                    views
                </th>
            </tr>
        </thead>
        <tbody>
            <?php

            $query = "SELECT * FROM posts  ORDER BY post_id DESC ";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("Query Faild" . mysqli_error($connection));
            }
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
                $post_view_count = $key['post_view_count'];
                echo "<tr>";
            ?>
                <td><input class='checkBoxes' value='<?php echo $post_id ?>' type='checkbox' name='checkBoxArray[]'></td>
            <?php
                echo "<td>$post_id</td>";
                if (!isset($post_author) || !empty($post_author)) {
                    echo "<td>$post_author</td>";
                }elseif(!isset($post_user) || !empty($post_user)){
                    echo "<td><a href='../author_post.php?author=$post_user'>$post_user</a></td>";
                }






                echo "<td>$post_title</td>";

                $query = "SELECT * FROM category WHERE cat_id='$post_category_id'";
                $catresult = mysqli_query($connection, $query);
                foreach ($catresult as $row) {
                    $cat_title = $row['cat_title'];
                    echo "<td>$cat_title</td>";
                }





                echo " <td>$post_status</td>";
                echo "<td><img class='img-responsive' src='../images/$post_image' alt='image'></td>";
                echo "<td>$post_tags</td>";
                $query_count = "SELECT * FROM comments WHERE comment_post_id=$post_id";
                $result_count = mysqli_query($connection, $query_count);
                $count_fetch = mysqli_fetch_array($result_count);

                $count_comment = mysqli_num_rows($result_count);


                echo "<td><a href='post_comments.php?id=$post_id'>$count_comment</a></td>";



                echo "<td>$post_date</td>";
                echo "<td>
                        <a href='../post.php?p_id=$post_id'>View Post</a>
                      </td>";
                echo "<td>
                        <a href='?source=edit_post&p_id=$post_id'>Edit</a>
                      </td>";
                echo " <td>
                        <a onClick=\" javascript: return confirm('are you sure you want to delete?') \" href='?delete=$post_id'>Delete</a>
                       </td>";
                echo "<td><a href='?reset=$post_id'>$post_view_count</a></td>";
                echo "</tr>";
            }

            ?>

        </tbody>
    </table>
</form>
<?php
if (isset($_GET['reset'])) {
    $post_id_reset =escape($_GET['reset']);
    $query = "UPDATE posts SET post_view_count=0 WHERE post_id=" . mysqli_real_escape_string($connection, $post_id_reset) . " ";
    $result = mysqli_query($connection, $query);
    comfirmQuery($result);
    header('location:posts.php');
}
if (isset($_GET['delete'])) {
    $post_id_delete = escape($_GET['delete']);
    $query = "DELETE FROM posts WHERE post_id=$post_id_delete";
    $result = mysqli_query($connection, $query);
    comfirmQuery($result);
    header('location:posts.php');
}


?>