<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../../db/connection.php';
    $query = "select * from store";
    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
//    print_r($data);exit;
    mysqli_close($link);
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}

require_once '../admin_layout/header.php';
?> 
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-cubes"></i> Store</h3>
    </div>
</div>
<section class="panel">
    <header class="panel-heading">
        <h3>Store</h3>
    </header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Manufacturer Part-num</th>
                        <th class="text-center">Package</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Drawer number</th>
                        <th class="text-center" colspan="5"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $key => $value) {
                        if ($value['quantity'] < $value['threshold']) {
                            echo'<tr style="background-color: #ffaa99">';
                        } else {
                            echo'<tr>';
                        }

                        echo '<td class="text-center">' . $value['id'] . '</td>';
                        echo '<td class="text-center" id="manu_part_num" >' . $value['manu_part_num'] . '</td>';
                        echo '<td class="text-center" >' . $value['package'] . '</td>';
                        echo '<td class="text-center" id="td_quantity_' . $value['id'] . '">' . $value['quantity'] . '</td>';
                        echo '<td class="text-center" >' . $value['drawer_num'] . '</td>';
                        echo '<td class="text-center" nowrap>'
                        . '<a href="http://localhost/EwestStore/str_admin/ma_store/show.php?id=' . $value['id'] . '"  class="btn btn-info" name="show" style="margin:5px;">show</a>'
                        . '<input type="button" id="' . $value['id'] . '" class="btn btn-success btn_add_component" name="btn_add_component" value="Add" style="margin:5px;">'
                        . '<input type="button" id="' . $value['id'] . '" class="btn btn-warning btn_pull_component" name="btn_pull_component" value="Pull" style="margin:5px;">'
                        . '<input type="button" id="' . $value['id'] . '" class="btn btn-danger delete_stored" name="delete_stored" value="Delete" style="margin:5px;">
'
                        . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <!-- Dialog -->
        <div id="dialog-confirm" title="Delete Stored component?" style="display: none">
            <p style="font-size: 16px; "><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>These item will be permanently deleted and cannot be recovered.<br><h4>Are you sure?</h4></p>
        </div>
        <!-- Dialog -->
        <div id="dialog-add-component" title="Add component" style="display: none">
            <p style="font-size: 16px; "></p>
            <form>
                <label for="added_quantity">Quantity Added</label>
                <input type="number" min="1" step="1" id="added_quantity" name="added_quantity">
            </form>
        </div>

        <!-- Dialog -->
        <div id="dialog-pull-component" title="Pull component" style="display: none">
            <p style="font-size: 16px; "></p>
            <form>
                <fieldset>
                    <label for="pulled_quantity">Quantity Pulled</label>
                    <input type="number" min="1" step="1" id="pulled_quantity" name="pulled_quantity">
                </fieldset>
            </form>
        </div>
    </div>
</section>

<?php
require_once '../admin_layout/footer.php';
