<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once '../db/connection.php';
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
require_once '../layout/header.php';
?>
<div class="row">
    <div id="profile" class="col-lg-offset-4 col-xs-12 col-lg-4">

        <div class="row">
            <div class="col-sm-offset-3 col-sm-6 text-center" style="font-size: 28px; font-weight: bold; color: #ccff00; padding-top: 10px;">Profile</div>
        </div>
        <div style="height: 40px;"></div>
        <div class="row">
            <div class="col-sm-2" >
                <div class="col-sm-offset-3 col-sm-9" style="background-color: rgba(255,255,255,1); padding: 0px;">
                    <?php
                    if ($data[0]['gender'] === 'female') {
                        echo '<img src="../resources/images/female_profile3.png" class="img-responsive" width="100%">';
                    } else {
                        echo '<img src="../resources/images/male_profile.png" class="img-responsive" width="100%">';
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-10">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td><?php echo $data[0]['name'] ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?php echo $data[0]['user_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $data[0]['email'] ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?php echo $data[0]['gender'] ?></td>
                    </tr>
                    <tr>
                        <th>Position</th>
                        <td><?php echo $data[0]['position'] ?></td>
                    </tr>
                    <tr>
                        <th>Position</th>
                        <td><?php echo $data[0]['role'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="height: 80px;"></div>

    </div>
</div>
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
    th{
        color: #ffffff;
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
<?php require_once '../layout/footer.php'; ?>