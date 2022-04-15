<?php include 'header.php'; ?>

<body>
    <?php
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        echo "<script>window.location.href='login.php'</script>";
    }
    // include 'partials/dbconnect.php';
    ?>


    <?php
    $showAlert = false;
    $showError = false;
    $id = $_GET['edit_ans'];
    $sql = "SELECT * FROM `answers` WHERE 'ans_id' = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['ans_id'];
    }
    if ($result) {
        $query = "SELECT * FROM `answers` WHERE `ans_id` = '$id'";
        $query_result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($query_result)) {
            $username = $row['username'];
        }
        if ($_SESSION['name'] === $username) {
            $method = $_SERVER["REQUEST_METHOD"];
            if ($method == "POST") {
                $username = $_SESSION['name'];
                $updated_ans = $_POST['edit_answer'];
                $sql = "UPDATE `answers` SET `ans`='$updated_ans' WHERE `ans_id`='$id'";
                $result = mysqli_query($conn, $sql);
                $showAlert = true;
            }
        } else {
            $showError = true;
            echo "<script>window.location.href='index.php'</script>";
        }
    }

    ?>

    <div class="wrapper1">
        <div class="container border border-dark form my-4" style="border: 2px solid lightgray !important;">


            <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your question was updated successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>


            <?php
            $sql = "SELECT * FROM `answers` WHERE `ans_id` = $id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $ans_title = $row['ans'];
                // echo $que_title;
                echo '<div class="mb-3 my-3 content ">
                            <h4>Question:</h4>
                            <h3 class="inner_question" name="inner_question">' . $ans_title . '</h3>';
            }
            ?>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                <div class="mb-3 my-3 content ">
                    <label for="username" class="form-label">Username:</label>
                    <i class="fas fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                    <input type="text" class="form-control col-lg-11 col-md-11 col-sm-11" id="username" name="username"
                        aria-describedby="emailHelp" disabled="disabled" value="<?php echo $_SESSION['name']; ?>">
                </div>
                <div class="mb-3 my-3 content ">
                    <label for="q_answer" class="form-label">Edit here:</label>
                    <i class="fas fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                    <?php
                    $id = $_GET['edit_ans'];
                    $sql = "SELECT * FROM `answers` WHERE `ans_id` = $id";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $answer = $row['ans'];
                        echo '<textarea type="text" class="form-control col-lg-11 col-md-11 col-sm-11" id="edit_question" name="edit_answer"
                        aria-describedby="">' . $answer . '</textarea>';
                    }
                    ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="box">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <?php 
 include "footer.php";
?>

</body>