<?php
class ControllerLoginHistory{
    public function __construct($url){
        $this->display();
    }
    public function display(){
        global $message, $alert, $stats, $retour, $status, $debut, $fin;
        $dan = new ModelTraitement();
//        $retour = $dan->getLodHistoryDT();
//        var_dump($retour);
//        die();
        require_once("views/viewLoginHistory.php");
    }
}
?>