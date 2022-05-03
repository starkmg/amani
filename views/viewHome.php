<?php
$title = "Accueil";
//require_once("views/commons/alertMessage.php");
//require("views/mainDashboard/mainStats.php");
//require("views/mainDashboard/accueil.php");
ob_start();
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <p class="card-title">Exhortations</p>
                    <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-12 col-xl-6 d-flex flex-column justify-content-center">
                                        <div class="ml-xl-4">
                                            <h1>2 Corinthiens 12:9</h1>
                                            <h3 class="font-weight-light mb-xl-4">PDV2017</h3>
                                            <p class="text-muted mb-2 mb-xl-0">Mais le Seigneur m’a dit : « Mon amour te suffit. Ma puissance se montre vraiment quand tu es faible. » Donc je me vanterai surtout parce que je suis faible. Alors la puissance du Christ habitera en moi.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-6">
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <img src="public/images/versets/1280x1280.jpg" style="width: 100%" alt="image small">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-12 col-xl-6 d-flex flex-column justify-content-center">
                                        <div class="ml-xl-4">
                                            <h1>$61321</h1>
                                            <h3 class="font-weight-light mb-xl-4">South America</h3>
                                            <p class="text-muted mb-2 mb-xl-0">It is the period time a user is actively engaged with your website, page or app, etc. The total number of sessions within the date range. </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-6">
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <canvas id="south-america-chart"></canvas>
                                                <div id="south-america-legend"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#detailedReports" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                        </a>
                        <a class="carousel-control-next" href="#detailedReports" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>

                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Notifications</p>
                    <ul class="icon-data-list">
                        <li>
                            <p class="text-primary mb-1">Isabella Becker</p>
                            <p class="text-muted">Sales dashboard have been created</p>
                            <small class="text-muted">9:30 am</small>
                        </li>
                        <li>
                            <p class="text-primary mb-1">Adam Warren</p>
                            <p class="text-muted">You have done a great job #TW11109872</p>
                            <small class="text-muted">10:30 am</small>
                        </li>
                        <li>
                            <p class="text-primary mb-1">Leonard Thornton</p>
                            <p class="text-muted">Sales dashboard have been created</p>
                            <small class="text-muted">11:30 am</small>
                        </li>
                        <li>
                            <p class="text-primary mb-1">George Morrison</p>
                            <p class="text-muted">Sales dashboard have been created</p>
                            <small class="text-muted">8:50 am</small>
                        </li>
                        <li>
                            <p class="text-primary mb-1">Ryan Cortez</p>
                            <p class="text-muted">Herbs are fun and easy to grow.</p>
                            <small class="text-muted">9:00 am</small>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">My Cases</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                            <tr>
                                <th>Case</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Search Engine Marketing</td>
                                <td>21 Sep 2018</td>
                                <td class="font-weight-medium text-success">Completed</td>
                            </tr>
                            <tr>
                                <td>Search Engine Optimization</td>
                                <td>13 Jun 2018</td>
                                <td class="font-weight-medium text-success">Completed</td>
                            </tr>
                            <tr>
                                <td>Display Advertising</td>
                                <td>28 Sep 2018</td>
                                <td class="font-weight-medium text-warning">Pending</td>
                            </tr>
                            <tr>
                                <td>Pay Per Click Advertising</td>
                                <td>30 Jun 2018</td>
                                <td class="font-weight-medium text-warning">Pending</td>
                            </tr>
                            <tr>
                                <td>E-Mail Marketing</td>
                                <td>01 Nov 2018</td>
                                <td class="font-weight-medium text-danger">Cancelled</td>
                            </tr>
                            <tr>
                                <td>Referral Marketing</td>
                                <td>20 Mar 2018</td>
                                <td class="font-weight-medium text-warning">Pending</td>
                            </tr>
                            <tr>
                                <td>Social media marketing</td>
                                <td>26 Oct 2018</td>
                                <td class="font-weight-medium text-success">Completed</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">To Do Lists</h4>
                    <div class="list-wrapper pt-2">
                        <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                            <li>
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Meeting with Urban Team
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked>
                                        Duplicate a project for new customer
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li>
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Project meeting with CEO
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked>
                                        Follow up of team zilla
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li>
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Level up for Antony
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="add-items d-flex mb-0 mt-2">
                        <input type="text" class="form-control todo-list-input"  placeholder="Add new task">
                        <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i class="ti-location-arrow"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require("layouts/header.php");
require("layouts/footer.php");
require("layouts/footerScript.php");
require("layouts/headerStyle.php");
require("views/template.php");
?>
<script>

</script>
