<?php
session_start();
//print_r($_SESSION);exit;
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../../db/connection.php';
    $email = mysqli_real_escape_string($link, $_SESSION['email']);
    $query = "SELECT * FROM user WHERE id =" . $_GET['id'];
    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    mysqli_close($link);
}
$position = ['Engineer', 'Team Leader', 'Manager'];
$role = ['Administrator', 'User'];
require_once '../admin_layout/header.php';
if ($_SESSION['user_id'] === $_GET["id"] || $data[0]['role'] === 'User') {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-users"></i> Users</h3>
        </div>
    </div>
    <section class="panel">
        <header class="panel-heading">
            <h3>Update user Profile</h3>
        </header>
        <div class="panel-body">
            <div class="row">
                <div id="register" class="col-lg-offset-4 col-xs-12 col-lg-4">
                    <div class="col-sm-offset-2" >
                        <p class="validTips"></p>
                    </div>


                    <form id="registerUser" class="form-horizontal" role="form">
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $data[0]['id']; ?>"> 
                        <div class="form-group">
                            <label for="name" class="col-sm-offset-2 col-sm-2">Name</label>
                            <div class="col-sm-5">
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $data[0]['name']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_name" class="col-sm-offset-2 col-sm-2">Username</label>
                            <div class="col-sm-5">
                                <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $data[0]['user_name']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-offset-2 col-sm-2">Email</label>
                            <div class="col-sm-5">
                                <input type="email" name="email" id="email" class="form-control" value="<?php echo $data[0]['email']; ?>">
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
                                <input type="radio" id="gender" name="gender" value="male" <?php echo ($data[0]['gender'] == 'male') ? 'checked' : '' ?>> Male<br>
                                <input type="radio" id="gender" name="gender" value="female"<?php echo ($data[0]['gender'] == 'female') ? 'checked' : '' ?>> Female<br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="position" class="col-sm-offset-2 col-sm-2">Position</label>
                            <div class="col-sm-5">
                                <select id="position" name="position" class="form-control">
                                    <option value="" disabled>-- select position --</option>
                                    <?php
                                    foreach ($position as $value) {
                                        if ($value === $data[0]['position']) {
                                            echo "<option value='" . $value . "' selected>" . $value . "</option>";
                                        } else {
                                            echo "<option value='" . $value . "'>" . $value . "</option>";
                                        }
                                    }
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-sm-offset-2 col-sm-2">Role</label>
                            <div class="col-sm-5">
                                <select id="role" name="role" class="form-control">
                                    <option value="" selected disabled>-- select role --</option>
                                    <?php
                                    foreach ($role as $value) {
                                        if ($value === $data[0]['role']) {
                                            echo "<option value='$value' selected>$value</option>";
                                        } else {
                                            echo "<option value='$value'>$value</option>";
                                        }
                                    }
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <input type="button" value="Update" id="update_profile" class="btn btn-success" name="update_profile">
                                <a href="http://localhost/EwestStore/str_admin/ma_user/index.php" class="btn btn-info">Back</a>
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

<?php } else { ?>
    <div class="row">
        <div class="col-md-6">
            <img src="../../resources/images/not_allowed.png" class="img-responsive" width="70%">
        </div>
        <div class="col-md-6">
            <br>
            <span  style="font-weight: bold; font-size: 28px; color: #FF0000;">OOPS!</span><br>
            <p style="font-size: 28px;">You are not allowed to edit this user.</p>
        </div>
    </div>
    <br>
    <a href="http://localhost/EwestStore/str_admin/ma_user/index.php" class="btn btn-info">Back</a>
    <?php
}
require_once '../admin_layout/footer.php';
