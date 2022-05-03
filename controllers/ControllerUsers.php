<?php
class ControllerUsers{
    public function __construct($url){
        $this->display();
    }
    public function display(){
        global $message, $alert, $stats, $retour, $status, $debut, $fin;
        $dan = new ModelTraitement();
        if(isset($_POST["action"])){
            $retour = $dan->userUpdate($_POST);
            if($retour) extract($retour);
        }
        require_once("views/viewUsers.php");
    }
}
?>