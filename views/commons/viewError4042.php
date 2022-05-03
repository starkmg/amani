<?php
$title = "Page Not Found";
ob_start();
?>
<!-- Begin page -->
<div class="card mo-mt-2">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-lg-4 offset-lg-1">
                <div class="ex-page-content">
                    <h1 class="text-dark">404!</h1>
                    <h4 class="mb-4">Sorry, page not found</h4>
                    <p class="mb-5">It will be as simple as Occidental in fact, it will be Occidental to an English person</p>
                    <a class="btn btn-warning mb-5 waves-effect waves-light" href="accueil"><i class="mdi mdi-home"></i> Back to Dashboard</a>
                </div>

            </div>
            <div class="col-lg-5 offset-lg-1">
                <img src="public/images/error.png" alt="" class="img-fluid mx-auto d-block">
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
require("views/template-old.php");
?>

