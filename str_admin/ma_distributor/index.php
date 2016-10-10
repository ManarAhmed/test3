<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../../db/connection.php';
    $query = "select * from distributor";
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
?> 
<section class="panel">
    <header class="panel-heading">
        <h3>Distributors</h3>

    </header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">distributor</th>
                        <th class="text-center">Website</th>
                        <th class="text-center" colspan="3"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $key => $value) {
                        echo'<tr>';
                        echo '<td class="text-center" >' . $value['id'] . '</td>';
                        echo '<td class="text-center" >' . $value['name'] . '</td>';
                        echo '<td class="text-center" >' . $value['website'] . '</td>';

                        echo '<td class="text-center" nowrap>'
                        . '<a href="http://localhost/EwestStore/str_admin/ma_distributor/show.php?id=' . $value['id'] . '"  class="btn btn-success" name="show" style="margin:5px;">show</a>'
                        . '<a href="http://localhost/EwestStore/str_admin/ma_distributor/edit.php?id=' . $value['id'] . '" class="btn btn-warning" name="update" style="margin:5px;">Edit</a>'
                        . '<input type="button" id="' . $value['id'] . '" class="btn btn-danger delete_distributor" name="delete_distributor" value="Delete" style="margin:5px;">'
                        . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Dialog -->
        <div id="dialog-confirm" title="Delete distributor?" style="display: none">
            <p style="font-size: 16px; "><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>These item will be permanently deleted and cannot be recovered.<br><h4>Are you sure?</h4></p>
        </div>
    </div>
</section>
<?php
require_once '../admin_layout/footer.php';
