<?php

require_once './connection.php';
//'component_id', 'added_quantity', 'pulled_quantity', 'add_date', 'pull_date'

//print_r($_REQUEST);exit;
if (isset($_REQUEST['add_log']) || isset($_REQUEST['update_log'])) {
    $component_id = mysqli_real_escape_string($link, $_REQUEST['component_id']);
    $added_quantity = mysqli_real_escape_string($link, $_REQUEST['added_quantity']);
    $pulled_quantity = mysqli_real_escape_string($link, $_REQUEST['pulled_quantity']);
    $add_date = $_REQUEST['add_date'];
    $pull_date = $_REQUEST['pull_date'];
    

    if (isset($_REQUEST['add_log'])) {
        $query = "INSERT INTO log_component(component_id, added_quantity, pulled_quantity, add_date, pull_date)"
                . " VALUES ($component_id,$added_quantity,$pulled_quantity,$add_date,$pull_date)";
    } elseif (isset($_REQUEST['update_log'])) {
        $id = mysqli_real_escape_string($link, $_REQUEST['id']);
        $query = "UPDATE log_component SET"
                . " component_id = $component_id, added_quantity = $added_quantity, pulled_quantity = '$pulled_quantity',"
                . " add_date = '$add_date', pull_date = '$pull_date' WHERE id = $id";
    }
} elseif (isset($_REQUEST["delete"])) {
    $id = mysqli_real_escape_string($link, $_REQUEST['id']);
    $query = "DELETE FROM log_component WHERE component_id = $component_id";
} else {
    print_r('proplem');
    exit;
}

if (mysqli_query($link, $query)) {
    if (isset($_REQUEST['log_component_log_componentd'])) {
        echo "New record created successfully";
    } elseif (isset($_REQUEST['update_log'])) {
        echo "Record updated successfully";
    } elseif (isset($_REQUEST['delete'])) {
        echo "Record deleted successfully";
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($link);
}
mysqli_close($link);