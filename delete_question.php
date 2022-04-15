<?php include 'header.php'; ?>

    <?php
    $showAlert = false;
    $showError = false;
    $id = $_GET['queid'];
    $select_user = "SELECT * FROM `questions` WHERE `que_id` = '$id'";
    $select_user_details = mysqli_query($conn , $select_user);
    while($row = mysqli_fetch_assoc($select_user_details)){
        $username = $row['username'];
    if(isset($_SESSION['name'])){
        if($_SESSION['name'] === $username){
            $sql = "DELETE FROM `questions` WHERE `que_id` = '$id'";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
            }
            else{
                $showError = true;
            }
        }else{
            echo "<script>window.location.href='index.php'</script>";
        }
    }
    else{
        $showError = true;
    }
    }
        

   
   

    ?>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Question has been deleted successfully.Go <a href="index.php">Back</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>
    <?php
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Failed to delete question.Go <a href="index.php">Back</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>
<?php include "footer.php"; ?>