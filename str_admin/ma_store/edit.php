<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../../db/connection.php';
    $query = 'select * from store where id =' . $_GET["id"];
    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    $query1 = "select id,name from manufacturer";
    $query2 = "select id,name from distributor";
    $query3 = "select id,location from company_branch";
    $result1 = mysqli_query($link, $query1);
    $result2 = mysqli_query($link, $query2);
    $result3 = mysqli_query($link, $query3);
    $manufacturers = [];
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $manufacturers[] = $row1;
    }
    $distributors = [];
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $distributors[] = $row2;
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

require_once '../admin_layout/header.php';
if (!empty($data)) {
    ?>
    <section class="panel">
        <header class="panel-heading">
            <h3>Edit stored component</h3>
        </header>
        <div class="panel-body">
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
                    <div style="margin-top: -15px;">
                        <div class="col-sm-1" style="padding: 0px;">
                            <button type="button" class="btn btn-plus" id="add_manu_edit">
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
                                        if ($value['id'] == $data[0]['dist_id']) {
                                            echo "<option value='" . $value['id'] . "' selected>" . $value['name'] . "</option>";
                                        } else {
                                            echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select> 
                            </div>
                            <div class="col-sm-1" style="padding: 0px;">
                                <button type="button" class="btn btn-plus" id="add_dist_edit">
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
                            <input type="text" id="manu-num" name="manu_num" class="form-control" value="<?php echo $data[0]['manu_part_num'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-offset-1 col-sm-2" for="dist-num">distributor Part-num</label>
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
                    <div class="form-group">
                        <label class="control-label col-sm-offset-1 col-sm-2" for="threshold">Threshold</label>
                        <div class="col-sm-3">
                            <input type="number" min="0" step="1" id="threshold" name="threshold" class="form-control" value="<?php echo $data[0]['threshold'] ?>">
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
                                    if ($value['id'] == $data[0]['branch_id']) {
                                        echo "<option value='" . $value['id'] . "' selected>" . $value['location'] . "</option>";
                                    } else {
                                        echo "<option value='" . $value['id'] . "'>" . $value['location'] . "</option>";
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-3" style="margin-top: 15px;">
                            <input type="button" value="Update" id="update_stored" class="btn btn-success" name="update_stored">
                            <a href="http://localhost/EwestStore/str_admin/ma_store/show.php?id=<?php echo $data[0]['id'] ?>" class="btn btn-info">Back</a>
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
} else {
    echo '<p style="font-weight: bold; font-size: 24px;">This stored component is not found.</p>';
}
require_once '../admin_layout/footer.php';