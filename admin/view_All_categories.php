<?php
include "includes/admin_header.php";
?>
<?php
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {

                // query for delete the post
            case 'delete';
                $query = " DELETE FROM `categories` WHERE `category_id` = '$postValueId'";
                $select_delete_cat = mysqli_query($conn, $query);
                break;
        }
    }
}

?>
<div id="wrapper">
        <?php
        include "includes/admin_navigation.php";
        ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome,
                            <b class="text-primary"><?php echo $_SESSION['name']; ?></b>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="">

                    <form action="" method="post">

                        <div class="row container">
                            <div class="form-group col-xs-4" id="bulkOptionContainer">
                                <select id="" class="form-control" name="bulk_options">
                                    <option value="">Select Options</option>
                                    <!-- <option value="publish">Publish</option>
                                    <option value="draft">Draft</option> -->
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                                <!-- <a href="add_posts.php" class="btn btn-primary">Add New</a> -->
                            </div>
                        </div>
                        <table class="table table-bordered table-hover" style="width:60%">
                            <thread>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes"></th>
                                    <th>cat_id</th>
                                    <th>cat_title</th>
                                    <th>Delete Category</th>
                                </tr>
                            </thread>
                            <tbody>

                                <?php
                                $query = "SELECT * FROM categories";
                                $select_que = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($select_que)) {
                                    $cat_id = $row['category_id'];
                                    $cat_title = $row['category_name'];

                                    echo "<tr>";
                                ?>
                                <td><input type="checkbox" class="checkBox" name="checkBoxArray[]"
                                        value="<?php echo $cat_id; ?>"></td>
                                <?php
                                    echo "<td>{$cat_id}</td>";
                                    echo "<td>{$cat_title}</td>";

                                    // echo "<td><a href='view_questions.php?change_to_approve={$cat_id}'>Approve</a></td>";
                                    // echo "<td><a href='view_questions.php?change_to_disapprove={$cat_id}'>Disapprove</a></td>";
                                    echo "<td><a href='view_All_categories.php?delete={$cat_id}'>Delete</a></td>";
                                    echo "</tr>";
                                }

                                ?>

                            </tbody>
                        </table>
                    </form>

                    <?php
                    if (isset($_GET['change_to_approve'])) {
                        $the_que_id = $_GET['change_to_approve'];
                        $query = "UPDATE questions SET que_status = 'approved' where que_id = {$the_que_id}";
                        $que_query = mysqli_query($conn, $query);
                        //    echo "<script>window.location.href='view_all_posts.php'</script>";
                        echo "<script>window.location.href='view_questions.php'</script>";
                    }
                    ?>

                    <?php
                    if (isset($_GET['change_to_disapprove'])) {
                        $the_que_id = $_GET['change_to_disapprove'];
                        $query = "UPDATE questions SET que_status = 'disapproved' where que_id = {$the_que_id}";
                        $que_query = mysqli_query($conn, $query);
                        //    echo "<script>window.location.href='view_all_posts.php'</script>";
                        echo "<script>window.location.href='view_questions.php'</script>";
                    }
                    ?>



                    <?php
                    if (isset($_GET['delete'])) {
                        $the_cat_id = $_GET['delete'];
                        $query = "DELETE FROM categories where category_id = {$the_cat_id}";
                        $delete_category_query = mysqli_query($conn, $query);
                        //    echo "<script>window.location.href='view_all_posts.php'</script>";
                        echo "<script>window.location.href='view_All_categories.php'</script>";
                    }
                    ?>


                </div>
                <!-- /.row -->
                <a class="btn btn-primary" href="view_All_categories.php?source=add_category">Add New Category</a>

                <div class="add_category" style="width:60%; padding:1%; margin-top:2%;">



                    <?php

                    if (isset($_GET['source'])) {
                        include "add_category.php";
                    }
                    ?>
                </div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
<?php
include "includes/admin_footer.php";
?>
