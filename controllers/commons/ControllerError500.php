<?php
    class ControllerError500{
        public function __construct($url) {
            global $path;
            for ($i = 2; $i <= count($url); $i++)
                $path .= "../";
            $this->apply();
        }
        private function apply(){
            global $scurrency;
            require_once("views/commons/viewError500.php");
        }
    }

?>