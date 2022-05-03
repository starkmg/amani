<?php
ob_start();
?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" >
                    <div class="row align-items-center">
                        <img class="col-6" src="public/images/orange-home-filleul.jpg" height="100%" alt="">
                        <img class="col-6" src="public/images/orange-home-filleul.jpg" height="100%" alt="">
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

<?php
$accueilContent = ob_get_clean();
?>