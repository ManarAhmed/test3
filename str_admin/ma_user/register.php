<?php
session_start();
if ($_SESSION['role'] !== "Administrator") {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}
$position = ['Engineer', 'Team Leader', 'Manager'];
$role = ['User'];
require_once '../admin_layout/header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Users</h3>
    </div>
</div>
<section class="panel">
    <header class="panel-heading">
        <h3>Register User</h3>
    </header>
    <div class="panel-body">
        <div class="row">
            <div id="register" class="col-lg-offset-4 col-xs-12 col-lg-4">
                <div class="col-sm-offset-2" >
                    <p class="validTips"></p>
                </div>
                <form id="registerUser" class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-offset-2 col-sm-2">Name</label>
                        <div class="col-sm-5">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_name" class="col-sm-offset-2 col-sm-2">Username</label>
                        <div class="col-sm-5">
                            <input type="text" name="user_name" id="user_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-offset-2 col-sm-2">Email</label>
                        <div class="col-sm-5">
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-offset-2 col-sm-2">Password</label>
                        <div class="col-sm-5">
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="col-sm-offset-2 col-sm-2">Confirm Password</label>
                        <div class="col-sm-5">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-sm-offset-2 col-sm-2">Gender</label>
                        <div class="col-sm-5">
                            <input type="radio" id="gender" name="gender" value="male"> Male<br>
                            <input type="radio" id="gender" name="gender" value="female"> Female<br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-sm-offset-2 col-sm-2">Position</label>
                        <div class="col-sm-5">
                            <select name="position" id="position" class="form-control">
                                <option value="" disabled selected>-- select position --</option>
                                <?php
                                foreach ($position as $value) {
                                    echo "<option value='" . $value . "'>" . $value . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-sm-offset-2 col-sm-2">Role</label>
                        <div class="col-sm-5">
                            <select name="role" id="role" class="form-control">
                                <option value="" disabled selected>-- select role --</option>
                                <?php
                                foreach ($role as $value) {
                                    echo "<option value='" . $value . "'>" . $value . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <input type="button" value="Register" id="add_user" class="btn btn-success" name="add_user">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
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
<?php require_once '../admin_layout/footer.php'; ?>