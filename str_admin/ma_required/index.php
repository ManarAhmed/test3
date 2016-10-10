<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../../db/connection.php';
    $query = "select r.id,m.name as manufacturer, d.name as distributor, r.manu_part_num, r.dist_part_num,"
            . " r.package, r.required_quantity, r.responsable_user, r.project, r.priority, r.due_date "
            . "from required r, manufacturer m, distributor d "
            . "where d.id = r.distributor and m.id = r.manufacturer";
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

$priorities = ['Very Low', 'Low', 'Medium', 'Heigh', 'Very Heigh'];
require_once '../admin_layout/header.php';
?>
<section class="panel">
    <header class="panel-heading">
        <h3>Required components</h3>
    </header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
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
                        . '<a href="http://localhost/EwestStore/str_admin/ma_required/show.php?id=' . $value['id'] . '"  class="btn btn-success" name="show" style="margin:5px;">show</a>'
                        . '<a href="http://localhost/EwestStore/str_admin/ma_required/edit.php?id=' . $value['id'] . '" class="btn btn-warning" name="update" style="margin:5px;">Edit</a>'
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
    </div>
</section>

<?php
require_once '../admin_layout/footer.php';