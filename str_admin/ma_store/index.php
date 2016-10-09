<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "admin") {
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
    <div class="col-sm-offset-4 col-sm-4 text-center" style="font-size: 22px; font-weight: bold; color: #d9534f;">Store</div>
</div>
<div style="height: 30px;"></div>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr style="background-color: #ff7f00; color: #FFFFFF;">
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
                if($value['quantity'] < $value['threshold']){
                    echo'<tr style="background-color: #ffaa99">';
                }  else {
                     echo'<tr>';
                }
                
                echo '<td class="text-center">' . $value['id'] . '</td>';
                echo '<td class="text-center" id="manu_part_num" >' . $value['manu_part_num'] . '</td>';
                echo '<td class="text-center" >' . $value['package'] . '</td>';
                echo '<td class="text-center" id="td_quantity_' . $value['id'] . '">' . $value['quantity'] . '</td>';
                echo '<td class="text-center" >' . $value['drawer_num'] . '</td>';
                echo '<td class="text-center" nowrap>'
                . '<a href="http://localhost/EwestStore/store/show.php?id=' . $value['id'] . '"  class="btn btn-info" name="show" style="margin:5px;">show</a>'
                . '<a href="http://localhost/EwestStore/log_component/show.php?id=' . $value['id'] . '"  class="btn btn-warning" name="log" style="margin:5px;">Log Details</a>'
                . '<input type="button" id="' . $value['id'] . '" class="btn btn-success btn_add_component" name="btn_add_component" value="Add" style="margin:5px;">'
                . '<input type="button" id="' . $value['id'] . '" class="btn btn-danger btn_pull_component" name="btn_pull_component" value="Pull" style="margin:5px;">'
                . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
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
<?php require_once '../admin_layout/footer.php'; ?>