<div style="height: 30px;"></div>
</div><!-- container div in header.php -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <span class="copyright">Copyright &copy; Ewest Egypt <?php echo date("Y"); ?></span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- jQuery -->
<script src="<?php echo substr(__DIR__, '-18', '-7') . '/vendor/jquery/jquery.min.js'; ?>"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo substr(__DIR__, '-18', '-7') . '/vendor/bootstrap/js/bootstrap.min.js' ?>"></script>
<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<!--Application JavaScript--> 
<script src="<?php echo substr(__DIR__, '-18', '-7') . '/resources/js/deleteData.js' ?>"></script>
<script src="<?php echo substr(__DIR__, '-18', '-7') . '/resources/js/distributor.js' ?>"></script>
<script src="<?php echo substr(__DIR__, '-18', '-7') . '/resources/js/manufacturer.js' ?>"></script>
<script src="<?php echo substr(__DIR__, '-18', '-7') . '/resources/js/required.js' ?>"></script>
<script src="<?php echo substr(__DIR__, '-18', '-7') . '/resources/js/store.js' ?>"></script>
<script src="<?php echo substr(__DIR__, '-18', '-7') . '/resources/js/user.js' ?>"></script>
<style>
    .footer {
        position: fixed;
        height: 25px;
        width: 100%;
        background-color: #333333;
        bottom: 0px;
    }

    .copyright {
        position: relative;
        width: 100%;
        color: #fff;
        font-size: 1em;
        bottom:0;
    }
</style>
</body>
</html>