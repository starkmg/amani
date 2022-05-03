<?php
class ControllerServices{
    public function __construct($url){
        global $message, $alert;
        $dan = new ModelTraitement();
        if(isset($_POST["save"])){
            $retour = $dan->setService($_POST);
            if($retour){
                $message="L'opération s'est effectuée avec succès";
                $alert="dan-success";
            }else{
                $message="L'opération a echouée";
                $alert="dan-bad";
            }
        }
        if(isset($_POST["action"])){
            $retour = $dan->serviceUpdate($_POST);
            if($retour) extract($retour);
        }
        $this->display();
    }
    public function display(){
        global $message, $alert, $stats, $retour, $status, $debut, $fin;

//        $retour = $dan->getLodHistoryDT();
//        var_dump($retour);
//        die();
        require_once("views/viewServices.php");
    }
}
?>