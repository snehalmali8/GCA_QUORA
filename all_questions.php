<?php include 'header.php'; ?>

<style>
    body {
        top: 0;
        left: 0;
        background-color: #000000;
        background-image: linear-gradient(147deg, #000000 0%, #2c3e50 74%);

    }

    .questions {
        border: 1px solid grey;
        border-radius: 10px;
        background-color: #e6e6ff;
        /* box-shadow: 0 0 20px rgba(0,0,0,0.2); */
        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;


    }

    .que-button {
        /* color: black; */
        background-color: black;
        box-shadow: 3px 3px #000033;
    }

    .que-button:hover {
        /* color: black; */
        background-color: #000033;
        cursor: pointer;
    }

    .que-anchor {
        color: white;
    }

    .que-anchor:hover {
        color: white;
    }

    .que-icon {
        float: right;
        margin: 5px;
    }

    /* button animation */
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
            width: 220px;
        }

        to {
            width: 230px;
        }
    }

    .hr {
        background-color: white;
        border: none;
        height: 1px;
        margin-left: 15%;
        margin-right: 15%;
        margin-bottom: 5%;
    }

    .form {
        border-radius: 10px;
    }
    </style>
</head>

<body>
    <?php
    $sql = "SELECT * FROM `questions` WHERE que_status = 'approved' ORDER BY `que_id` DESC";
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
                        <h5 class="mt-0">' . $name . '</h5>

                        <strong style="color:#000066; font-size:1.2rem;">Question: </strong>' . $que_title . '
                        
                        <div><hr/>
                        <strong style="color: #000099; font-size:1.2rem;">Answers:</strong>';
    ?>

    <?php
        $ans_query = "SELECT * FROM `answers` WHERE ans_status = 'approved' AND `que_id` = '$que_id'  LIMIT 2";
        $select_ans = mysqli_query($conn, $ans_query);
        if (!$select_ans) {
            die("Failed query" . mysqli_error($conn));
        }

        $ans=0;
        while ($row = mysqli_fetch_assoc($select_ans)) {
            $ans_id = $row['ans_id'];
            $ans_title = $row['ans'];
        
            $ans++;
            echo '<p>   • ' . $ans_title . '<br/> 
            </p>
            <hr/> ';
        }
        if($ans>2){
            echo '<a href="answer_list.php?queid=' . $que_id . '" style="font-size: 0.8rem;color:blue;">See More Answers</a>';
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
    include 'footer.php';
    ?>


    <script>
    document.getElementById('mybutton').onclick = function() {
        location.href = "login.php";
    };
    </script>
</body>

</html>