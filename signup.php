<?php include 'header.php'; ?>
    <style>
    * {
        margin: 0;
        padding: 0%;
        color: white;
    }

    .signup-container {
        width: 60% !important;
        height: 80vh !important;
        padding-right: 10px;
        padding-left: 10px;
        margin-right: auto;
        margin-left: auto;
        /* border: 1px solid lightgray; */
        /* border-radius: 20px; */
        /* background-color: #ccebff; */
        /* background-color: rgba(0, 0, 0, 0.12); */


    }

    .heading {
        margin-top: 4%;
        font-size: 3rem;
        color: #e6f5ff;
        text-shadow: 3px 2px grey;

    }
    .login_end{
    font-size:1.1rem;
    color:white;
    margin-top:6px !important;
}

    @media(max-width: 993px) {
        .signup-container {
            width: 100%;
        }

        .container input {
            font-size: 20px;
            padding: 4px;
        }

        .signup-container {
            width: 90% !important;
            height: 90vh !important;
            padding-right: 10px;
            padding-left: 10px;
        }

    }


    @media(max-width: 768px) {
        .heading {
            font-size: 2rem;
        }


    }

    @media(max-width: 548px) {
        .heading {
            font-size: 1.7rem;
        }

        .signup-container {
            width: 97% !important;
            height: 90vh !important;
            padding-right: 5px;
            padding-left: 5px;
        }
    }

    @media(max-width: 420px) {
        .heading {
            margin-top: 6%;
            margin-bottom: 0px;
            /* font-size: 1.2rem; */
        }


        .signup-container {
            width: 90% !important;
            height: 95vh !important;
            padding-right: 4px;
            padding-left: 4px;
            padding-top: 2px !important;
            padding-bottom: 2px !important;

        }
    }

    .container input {
        background: none;
        border: none;
        outline: none;
        color: white;
        background: transparent;
        font-size: 25px;
        padding: 6px;
        font-family: cursive;
    }

    .content2 {
        border-bottom: 3px solid brown;

    }

    .content {
        /* width: 80%; */
        /* border-bottom: 4px solid rgb(102, 16, 16); */
        display: block;
        margin: auto;
        padding-left: 40px;
        padding-right: 40px;
        padding-top: 2.5rem;


        /* margin: 18px 0; */
    }

    .sign-button {
        /* color: black; */
        background-color: crimson;
        box-shadow: 3px 3px #000033;
    }

    .sign-button:hover {
        /* color: black; */
        background-color: black;
        cursor: pointer;
    }

    .sign-anchor {
        color: white;
    }

    .sign-anchor:hover {
        color: white;
    }



    /* button  animation   */
    .button {
        text-align: center !important;
        animation-name: snehal;
        animation-duration: 1s;
        animation-iteration-count: infinite;
        animation-direction: alternate;
        /* animation-play-state: running; */
        /* animation-timing-function: ease-in-out; */
        animation-delay: 1s;

    }

    @keyframes snehal {
        from {
            width: 100px;
        }

        to {
            width: 120px;
        }
    }
    </style>

    <?php
$passwordAlert = false;
$emptyData = false;
$ue = 0;

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $roll = $_POST["roll"];
    $pass = $_POST["password"];
    $cpass = $_POST["cpassword"];
    $branch = $_POST["branch"];
    if (!empty($name) && !empty($pass) && !empty($email) && !empty($roll) && !empty($cpass) && !empty($branch)) {

        $existsql = "SELECT * FROM `signup` WHERE `name`='$name' OR `email`='$email'";
        $result = mysqli_query($conn, $existsql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            ++$ue;
        }

        if (($pass == $cpass) && $ue == 0) {
            $hashedpwd = password_hash($pass, PASSWORD_DEFAULT);
            // $sql="INSERT INTO `users1` (`name`, `email`, `password`, `dt`) VALUES ('$name', '$email','$hashedpwd', CURRENT_TIMESTAMP);";
            $sql = "INSERT INTO `signup` (`name`, `email`, `roll` , `password` , `branch` , `date`) VALUES ('$name', '$email' , '$roll' , '$hashedpwd', '$branch' , current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                // $_SESSION['signedup']=true;
                // header("location: login.php?signedup=true");
                echo "<script>window.location.href='login.php'</script>";
            }
        } else {
            $passwordAlert = true;
        }
    } else {
        $emptyData = true;
    }
}
?>
    <?php
    if ($emptyData) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Please enter valid information!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>;</span>
        </button>
    </div>";
    } else {

        if ($ue == 1) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>name or password do not match!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>;</span>
        </button>
        </div>";
        }
        
        if ($passwordAlert) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong>Password do not match.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>;</span>
            </button>
        </div>";
        }
    }
    ?>
    <div class="wrapper1">
        <div class="container my-2">
            <h2 class="heading text-center">Sign Up to GCA-Quora</h2>
            <div class="signup-container my-2">
                <form action="signup.php" method="post">
                    <div class="content my-0 text-center">
                        <div class="mb-3 content2 row">
                            <!-- <label for="name" class="form-label">Email</label> -->
                            <!-- <i class="far fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i> -->
                            <i class="fas fa-user col-lg-1 col-md-1 col-sm-1 col-1 text-center my-1"></i>
                            <input type="text" class="form-control col-lg-11 col-md-11 col-sm-11 col-11" id="name"
                                name="name" aria-describedby="emailHelp" placeholder="Enter Username">
                        </div>
                        <div class="mb-3 my-3 content2 row">
                            <!-- <label for="email" class="form-label">Email</label> -->
                            <!-- <i class="far fa-envelope"></i> -->
                            <i class="fas fa-envelope col-lg-1 col-md-1 col-sm-1 col-1 text-center my-1"></i>
                            <input type="email" class="form-control col-lg-11 col-md-11 col-sm-1 col-11" id="email"
                                name="email" aria-describedby="emailHelp" placeholder="Enter Your Email">
                        </div>
                        <div class="mb-3 content2 row">
                            <!-- <label for="branch" class="form-label"> Confirm Password</label> -->
                            <i class="fas fa-user-graduate col-lg-1 col-md-1 col-sm-1 col-1 text-center my-1"></i>
                            <input type="text" class="form-control col-lg-11 col-md-11 col-sm-1" id="branch"
                                name="branch" placeholder="Enter Your Branch">
                        </div>
                        <div class="mb-3 my-3 content2 row">
                            <!-- <label for="roll" class="form-label">Roll No.</label> -->
                            <i class="fas fa-sort-numeric-up col-lg-1 col-md-1 col-sm-1 col-1 text-center my-1"></i>
                            <input type="number" class="form-control col-lg-11 col-md-11 col-sm-1 col-11" id="roll"
                                name="roll" aria-describedby="emailHelp" placeholder="Enter Your Roll Number">
                        </div>
                        <div class="mb-3 content2 row">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <i class="fas fa-key col-lg-1 col-md-1 col-sm-1 col-1 text-center my-1"></i>
                            <input type="password" class="form-control col-lg-11 col-md-11 col-sm-1 col-11"
                                id="password" name="password" placeholder="Enter Your Password">
                        </div>
                        <div class="mb-3 content2 row">
                            <!-- <label for="cpassword" class="form-label"> Confirm Password</label> -->
                            <i class="fas fa-key col-lg-1 col-md-1 col-sm-1 col-1 text-center my-1"></i>
                            <input type="password" class="form-control col-lg-11 col-md-11 col-sm-1 col-11"
                                id="cpassword" name="cpassword" placeholder="Confirm Your Password">
                        </div>
                        <button type="submit" class="btn sign-button sign-anchor text-center button">Sign Up</button>
                                        <p class="login_end text-center">Already have an account? <a href='login.php' style="color:blue">Login Here</a></p>


                    </div>
                    <!-- <div id="passwordHelp" class="form-text">Make sure to type the same password.</div> -->
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
    </div>
    <?php
    include 'footer.php';
    ?>