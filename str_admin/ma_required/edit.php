<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../../db/connection.php';
    $query = 'select * from required where id =' . $_GET["id"];
    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

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

$priorities = ['Very Low', 'Low', 'Medium', 'Heigh', 'Very Heigh'];
require_once '../admin_layout/header.php';
if (!empty($data)) {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-shopping-cart"></i> Required Component</h3>
        </div>
    </div>
    <section class="panel">
        <header class="panel-heading">
            <h3>Edit required component</h3>

        </header>
        <div class="panel-body">
            <form id="requiredForm">
                <input type="hidden" id="required_id" name="required_id" class="form-control" value="<?php echo $data[0]['id'] ?>">
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="manu">Manufacturer</label>
                        <div class="col-sm-3">
                            <select id="manu" name="manufacturer" class="form-control">
                                <option value="" selected disabled>-- select manufacturer --</option>
                                <?php
                                foreach ($manufacturers as $key => $value) {
                                    if ($value['id'] == $data[0]['manufacturer']) {
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
                            <button type="button" class="btn btn-plus" id="add_manu_edit_required">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="dist">distributor</label>
                            <div class="col-sm-3">
                                <select id="dist" name="distribter" class="form-control">
                                    <option value="" selected disabled>-- select distributor --</option>
                                    <?php
                                    foreach ($distributors as $key => $value) {
                                        if ($value['id'] == $data[0]['distributor']) {
                                            echo "<option value='" . $value['id'] . "' selected>" . $value['name'] . "</option>";
                                        } else {
                                            echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <div class="col-sm-1" style="padding: 0px;">
                            <button type="button" class="btn btn-plus" id="add_dist_edit_required">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" style="margin-top:15px;">
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
                    <div class="form-group" style="margin-top:15px;">
                        <label class="control-label col-sm-2" for="package">Package</label>
                        <div class="col-sm-3">
                            <input type="text" id="package" name="package" class="form-control" value="<?php echo $data[0]['package'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-offset-1 col-sm-2" for="req-quantity">Required Quantity</label>
                        <div class="col-sm-3">
                            <input type="number" min="0" step="1" id="req-quantity" name=" req_quantity" class="form-control" value="<?php echo $data[0]['required_quantity'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" style="margin-top:15px;">
                        <label class="control-label col-sm-2" for="resp-user">Responsible User</label>
                        <div class="col-sm-3">
                            <input type="text" id="resp-user" name="resp_user" class="form-control"  value="<?php echo $_SESSION['username']; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-offset-1 col-sm-2" for="project">Project</label>
                        <div class="col-sm-3">
                            <input type="text" id="project" name="project" class="form-control" value="<?php echo $data[0]['project'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" style="margin-top:15px;">
                        <label class="control-label col-sm-2" for="priority">Priority</label>
                        <div class="col-sm-3">
                            <select id="priority" name="priority" class="form-control">
                                <option value="" selected disabled>-- select priority --</option>
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($data[0]['priority'] == $i) {
                                        echo "<option value='" . $i . "' selected>" . $priorities[$i - 1] . "</option>";
                                    } else {
                                        echo "<option value='" . $i . "'>" . $priorities[$i - 1] . "</option>";
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-offset-1 col-sm-2" for="due-date">Due to date</label>
                        <div class="col-sm-3">
                            <input type="text" id="due-date" name="due_date" class="form-control" value="<?php echo $data[0]['due_date'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" style="margin-top:15px;">        
                        <div class="col-sm-offset-2 col-sm-3">
                            <input type="button" value="Update" id="update" class="btn btn-success" name="update">
                            <a href="http://localhost/EwestStore/str_admin/ma_required/index.php" class="btn btn-info">Back</a>
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
    echo '<p style="font-weight: bold; font-size: 24px;">This required component is not found.</p>';
}require_once '../admin_layout/footer.php';

