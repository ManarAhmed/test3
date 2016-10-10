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
    <section class="panel">
        <header class="panel-heading">
            <h3>Edit distributor</h3>

        </header>
        <div class="panel-body">
            <form class="form-horizontal" id="distributorForm">

                <input type="hidden" id="dist_id" name="dist_id" class="form-control" value="<?php echo $data[0]['id'] ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="distributor">distributor</label>
                    <div class="col-sm-6">
                        <input type="text" id="distributor" name="distributor" class="form-control" value="<?php echo $data[0]['name'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="dist_website">distributor</label>
                    <div class="col-sm-6">
                        <input type="text" id="dist_website" name="dist_website" class="form-control" value="<?php echo $data[0]['website'] ?>">
                    </div>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-6">
                        <input type="button" value="Update" id="update_dist" class="btn btn-success" name="update_dist">
                        <a href="http://localhost/EwestStore/str_admin/ma_distributor/index.php" class="btn btn-info">Back</a>
                    </div>
                </div>

            </form>
        </div>
    </section>
    <?php
} else {
    echo '<p style="font-weight: bold; font-size: 24px;">This distributor is not found.</p>';
}
require_once '../admin_layout/footer.php';