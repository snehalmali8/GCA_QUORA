<?php include 'header.php'; ?>
<?php
    if(isset($_SESSION['loggedin'])){
        $logggedin = $_SESSION['loggedin'];
    }else{
        $loggedin=false;
    }
    if ($loggedin != true) {
        echo "<script>window.location.href='login.php'</script>";
    }
    ?>
    <div class="wrapper1">
        <div class="container border border-dark form my-4 ans-container">

            <?php
            if (isset($_GET['queid'])) {
                $id = $_GET['queid'];
                $sql = "SELECT * FROM `questions` WHERE `que_id` = $id";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $que_title = $row['que_title'];
                    // echo $que_title;
                    echo '<div class="mb-3 my-3 content" style="color:black;">
                            <h4>Question:</h4>
                            <h3 class="inner_question" name="inner_question">' . $que_title . '</h3>';
                }
            }
            ?>

            <?php
            if (isset($_POST['submit'])) {
                $username = $_SESSION['name'];
                $email = $_SESSION['email'];
                $ans = $_POST['ans'];
                $sql = "INSERT INTO `answers` (`username`, `ans`, `que_id`, `email`, `date`) VALUES ('$username', '$ans', '$id', '$email', current_timestamp());";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your answer added successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                }
            }

            ?>
            
            <?php 
            // echo $_SERVER['REQUEST_URI'];
            ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">
                    </label>
                    <input type="text" class="form-control" id="username" name="username" disabled="disabled"
                        value="<?php echo $_SESSION['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="ans">
                    </label>
                    <input type="text" class="form-control" id="ans" name="ans" placeholder="Type Your Answer Here">
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>


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
    </div>
    <div class="container text-center">
        <h1>Answers</h1>
    </div>
    <?php
    if (isset($_GET['queid'])) {
        $id = $_GET['queid'];
        $sql = "SELECT* FROM `answers` WHERE `que_id` = '$id' AND `ans_status` = 'approved' ORDER BY `ans_id` DESC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $ans_id = $row['ans_id'];
            $ans_title = $row['ans'];
            $username = $row['username'];
            echo '</div>
            <div class="container my-2 answers">
                <div class="media my-4">
                    <img class="mr-3 img-fluid" src="images/user.png" alt="Generic placeholder image" style="width: 50px; height:50px;">
                    <div class="media-body">
                    <a class="ans-icon" title="delete" href="delete_ans.php?delete_ans=' . $ans_id . '"><i class="fas fa-trash"></i>
                    <a class="ans-icon" title="edit" href="edit_ans.php?edit_ans=' . $ans_id . '"><i class="fas fa-edit"></i>
                    </a>
                    
                    </a>
                        <h5 class="mt-0">' . $username . '</h5>

                        ' . $ans_title . '
                    </div>
                </div>
            </div>';
        }
    }
    ?>
    </div>
    <?php
    include 'footer.php';
    ?>
