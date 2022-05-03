<?php
class ControllerHome{
    public function __construct($url){
        global $message, $alert;
        $dan = new ModelTraitement();
        if(isset($_POST["uploadFile"])){
            $retour = $dan->chargement($_POST);
            if($retour) extract($retour);
        }
        if(isset($_POST["deleteChargement"])){
            $retour = $dan->chargementDeletion($_POST);
            if($retour) extract($retour);
        }
        $this->display();
    }
    public function display(){
        global $message, $alert, $stats, $retour, $status, $debut, $fin;
        $dan = new ModelTraitement();
        $retour = $dan->getAllServices();
        require_once("views/viewHome.php");
    }
}
