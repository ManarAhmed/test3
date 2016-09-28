<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once '../db/connection.php';
    $query1 = "select id,name from manufacturer";
    $query2 = "select id,name from distributer";
    $result1 = mysqli_query($link, $query1);
    $result2 = mysqli_query($link, $query2);
    $manufacturers = [];
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $manufacturers[] = $row1;
    }
    $distributers = [];
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $distributers[] = $row2;
    }
    mysqli_close($link);
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}

require_once '../layout/header.php';
?>

<div class="row">
    <div class="col-sm-4" style="font-size: 22px; font-weight: bold; color: #d9534f;">Add required component</div>
</div>
<div style="height: 40px;"></div>

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
                <button type="button" class="btn btn-success" id="add_manu">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="dist">Distributer</label>
                <div class="col-sm-3" >
                    <select id="dist" name="distribter" class="form-control">
                        <option value="" selected disabled>-- select distributer --</option>
                        <?php
                        foreach ($distributers as $key => $value) {
                            echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                        }
                        ?>
                    </select> 
                </div>
                <div class="col-sm-1" style="padding: 0px;">
                    <button type="button" class="btn btn-success" id="add_dist">
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
            <label class="control-label col-sm-offset-1 col-sm-2" for="dist-num">Distributer Part-num</label>
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
                <input type="text" id="resp-user" name="resp_user" class="form-control">
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
            <a href="http://localhost/EwestStore/required.php" class="btn btn-info">Back to required</a>
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
<div id="dialog_add_dist" title="Add Distributer" style="display: none" class="col-xs-12">
    <form class="form-horizontal" id="distributerForm">
        <div class="form-group">
            <label class="control-label col-sm-4" for="distributer">Distributer</label>
            <div class="col-sm-8">
                <input type="text" id="distributer" name="distributer" class="form-control">
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

<?php require_once '../layout/footer.php'; ?>