<?php

require_once './connection.php';

//print_r($_REQUEST);exit;
if (isset($_REQUEST['store']) || isset($_REQUEST['update'])) {
    $manufacturer = mysqli_real_escape_string($link, $_REQUEST['manufacturer']);
    $distributer = mysqli_real_escape_string($link, $_REQUEST['distribter']);
    $manu_part_num = mysqli_real_escape_string($link, $_REQUEST['manu_num']);
    $dist_part_num = mysqli_real_escape_string($link, $_REQUEST['dist_num']);
    $package = mysqli_real_escape_string($link, $_REQUEST['package']);
    $required_quantity = mysqli_real_escape_string($link, $_REQUEST['req_quantity']);
    $responsable_user = mysqli_real_escape_string($link, $_REQUEST['resp_user']);
    $project = mysqli_real_escape_string($link, $_REQUEST['project']);
    $priority = mysqli_real_escape_string($link, $_REQUEST['priority']);
    $due_date = mysqli_real_escape_string($link, $_REQUEST['due_date']);

    if (isset($_REQUEST['store'])) {
        $query = "INSERT INTO required(manufacturer, distributer, manu_part_num, dist_part_num, package, required_quantity, responsable_user, project, priority, due_date)"
                . " VALUES ('$manufacturer','$distributer','$manu_part_num','$dist_part_num','$package',$required_quantity,'$responsable_user','$project',$priority,'$due_date')";
    } elseif (isset($_REQUEST['update'])) {
        $id = mysqli_real_escape_string($link, $_REQUEST['id']);
        $query = "UPDATE required SET"
                . " manufacturer = $manufacturer, distributer = $distributer, manu_part_num = '$manu_part_num',"
                . " dist_part_num = '$dist_part_num', package = '$package', required_quantity = $required_quantity,"
                . "responsable_user = '$responsable_user', project = '$project', priority = $priority, "
                . "due_date = '$due_date' WHERE id =" . $id;
    }
} elseif (isset($_REQUEST["delete"])) {
    $id = mysqli_real_escape_string($link, $_REQUEST['id']);
    $query = "DELETE FROM required WHERE id = " . $id;
} elseif (isset($_REQUEST["find"])) {
    $query = "select id from required where manu_part_num = '" . $manu_part_num . "'";
} else {
    print_r('proplem');
    exit;
}
$result = mysqli_query($link, $query);
$d = [];
while ($row = mysqli_fetch_assoc($result)) {
    $d[] = $row;
}

if ($result) {
    if (isset($_REQUEST['store'])) {
        echo "New record created successfully";
    } elseif (isset($_REQUEST['update'])) {
        echo "Record updated successfully";
    } elseif (isset($_REQUEST['delete'])) {
        echo "Record deleted successfully";
    } elseif (isset($_REQUEST['find'])) {
        echo $d[0]['id'];
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($link);
}
mysqli_close($link);
