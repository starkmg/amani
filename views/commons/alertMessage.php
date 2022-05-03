<?php
global $message, $alert;
if(!$message&&isset($_SESSION["message"])&&$_SESSION["message"]){
    $message = $_SESSION["message"];
    $alert = (isset($_SESSION["alert"])&&$_SESSION["alert"])?$_SESSION["alert"]:$alert;
}
switch ($alert) {
    case "dan-success" :
        $icon = "fa-check-circle";
        $text_type = "alert-success bg-success";
        $text_label = "Success!";
        break;
    case "dan-bad":
        $icon = "fa-exclamation-triangle";
        $text_type = "alert-warning bg-warning";
        $text_label = "Fail!";
        break;
    case "dan-warning":
        $icon = "fa-exclamation-triangle";
        $text_type = "alert-warning bg-warning";
        $text_label = "Attentin!";
        break;
    default:
        $icon = "fa-exclamation-triangle";
        $text_type = "alert-success bg-success";
        $text_label = "Alert!";
}
ob_start();
?>
    <!-- Message Alert================================== -->
    <div class="alert <?=$text_type?> text-white alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fas <?=$icon;?>"></i> <strong><?=$text_label?></strong> <?=$message?>
    </div>
    <!-- Message Alert End -->
<?php
$alertMessage = ob_get_clean();
$alertMessage = ($message)?$alertMessage:null;
?>