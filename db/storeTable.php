<?php

require_once './connection.php';

//print_r($_REQUEST);exit;
if (isset($_REQUEST['submit_stored']) || isset($_REQUEST['update_stored'])) {
    $manufacturer = mysqli_real_escape_string($link, $_REQUEST['manufacturer']);
    $distributer = mysqli_real_escape_string($link, $_REQUEST['distribter']);
    $manu_part_num = mysqli_real_escape_string($link, $_REQUEST['manu_num']);
    $dist_part_num = mysqli_real_escape_string($link, $_REQUEST['dist_num']);
    $package = mysqli_real_escape_string($link, $_REQUEST['package']);
    $quantity = mysqli_real_escape_string($link, $_REQUEST['quantity']);
    $drawer_num = mysqli_real_escape_string($link, $_REQUEST['drawer_num']);
    $threshold = mysqli_real_escape_string($link, $_REQUEST['threshold']);
    $branch_id = mysqli_real_escape_string($link, $_REQUEST['branch_id']);

    if (isset($_REQUEST['submit_stored'])) {
        $query = "INSERT INTO store(manu_id, dist_id, manu_part_num, dist_part_num, package, quantity, drawer_num, threshold, branch_id)"
                . " VALUES ('$manufacturer','$distributer','$manu_part_num','$dist_part_num','$package',$quantity,$drawer_num, $threshold,$branch_id)";
    } elseif (isset($_REQUEST['update_stored'])) {
        $id = mysqli_real_escape_string($link, $_REQUEST['id']);
        $query = "UPDATE store SET"
                . " manu_id = $manufacturer, dist_id = $distributer, manu_part_num = '$manu_part_num',"
                . " dist_part_num = '$dist_part_num', package = '$package', quantity = $quantity,"
                . " drawer_num = $drawer_num, threshold = $threshold, branch_id = $branch_id"
                . " WHERE id = $id";
    }
}elseif (isset($_REQUEST["update_quantity"])) {
    $id = mysqli_real_escape_string($link, $_REQUEST['id']);
    $new_quantity = mysqli_real_escape_string($link, $_REQUEST['new_quantity']);
    $query = "UPDATE store SET quantity = $new_quantity WHERE id = $id";
} elseif (isset($_REQUEST["delete"])) {
    $id = mysqli_real_escape_string($link, $_REQUEST['id']);
    $query = "DELETE FROM store WHERE id = $id";
} else {
    print_r('proplem');
    exit;
}

if (mysqli_query($link, $query)) {
    if (isset($_REQUEST['store_stored'])) {
        echo "New record created successfully";
    } elseif (isset($_REQUEST['update_stored'])) {
        echo "Record updated successfully";
    } elseif (isset($_REQUEST['delete'])) {
        echo "Record deleted successfully";
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($link);
}
mysqli_close($link);
