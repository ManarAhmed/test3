<?php

require_once './connection.php';

//print_r($_REQUEST);exit;
if (isset($_REQUEST['submit_manu']) || isset($_REQUEST['update_manu'])) {
    $name = mysqli_real_escape_string($link, $_REQUEST['manufacturer']);
    $website = mysqli_real_escape_string($link, $_REQUEST['manu_website']);
   
    if (isset($_REQUEST['submit_manu'])) {
        $query = "INSERT INTO manufacturer(name, website) VALUES ('$name','$website')";
    } elseif (isset($_REQUEST['update_manu'])) {
        $id = mysqli_real_escape_string($link, $_REQUEST['id']);
        $query = "UPDATE manufacturer SET name = '$name', website = '$website' WHERE id = $id";
    }
} elseif (isset($_REQUEST["delete"])) {
    $id = mysqli_real_escape_string($link, $_REQUEST['id']);
    $query = "DELETE FROM manufacturer WHERE id = $id";
} else {
    print_r('proplem');
    exit;
}

if (mysqli_query($link, $query)) {
    if (isset($_REQUEST['submit_manu'])) {
        echo "New record created successfully";
    } elseif (isset($_REQUEST['update_manu'])) {
        echo "Record updated successfully";
    } elseif (isset($_REQUEST['delete'])) {
        echo "Record deleted successfully";
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($link);
}
mysqli_close($link);
