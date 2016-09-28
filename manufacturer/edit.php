<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    require_once '../db/connection.php';
    $query = 'select * from manufacturer where id =' . $_GET["id"];
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

// add page layout header
require_once '../layout/header.php';
?>

<div class="row">
    <div class="col-sm-6" style="font-size: 22px; font-weight: bold; color: #d9534f;">Edit manufacturer</div>
</div>
<div style="height: 40px;"></div>

<form class="form-horizontal" id="manufacturerForm">

    <input type="hidden" id="manu_id" name="manu_id" class="form-control" value="<?php echo $data[0]['id'] ?>">
    <div class="form-group">
        <label class="control-label col-sm-2" for="manufacturer">Manufacturer</label>
        <div class="col-sm-6">
            <input type="text" id="manufacturer" name="manufacturer" class="form-control" value="<?php echo $data[0]['name'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="manu_website">Website</label>
        <div class="col-sm-6">
            <input type="text" id="manu_website" name="manu_website" class="form-control" value="<?php echo $data[0]['website'] ?>">
        </div>
    </div>
    <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-6">
            <input type="button" value="Update" id="update_manu" class="btn btn-success" name="update_manu">
            <a href="http://localhost/EwestStore/manufacturer.php" class="btn btn-info">Back</a>
        </div>
    </div>

</form>
<?php
// add page layout footer
require_once '../layout/footer.php';
?>