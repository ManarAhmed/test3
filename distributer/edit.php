<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once '../db/connection.php';
    $query = 'select * from distributer where id =' . $_GET["id"];
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
        <div class="col-sm-6" style="font-size: 22px; font-weight: bold; color: #d9534f;">Edit distributer</div>
    </div>
    <div style="height: 40px;"></div>

    <form class="form-horizontal" id="distributerForm">

        <input type="hidden" id="dist_id" name="dist_id" class="form-control" value="<?php echo $data[0]['id'] ?>">
        <div class="form-group">
            <label class="control-label col-sm-2" for="distributer">Distributer</label>
            <div class="col-sm-6">
                <input type="text" id="distributer" name="distributer" class="form-control" value="<?php echo $data[0]['name'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="dist_website">Distributer</label>
            <div class="col-sm-6">
                <input type="text" id="dist_website" name="dist_website" class="form-control" value="<?php echo $data[0]['website'] ?>">
            </div>
        </div>
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-6">
                <input type="button" value="Update" id="update_dist" class="btn btn-success" name="update_dist">
                <a href="http://localhost/EwestStore/distributer.php" class="btn btn-info">Back</a>
            </div>
        </div>

    </form>

    <?php
} else {
    echo '<p style="font-weight: bold; font-size: 24px;">This distributer is not found.</p>';
}
require_once '../layout/footer.php';
?>