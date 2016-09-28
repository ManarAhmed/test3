<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once '../db/connection.php';
    $query = 'select r.id,m.name as manufacturer, d.name as distributer, r.manu_part_num, r.dist_part_num,'
            . ' r.package, r.required_quantity, r.responsable_user, r.project, r.priority, r.due_date'
            . ' from required r, manufacturer m, distributer d where d.id = r.distributer and m.id = r.manufacturer and r.id = ' . $_GET["id"];
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
require_once '../layout/header.php';
?>

<div class="row">
    <div style="font-size: 22px; font-weight: bold; color: #d9534f;">Required: <?php echo $data[0]['manu_part_num'] ?></div>
</div>
<div style="height: 30px;"></div>

<div class="table-responsive">
    <table class="table table-striped">

        <tr>
            <th class="text-left">ID</th>
            <td class="text-left"><?php echo $data[0]['id'] ?></td>
        </tr>
        <tr>
            <th class="text-left">Manufacturer</th>
            <td class="text-left"><?php echo $data[0]['manufacturer'] ?></td>
        </tr>
        <tr>
            <th class="text-left">Distributer</th>
            <td class="text-left"><?php echo $data[0]['distributer'] ?></td>
        </tr>
        <tr>
            <th class="text-left">Manufacturer Part-num</th>
            <td class="text-left"><?php echo $data[0]['manu_part_num'] ?></td>
        </tr>
        <tr>
            <th class="text-left">Distributer Part-num</th>
            <td class="text-left"><?php echo $data[0]['dist_part_num'] ?></td>
        </tr>
        <tr>
            <th class="text-left">Package</th>
            <td class="text-left"><?php echo $data[0]['package'] ?></td>
        </tr>
        <tr>
            <th class="text-left">Required Quantity</th>
            <td class="text-left"><?php echo $data[0]['required_quantity'] ?></td>
        </tr>
        <tr>
            <th class="text-left">Responsible User</th>
            <td class="text-left"><?php echo $data[0]['responsable_user'] ?></td>
        </tr>
        <tr>
            <th class="text-left">Project</th>
            <td class="text-left"><?php echo $data[0]['project'] ?></td>
        </tr>
        <tr>
            <th class="text-left">Priority</th>
            <td class="text-left"><?php echo $priorities[$data[0]['priority'] - 1] ?></td>
        </tr>
        <tr>
            <th class="text-left">Due to date</th>
            <td class="text-left"><?php echo $data[0]['due_date'] ?></td>
        </tr>
    </table>
</div>
<a href="http://localhost/EwestStore/required.php" class="btn btn-info">Back to required</a>
<?php require_once '../layout/footer.php'; ?>

