<?php
$title = "Page Not Found";
ob_start();
?>
<!-- Begin page -->
<div class="content-wrapper d-flex align-items-center text-center error-page bg-gradient">
    <div class="row flex-grow">
        <div class="col-lg-7 mx-auto text-white">
            <div class="row align-items-center d-flex flex-row">
                <div class="col-lg-6 text-lg-right pr-lg-4">
                    <h1 class="display-1 mb-0 text-primary">404</h1>
                </div>
                <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                    <h2 class="text-dark">SORRY!</h2>
                    <h3 class="font-weight-light text-muted">The page you’re looking for was not found.</h3>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 text-center mt-xl-2">
                    <a class="font-weight-medium text-primary" href="home">Back to home</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end error page -->

<?php
$content = ob_get_clean();
require("layouts/header.php");
require("layouts/footer.php");
require("layouts/footerScript.php");
require("layouts/headerStyle.php");
require("views/template.php");
?>

