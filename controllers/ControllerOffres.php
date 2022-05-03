<?php
class ControllerOffres{
    public function __construct($url){
        $this->display();
    }
    public function display(){
        global $message, $alert, $stats, $retour, $status, $selectedFilter, $selectedFilterType, $allRegions, $allOffertypes, $debut, $fin;
        extract($_POST);
        $dan = new ModelTraitement();
        $allRegions = $dan->getAllRegions();
        $allOffertypes = $dan->getAllOfferTypes();
        require_once("views/viewOffres.php");
    }
}
?>