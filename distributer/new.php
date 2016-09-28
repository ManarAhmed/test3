<?php 
session_start();
if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
    header('Location: http://localhost/EwestStore/user/login.php');
    exit();
}

require_once '../layout/header.php'; 
?>

<div class="row">
    <div class="col-sm-6" style="font-size: 22px; font-weight: bold; color: #d9534f;">Add distributer</div>
</div>
<div style="height: 40px;"></div>

<form class="form-horizontal" id="distributerForm">
    <div class="form-group">
        <label class="control-label col-sm-2" for="distributer">Distributer</label>
        <div class="col-sm-6">
            <input type="text" id="distributer" name="distributer" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="dist_website">Website</label>
        <div class="col-sm-6">
            <input type="text" id="dist_website" name="dist_website" class="form-control">
        </div>
    </div>
    <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-6">
            <input type="button" value="Submit" id="submit_dist" class="btn btn-success" name="submit_dist">
            <a href="http://localhost/EwestStore/distributer.php" class="btn btn-info">Back to distributers</a>
        </div>
    </div>
</form>

<?php require_once '../layout/footer.php'; ?>