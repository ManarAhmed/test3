<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once '../db/connection.php';
    $email = mysqli_real_escape_string($link, $_SESSION['email']);
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    mysqli_close($link);
}
require_once '../layout/header.php';
?>
<div class="row">
    <div id="register" class="col-lg-offset-4 col-xs-12 col-lg-4">

        <div class="row">
            <div class="col-sm-offset-3 col-sm-6 text-center" style="font-size: 28px; font-weight: bold; color: #ccff00; padding-top: 10px;">Update Profile</div>
        </div>
        <div style="height: 40px;"></div>
        <div class="col-sm-offset-2" >
            <p class="validTips"></p>
        </div>


        <form id="registerUser" class="form-horizontal">
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $data[0]['id']; ?>"> 
            <div class="row">
                <div class="form-group">
                    <label for="name" class="col-sm-offset-2 col-sm-2">Name</label>
                    <div class="col-sm-5">
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $data[0]['name']; ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="user_name" class="col-sm-offset-2 col-sm-2">Username</label>
                    <div class="col-sm-5">
                        <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $data[0]['user_name']; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="email" class="col-sm-offset-2 col-sm-2">Email</label>
                    <div class="col-sm-5">
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $data[0]['email']; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="password" class="col-sm-offset-2 col-sm-2">Password</label>
                    <div class="col-sm-5">
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="confirm_password" class="col-sm-offset-2 col-sm-2">Confirm Password</label>
                    <div class="col-sm-5">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="position" class="col-sm-offset-2 col-sm-2">Gender</label>
                    <div class="col-sm-5">
                        <?php if($data[0]['gender'] === 'male'){ ?>
                        <input type="radio" id="gender" name="gender" value="male" checked> Male<br>
                        <input type="radio" id="gender" name="gender" value="female" disabled> Female<br>
                        <?php } else { ?>
                            <input type="radio" id="gender" name="gender" value="male" disabled> Male<br>
                            <input type="radio" id="gender" name="gender" value="female" checked> Female<br>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="position" class="col-sm-offset-2 col-sm-2">Position</label>
                    <div class="col-sm-5">
                        <input type="text" name="position" id="position" class="form-control" value="<?php echo $data[0]['position']; ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <input type="button" value="Update" id="update_profile" class="btn btn-success" name="update_profile">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    body{
        background: url(../resources/images/register1.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    #register{
        background: rgba(0,0,0,0.5) center;
    }
    label{
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