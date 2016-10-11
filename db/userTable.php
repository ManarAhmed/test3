<?php

require_once './connection.php';

//print_r($_REQUEST);exit;
if (isset($_REQUEST['add_user']) || isset($_REQUEST['update_user'])) {
    $name = mysqli_real_escape_string($link, $_REQUEST['name']);
    $user_name = mysqli_real_escape_string($link, $_REQUEST['user_name']);
    $email = mysqli_real_escape_string($link, $_REQUEST['email']);
    $password = password_hash(mysqli_real_escape_string($link, $_REQUEST['password']) , PASSWORD_DEFAULT);
    $gender = mysqli_real_escape_string($link, $_REQUEST['gender']);
    $position = mysqli_real_escape_string($link, $_REQUEST['position']);
    $role = mysqli_real_escape_string($link, $_REQUEST['role']);
   
    if (isset($_REQUEST['add_user'])) {
        $query = "INSERT INTO user(name, user_name, email, password, gender, position, role) VALUES ('$name','$user_name','$email','$password', '$gender','$position', '$role')";
    } elseif (isset($_REQUEST['update_user'])) {
        $id = mysqli_real_escape_string($link, $_REQUEST['id']);
        $query = "UPDATE user SET name = '$name', user_name ='$user_name', email = '$email', password = '$password', gender = '$gender', position = '$position', role = '$role' WHERE id = $id";
    }
} elseif (isset($_REQUEST["delete"])) {
    $id = mysqli_real_escape_string($link, $_REQUEST['id']);
    $query = "DELETE FROM user WHERE id = $id";
} else {
    print_r('proplem');
    exit;
}

if (mysqli_query($link, $query)) {
    if (isset($_REQUEST['add_user'])) {
        echo "New record created successfully";
    } elseif (isset($_REQUEST['update_user'])) {
        echo "Record updated successfully";
    } elseif (isset($_REQUEST['delete'])) {
        echo "Record deleted successfully";
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($link);
}
mysqli_close($link);