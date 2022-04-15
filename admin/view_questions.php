<?php
include "includes/admin_header.php";
?>
<?php
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
                // case for publish post
            case 'disapproved';
                $query = "UPDATE `questions` SET `que_status` = '$bulk_options' WHERE `que_id` = '$postValueId'";
                $select_disapprove_que = mysqli_query($conn, $query);
                break;

                // query for draft post
            case 'approved';
                $query = "UPDATE `questions` SET `que_status` = '$bulk_options' WHERE `que_id` = '$postValueId'";
                $select_approve_que = mysqli_query($conn, $query);
                break;

                // query for delete the post
            case 'delete';
                $query = " DELETE FROM `questions` WHERE `que_id` = '$postValueId'";
                $select_delete_que = mysqli_query($conn, $query);
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
                                    <option value="disapproved">Disapproved</option>
                                    <option value="approved">Approved</option>
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                                <!-- <a href="add_posts.php" class="btn btn-primary">Add New</a> -->
                            </div>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thread>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes"></th>
                                    <th>Question Id</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Added By</th>
                                    <th>Question Status</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Disapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thread>
                            <tbody>

                                <?php
                                $query = "SELECT * FROM questions";
                                $select_que = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($select_que)) {
                                    $que_id = $row['que_id'];
                                    $que_title = $row['que_title'];
                                    $que_cat_id = $row['que_cat_id'];
                                    $username = $row['username'];
                                    $que_status = $row['que_status'];
                                    $date = $row['date'];


                                    $query = "SELECT * FROM `categories` WHERE `category_id` = '$que_cat_id'";
                                    $select_que_id_query = mysqli_query($conn, $query);

                                    while ($row = mysqli_fetch_assoc($select_que_id_query)) {
                                        $cat_id = $row["category_id"];
                                        $cat_title = $row["category_name"];
                                    }


                                    echo "<tr>";
                                ?>
                                <td><input type="checkbox" class="checkBox" name="checkBoxArray[]"
                                        value="<?php echo $que_id; ?>"></td>
                                <?php
                                    echo "<td>{$que_id}</td>";
                                    echo "<td><a href='../que_list.php?catid={$cat_id}'>{$cat_title}</a></td>";
                                    echo "<td>{$que_title}</td>";
                                    echo "<td>{$username}</td>";
                                    echo "<td>{$que_status}</td>";
                                    echo "<td>{$date}</td>";
                                    // echo "<td></td>";                                       
                                    echo "<td><a href='view_questions.php?change_to_approve={$que_id}'>Approve</a></td>";
                                    echo "<td><a href='view_questions.php?change_to_disapprove={$que_id}'>Disapprove</a></td>";
                                    echo "<td><a href='view_questions.php?delete={$que_id}'>Delete</a></td>";
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
                        $the_que_id = $_GET['delete'];
                        $query = "DELETE FROM questions where que_id = {$the_que_id}";
                        $delete_user_query = mysqli_query($conn, $query);
                        //    echo "<script>window.location.href='view_all_posts.php'</script>";
                        echo "<script>window.location.href='view_questions.php'</script>";
                    }
                    ?>


                </div>
                <!-- /.row -->

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
