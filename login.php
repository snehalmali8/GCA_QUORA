<?php
    include 'header.php';
    ?>
<?php
$showError = false;
$passwordAlert = false;
$emptyData = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_email = $_POST['identity'];
    $password = $_POST['password'];
    if (!empty($name_email) && !empty($password)) {
        
        $sql = "SELECT * FROM signup WHERE `name`='$name_email' or `email`='$name_email'";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            // echo "in";
            $user_data = mysqli_fetch_assoc($result);
            // echo $user_data['name']."<br>";
            $hashed_pwd = $user_data['password'];
            if (password_verify($password, $hashed_pwd)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['name'] = $user_data['name'];
                $_SESSION['email'] = $user_data['email'];
                
                echo "<script>window.location.href='index.php'</script>";
            } else {
                $passwordAlert = true;
            }
        }else{

            $sql_admin = "SELECT * FROM `admin` WHERE `admin_username`='$name_email' or `admin_email`='$name_email'";
            $result = mysqli_query($conn, $sql_admin);
            // echo "in";
            $admin_data = mysqli_fetch_assoc($result);
            if($result){              
                $admin_pwd = $admin_data['admin_password'];
                if ($admin_pwd == $password) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['name'] = $admin_data['admin_username'];
                    $_SESSION['email'] = $admin_data['admin_email'];
                    $_SESSION['admin'] = true;
                    echo "<script>window.location.href='admin'</script>";
                } else {
                    $passwordAlert = true;
                }
            }else{
                $showError=true;
            }
        }
    } else {
        $emptyData = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/66ad72334a.js" crossorigin="anonymous"></script>

    <title>GCA_QUORA | Login</title>
</head>
<style>
* {
    margin: 0;
    padding: 0%;
    /* color: red; */
}

.login1 {
    height: 75vh;
    padding-top: 6%;
}

.login-container {
    width: 64% !important;
    height: 42vh !important;
    margin-top: 5% !important;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    border: 1px solid #b3e0ff;
    border-radius: 20px;
    /* background-color: #ccebff; */
    background-color: transparent;

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

.que-button {
    /* color: black; */
    background-color: #0000b3;
    box-shadow: 3px 3px #000033;
}

.que-button:hover {
    /* color: black; */
    background-color: black;
    cursor: pointer;
}

.que-anchor {
    color: white;
}

.que-anchor:hover {
    color: white;
}

.heading {
    font-size: 3rem;
    font-family: serif;
    color: transparent;
    text-align: center;
    color: #e6f5ff;
    text-shadow: 3px 2px grey;

}
.login_end{
    font-size:1.1rem;
    color:white;
    margin-top:5px !important;
}

@keyframes effect {
    0% {
        background: linear-gradient(#000033, #990000);
        -webkit-background-clip: text;
    }

    100% {
        background: linear-gradient(#000033, #000FFF);
        -webkit-background-clip: text;
    }
}

@media(max-width: 988px) {
    .login-container {
        width: 64% !important;
        height: 36vh !important;
        margin-top: 5% !important;
        padding-right: 5px;
        padding-left: 5px;
    }
}

/* 
.heading {
    font-size: 3rem;
} */

@media(max-width: 773px) {
    .heading {
        font-size: 2rem;
    }

    .login-container {
        width: 85% !important;
        height: 34vh !important;
        margin-top: 5% !important;
        padding-right: 2px;
        padding-left: 2px;
    }

    .content {

        padding-left: 20px !important;
        padding-right: 20px;
        padding-top: 1.5rem;


        /* margin: 18px 0; */
    }
}

@media(max-width: 480px) {
    .heading {
        font-size: 2rem;
    }

    .login-container {
        width: 95% !important;
        /*height: 34vh !important;*/
        margin-top: 5% !important;
        padding-right: 2px;
        padding-left: 2px;
    }

    .content {

        padding-left: 20px !important;
        padding-right: 20px;
        padding-top: 1.5rem;


        /* margin: 18px 0; */
    }

    .container input {
        font-size: 17px;
        padding: 4px;

    }
}

@media(max-width:430px) {
    .content2 i {
        display: none;
    }

    .login-container {
        width: 98% !important;
        height: 33vh !important;
        margin-top: 10% !important;
        padding-right: 2px;
        padding-left: 2px;
    }

    .heading {
        margin-top: 10%;
    }
}

/* button animationn */
.button {
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

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['signedup']) && $_GET['signedup'] == true) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>You have succefully signedup, now you can login</strong>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    };
    ?>
    <?php
    if ($emptyData) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> Please enter valid information!!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
    } else {
        if ($showError) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> name or Email does not exists!!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        } else {
            if ($passwordAlert) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> Password not matched!!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
            }
        }
    }
    ?>

    <div class="wrapper1">
        <div class="container login1 my-2">
            <h2 class="heading text-center">Login to Continue</h2>
            <div class="login-container my-4">
                <form action="login.php" method="post" class="text-center">
                    <div class="content">
                        <div class="mb-3 my-1 content2 row text-center">
                            <!-- <label for="name" class="form-label">Email</label> -->
                            <!-- <i class="far fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i> -->
                            <i class="fas fa-user col-xs-1 col-lg-1 col-md-1 col-sm-1 col-1 text-center my-2"></i>
                            <input type="text" class="form-controlcol-xs-11 col-lg-11 col-md-11 col-sm-11 col-11"
                                id="identity" name="identity" autocomplete="off" aria-describedby="emailHelp"
                                placeholder="Enter Your name or Email ID">
                        </div>
                        <div class="mb-3 content2 row">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <i class="fas fa-key col-xs-1 col-lg-1 col-md-1 col-sm-1 col-1 text-center my-2"></i>
                            <input type="password" class="form-control col-xs-11 col-lg-11 col-md-11 col-sm-1 col-11"
                                id="password" name="password" autocomplete="off" placeholder="Enter Your Password">
                        </div>
                    </div>
                    <button type="submit" class="btn que-button que-anchor button">LogIn</button>
                    <p class="login_end text-center"><a href='forgot_password.php' style="color:blue">Forgot Password?</a></p>

                </form>
                <p class="login_end text-center">Don't have an account? <a href='signup.php' style="color:blue">Signup</a></p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>