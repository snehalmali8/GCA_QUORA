<?php include 'header.php'; ?>
    <?php
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        echo "<script>window.location.href='login.php'</script>";
    }
    // include 'partials/dbconnect.php';
    ?>
    <?php
    $showAlert = false;
    $showError = false;
    $id = $_GET['queid'];
    $sql = "SELECT * FROM `questions` WHERE 'que_id' = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['queid'];
    }
    if ($result) {
        $query = "SELECT * FROM `questions` WHERE `que_id` = '$id'";
        $query_result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($query_result)) {
            $username = $row['username'];
        }
        if ($_SESSION['name'] === $username) {
            $method = $_SERVER["REQUEST_METHOD"];
            // echo $method;
            if ($method == "POST") {
                $username = $_SESSION['name'];
                // $email=$_SESSION['email'];
                // $username= mysqli_real_escape_string($conn, $username);
                $updated_que = $_POST['edit_question'];
                // $sql = "INSERT INTO `answers` (`username`, `ans`, `que_id`, `email`, `date`) VALUES ('$username', '$ans', '$id', '$email', current_timestamp());";
                $sql = "UPDATE `questions` SET `que_title`='$updated_que' WHERE `que_id`='$id'";
                $result = mysqli_query($conn, $sql);
                $showAlert = true;
            }
        }
        else{
            $showError = true;
            echo "<script>window.location.href='index.php'</script>";
        }
    }

    ?>
    <title>Add a question</title>

    <div class="wrapper1">
        <div class="container border border-dark form my-4">

            <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your question was updated successfully.<a href="all_questions.php">View All Questions</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>


            <?php
        // $id = $_GET['queid'];
        $sql = "SELECT * FROM `questions` WHERE `que_id` = $id";
        $result = mysqli_query($conn, $sql);
        // echo $id;
        // echo "hii";
        while ($row = mysqli_fetch_assoc($result)) {
            $que_title = $row['que_title'];
            // echo $que_title;
            echo '<div class="mb-3 my-3 content ">
                            <h4>Question:</h4>
                            <h3 class="inner_question" name="inner_question">' . $que_title . '</h3>';
        }
        ?>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                <div class="mb-3 my-3 content ">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control col-lg-12 col-md-12 col-sm-12 col-12" id="username" name="username"
                        aria-describedby="emailHelp" disabled="disabled" value="<?php echo $_SESSION['name']; ?>">
                </div>
                <div class="mb-3 my-3 content ">
                    <label for="q_answer" class="form-label">Edit here:</label>
                    <?php
                $id = $_GET['queid'];
                $sql = "SELECT * FROM `questions` WHERE `que_id` = $id";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $question = $row['que_title'];
                    echo '<textarea type="text" class="form-control col-lg-12 col-md-12 col-sm-12 col-12" id="edit_question" name="edit_question"
                        aria-describedby="">' . $question . '</textarea>';
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
