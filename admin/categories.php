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
                    <div class="col-xs-6">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cattitle">Add Category</label>
                                <?php
                                insert_category();
                                ?>
                                <input type="text" class="form-control" name="cattitle">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                            </div>
                        </form>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cattitleedit">Update Category</label>
                                <?php
                                edit_category();
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="update" value="Update Category" class="btn btn-primary">
                            </div>


                        </form>
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>Id</th>
                                    <th>Category Title</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                show_category();

                                ?>

                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php"  ?>