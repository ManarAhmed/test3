<?php

session_start();
if (!isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../admin_layout/header.php';
    ?>
    <section class="panel">
        <header class="panel-heading">
            <h3>Add manufacturer</h3>

        </header>
        <div class="panel-body">
            <form class="form-horizontal" id="manufacturerForm">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="manufacturer">Manufacturer</label>
                    <div class="col-sm-6">
                        <input type="text" id="manufacturer" name="manufacturer" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="manu_website">Website</label>
                    <div class="col-sm-6">
                        <input type="text" id="manu_website" name="manu_website" class="form-control">
                    </div>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-6">
                        <input type="button" value="Submit" id="submit_manu" class="btn btn-success" name="submit_manu">
                        <a href="http://localhost/EwestStore/str_admin/ma_manufacturer/index.php" class="btn btn-info">Back to manufacturers</a>
                    </div>
                </div>
            </form>
        </div>
    </section>



    <?php
    require_once '../admin_layout/footer.php';
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}