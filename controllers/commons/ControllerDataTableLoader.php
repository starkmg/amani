<?php
    class ControllerDataTableLoader{
        public function __construct($url) {
            global $path;
            $this->apply();
        }
        private function apply(){
            global $scurrency;
            require_once("views/commons/viewDataTableLoader.php");
        }
    }

?>