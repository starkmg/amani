<?php
require("layouts/navbar.php");
require("layouts/menu.php");
ob_start();
?>
    <div class="horizontal-menu">
        <!-- Top Bar Start ->
        <?= $navbar?>
        <!-- Top Bar End -->
        <!-- ========== Left Sidebar Start ========== -->
        <?= $menu?>
        <!-- Left Sidebar End -->
    </div>
<?php
$header = ob_get_clean();
//require("views/commons/alertMessage.php");
//require("views/commons/alertModal.php");
?>