<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../../db/connection.php';
    $user_id = mysqli_real_escape_string($link, $_SESSION['user_id']);
    $query = "SELECT * FROM user WHERE id = '$user_id'";
    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    mysqli_close($link);
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}
require_once '../admin_layout/header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Users</h3>
    </div>
</div>
<section class="panel">
    <header class="panel-heading">
        <h3 class="page-header"><i class="fa fa-user-md"></i> User Profile</h3>
    </header>
    <div class="panel-body">
        <div class="row">
            <div id="profile" class="col-lg-offset-4 col-xs-12 col-lg-4">
                <br>
                <div class="row">
                    <div class="col-sm-2" >
                        <div class="col-sm-offset-3 col-sm-9" style="background-color: rgba(255,255,255,1); padding: 0px;">
                            <?php
                            if ($data[0]['gender'] === 'female') {
                                echo '<img src="/'. substr(__DIR__, '-28', '-18').'/resources/images/female_profile3.png" class="img-responsive" width="100%">';
                            } else {
                                echo '<img src="/'. substr(__DIR__, '-28', '-18').'/resources/images/male_profile.png" class="img-responsive" width="100%">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <table class="table">
                            <tr>
                                <th style=" color: #ffffff;">Name</th>
                                <td><?php echo $data[0]['name'] ?></td>
                            </tr>
                            <tr>
                                <th style=" color: #ffffff;">Username</th>
                                <td><?php echo $data[0]['user_name'] ?></td>
                            </tr>
                            <tr>
                                <th style=" color: #ffffff;">Email</th>
                                <td><?php echo $data[0]['email'] ?></td>
                            </tr>
                            <tr>
                                <th style=" color: #ffffff;">Gender</th>
                                <td><?php echo $data[0]['gender'] ?></td>
                            </tr>
                            <tr>
                                <th style=" color: #ffffff;">Position</th>
                                <td><?php echo $data[0]['position'] ?></td>
                            </tr>
                            <tr>
                                <th style=" color: #ffffff;">Role</th>
                                <td><?php echo $data[0]['role'] ?></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><a href="http://localhost/EwestStore/str_admin/ma_user/index.php" class="btn btn-info">Back</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="height: 80px;"></div>

            </div>
        </div>
    </div>
</section>
<style>
    body{
        background: url(../resources/images/profile_bckground.jpeg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    #profile{
        background: rgba(0,0,0,0.5) center;
    }
    td{
        color: #ffffff;
    }
    .validTips{
        color: #ff3535; 
        font-weight: bold; 
        font-style: 24px; 
        border: solid #ff3535 2px;
        display: none;
    }
    div .has-error > div > input {
        background-color: #f2dede;
    }
</style>
<?php require_once '../admin_layout/footer.php'; 