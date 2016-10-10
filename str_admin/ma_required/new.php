<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../../db/connection.php';
    $query1 = "select id,name from manufacturer";
    $query2 = "select id,name from distributor";
    $result1 = mysqli_query($link, $query1);
    $result2 = mysqli_query($link, $query2);
    $manufacturers = [];
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $manufacturers[] = $row1;
    }
    $distributors = [];
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $distributors[] = $row2;
    }
    mysqli_close($link);
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}

require_once '../admin_layout/header.php';
?>
<section class="panel">
    <header class="panel-heading">
        <h3>Add required components</h3>

    </header>
    <div class="panel-body">
        <form id="requiredForm">
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="manu">Manufacturer</label>
                    <div class="col-sm-3">
                        <select id="manu" name="manufacturer" class="form-control">
                            <option value="" selected disabled>-- select manufacturer --</option>
                            <option value="http://localhost/EwestStore/manufacturer/new.php"> add new manufacturer</option>
                            <?php
                            foreach ($manufacturers as $key => $value) {
                                echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                            }
                            ?>
                        </select> 
                    </div>
                </div>
                <div style="margin-top: -15px;">
                    <div class="col-sm-1" style="padding: 0px;">
                        <button type="button" class="btn btn-plus" id="add_manu_required">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="dist">distributor</label>
                        <div class="col-sm-3" >
                            <select id="dist" name="distribter" class="form-control">
                                <option value="" selected disabled>-- select distributor --</option>
                                <?php
                                foreach ($distributors as $key => $value) {
                                    echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="col-sm-1" style="padding: 0px;">
                            <button type="button" class="btn btn-plus" id="add_dist_required">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group" style="margin-top:15px;">
                    <label class="control-label col-sm-2" for="manu-num">Manufacturer Part-num</label>
                    <div class="col-sm-3">
                        <input type="text" id="manu-num" name="manu_num" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-offset-1 col-sm-2" for="dist-num">distributor Part-num</label>
                    <div class="col-sm-3">
                        <input type="text" id="dist-num" name="dist_num" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group" style="margin-top:15px;">
                    <label class="control-label col-sm-2" for="package">Package</label>
                    <div class="col-sm-3">
                        <input type="text" id="package" name="package" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-offset-1 col-sm-2" for="req-quantity">Required Quantity</label>
                    <div class="col-sm-3">
                        <input type="number" min="0" step="1" id="req-quantity" name=" req_quantity" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group" style="margin-top:15px;">
                    <label class="control-label col-sm-2" for="resp-user">Responsible User</label>
                    <div class="col-sm-3">
                        <input type="text" id="resp-user" name="resp_user" value="<?php echo $_SESSION['username']; ?>" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-offset-1 col-sm-2" for="project">Project</label>
                    <div class="col-sm-3">
                        <input type="text" id="project" name="project" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group" style="margin-top:15px;">
                    <label class="control-label col-sm-2" for="priority">Priority</label>
                    <div class="col-sm-3">
                        <select id="priority" name="priority" class="form-control">
                            <option value="" selected disabled>-- select priority --</option>
                            <option value="5">Very Heigh</option>
                            <option value="4">Heigh</option>
                            <option value="3">Medium</option>
                            <option value="2">Low</option>
                            <option value="1">Very Low</option>
                        </select> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-offset-1 col-sm-2" for="due-date">Due to date</label>
                    <div class="col-sm-3">
                        <input type="text" id="due-date" name="due_date" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group" style="margin-top:15px;">        
                <div class="col-sm-offset-2 col-sm-3">
                    <input type="button" value="Submit" id="submit" class="btn btn-success" name="submit">
                    <a href="http://localhost/EwestStore/str_admin/ma_required/index.php" class="btn btn-info">Back to required</a>
                </div>
            </div>
        </form>

        <!-- Dialog -->
        <div id="dialog_add_manu" title="Add Manufacturer" style="display: none" class="col-xs-12">
            <form class="form-horizontal" id="manufacturerForm">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="manufacturer">Manufacturer</label>
                    <div class="col-sm-8">
                        <input type="text" id="manufacturer" name="manufacturer" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="manu_website">Website</label>
                    <div class="col-sm-8">
                        <input type="text" id="manu_website" name="manu_website" class="form-control">
                    </div>
                </div>
            </form>
        </div>

        <!-- Dialog -->
        <div id="dialog_add_dist" title="Add distributor" style="display: none" class="col-xs-12">
            <form class="form-horizontal" id="distributorForm">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="distributor">distributor</label>
                    <div class="col-sm-8">
                        <input type="text" id="distributor" name="distributor" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="dist_website">Website</label>
                    <div class="col-sm-8">
                        <input type="text" id="dist_website" name="dist_website" class="form-control">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<style>
    .btn-plus{
        background-color: white;
    }
    .btn-plus:active{
        background-color: white;
        box-shadow: none;
    }
    .glyphicon-plus{
        color: green;
    }
    .col-sm-3{
        padding: 0px;
    }
</style>

<?php 
require_once '../admin_layout/footer.php';