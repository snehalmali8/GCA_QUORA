<?php
include "includes/admin_header.php";
?>
<?php
if(!isset($_SESSION['admin'])){
 echo "<script>window.location.href='../about.php'</script>";   
}
?>
    <div id="wrapper">

        <?php
        include "includes/admin_navigation.php";
        ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome,
                            <b class="text-primary"><?php echo $_SESSION['name']; ?></b>
                        </h1>
                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                            </li>
                        </ol> -->
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-file-text fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class='huge'>
                                                    <?php

                                                    $query = "SELECT * FROM `categories`";
                                                    $select_category = mysqli_query($conn, $query);

                                                    $category_count = mysqli_num_rows($select_category);
                                                    echo "<div class='huge'>{$category_count}</div>";

                                                    ?>
                                                </div>
                                                <div>categories</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="view_All_categories.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-comments fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class='huge'>
                                                    <?php

                                                    $query = "SELECT * FROM `questions`";
                                                    $select_question = mysqli_query($conn, $query);

                                                    $question_count = mysqli_num_rows($select_question);
                                                    echo "<div class='huge'>{$question_count}</div>";

                                                    ?>
                                                </div>
                                                <div>Questions</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="view_questions.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class='huge'>
                                                    <?php

                                                    $query = "SELECT * FROM `answers`";
                                                    $select_answers = mysqli_query($conn, $query);

                                                    $answers_count = mysqli_num_rows($select_answers);
                                                    echo "<div class='huge'>{$answers_count}</div>";

                                                    ?>
                                                </div>
                                                <div> Answers</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="view_answers.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-list fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class='huge'>
                                                    <?php

                                                    $query = "SELECT * FROM `signup`";
                                                    $select_users = mysqli_query($conn, $query);

                                                    $users_count = mysqli_num_rows($select_users);
                                                    echo "<div class='huge'>{$users_count}</div>";

                                                    ?>
                                                </div>
                                                <div>Users</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="view_users.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->

                        <?php
                        $query = "SELECT * FROM `signup` WHERE `user_status` = 'approved'";
                        $select_active_users = mysqli_query($conn, $query);
                        $active_users_count = mysqli_num_rows($select_active_users);

                        $query = "SELECT * FROM `signup` WHERE `user_status` = 'disapproved'";
                        $select_unactive_users = mysqli_query($conn, $query);
                        $unactive_users_count = mysqli_num_rows($select_unactive_users);

                        $query = "SELECT * FROM `questions` WHERE `que_status` = 'disapproved'";
                        $select_unactive_ques = mysqli_query($conn, $query);
                        $unactive_ques_count = mysqli_num_rows($select_unactive_ques);

                        $query = "SELECT * FROM `answers` WHERE `ans_status` = 'disapproved'";
                        $select_unactive_ans = mysqli_query($conn, $query);
                        $unactive_ans_count = mysqli_num_rows($select_unactive_ans);


                        ?>
                        <div class="container-fluid">
                            <script type="text/javascript">
                                google.charts.load('current', {
                                    'packages': ['bar']
                                });
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                    var data = google.visualization.arrayToDataTable([
                                        ['Data', 'Count'],

                                        <?php
                                        $elements_text = [
                                            'All Users', 'Active Users', 'Denied Users', 'Questions', 'Pending Questions', 'Answers', 'Pending Answers', 'Categories'
                                        ];

                                        $elements_count = [$users_count, $active_users_count, $unactive_users_count, $question_count, $unactive_ques_count, $answers_count, $unactive_ans_count, $category_count];
                                        for ($i = 0; $i < 8; $i++) {
                                            echo "['{$elements_text[$i]}'" . "," . "'{$elements_count[$i]}'],";
                                        }
                                        ?>
                                    ]);

                                    var options = {
                                        chart: {
                                            title: 'GCA_Quora Performance',
                                        }
                                    };

                                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                    chart.draw(data, google.charts.Bar.convertOptions(options));
                                }
                            </script>
                            <div id="columnchart_material" style="width: 800px; height: 500px;"></div>

                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <?php
    include "includes/admin_footer.php";
    ?>
