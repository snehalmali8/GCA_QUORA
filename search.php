<?php include "header.php";?>
<link href="search.css" rel="stylesheet">

    <title>iDiscuss</title>
    
    <div class="black_color">
        <div class="container wrapper1 text-center">
            <h2 class="py-2 my-4">Searching Results for Question: <em>"<?php echo $_GET["search"]; ?>"</em></h2>

            <div class="anim_css">
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
                <div></div>
                <div></div>
            </div>

            <?php
        // include 'partials/dbconnect.php';
        $showResult = false;
        $query = $_GET["search"];
        $sql = "SELECT * FROM `questions` WHERE (`que_title` LIKE '%" . $query . "%')";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $que_title = $row['que_title'];
            $que_id = $row['que_id'];
            $name = $row['username'];
            $url = "/GCA_QUORA/que_list.php?queid=" . $que_id;
            $showResult = true;
            echo '</div>
            <div class="container my-2 searches">
                <div class="media my-4">
                    <img class="mr-3 img-fluid" src="images/user.png" alt="Generic placeholder image" style="width: 50px; height:50px;">
                    <div class="media-body">
                    <a class="que-icon" title="delete" href="delete_question.php?queid=' . $row['que_id'] . '"><i class="fas fa-trash"></i>
                    <a class="que-icon" title="edit" href="edit_question.php?queid=' . $row['que_id'] . '"><i class="fas fa-edit"></i>
                    </a>
                    
                    </a>
                        <h5 class="mt-0">'.$name.'</h5>

                        ' . $que_title . '
                    </div>
                </div>
                <button class="btn mb-4 search-button button"><a class="search-anchor" href="answer_list.php?queid=' . $row['que_id'] . '">Answer a Question</a></button>

            </div>';
        }
        if (!$showResult) {
            echo '<div class="jumbotron text-center">
                        <h3 class="display-3">No Results Found... :(</h3>
                    </div>';
        }

        ?>
        </div>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    </div>

<?php 
include "footer.php";
?>