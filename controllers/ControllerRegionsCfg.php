<?php
class ControllerRegionsCfg{
    public function __construct($url){
        $this->display();
    }
    public function display(){
        global $message, $alert, $stats, $retour, $status, $selectedFilter, $debut, $fin;
        extract($_POST);
        $dan = new ModelTraitement();
        require_once("views/viewRegionsCfg.php");
    }
}
?>