<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once './db/connection.php';
    $query = "select r.id,m.name as manufacturer, d.name as distributor, r.manu_part_num, r.dist_part_num,"
            . " r.package, r.required_quantity, r.responsable_user, r.project, r.priority, r.due_date "
            . "from required r, manufacturer m, distributor d "
            . "where d.id = r.distributor and m.id = r.manufacturer order by d.name";
    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    //gather each distributor request in array element
    $flag = 0;
    $flag2 = -1;
    $arr = [];
    for ($i = 0; $i < count($data); $i++) {
        if (!isset($arr[0][0]) || $arr[$flag][$flag2]['distributor'] === $data[$i]['distributor']) {
            $flag2 ++;
        } else {
            $flag++;
            $flag2 = 0;
        }
        $arr[$flag][$flag2] = $data[$i];
    }
    mysqli_close($link);
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}

$priorities = ['Very Low', 'Low', 'Medium', 'Heigh', 'Very Heigh'];
require_once './layout/header.php';
?>

<div class="row">
    <div class="col-sm-offset-4 col-sm-4 text-center" style="font-size: 22px; font-weight: bold; color: #d9534f;">Requests</div>
</div>
<div style="height: 30px;"></div>
<?php foreach ($arr as $key => $val) { ?>
    <h3 class="text-center" style="font-size: 22px; font-weight: bold; color: #FF0000;"><?php echo 'distributor ( ' . $val[$key]['distributor'] . ' ) requests'; ?></h3><br>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr style="background-color: rgb(255, 165, 0);">
                    <th class="text-center">ID</th>
                    <th class="text-center">Manufacturer Part-num</th>
                    <th class="text-center">Package</th>
                    <th class="text-center">Required Quantity</th>
                    <th class="text-center">Project</th>
                    <th class="text-center">Priority</th>
                    <th class="text-center">Due to date</th>
                    <th class="text-center" colspan="3"></th>
                </tr>

            </thead>
            <tbody>
                <?php
                foreach ($val as $key2 => $value2) {
                    $date = strtotime($value2['due_date'], time());
                    $now = time();
                    if ($now > $date) {
                        echo'<tr class="danger">';
                    } else {
                        echo'<tr>';
                    }
                    echo '<td class="text-center" >' . $value2['id'] . '</td>';
                    echo '<td class="text-center" >' . $value2['manu_part_num'] . '</td>';
                    echo '<td class="text-center" >' . $value2['package'] . '</td>';
                    echo '<td class="text-center" >' . $value2['required_quantity'] . '</td>';
                    echo '<td class="text-center" >' . $value2['project'] . '</td>';
                    echo '<td class="text-center" >' . $priorities[$value2['priority'] - 1] . '</td>';
                    echo '<td class="text-center" >' . $value2['due_date'] . '</td>';

                    echo '<td class="text-center" nowrap>'
                    . '<a href="http://localhost/EwestStore/required/show.php?id=' . $value2['id'] . '"  class="btn btn-success" name="show" style="margin:5px;">show</a>'
                    . '<a href="http://localhost/EwestStore/required/edit.php?id=' . $value2['id'] . '" class="btn btn-warning" name="update" style="margin:5px;">Edit</a>'
                    . '<input type="button" id="' . $value2['id'] . '" class="btn btn-danger delete" name="delete" value="Delete" style="margin:5px;">'
                    . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
        <a href=<?php echo "http://localhost/EwestStore/download.php?filename=".$val[$key]['distributor'];?> class="btn btn-success">download as excel sheet</a>

    <hr>
    <br>
<?php } ?>

<!-- Dialog -->
<div id="dialog-confirm" title="Delete required component?" style="display: none">
    <p style="font-size: 16px; ">
        <span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
        These item will be permanently deleted and cannot be recovered.
    </p><br><h4>Are you sure?</h4>

</div>

<?php require_once './layout/footer.php'; ?>