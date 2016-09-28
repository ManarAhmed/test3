<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once '../db/connection.php';
    $query = 'select * from store where id =' . $_GET["id"];
    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

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
    <div class="col-sm-6" style="font-size: 22px; font-weight: bold; color: #d9534f;">Edit stored component</div>
</div>
<div style="height: 40px;"></div>

<form id="storedForm">
    <input type="hidden" id="stored_id" name="stored_id" class="form-control" value="<?php echo $data[0]['id'] ?>">
    <div class="row">
        <div class="form-group">
            <label class="control-label col-sm-2" for="manu">Manufacturer</label>
            <div class="col-sm-3">
                <select id="manu" name="manufacturer" class="form-control">
                    <option value="" selected disabled>-- select manufacturer --</option>
                    <?php
                    foreach ($manufacturers as $key => $value) {
                        if ($value['id'] == $data[0]['manu_id']) {
                            echo "<option value='" . $value['id'] . "' selected>" . $value['name'] . "</option>";
                        } else {
                            echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                        }
                    }
                    ?>
                </select> 
            </div>
        </div>
        <div class="form-group" style="margin-top: -10px;">
            <label class="control-label col-sm-offset-1 col-sm-2" for="dist">Distributer</label>
            <div class="col-sm-3">
                <select id="dist" name="distribter" class="form-control">
                    <option value="" selected disabled>-- select distributer --</option>
                    <?php
                    foreach ($distributers as $key => $value) {
                        if ($value['id'] == $data[0]['dist_id']) {
                            echo "<option value='" . $value['id'] . "' selected>" . $value['name'] . "</option>";
                        } else {
                            echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                        }
                    }
                    ?>
                </select> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group" style="margin-top: 15px;">
            <label class="control-label col-sm-2" for="manu-num">Manufacturer Part-num</label>
            <div class="col-sm-3">
                <input type="text" id="manu-num" name="manu_num" class="form-control" value="<?php echo $data[0]['manu_part_num'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-offset-1 col-sm-2" for="dist-num">Distributer Part-num</label>
            <div class="col-sm-3">
                <input type="text" id="dist-num" name="dist_num" class="form-control" value="<?php echo $data[0]['dist_part_num'] ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group" style="margin-top: 15px;">
            <label class="control-label col-sm-2" for="package">Package</label>
            <div class="col-sm-3">
                <input type="text" id="package" name="package" class="form-control" value="<?php echo $data[0]['package'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-offset-1 col-sm-2" for="quantity">Quantity</label>
            <div class="col-sm-3">
                <input type="number" min="0" step="1" id="quantity" name=" quantity" class="form-control" value="<?php echo $data[0]['quantity'] ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group" style="margin-top: 15px;">
            <label class="control-label col-sm-2" for="drawer_num">Drawer Number</label>
            <div class="col-sm-3">
                <input type="number" min="1" step="1" id="drawer_num" name="drawer_num" class="form-control" value="<?php echo $data[0]['drawer_num'] ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-3" style="margin-top: 15px;">
                <input type="button" value="Update" id="update_stored" class="btn btn-success" name="update_stored">
                <a href="http://localhost/EwestStore/store.php" class="btn btn-info">Back</a>
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
<?php require_once '../layout/footer.php'; ?>