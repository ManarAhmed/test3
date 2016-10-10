<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../db/connection.php';
    $query1 = "select * from store";
    $query2 = "select * from required";
    $query3 = "SELECT sum(added_quantity) FROM `log_component` WHERE add_date='" . date("Y-m-d") . "'";
    $query4 = "SELECT sum(pulled_quantity) FROM `log_component` WHERE pull_date='" . date("Y-m-d") . "'";

    $result1 = mysqli_query($link, $query1);
    $result2 = mysqli_query($link, $query2);
    $result3 = mysqli_query($link, $query3);
    $result4 = mysqli_query($link, $query4);

    $stored_count = mysqli_num_rows($result1);
    $required_count = mysqli_num_rows($result2);
    $data1 = [];
    while ($row = mysqli_fetch_assoc($result3)) {
        $data1[] = $row;
    }
    $data2 = [];
    while ($row = mysqli_fetch_assoc($result4)) {
        $data2[] = $row;
    }
    $added_count = $data1[0]['sum(added_quantity)'];
    $pulled_count = $data2[0]['sum(pulled_quantity)'];



    require_once "./admin_layout/header.php";
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
        </div>
    </div>
    <!--overview start-->
    <div class = "row">
        <div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class = "info-box blue-bg">
                <i class = "fa fa-shopping-cart"></i>
                <div class = "count"><?php echo $required_count; ?></div>
                <div class = "title">Required</div>
            </div><!--/.info-box-->
        </div><!--/.col-->

        <div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class = "info-box brown-bg">
                <i class = "fa fa-level-down"></i>
                <?php
                if (!empty($pulled_count)) {
                    echo '<div class = "count">' . print_r($pulled_count) . '</div>';
                } else {
                    echo '<div class = "count">0</div>';
                }
                ?>
                <div class = "title">Pulled Today</div>
            </div><!--/.info-box-->
        </div><!--/.col-->

        <div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class = "info-box dark-bg">
                <i class = "fa fa-level-up"></i>
                <?php
                if (!empty($added_count)) {
                    echo '<div class = "count">' . print_r($added_count) . '</div>';
                } else {
                    echo '<div class = "count">0</div>';
                }
                ?>

                <div class = "title">Added Today</div>
            </div><!--/.info-box-->
        </div><!--/.col-->

        <div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class = "info-box green-bg">
                <i class = "fa fa-cubes"></i>
                <div class = "count"><?php echo $stored_count; ?></div>
                <div class = "title">Store</div>
            </div><!--/.info-box-->
        </div><!--/.col-->

    </div><!--/.row-->
    <?php
    require_once "./admin_layout/footer.php";
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}