<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once './db/connection.php';
    $query = "select r.id,m.name as manufacturer, d.name as distributer, r.manu_part_num, r.dist_part_num,"
            . " r.package, r.required_quantity, r.responsable_user, r.project, r.priority, r.due_date "
            . "from required r, manufacturer m, distributer d "
            . "where d.id = r.distributer and m.id = r.manufacturer";
    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
//    echo '<pre>';print_r($data);
//        echo '</pre>';
//        exit;
    mysqli_close($link);
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}

$priorities = ['Very Low', 'Low', 'Medium', 'Heigh', 'Very Heigh'];
require_once './layout/header.php';
?>

<div class="row">
    <div class="col-sm-offset-4 col-sm-4 text-center" style="font-size: 22px; font-weight: bold; color: #d9534f;">Required</div>
</div>
<div style="height: 30px;"></div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
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
            foreach ($data as $key => $value) {
                $date = strtotime($value['due_date'], time());
                $now = time();
                if ($now > $date) {
                    echo'<tr class="danger">';
                } else {
                    echo'<tr>';
                }
                echo '<td class="text-center" >' . $value['id'] . '</td>';
                echo '<td class="text-center" >' . $value['manu_part_num'] . '</td>';
                echo '<td class="text-center" >' . $value['package'] . '</td>';
                echo '<td class="text-center" >' . $value['required_quantity'] . '</td>';
                echo '<td class="text-center" >' . $value['project'] . '</td>';
                echo '<td class="text-center" >' . $priorities[$value['priority'] - 1] . '</td>';
                echo '<td class="text-center" >' . $value['due_date'] . '</td>';

                echo '<td class="text-center" nowrap>'
                . '<a href="http://localhost/EwestStore/required/show.php?id=' . $value['id'] . '"  class="btn btn-success" name="show" style="margin:5px;">show</a>'
                . '<a href="http://localhost/EwestStore/required/edit.php?id=' . $value['id'] . '" class="btn btn-warning" name="update" style="margin:5px;">Edit</a>'
                . '<input type="button" id="' . $value['id'] . '" class="btn btn-danger delete" name="delete" value="Delete" style="margin:5px;">'
                . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Dialog -->
<div id="dialog-confirm" title="Delete required component?" style="display: none">
    <p style="font-size: 16px; ">
        <span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
        These item will be permanently deleted and cannot be recovered.
    </p><br><h4>Are you sure?</h4>

</div>

<?php require_once './layout/footer.php'; ?>