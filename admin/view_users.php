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
                $query = "UPDATE `signup` SET `user_status` = '$bulk_options' WHERE `srno` = '$postValueId'";
                $select_disapprove_user = mysqli_query($conn, $query);
                break;

                // query for draft post
            case 'approved';
                $query = "UPDATE `signup` SET `user_status` = '$bulk_options' WHERE `srno` = '$postValueId'";
                $select_approve_user = mysqli_query($conn, $query);
                break;

                // query for delete the post
            case 'delete';
                $query = " DELETE FROM `signup` WHERE `srno` = '$postValueId'";
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
                                <a href="../dummy.php" class="btn btn-primary">Add New</a>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thread>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes"></th>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roll No.</th>
                                    <th>Branch</th>
                                    <th>User Status</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Disapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thread>
                            <tbody>

                                <?php
                                $query = "SELECT * FROM signup";
                                $select_que = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($select_que)) {
                                    $user_sr_no = $row['srno'];
                                    $user_name = $row['name'];
                                    $user_email = $row['email'];
                                    $user_roll = $row['roll'];
                                    $user_branch = $row['branch'];
                                    $user_date = $row['date'];
                                    $user_status = $row['user_status'];
                                    echo "<tr>";
                                ?>
                                <td><input type="checkbox" class="checkBox" name="checkBoxArray[]"
                                        value="<?php echo $user_sr_no; ?>"></td>

                                <?php
                                    echo "<td>{$user_sr_no}</td>";
                                    echo "<td>{$user_name}</td>";
                                    echo "<td>{$user_email}</td>";
                                    echo "<td>{$user_roll}</td>";
                                    echo "<td>{$user_branch}</td>";
                                    echo "<td>{$user_status}</td>";
                                    echo "<td>{$user_date}</td>";

                                    // echo "<td></td>";                                       
                                    echo "<td><a href='view_users.php?change_to_approve={$user_sr_no}'>Approve</a></td>";
                                    echo "<td><a href='view_users.php?change_to_disapprove={$user_sr_no}'>Disapprove</a></td>";
                                    echo "<td><a href='view_users.php?delete={$user_sr_no}'>Delete</a></td>";
                                    echo "</tr>";
                                }

                                ?>

                            </tbody>
                        </table>
                    </form>

                    <?php
                    if (isset($_GET['change_to_approve'])) {
                        $the_user_id = $_GET['change_to_approve'];
                        $query = "UPDATE signup SET user_status = 'approved' where srno = {$the_user_id}";
                        $user_query = mysqli_query($conn, $query);
                        //    echo "<script>window.location.href='view_all_posts.php'</script>";
                        echo "<script>window.location.href='view_users.php'</script>";
                    }
                    ?>

                    <?php
                    if (isset($_GET['change_to_disapprove'])) {
                        $the_que_id = $_GET['change_to_disapprove'];
                        $query = "UPDATE signup SET user_status = 'disapproved' where srno = {$the_que_id}";
                        $que_query = mysqli_query($conn, $query);
                        //    echo "<script>window.location.href='view_all_posts.php'</script>";
                        echo "<script>window.location.href='view_users.php'</script>";
                    }
                    ?>



                    <?php
                    if (isset($_GET['delete'])) {
                        $the_que_id = $_GET['delete'];
                        $query = "DELETE FROM signup where srno = {$the_que_id}";
                        $delete_user_query = mysqli_query($conn, $query);
                        echo "<script>window.location.href='view_users.php'</script>";
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
