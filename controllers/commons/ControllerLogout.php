<?php
class ControllerLogout{
    public function __construct($url){
        $this->display();
    }
    public function display(){
        global $message, $alert, $stats, $retour, $scurrency;
        $dan = new ModelTraitement();
        $dan->logoutClient();
        header("Location:accueil");
    }
}
?>