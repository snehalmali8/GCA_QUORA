<?php include 'header.php'; ?>

<body>


    <?php
    // include 'partials/dbconnect.php';
    $showAlert = false;
    $showError = false;
    $id = $_GET['delete_ans'];
    $query = "SELECT * FROM `answers` WHERE `ans_id` = '$id'";
    $query_result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($query_result)) {
        $username = $row['username'];
    }
    if ($_SESSION['name'] === $username) {
        $sql = "DELETE FROM `answers` WHERE `ans_id` = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
            // include "/GCA_QUORA/que_list.php";
            // header("location: que_list.php");

        } else {
            $showError = true;
        }
    } else {
        $showError = true;
    }


    ?>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Answer has been deleted successfully.Go <a href="/index.php">Back</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>
    <?php
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Failed to delete Answer.Go <a href="index.php">Back</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>

</body>

</html>