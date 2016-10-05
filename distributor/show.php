<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once '../db/connection.php';
    $query = 'select * from distributor where id =' . $_GET["id"];
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

require_once '../layout/header.php';
if (!empty($data)) {
    ?>

    <div class="row">
        <div style="font-size: 22px; font-weight: bold; color: #d9534f;">distributor: <?php echo $data[0]['name'] ?></div>
    </div>
    <div style="height: 30px;"></div>

    <div class="table-responsive">
        <table class="table table-striped">

            <tr>
                <th class="text-left">ID</th>
                <td class="text-left"><?php echo $data[0]['id'] ?></td>
            </tr>
            <tr>
                <th class="text-left">distributor</th>
                <td class="text-left"><?php echo $data[0]['name'] ?></td>
            </tr>
            <tr>
                <th class="text-left">Website</th>
                <td class="text-left"><?php echo $data[0]['website'] ?></td>
            </tr>
            <tr>
                <th class="text-left" colspan="3"></th>
            </tr>

        </table>
    </div>
    <a href="http://localhost/EwestStore/distributor.php" class="btn btn-info">Back to distributors</a>

    <?php
} else {
    echo '<p style="font-weight: bold; font-size: 24px;">This distributor is not found.</p>';
}
require_once '../layout/footer.php';
?>