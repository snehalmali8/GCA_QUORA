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
                $query = "UPDATE `answers` SET `ans_status` = '$bulk_options' WHERE `ans_id` = '$postValueId'";
                $select_disapprove_post = mysqli_query($conn, $query);
                break;

                // query for draft post
            case 'approved';
                $query = "UPDATE `answers` SET `ans_status` = '$bulk_options' WHERE `ans_id` = '$postValueId'";
                $select_approve_post = mysqli_query($conn, $query);
                break;

                // query for delete the post
            case 'delete';
                $query = " DELETE FROM `answers` WHERE `ans_id` = '$postValueId'";
                $select_delete_post = mysqli_query($conn, $query);
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
                                    <th>Answer Id</th>
                                    <th>Answered By</th>
                                    <th>Answer</th>
                                    <th>In Response To</th>
                                    <th>Answer Status</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Disapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thread>
                            <tbody>

                                <?php
                                $query = "SELECT * FROM answers";
                                $select_que = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($select_que)) {
                                    $ans_id = $row['ans_id'];
                                    $ans = $row['ans'];
                                    $username = $row['username'];
                                    $que_id = $row['que_id'];
                                    $ans_status = $row['ans_status'];
                                    $date = $row['date'];

                                    $query = "SELECT * FROM `questions` WHERE `que_id` = '$que_id'";
                                    $select_ans_id_query = mysqli_query($conn, $query);

                                    while ($row = mysqli_fetch_assoc($select_ans_id_query)) {
                                        $que_id = $row["que_id"];
                                        $que_title = $row["que_title"];
                                    

                                    echo "<tr>";
                                ?>
                                <td><input type="checkbox" class="checkBox" name="checkBoxArray[]"
                                        value="<?php echo $ans_id; ?>"></td>
                                <?php
                                    echo "<td>{$ans_id}</td>";
                                    echo "<td>{$username}</td>";
                                    echo "<td>{$ans}</td>";
                                    echo "<td><a href='../final_Ans.php?queid={$que_id}'>{$que_title}</a></td>";
                                    echo "<td>{$ans_status}</td>";
                                    echo "<td>{$date}</td>";
                                    // echo "<td></td>";                                       
                                    echo "<td><a href='view_answers.php?change_to_approve={$ans_id}'>Approve</a></td>";
                                    echo "<td><a href='view_answers.php?change_to_disapprove={$ans_id}'>Disapprove</a></td>";
                                    echo "<td><a href='view_answers.php?delete={$ans_id}'>Delete</a></td>";
                                    echo "</tr>";
                                }
                            }
                                ?>

                            </tbody>
                        </table>
                    </form>

                    <?php
                    if (isset($_GET['change_to_approve'])) {
                        $the_ans_id = $_GET['change_to_approve'];
                        $query = "UPDATE answers SET ans_status = 'approved' where ans_id = {$the_ans_id}";
                        $ans_query = mysqli_query($conn, $query);
                        //    echo "<script>window.location.href='view_all_posts.php'</script>";
                        echo "<script>window.location.href='view_answers.php'</script>";
                    }
                    ?>

                    <?php
                    if (isset($_GET['change_to_disapprove'])) {
                        $the_ans_id = $_GET['change_to_disapprove'];
                        $query = "UPDATE answers SET ans_status = 'disapproved' where ans_id = {$the_ans_id}";
                        $ans_query = mysqli_query($conn, $query);
                        //    echo "<script>window.location.href='view_all_posts.php'</script>";
                        echo "<script>window.location.href='view_answers.php'</script>";
                    }
                    ?>

                    <?php
                    if (isset($_GET['delete'])) {
                        $the_ans_id = $_GET['delete'];
                        $query = "DELETE FROM answers where ans_id = {$the_ans_id}";
                        $delete_ans_query = mysqli_query($conn, $query);
                        //    echo "<script>window.location.href='view_all_posts.php'</script>";
                        echo "<script>window.location.href='view_answers.php'</script>";
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
