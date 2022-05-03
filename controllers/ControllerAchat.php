<?php
class ControllerAchat{
    public function __construct($url){
        $this->display();
    }
    public function display(){
        global $message, $alert, $stats, $retour, $status, $selectedStatus, $debut, $fin;
        $dan = new ModelTraitement();
        require_once("views/viewAchat.php");
    }
}
?>