<?php
ob_start();
?>
    <!-- Start Stat -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-dark text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <i class="fas fa-users fa-2x text-warning"></i>
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-warning">PDVs</h5>
                        <h4 class="font-500">0.0</h4>
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">Details</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-dark text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <i class="ti-layers-alt fa-2x text-warning"></i>
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-warning">Regions</h5>
                        <h4 class="font-500">0.0</h4>
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">Details</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-dark text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <i class="fas fa-list fa-2x text-warning"></i>
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-warning">Offres Actives</h5>
                        <h4 class="font-500">0.0</h4>
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">Details</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-dark text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <i class="fas fa-user fa-2x text-warning"></i>
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-warning">Users Actifs</h5>
                        <h4 class="font-500">0.0 </h4>
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="users" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">Configuration</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Stat End -->
<?php
$mainStats = ob_get_clean();
//$mainStats = null;
?>