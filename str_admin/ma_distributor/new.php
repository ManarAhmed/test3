<?php

session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../admin_layout/header.php';
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}
?>
<section class="panel">
    <header class="panel-heading">
        <h3>>Add distributor</h3>

    </header>
    <div class="panel-body">
        <form class="form-horizontal" id="distributorForm">
            <div class="form-group">
                <label class="control-label col-sm-2" for="distributor">distributor</label>
                <div class="col-sm-6">
                    <input type="text" id="distributor" name="distributor" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="dist_website">Website</label>
                <div class="col-sm-6">
                    <input type="text" id="dist_website" name="dist_website" class="form-control">
                </div>
            </div>
            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-6">
                    <input type="button" value="Submit" id="submit_dist" class="btn btn-success" name="submit_dist">
                    <a href="http://localhost/EwestStore/str_admin/ma_distributor/index.php" class="btn btn-info">Back to distributors</a>
                </div>
            </div>
        </form>
    </div>
</section>
<?php
require_once '../admin_layout/footer.php';