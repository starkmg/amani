<?php
class ControllerLogin{
    public function __construct($url){
        global $session,$message, $alert;
        $dan = new ModelTraitement();
        extract($_POST);
//        if(isset($_POST["loginMe"])){
//            $dan->loginClient($_POST);
//        }
//        if($session["isConnected"]){
//            $_SESSION["message"]=$message;
//            $_SESSION["alert"]=$alert;
//            header("location:home");
//        }else{
            $this->display();
//        }
    }
    public function display(){
        global $message, $alert, $stats, $retour, $scurrency;
        require_once("views/viewLogin.php");
    }
}
?>