<style>
.gcaquora_navbar a {
    color: white !important;
}

.gcaquora_navbar a:hover {
    color: yellow !important;
}
</style>


<nav class="navbar navbar-inverse navbar-fixed-top gcaquora_navbar" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">GCA-Quora Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="../index.php">HOME</a></li>


        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>

                <?php
                if (isset($_SESSION['name'])) {
                    echo $_SESSION['name'];
                }
                ?>

                <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <!-- <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li> -->
                <!-- <li class="divider"></li> -->
                <li>
                    <a href="../logout.php" style="color: black !important;"><i class="fa fa-fw fa-power-off"></i> Log
                        Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="view_All_categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#pdropdown"><i
                        class="fa fa-fw fa-arrows-v"></i>
                    Q&A <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="pdropdown" class="collapse">
                    <li>
                        <a href="./view_questions.php">Questions</a>
                    </li>
                    <li>
                        <a href="./view_answers.php">Answers</a>
                    </li>
                </ul>
            </li>

            <!-- <li class="active">
                <a href="./comments.php"><i class="fa fa-fw fa-file"></i>Comments</a>
            </li> -->
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>
                    Users<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="./view_users.php">View All Users</a>
                    </li>
                </ul>
            </li>
             <li>
                <a href="feedbacks.php"><i class="fa fa-fw fa-arrows-v"></i> Feedbacks</a>
            </li>
            <!-- <li>
                <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
            </li> -->
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>