<?php
ob_start();
?>
    <!-- Start Footer #27293d-->
    <footer class="footer">
        <div class="d-sm-flex justify-content-between justify-content-sm-between">
            <span class="text-muted">Copyright ©2022 <a href="https://www.stark-consults.com/" target="_blank">Stark Consult</a>. All rights reserved.</span>
            <span>Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i></span>
        </div>
    </footer>
    <!-- Footer End-->
<?php
$footer = ob_get_clean();
if(isset($_SESSION["message"])&&$_SESSION["message"]){
    unset($_SESSION["message"],$_SESSION["alert"]);
}
?>