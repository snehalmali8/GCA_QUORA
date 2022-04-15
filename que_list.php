<?php include 'header.php'; ?>
<body class="que_list_back">
<div>
  <!-- Form php for putting quetions -->
    <?php
    $showAlert = false;
    $showError = false;
    $id = $_GET["catid"];
    $method = $_SERVER["REQUEST_METHOD"];
    if ($method == "POST") {
        if ($_SESSION['loggedin'] == true) {
            $que_title = $_POST['question'];
            $username = $_SESSION['name'];
            $Rsql = "INSERT INTO `questions` (`que_title`, `que_cat_id`, `que_user_id`, `date` , `username`) VALUES ('$que_title', '$id', 1, current_timestamp() , '$username')";
            $result = mysqli_query($conn, $Rsql);
            if(!$result){
                $showError = true;
            }
            else{
                $showAlert = true;
            }
        } else {
            echo "<script>window.location.href='login.php'</script>";
        }
    }
    ?>



    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your question was added successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    if($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Something wents wrong.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }

    ?>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE `category_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $category_name = $row['category_name'];
    }
    ?>

    <div class="gca-jumbo">
        <div class="jumbotron text-center jumbo">
            <h1 class="display-4 category-name heading">Welcome to <?php echo $category_name;  ?></h1>
            <hr class="hr">
            <p class="text-warning jumbo_sub_text"><strong>This website is made for benefit of students</strong></p>
            <hr class="my-2">
            <p class="text-primary jumbo_sub_text"><strong>Feel free to ask any queries related to
                    <?php echo $category_name;  ?>.</strong></p>
            <p class="lead">
                <button class="btn mb-4 que-button que-anchor button"><a class="que-anchor" data-toggle="modal"
                        data-target="#questionModal">Ask a Question</a></button>
            </p>
        </div>


        <!-- Modal for add a question -->
        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#questionModal">
            Launch demo modal
        </button> -->

        <!-- Modal -->
        <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="questionModalLabel">Add a Question</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Form -->
                        <div class="container border border-dark form">
                            <form action=" <?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                                <div class="form-group">
                                    <label for="question">
                                        <h5>Ask Question</h5>
                                    </label>
                                    <input type="text" class="form-control" id="question" name="question"
                                        placeholder="Type Your Question Here">
                                </div>
                                <button type="submit" class="btn que-button que-anchor" id="mybutton">Submit</button>
                            </form>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>


        <?php
        $id = $_GET["catid"];
        // $sql = "SELECT * FROM `questions` WHERE `que_cat_id` = $id ";
        $sql = "SELECT * FROM `questions` WHERE `que_status` = 'approved' AND `que_cat_id` = '$id' ORDER BY `que_id` DESC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $que_id = $row['que_id'];
            $que_title = $row['que_title'];
            $name = $row['username'];

            

            echo '</div>
            <div class="container my-2 questions">
                <div class="media my-4">
                    <img class="mr-3 img-fluid" src="images/user.png" alt="Generic placeholder image" style="width: 50px; height:50px;">
                    <div class="media-body">
                    <a class="que-icon" title="delete" href="delete_question.php?queid=' . $que_id . '"><i class="fas fa-trash"></i>
                    <a class="que-icon" title="edit" href="edit_question.php?queid=' . $que_id . '"><i class="fas fa-edit"></i>
                    </a>
                    
                    </a>
                        <h5 class="mt-0">' . $name . '</h5>

                        <strong style="color:#000066; font-size:1.2rem;">Question: </strong>' . $que_title . '<hr style=" background-color: black;border: none;height: 1px;"/>
                        
                        <div>';
        ?>
        <?php
        $ans_query = "SELECT * FROM `answers` WHERE `ans_status` = 'approved' AND `que_id` = '$que_id'  LIMIT 1";
        $select_ans = mysqli_query($conn, $ans_query);
        if (!$select_ans) {
            die("Failed query" . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($select_ans)) {
            $ans_id = $row['ans_id'];
            $ans_title = $row['ans'];
        

            echo '<strong style="color: #000099; font-size:1.2rem;">Answer:</strong><p>   • ' . $ans_title . '<br/><a href="more_answers.php?queid=' . $que_id . '" style="font-size: 0.8rem;color:blue;">See More Answers</a></p> ';
        }
            
            ?>
        <?php
                        echo '</div>
                    </div>
                </div>
                <button class="btn mb-4 que-button button"><a class="que-anchor" href="answer_list.php?queid=' . $que_id . '">Answer a Question</a></button>

            </div>';
        }
        ?>
        <hr style=" background-color: white;border: none;height: 1px;" />

        <?php
        // session_start();
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<div class="container border border-dark form my-4 mb-4" style="background:white;">
            <form action=" ' .  $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="form-group">
                                    <label for="username">
                                        <h5>Ask Question</h5>
                                    </label>
                                    <input type="text" class="form-control" id="username" name="username" value=' . $_SESSION['name'] . '>
                                </div>
                <div class="form-group">
                    <label for="question">
                        <h3>Ask Question</h3>
                    </label>
                    <input type="text" class="form-control" id="question" name="question" placeholder="Type Your Question Here">
                </div>
                <button type="submit" class="btn que-button que-anchor button">Submit</button>
            </form>
        </div>';
        } else {
            // header("location: login.php");
            echo "You have to login first";
        }

        ?>

        <?php
        include 'footer.php';
        ?>
</div>
