<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../../db/connection.php';
    $query = "SELECT s.id, s.manu_id, s.dist_id, m.name AS manufacturer, d.name AS distributor, s.manu_part_num, "
            . "s.dist_part_num, s.package, s.quantity, s.drawer_num, s.threshold, c.location "
            . "FROM store s, manufacturer m, distributor d, company_branch c "
            . "WHERE d.id = s.dist_id AND m.id = s.manu_id AND c.id = s.branch_id AND s.id = " . $_GET["id"];

    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    mysqli_close($link);
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}

require_once '../admin_layout/header.php';
if (!empty($data)) {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-cubes"></i> Store</h3>
        </div>
    </div>
    <section class="panel">
        <header class="panel-heading">
            <h3>Stored component [<?php echo $data[0]['manu_part_num'] ?>]</h3>

        </header>
        <div class="panel-body">
            <input type="hidden" value="<?php echo $_SESSION['username']; ?>" id="username">
            <div class="table-responsive">
                <table class="table table-striped">

                    <tr>
                        <th class="text-left">ID</th>
                        <td class="text-left"><?php echo $data[0]['id'] ?></td>
                    </tr>
                    <tr class="manufacturer">
                        <th class="text-left">Manufacturer</th>
                        <td class="text-left" id="<?php echo $data[0]['manu_id'] ?>"><?php echo $data[0]['manufacturer'] ?></td>
                    </tr>
                    <tr class="distributor">
                        <th class="text-left">distributor</th>
                        <td class="text-left" id="<?php echo $data[0]['dist_id'] ?>"><?php echo $data[0]['distributor'] ?></td>
                    </tr>
                    <tr class="manu_part_num">
                        <th class="text-left">Manufacturer Part-num</th>
                        <td class="text-left"><?php echo $data[0]['manu_part_num'] ?></td>
                    </tr>
                    <tr class="dist_part_num">
                        <th class="text-left">distributor Part-num</th>
                        <td class="text-left"><?php echo $data[0]['dist_part_num'] ?></td>
                    </tr>
                    <tr class="package">
                        <th class="text-left">Package</th>
                        <td class="text-left"><?php echo $data[0]['package'] ?></td>
                    </tr>
                    <tr class="quantity">
                        <th class="text-left">Quantity</th>
                        <td class="text-left"><?php echo $data[0]['quantity'] ?></td>
                    </tr>
                    <tr>
                        <th class="text-left">Drawer Number</th>
                        <td class="text-left"><?php echo $data[0]['drawer_num'] ?></td>
                    </tr>
                    <tr>
                        <th class="text-left">Threshold</th>
                        <td class="text-left"><?php echo $data[0]['threshold'] ?></td>
                    </tr>
                    <tr>
                        <th class="text-left">Company Branch</th>
                        <td class="text-left"><?php echo $data[0]['location'] ?></td>
                    </tr>
                </table>
            </div>
            <a href="http://localhost/EwestStore/str_admin/ma_store/edit.php?id=<?php echo $data[0]['id']; ?>" class="btn btn-warning" name="update" style="margin:5px;">Edit</a>
            <input type="button" id="<?php echo $data[0]['id']; ?>" class="btn btn-success btn_require" name="btn_require" value="Require" style="margin:5px; background-color: #007fff;">
            <input type="button" id="<?php echo $data[0]['id']; ?>" class="btn btn-danger delete_stored" name="delete_stored" value="Delete" style="margin:5px;">
            <a href="http://localhost/EwestStore/str_admin/ma_store/index.php" class="btn btn-info">Back to store</a>

            <!-- Dialog -->
            <div id="dialog-confirm" title="Delete Stored component?" style="display: none">
                <p style="font-size: 16px; "><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>These item will be permanently deleted and cannot be recovered.<br><h4>Are you sure?</h4></p>
            </div>

            <!-- Dialog -->
            <div id="dialog-require-component" title="Add required component" style="display: none">
                <p style="font-size: 16px; "></p>
                <form>
                    <label for="added_quantity">Quantity needed</label>
                    <input type="number" min="1" step="1" id="require_quantity" name="require_quantity">
                    <br><br>
                    <label for="priority">Priority</label>
                    <select id="priority" name="priority" style="margin-left: 53px;">
                        <option value="" selected disabled>-- select priority --</option>
                        <option value="5">Very Heigh</option>
                        <option value="4">Heigh</option>
                        <option value="3">Medium</option>
                        <option value="2">Low</option>
                        <option value="1">Very Low</option>
                    </select> 
                </form>
            </div>
        </div>
    </section>

    <?php
} else {
    echo '<p style="font-weight: bold; font-size: 24px;">This stored component is not found.</p>';
}
require_once '../admin_layout/footer.php';
