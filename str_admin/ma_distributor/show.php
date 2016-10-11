<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") {
    require_once '../../db/connection.php';
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

require_once '../admin_layout/header.php';
if (!empty($data)) {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-sitemap"></i> Distribtors</h3>
        </div>
    </div>
    <section class="panel">
        <header class="panel-heading">
            <h3>Distributor [<?php echo $data[0]['name'] ?>]</h3>

        </header>
        <div class="panel-body">
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
            <a href="http://localhost/EwestStore/str_admin/ma_distributor/index.php" class="btn btn-info">Back to distributors</a>
        </div>
    </section>


    <?php
} else {
    echo '<p style="font-weight: bold; font-size: 24px;">This distributor is not found.</p>';
}
require_once '../admin_layout/footer.php';
?>