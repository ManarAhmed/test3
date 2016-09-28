<?php
session_start();
require_once '../layout/loginHeader.php';

if (isset($_POST['user_login'])) {
//    echo 'hiiiii';exit();
    require_once '../db/connection.php';
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    mysqli_close($link);

    if (!empty($data)) {
        $password = password_verify($_POST['password'], $data[0]['password']);
        if ($password) {
            $_SESSION['user_id'] = $data[0]['id'];
            $_SESSION['email'] = $data[0]['email'];
            $_SESSION['username'] = $data[0]['user_name'];
            $_SESSION['password'] = $data[0]['password'];
            header('Location: http://localhost/EwestStore/store.php');
            exit();
        } else {
            echo '<p class="validTips">password is not correct</p>';
        }
    } else {
        echo '<p class="validTips">username or password is not correct</p>';
    }
}
?>
<div class="row">
    <div id="login" class="col-lg-offset-4 col-xs-12 col-lg-4">

        <div class="row">
            <div class="col-sm-offset-3 col-sm-6 text-center" style="font-size: 28px; font-weight: bold; color: #ccff00; padding-top: 10px;">Login</div>
        </div>
        <div style="height: 40px;"></div>

        <form id="registerUser" class="form-horizontal" method="post" action="login.php">
            <div class="row">
                <div class="form-group">
                    <label for="email" class="col-sm-offset-2 col-sm-2">Email</label>
                    <div class="col-sm-5">
                        <input type="text" name="email" id="email" class="form-control">
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
                    <div class="col-sm-offset-4 col-sm-8">
                        <input type="submit" value="Login" id="user_login" class="btn btn-success" name="user_login">
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
    #login{
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
    }
    div .has-error > div > input {
        background-color: #f2dede;
    }
</style>

<?php require_once '../layout/footer.php'; ?>
