<?php
global $message, $alert;
if(isset($_SESSION["message"])&&$_SESSION["message"]){
    $message = $_SESSION["message"];
    $alert = $_SESSION["alert"];
}
//var_dump($_SESSION);
switch ($alert) {
    case "dan-success" :
        $icon = "fa-check-circle";
        $text_type = "text-success";
        $text_label = "Success!";
        break;
    case "dan-bad":
        $icon = "fa-exclamation-triangle";
        $text_type = "text-warning";
        $text_label = "Fail!";
        break;
    case "dan-warning":
        $icon = "fa-exclamation-triangle";
        $text_type = "text-warning";
        $text_label = "Attentin!";
        break;
    default:
        $icon = "fa-check-circle";
        $text_type = "text-success";
        $text_label = "Success!";
}
ob_start();
?>
    <a id="notif" class="notifications-item px-4 py-3" style="display: none" data-toggle="modal" data-target="#notifications-detail"> Cliquez moi</a>
    <!-- Notification Modal ================================== -->
    <div id="notifications-detail" class="modal fade " role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-400"><span class="text-6 mr-2"><i class="far fa-bell"></i></span> Notifications</h5>
                    <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="my-4">
                        <p class="<?=$text_type;?> text-20 line-height-07"><i class="fas <?=$icon;?>"></i></p>
                        <p class="<?=$text_type;?> text-8 font-weight-500 line-height-07"><?=$text_label;?></p>
                        <p class="lead"><?=$message;?></p>
                        <!--h3 class="text-5 mb-3"><?=$message;?></h3-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary col-12-" data-dismiss="modal" type="button">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Notification Modal -->

<?php
$alertModal = ob_get_clean();
$alertModal = ($message)?$alertModal:null;
?>