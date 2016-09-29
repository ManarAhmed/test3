<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once '../db/connection.php';
    $id = $_GET['id'];
    $query = "SELECT l.component_id, l.added_quantity, l.pulled_quantity, l.add_date, l.pull_date, s.manu_part_num "
            . "FROM log_component as l LEFT JOIN store as s "
            . "on s.id = $id AND l.component_id = $id";

    $result = mysqli_query($link, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
//    echo count($data);
//    echo '<pre>';print_r($data);echo '</pre>';exit;
    mysqli_close($link);
} else {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}
//'component_id', 'l.added_quantity', 'l.pulled_quantity', 'l.add_date', 'l.pull_date'

require_once '../layout/header.php';
if (!empty($data)) {
    ?>

    <div class="row">
        <div style="font-size: 22px; font-weight: bold; color: #d9534f;">Log Details for "<?php echo $data['0']['manu_part_num'] ?>"</div>
    </div>
    <div style="height: 30px;"></div>

    <div class="table-responsive">
        <table class="table table-striped">
            <?php
            foreach ($data as $key => $value) {
                if ($value['added_quantity'] == 1) {
                    echo '<tr class="success"><td class="text-left" style="font-size: 24;"><span style="font-weight: bold;">' . $value['added_quantity'] . '</span> piece added at <span style="font-weight: bold;"> ' . $value['add_date'] . '</span></td></tr>';
                } else if ($value['added_quantity'] > 1) {
                    echo '<tr class="success"><td class="text-left" style="font-size: 24;"><span style="font-weight: bold;">' . $value['added_quantity'] . '</span> pieces added at <span style="font-weight: bold;"> ' . $value['add_date'] . '</span></td></tr>';
                } else if ($value['pulled_quantity'] == 1) {
                    echo '<tr class="warning"><td class="text-left" style="font-size: 24;"><span style="font-weight: bold;">' . $value['pulled_quantity'] . '</span> piece pulled at <span style="font-weight: bold;">' . $value['pull_date'] . '</span></td></tr>';
                } else if ($value['pulled_quantity'] > 1) {
                    echo '<tr class="warning"><td class="text-left" style="font-size: 24;"><span style="font-weight: bold;">' . $value['pulled_quantity'] . '</span> pieces pulled at <span style="font-weight: bold;">' . $value['pull_date'] . '</span></td></tr>';
                }
            }
            ?>

        </table>
    </div>
    <a href="http://localhost/EwestStore/store.php" class="btn btn-info">Back to store</a>

    <?php
} else {
    echo '<p style="font-weight: bold; font-size: 24px;">There is no log details for this component</p>';
}require_once '../layout/footer.php';
?>