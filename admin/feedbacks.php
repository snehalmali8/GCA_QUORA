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
                $query = " DELETE FROM `contact` WHERE `contact_id` = '$postValueId'";
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
                                    <th>Contact ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Contact No</th>
                                    <th>Delete</th>

                                </tr>
                            </thread>
                            <tbody>

                                <?php
                                $query = "SELECT * FROM contact";
                                $select_que = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($select_que)) {
                                    $contact_id = $row['contact_id'];
                                    $contact_name = $row['name'];
                                    $contact_email = $row['email'];
                                    $contact_mobile = $row['mobile'];
                                    $contact_message = $row['message'];
                                    echo "<tr>";
                                ?>
                                <td><input type="checkbox" class="checkBox" name="checkBoxArray[]"
                                        value="<?php echo $contact_id; ?>"></td>
                                <?php
                                    echo "<td>{$contact_id}</td>";
                                    echo "<td>{$contact_name}</td>";
                                    echo "<td>{$contact_email}</td>";
                                    echo "<td>{$contact_message}</td>";
                                    echo "<td>{$contact_mobile}</td>";

                                    // echo "<td><a href='view_questions.php?change_to_approve={$cat_id}'>Approve</a></td>";
                                    // echo "<td><a href='view_questions.php?change_to_disapprove={$cat_id}'>Disapprove</a></td>";
                                    echo "<td><a href='feedbacks.php?delete={$contact_id}'>Delete</a></td>";
                                    echo "</tr>";
                                }

                                ?>

                            </tbody>
                        </table>
                    </form>

                    <?php
                    if (isset($_GET['delete'])) {
                        $the_contact_id = $_GET['delete'];
                        $query = "DELETE FROM contact where contact_id = {$the_contact_id}";
                        $delete_category_query = mysqli_query($conn, $query);
                        //    echo "<script>window.location.href='view_all_posts.php'</script>";
                        echo "<script>window.location.href='feedbacks.php'</script>";
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
