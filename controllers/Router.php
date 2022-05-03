<?php
#Chargement des configurations
$message =null;
$alert = null;
$title = null;
$date=date("Y-m-d H:i:s");
$header=array(	"Content-Type: text/json",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "SOAPAction: \"urn:schemas-upnp-org:service:WANIPConnection:1#ForceTermination\"",
);
$sdata = array("User-MSISDN"=>null, "User-IMSI"=>null);
foreach (getallheaders() as $name => $value) {
    $sdata["$name"] = $value;
}
$SMSISDN = $sdata['User-MSISDN'];
$SIMSI = $sdata['User-IMSI'];
class Router{
    private $_ctrl;
    private $_view;
    private $fixedMenu;

    public function routeReq(){
        global $message,$path, $url, $route, $alert, $debut, $date, $fin, $scurrency, $selectedStatus, $session;
        $debut = (isset($_REQUEST["debut"])&&$_REQUEST["debut"])?$_REQUEST["debut"]:date("m/d/Y",strtotime($date)-7776000);
        $debut = (isset($_REQUEST["debut"])&&$_REQUEST["debut"])?$_REQUEST["debut"]:date("m/d/Y");
        $fin = (isset($_REQUEST["fin"])&&$_REQUEST["fin"])?$_REQUEST["fin"]:date("m/d/Y");
        $selectedStatus = (isset($_REQUEST["selectedStatus"])&&$_REQUEST["selectedStatus"])?$_REQUEST["selectedStatus"]:"success";

        try{
            spl_autoload_register(function ($class){
                require_once ("models/".$class.".php");
            });
            $url = "";
            $dan = new ModelTraitement();
            if(isset($_POST["loginMe"])) if (isset($dan)) {
                $retour = $dan->loginClient($_POST);
            }
            $session=$dan->checkSession();
//            var_dump($session);
//            die();
            $route=$url = isset($_GET["url"]) ? explode("/", filter_var($_GET["url"], FILTER_SANITIZE_URL)) : false;
            if(isset($url[0])&&$url[0]=="dataTableLoader"){
                $isDataTable = true;
            }else{
                $isDataTable = false;
            }

            if(isset($_GET["url"])){
                $url=explode("/", filter_var($_GET["url"], FILTER_SANITIZE_URL));
                #$controller= ucfirst(strtolower($url[0]));
                $controller= ucfirst($url[0]);
                $scurrency = (isset($url[1])&&$url[1])?$url[1]:"USD";
                $controllerClass = "Controller".$controller;
                $controllerFile = "controllers/".$controllerClass.".php";
                $controllerFileFrontend = "controllers/frontend/".$controllerClass.".php";
                $controllerFileDashboard = "controllers/dashboard/".$controllerClass.".php";
                $controllerFileCommons = "controllers/commons/".$controllerClass.".php";
                $urlcount=count($url);
//                    var_dump($_REQUEST);
//                    die("esili");
                if($urlcount<2||$isDataTable){
                    if(file_exists($controllerFile)){
//                        if(!$session["isConnected"]) {
//                            $dan->applyLogin();
//                        }else {
                            require_once($controllerFile);
                            $this->_ctrl = new $controllerClass($url);
//                        }
                    }elseif(file_exists($controllerFileCommons)){
                        require_once($controllerFileCommons);
                        $this->_ctrl=new $controllerClass($url);
                    }else{
                        if(!$session["isConnected"]) {
                            $dan->applyLogin();
                        }else {
                            if(!$_GET["url"]){
                                require_once("controllers/ControllerHome.php");
                                $this->_ctrl= new ControllerHome($url);
                            }else{
                                require_once("controllers/commons/ControllerError404.php");
                                $this->_ctrl= new ControllerError404($url);
                                #throw new Exception("Page Introuvable");
                            }
                        }
                    }
                }else{
                    throw new Exception("Page Introuvable");
                }
            }else{
                if(!$session["isConnected"]) {
                    $dan->applyLogin();
                }else {
                    require_once("controllers/ControllerHome.php");
                    if (isset($_SERVER["PATH_INFO"]))
                        $url = explode("/", filter_var($_SERVER["PATH_INFO"], FILTER_SANITIZE_URL));
                    $this->_ctrl = new ControllerHome($url);
                }
            }
        }catch (Exception $e){
            $path = "";
            for ($i = 2; $i <= count($url); $i++)
                $path .= "../";
            $errorMsg = $e->getMessage();
            header("location:$path"."error404");
        }
    }

    public function logToFile(){
        global $message, $alert;
        /**/
        $REMOTE_ADDR=$SERVER_ADDR=$SERVER_PORT=$SERVER_PROTOCOL=$REQUEST_METHOD=$REDIRECT_URL=$REQUEST_URI=$REDIRECT_STATUS=$HTTP_REFERER=$HTTP_USER_AGENT=null;
        $logFile = "logs/serverlog_".date("Ymd").".log";
        $logFile2 = "logs/messagelog_".date("Ymd").".log";
        $transDate = date("Y-m-d H:i:s");
        $username = isset($_SESSION["displayName"])?$_SESSION["displayName"]:"No User";

        $logUniqueID=isset($_SESSION["logUniqueID"])?$_SESSION["logUniqueID"]:uniqid("NoLoginID_");
        $contactnumber=isset($_SESSION["contactnumber"])?$_SESSION["contactnumber"]:"No ContactNumber";
        $userFullName=isset($_SESSION["userFullName"])?$_SESSION["userFullName"]:"No Username";
        $logType = "logs";

        $REMOTE_ADDR=$_SERVER["REMOTE_ADDR"];
        $SERVER_ADDR=$_SERVER["SERVER_ADDR"];
        $SERVER_PORT=$_SERVER["SERVER_PORT"];
        $SERVER_PROTOCOL=$_SERVER["SERVER_PROTOCOL"];
        $REQUEST_METHOD=$_SERVER["REQUEST_METHOD"];
        $REDIRECT_URL=(isset($_SERVER["REDIRECT_URL"]))?$_SERVER["REDIRECT_URL"]:"ND";
        $REQUEST_URI=$_SERVER["REQUEST_URI"];
        $REDIRECT_STATUS=(isset($_SERVER["REDIRECT_STATUS"]))?$_SERVER["REDIRECT_STATUS"]:"No Redirection";
        $HTTP_REFERER=(isset($_SERVER["HTTP_REFERER"]))?$_SERVER["HTTP_REFERER"]:$REDIRECT_URL;
        $HTTP_USER_AGENT=$_SERVER["HTTP_USER_AGENT"];
        $format1 = "[{$transDate}]-{$logType}-<{$logUniqueID}>-{$contactnumber}-{$userFullName}-From:$REMOTE_ADDR To:$SERVER_ADDR:$SERVER_PORT \"$SERVER_PROTOCOL $REQUEST_URI $REQUEST_METHOD\" $REDIRECT_STATUS \"$HTTP_REFERER\" \"$HTTP_USER_AGENT\"\n";
//        $format2 = "[$transDate] - $username - From:$REMOTE_ADDR To:$SERVER_ADDR:$SERVER_PORT \"$SERVER_PROTOCOL $REQUEST_URI $REQUEST_METHOD\" $REDIRECT_STATUS \"$HTTP_REFERER\" - $alert - \"$message\"\n";
        error_log($format1, 3, $logFile);
//        error_log($format2, 3, $logFile2);
        /***/
    }
}

?>