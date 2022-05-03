<?php

class ModelConfigurations{
    public static $myConfig;
    public static $_db;
    public static $getDbConfigs;
    public function __construct(){
        global $allShops, $allUsers;
        if(file_exists("config/properties.ini")){
            self::$myConfig = parse_ini_file ("config/properties.ini",TRUE);
        }else{
            die("Erreur, fichier de configuration non trouvé!");
        }
        require_once("config/config-lang-fr.php");
    }
    public static function getDbConfigs(){
        $host = $dbname = $user = $password = null;
        $host = self::$myConfig["SECTION DB"]["host"];
        $dbname = self::$myConfig["SECTION DB"]["dbname"];
        $user = self::$myConfig["SECTION DB"]["user"];
        $password = self::$myConfig["SECTION DB"]["password"];
        $port = self::$myConfig["SECTION DB"]["port"];
        $encrypt_key = self::$myConfig["SECTION INIT"]["encrypt_key"];

        $retour = array("host"=>$host,
            "dbname"=>$dbname,
            "user"=>$user,
            "password"=>$password,
            "port"=>$port,
            "encrypt_key"=>$encrypt_key
        );
        return $retour;
    }
    private static function setBdd(){
        $db_conf = self::getDbConfigs();
        extract($db_conf);
        try{
//            self::$_db=NEW PDO("mysql:host=$host;dbname=$dbname;port=$port;charset=utf8","$user","$password");
//            self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }catch (PDOException $e){
//            print "Erreur !: " . $e->getMessage() . "<br/>";
//            die();
        }

    }
    protected function getBdd(){
        if(self::$_db==null)
            self::setBdd();
        return self::$_db;
    }

    public function getAllActiveMenus($data=null){
        global $db, $message , $alert, $date;
        $query = "SELECT `poidMenu`, `labelMenu`, `url` urlMenus FROM `config_menus` WHERE `statuMenu` AND `poidMenu` ORDER BY `labelMenu`;";
        return self::getQuery($query);
    }

    public function getAllShops($data=null){
        global $db, $message , $alert, $date;
        $query = "SELECT * FROM `config_shop`;";
        return self::getQuery($query);
    }
    public static function getConfigs(){
        $url_ldap = $methode_auth = $methode_post_auth = $methode_getinfos = $password =$methode_getbalances= null;
        $url_ldap = self::$myConfig["SECTION LDAP API"]["url_ldap"];
        $post_login = self::$myConfig["SECTION LDAP API"]["post_login"];
        return array(
            "url_ldap"=>$url_ldap,
            "post_login"=>$post_login
        );
    }
    public function sendJsonRequest($url=null, $data=null, $methode="POST"){
        $responsedescription=$responseCode=null;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $methode,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJnYXV0aGllciIsImlhdCI6MTU5ODQ3NTM1NiwiZXhwIjoxNTk4NTYxNzU2fQ.GfH4_d0-yIMlDX1Ih7EpGgItSZdeA2NqB-YOISZn53HpsGuu5YE6AEI80M2Fu9w5Jcbg6nL2cee253xEuNVQig",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $error_no = curl_errno($curl);
        $error_msg = curl_error($curl);
        $error_info = curl_getinfo($curl);
//        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
//        var_dump($methode);
//        var_dump($data);
//        die();
//        var_dump($response);
        $out_json = json_decode($response, true);
        if($out_json) extract($out_json);
        if (isset($responseCode)&&$responseCode) {
            $result["resultCode"]=$responseCode;
            $result["resultDesc"]=$responsedescription;
        }elseif(isset($systemError)&&$systemError){
            $result["resultCode"]=$status;
            $result["resultDesc"]=(($message)?$message:"Erreur système");
        }elseif(isset($status)&&$status){
            $result["resultCode"]=$status;
            $result["resultDesc"]=(($message)?$message:"Erreur système");
        }else{
            $result["resultCode"]=200;
            $result["resultDesc"]="Success";
        }
        $result["out"]= $out_json;
        $result["error_no"]=$error_no;
        $result["error_msg"]=$error_msg;
        $result["error_info"]=$error_info;
        return $result;
    }
    public function sendXmlRequest($url=null, $data=null, $methode="POST"){
        $curl = curl_init();
        curl_setopt_array($curl, array(
//            CURLOPT_PORT => "8080",
            CURLOPT_URL => "http://10.25.2.25:8080/ldap/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/xml",
                "postman-token: a855fdcb-2ede-180e-9710-7a517b938fcd"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $retour = json_decode($json,TRUE);
        curl_close($curl);
//        var_dump($retour);
        return $retour;
    }
    public function getQueryForDataTable($data = null){
        $sortie=array();
        $n=0;
        $req =self::getQuery($data);
        if($req)
            foreach ($req as $ligne){
                $subData=null;
                $n++;
//                $subData[]="$n";
                foreach ($ligne as $key){
                    $subData[]=$key;
                }
                $sortie[]=$subData;
            }
        $nombre = count($sortie);
        $output["draw"]=1;
        $output["recordsTotal"]=$nombre;
        $output["recordsFiltered"]=$nombre;
        $output["data"]=$sortie;
        return $output;
    }
    public static function getConvert($data){
        $retour=$valeur=$ext=null;
        if($data >= pow(10,6)){
            $valeur = $data/ pow(10,6);
            $ext = "M";
        }elseif($data >= pow(10,3)){
            $valeur = $data/ pow(10,3);
            $ext = "K";
        }else{
            $valeur = $data;
            $ext = null;
        }
        $valeur = round($valeur, 2);
        $retour = array($valeur, $ext);
        return $retour;
    }
    protected function getQuery($query){
        self::getBdd();
        $var = [];
        $req = self::$_db->prepare($query);
        @$req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[]=$data;
        }
        $req->closeCursor();
        return $var;
    }
    protected function setQuery($query){
        global $message, $alert, $date;
        self::getBdd();
        @$req = self::$_db->exec($query);
        $rep= self::$_db->errorInfo();
        $message = $rep[2];
        $message = (($req)?"Votre enregistrement est effectué avec Succès!":$message);
        $alert = (($req)?"dan-success":"dan-warning");
        return $req;
    }
}