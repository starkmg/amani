<?php
ob_start();
?>

<!-- plugins:js -->
<script src="public/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="public/vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="public/js/off-canvas.js"></script>
<script src="public/js/hoverable-collapse.js"></script>
<script src="public/js/template.js"></script>
<script src="public/js/settings.js"></script>
<script src="public/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="public/js/dashboard.js"></script>
<script src="public/js/todolist.js"></script>
<!-- End custom js for this page-->
<?php
$footerScript = ob_get_clean();
?>

