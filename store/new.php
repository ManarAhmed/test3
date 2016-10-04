<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once '../db/connection.php';
    $query1 = "select id,name from manufacturer";
    $query2 = "select id,name from distributer";
    $query3 = "select id,location from company_branch";
    $result1 = mysqli_query($link, $query1);
    $result2 = mysqli_query($link, $query2);
    $result3 = mysqli_query($link, $query3);
    $manufacturers = [];
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $manufacturers[] = $row1;
    }
    $distributers = [];
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $distributers[] = $row2;
    }
    $branches = [];
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $branches[] = $row3;
    }
    mysqli_close($link);
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}

require_once '../layout/header.php';
?>

<div class="row">
    <div class="col-sm-6" style="font-size: 22px; font-weight: bold; color: #d9534f;">Add stored component</div>
</div>
<div style="height: 40px;"></div>

<form id="storedForm">
    <div class="row">
        <div class="form-group">
            <label class="control-label col-sm-2" for="manu">Manufacturer</label>
            <div class="col-sm-3 col-sm-3">
                <select id="manu" name="manufacturer" class="form-control">
                    <option value="" selected disabled>-- select manufacturer --</option>
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
                <button type="button" class="btn btn-plus" id="add_manu">
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
                    <button type="button" class="btn btn-plus" id="add_dist">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group" style="margin-top: 15px;">
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
        <div class="form-group" style="margin-top: 15px;">
            <label class="control-label col-sm-2" for="package">Package</label>
            <div class="col-sm-3">
                <input type="text" id="package" name="package" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-offset-1 col-sm-2" for="quantity">Quantity</label>
            <div class="col-sm-3">
                <input type="number" min="0" step="1" id="quantity" name="quantity" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group" style="margin-top: 15px;">
            <label class="control-label col-sm-2" for="drawer_num">Drawer Number</label>
            <div class="col-sm-3">
                <input type="number" min="1" step="1" id="drawer_num" name="drawer_num" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-offset-1 col-sm-2" for="threshold">Threshold</label>
            <div class="col-sm-3">
                <input type="number" min="0" step="1" id="threshold" name="threshold" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group" style="margin-top: 15px;">
            <label class="control-label col-sm-2" for="branch">Company Branch</label>
            <div class="col-sm-3" >
                <select id="branch" name="branch" class="form-control">
                    <option value="" selected disabled>-- select branch --</option>
                    <?php
                    foreach ($branches as $key => $value) {
                        echo "<option value='" . $value['id'] . "'>" . $value['location'] . "</option>";
                    }
                    ?>
                </select> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group"  style="margin-top: 15px;">        
            <div class="col-sm-offset-2 col-sm-6 col-md-6">
                <input type="button" value="Submit" id="submit_stored" class="btn btn-success" name="submit_stored">
                <a href="http://localhost/EwestStore/store.php" class="btn btn-info">Back to store</a>
            </div>
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
<?php require_once '../layout/footer.php'; ?>