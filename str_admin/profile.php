<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
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
$position = ['Engineer', 'Team Leader', 'Manager'];
require_once './admin_layout/header.php';
?>

<!--main content start-->
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
    </div>
</div>
<div class="row">
    <!-- profile-widget -->
    <div class="col-lg-12">
        <div class="profile-widget profile-widget-info">
            <div class="panel-body">
                <div class="col-lg-2 col-sm-2">
                    <h4><?php echo $data[0]['user_name'] ?></h4>               
                    <div class="follow-ava">
                        <?php
                        if ($data[0]['gender'] === 'female') {
                            echo "<img src='/" . substr(__DIR__, '-20', '-10') . "/resources/images/female_profile3.png' class='img-responsive' width='100%'>";
                        } else {
                            echo "<img src='/" . substr(__DIR__, '-20', '-10') . "/resources/images/male_profile.png' class='img-responsive' width='100%'>";
                        }
                        ?>
                    </div>
                    <h6><?php echo $data[0]['role'] ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading tab-bg-info">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#profile">
                            <i class="icon-user"></i>
                            Profile
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#edit-profile">
                            <i class="icon-envelope"></i>
                            Edit Profile
                        </a>
                    </li>
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">
                    <!-- profile -->
                    <div id="profile" class="tab-pane active">
                        <section class="panel">
                            <div class="panel-body bio-graph-info">
                                <h1>Bio Graph</h1>
                                <div class="row">
                                    <div class="bio-row">
                                        <p><span>Name </span>: <?php echo $data[0]['name'] ?> </p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Username </span>: <?php echo $data[0]['user_name'] ?></p>
                                    </div>                                              
                                    <div class="bio-row">
                                        <p><span>Email </span>: <?php echo $data[0]['email'] ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Gender</span>: <?php echo $data[0]['gender'] ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Position </span>: <?php echo $data[0]['position'] ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Role </span>:  <?php echo $data[0]['role'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row">                                              
                            </div>
                        </section>
                    </div>
                    <!-- edit-profile -->
                    <div id="edit-profile" class="tab-pane">
                        <section class="panel">                                          
                            <div class="panel-body bio-graph-info">
                                <h1> Profile Info</h1>

                                <form id="registerUser" class="form-horizontal" role="form">
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $data[0]['id']; ?>"> 
                                    <div class="form-group">
                                        <label for="name" class="col-lg-2 control-label">Name</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $data[0]['name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_name" class="col-lg-2 control-label">Username</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $data[0]['user_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-lg-2 control-label">Email</label>
                                        <div class="col-lg-6">
                                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $data[0]['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-lg-2 control-label">Password</label>
                                        <div class="col-lg-6">
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password" class="col-lg-2 control-label">Confirm Password</label>
                                        <div class="col-lg-6">
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="position" class="col-lg-2 control-label">Gender</label>
                                        <div class="col-lg-6">
                                            <?php if ($data[0]['gender'] === 'male') { ?>
                                                <input type="radio" id="gender" name="gender" value="male" checked> Male<br>
                                                <input type="radio" id="gender" name="gender" value="female"> Female<br>
                                            <?php } else { ?>
                                                <input type="radio" id="gender" name="gender" value="male"> Male<br>
                                                <input type="radio" id="gender" name="gender" value="female" checked> Female<br>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="position" class="col-lg-2 control-label">Position</label>
                                        <div class="col-lg-6">
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
                                        <label for="role" class="col-lg-2 control-label">Role</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="role" name="role" class="form-control" value="<?php echo $data[0]['role'];?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <input type="button" value="Update" id="update_profile" class="btn btn-success" name="update_profile">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- page end-->
<?php require_once './admin_layout/footer.php'; ?>