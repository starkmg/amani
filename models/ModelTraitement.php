<?php

class ModelTraitement extends ModelConfigurations {
    public function getAllServices($data=null){
        global $db, $message , $alert, $date;
        $query = "SELECT * FROM `ml_services` WHERE `active`=1 ORDER BY `name` ASC;";
        return self::getQuery($query);
    }
    public function getAllRegions($data=null){
        $query = "SELECT `reg_code`, `reg_label`, `reg_postition`, IF(`reg_buy_bundle`, 'YES','NO') buyBundle, IF(`reg_sale_bundle`,'YES','NO') saleBundle, `reg_status`, IF(`reg_status`,'Actif', 'Inactif') statut, 
`reg_create_username`, `reg_update_username`, `reg_update_on`, `reg_create_on` FROM `rlms_region` ORDER BY `reg_code`;";
        return self::getQuery($query);
    }
    public function getAllOfferTypes($data=null){
        $query = "SELECT `offerTypeCode`, `offerTypeLabel`, `offerTypeUnit`,`offerTypeOrder`, IF(`offerTypeStatus`, 'Actif', 'Inactif') statut
FROM `rlms_offer_type` ORDER BY `offerTypeLabel`;";
        return self::getQuery($query);
    }
    public function setService($data=null){
        global $db, $message , $alert, $date;
        $name=$code_service=$description=$active=$added_by=$serviceStatus=null;
        if($data) extract($data);
        $added_by=$_SESSION["CUID"];
        $active = ($serviceStatus=="on")?1:0;
        $query = "INSERT INTO `ml_services` (`name`, `code_service`, `description`, `active`, `added_by`, `created_at`, `updated_at`)
                VALUES('$name', '$code_service', '$description', '$active', '$added_by', NOW(), NOW());";
        return self::setQuery($query);
    }
    public function getAchatDT($data=null){
        global  $date, $fin, $debut, $status;
        if($data) extract($data);
        if($debut&&$fin){
            $debut = date("Y-m-d",strtotime($debut));
            $fin = date("Y-m-d",strtotime($fin));
        }else{
            $debut = date("Y-m-d",strtotime($date)-7776000);
            $fin = date("Y-m-d");
        }
        if(isset($status)){
            switch($status){
                case "success":
                    $status = "`bbundle_result_code`='200' AND ";
                    break;
                case "fail":
                    $status = "`bbundle_result_code` <>'200' AND ";
                    break;
                default:
                    $status = null;
            }
        }
        $query = "SELECT * FROM `view_achat_pdv` WHERE {$status} `bbundle_date` BETWEEN '$debut' AND '$fin 23:59:59'";
        return self::getQueryForDataTable($query);
    }
    public function getBalanceCollectorDT($data=null){
        global  $date, $fin, $debut;
        if($data) extract($data);
        if($debut&&$fin){
            $debut = date("Y-m-d",strtotime($debut));
            $fin = date("Y-m-d",strtotime($fin));
        }else{
            $debut = date("Y-m-d",strtotime($date)-7776000);
            $fin = date("Y-m-d");
        }
        $query = "SELECT `cbal_id`, `cbal_collector`, `clbal_balance`, `cbal_devise`, (CASE`cbal_action` WHEN 'addbal' THEN 'Augmentation' WHEN 'delbal' THEN 'Augmentation' ELSE 'Inconnue' END) actions, `cbal_date`
                FROM `rlms_collector_balance` WHERE `cbal_date` BETWEEN '{$debut}' AND '{$fin} 23:59:59' ORDER BY `cbal_id` DESC;";
        return self::getQueryForDataTable($query);
    }
    public function getBalancePdvDT($data=null){
        global  $date, $fin, $debut,$encrypt_key;
        $conf = self::getDbConfigs();
        if($data) extract($data);
        if($debut&&$fin){
            $debut = date("Y-m-d",strtotime($debut));
            $fin = date("Y-m-d",strtotime($fin));
        }else{
            $debut = date("Y-m-d",strtotime($date)-7776000);
            $fin = date("Y-m-d");
        }
        extract($conf);
        $query = "SELECT `bpdv_id`, DECODE(`bpdv_pdv`,'{$encrypt_key}') pdv, ROUND(`bpdv_balance`,2) balance, `offerTypeUnit`,FROM_UNIXTIME(`bpdv_validity`) validity, 
                    `offerTypeLabel`, `bpdv_update_on` update_on  
                    FROM `rlms_balance_pdv` LEFT JOIN `rlms_offer_type` ON `bpdv_offer_type`=`offerTypeCode` WHERE FROM_UNIXTIME(`bpdv_validity`) >= NOW() AND `bpdv_update_on` BETWEEN '{$debut}' AND '{$fin} 23:59:59';";
        return self::getQueryForDataTable($query);
    }
    public function getPdvsDT($data=null){
        global  $date, $fin, $debut;
        if($data) extract($data);
        if($debut&&$fin){
            $debut = date("Y-m-d",strtotime($debut));
            $fin = date("Y-m-d",strtotime($fin));
        }else{
            $debut = date("Y-m-d",strtotime($date)-7776000);
            $fin = date("Y-m-d");
        }
        if(isset($status)){
            switch($status){
                case "all":
                    $status = null;
                    break;
                default:
                    $status = "WHERE (`bpdv_create_on` BETWEEN '{$debut}' AND '{$fin} 23:59:59') OR (`bpdv_update_on` BETWEEN '{$debut}' AND '{$fin} 23:59:59')";
            }
        }else{
            $status = null;
        }
        $query = "SELECT `bpdv_id`, `bpdv_msisdn`, `bpdv_province`, `bpdv_zone`, IF(`bpdv_status`,'Actif','Inactif') statut, `bpdv_update_on`, `bpdv_create_on` 
                FROM `rlms_pdv_base` {$status} ;";
        return self::getQueryForDataTable($query);
    }
    public function getPdvsCfgDT($data=null){
        global  $date, $fin, $debut;
        if($data) extract($data);
        if($debut&&$fin){
            $debut = date("Y-m-d",strtotime($debut));
            $fin = date("Y-m-d",strtotime($fin));
        }else{
            $debut = date("Y-m-d",strtotime($date)-7776000);
            $fin = date("Y-m-d");
        }
        if(isset($status)){
            switch($status){
                case "all":
                    $status = null;
                    break;
                default:
                    $status = "WHERE (`bpdv_create_on` BETWEEN '{$debut}' AND '{$fin} 23:59:59') OR (`bpdv_update_on` BETWEEN '{$debut}' AND '{$fin} 23:59:59')";
            }
        }else{
            $status = null;
        }
        $loadId = "CONCAT(\"<input name='selectedId[]' value='\",`bpdv_id`,\"' type='checkbox' class='control-group'>\")";
        $query = "SELECT {$loadId}, `bpdv_msisdn`, `bpdv_province`, `bpdv_zone`, IF(`bpdv_status`,'Actif','Inactif') statut, `bpdv_update_on`, `bpdv_create_on` 
                FROM `rlms_pdv_base` {$status} ;";
        return self::getQueryForDataTable($query);
    }
    public function getRegionsDT($data=null){
        $query = "SELECT `reg_code`, `reg_label`, `reg_postition`, IF(`reg_buy_bundle`, 'YES','NO') buyBundle, IF(`reg_sale_bundle`,'YES','NO') saleBundle, IF(`reg_status`,'Actif', 'Inactif') statut, 
                `reg_create_username`, `reg_update_username`, `reg_update_on`, `reg_create_on` FROM `rlms_region` ORDER BY `reg_code`;";
        return self::getQueryForDataTable($query);
    }
    public function getTemplateSaleBundleDT($data=null){
        $loadId = "CONCAT(\"<input name='selectedId[]' value='\",`tsale_id`,\"' type='checkbox' class='control-group'>\")";
        $query = "SELECT {$loadId}, `offerTypeLabel`, `tsale_ipp_code`, `tsale_volume`, `offerTypeUnit`, `tsale_validity`, `tsale_commercial_name`, `tsale_internal_name`, 
                `tsale_price`, `tsale_devise`,  IF(`tsale_status`,'Actif','Inactif') statut, `tsale_create_username`,
                `tsale_update_username`, `tsale_update_on`, `tsale_create_on` 
                FROM `rlms_template_sale_offer` b LEFT JOIN `rlms_offer_type` o ON `tsale_type_offer`=`offerTypeCode` 
                ORDER BY `offerTypeLabel`, `tsale_volume` ASC;";
        return self::getQueryForDataTable($query);
    }
    public function getTemplateBuyBundleDT($data=null){
        $loadId = "CONCAT(\"<input name='selectedId[]' value='\",`tbuy_id`,\"' type='checkbox' class='control-group'>\")";
        $query = "SELECT {$loadId}, `offerTypeLabel`, `tbuy_volume`, `offerTypeUnit`, `tbuy_volume_validity`, `tbuy_commercial_name`, `tbuy_internal_name`,
                `tbuy_price_unit`, `tbuy_price_usd`, (CASE `tbuy_volume_status` WHEN 1 THEN 'ALL' WHEN 2 THEN 'ETOPUP' WHEN 3 THEN 'OM' ELSE 'ND' END) canal, 
                IF(`tbuy_volume_status`, 'Actif', 'Inactif') statut, `tbuy_create_username`, `tbuy_update_username`, `tbuy_update_on`, `tbuy_create_on`
                FROM `rlms_template_buy_bundle` b LEFT JOIN `rlms_offer_type` o ON `tbuy_offer_type`=`offerTypeCode` 
                ORDER BY `offerTypeLabel`, `tbuy_volume` ASC;";
        return self::getQueryForDataTable($query);
    }
    public function getSaleBundleDT($data=null){
        global  $date, $fin, $debut;
        $reg_code_val=$offerTypeCode_val=null;
        if($data) extract($data);
        if(isset($reg_code)){
            switch($reg_code){
                case "all":
                case "":
                    $reg_code_val = null;
                    break;
                default:
                    $reg_code_val = "AND `reg_code` = '{$reg_code}'";
            }
        }
        if(isset($offerTypeCode)){
            switch($offerTypeCode){
                case "all":
                case "":
                    $offerTypeCode_val = null;
                    break;
                default:
                    $offerTypeCode_val = "AND `tsale_type_offer`= '{$offerTypeCode}'";
            }
        }
        $query = "SELECT `tsale_id`, `offerTypeLabel`, `reg_label`, `tsale_ipp_code`, CONCAT(`tsale_volume`, ' ',`offerTypeUnit`) volume, `tsale_commercial_name`, `tsale_internal_name`, 
             `tsale_validity`, (CASE `tsale_status` WHEN 1 THEN 'ALL' WHEN 2 THEN 'ETOPUP' WHEN 3 THEN 'OM' ELSE 'ND' END) canal, 
            IF(`tsale_status`, 'Actif', 'Inactif') statut, `tsale_create_username`, `tsale_update_username`, `tsale_update_on`, `tsale_create_on`
            FROM `view_sale_bundle_by_region` s LEFT JOIN `rlms_offer_type` o ON s.`tsale_type_offer`=o.`offerTypeCode`
            WHERE 1  {$reg_code_val} {$offerTypeCode_val} ORDER BY `offerTypeLabel` ASC, `reg_label` ASC;";
        return self::getQueryForDataTable($query);
    }
    public function getBuyBundleDT($data=null){
        global  $date, $fin, $debut;
        $reg_code_val=$offerTypeCode_val=null;
        if($data) extract($data);
        if(isset($reg_code)){
            switch($reg_code){
                case "all":
                case "":
                    $reg_code_val = null;
                    break;
                default:
                    $reg_code_val = "AND `reg_code` = '{$reg_code}'";
            }
        }
        if(isset($offerTypeCode)){
            switch($offerTypeCode){
                case "all":
                case "":
                    $offerTypeCode_val = null;
                    break;
                default:
                    $offerTypeCode_val = "AND `tbuy_offer_type`= '{$offerTypeCode}'";
            }
        }
        $query = "SELECT `tbuy_id`, `offerTypeLabel`, `reg_label`, CONCAT(`tbuy_volume`, ' ',`offerTypeUnit`) volume, `tbuy_volume_validity`, `tbuy_commercial_name`, `tbuy_internal_name`,
            `tbuy_price_unit`, `tbuy_price_usd`, (CASE `tbuy_volume_status` WHEN 1 THEN 'ALL' WHEN 2 THEN 'ETOPUP' WHEN 3 THEN 'OM' ELSE 'ND' END) canal, 
            IF(`tbuy_volume_status`, 'Actif', 'Inactif') statut, `tbuy_create_username`, `tbuy_update_username`, `tbuy_update_on`, `tbuy_create_on`
            FROM `view_buy_bundle_by_region` b LEFT JOIN `rlms_offer_type` o ON b.`tbuy_offer_type`=o.`offerTypeCode`
            WHERE 1  {$reg_code_val} {$offerTypeCode_val} ORDER BY `offerTypeLabel` ASC, `reg_label` ASC;";
        return self::getQueryForDataTable($query);
    }
    public function getSaleBundleCfgDT($data=null){
        $loadId = "CONCAT(\"<input name='selectedId[]' value='\",`tsale_id`,\"' type='checkbox' class='control-group'>\")";
        $query = "SELECT {$loadId}, `offerTypeLabel`, `reg_label`, `tsale_ipp_code`, CONCAT(`tsale_volume`, ' ',`offerTypeUnit`) volume, `tsale_commercial_name`, `tsale_internal_name`, 
             `tsale_validity`, (CASE `tsale_status` WHEN 1 THEN 'ALL' WHEN 2 THEN 'ETOPUP' WHEN 3 THEN 'OM' ELSE 'ND' END) canal, 
            IF(`tsale_status`, 'Actif', 'Inactif') statut, `tsale_create_username`, `tsale_update_username`, `tsale_update_on`, `tsale_create_on`
            FROM `view_sale_bundle_by_region` s LEFT JOIN `rlms_offer_type` o ON s.`tsale_type_offer`=o.`offerTypeCode`
            ORDER BY `offerTypeLabel` ASC, `reg_label` ASC;";
        return self::getQueryForDataTable($query);
    }
    public function getBuyBundleCfgDT($data=null){
        $loadId = "CONCAT(\"<input name='selectedId[]' value='\",`tbuy_id`,\"' type='checkbox' class='control-group'>\")";
        $query = "SELECT {$loadId}, `offerTypeLabel`, `reg_label`, CONCAT(`tbuy_volume`, ' ',`offerTypeUnit`) volume, `tbuy_volume_validity`, `tbuy_commercial_name`, `tbuy_internal_name`,
            `tbuy_price_unit`, `tbuy_price_usd`, (CASE `tbuy_volume_status` WHEN 1 THEN 'ALL' WHEN 2 THEN 'ETOPUP' WHEN 3 THEN 'OM' ELSE 'ND' END) canal, 
            IF(`tbuy_volume_status`, 'Actif', 'Inactif') statut, `tbuy_create_username`, `tbuy_update_username`, `tbuy_update_on`, `tbuy_create_on`
            FROM `view_buy_bundle_by_region` b LEFT JOIN `rlms_offer_type` o ON b.`tbuy_offer_type`=o.`offerTypeCode`
            ORDER BY `offerTypeLabel` ASC, `reg_label` ASC;";
        return self::getQueryForDataTable($query);
    }
    public function getVenteDT($data=null){
        global  $date, $fin, $debut;
        if($data) extract($data);
        if($debut&&$fin){
            $debut = date("Y-m-d",strtotime($debut));
            $fin = date("Y-m-d",strtotime($fin));
        }else{
            $debut = date("Y-m-d",strtotime($date)-7776000);
            $fin = date("Y-m-d");
        }
        if(isset($status)){
            switch($status){
                case "success":
                    $status = "`sbundle_result_code`='0' AND ";
                    break;
                case "fail":
                    $status = "`sbundle_result_code` <>'0' AND ";
                    break;
                default:
                    $status = null;
            }
        }
        $query = "SELECT * FROM `view_vente_client` WHERE  {$status} `sbundle_date` BETWEEN '$debut' AND '$fin 23:59:59'";
        return self::getQueryForDataTable($query);
    }
    public function getLaodHistoryDT($data=null){
        global  $date, $fin, $debut;
        if($data) extract($data);
        if($debut&&$fin){
            $debut = date("Y-m-d",strtotime($debut));
            $fin = date("Y-m-d",strtotime($fin));
        }else{
            $debut = date("Y-m-d",strtotime($date)-7776000);
            $fin = date("Y-m-d");
        }
        $loadId = "CONCAT(\"<input name='selectedId[]' value='\",`id`,\"' type='checkbox' class='control-group'>\")";
        $query = "SELECT $loadId, `id`,`loaded_by`, `code_service`, `service_name`,IF(`count_wl`>0, `count_wl`, `count_del`) Nbre, IF(`status` IS NULL OR `status`='','Active',`status`) statut,
                    `created_at`, `updated_at`, `deleted_by` FROM `ml_loadinghistory` 
                    WHERE `created_at` BETWEEN '$debut' AND '$fin 23:59:59' OR `updated_at` BETWEEN '$debut' AND '$fin 23:59:59' ORDER BY `updated_at` DESC;";
        return self::getQueryForDataTable($query);
    }
    public function getServicesListDT($data=null){
        $loadId = "CONCAT(\"<input name='selectedId[]' value='\",`id`,\"' type='checkbox' class='control-group'>\")";
        $query = "SELECT $loadId, `id`, `name`, `code_service`, `description`, IF(`active`=1,'Active', 'Disabled') Statut, `created_at`,`updated_at`
                    FROM `ml_services` ORDER BY `updated_at` DESC;";
        return self::getQueryForDataTable($query);
    }
    public function getUserListDT($data=null){
        $loadId = "CONCAT(\"<input name='selectedId[]' value='\",`id`,\"' type='checkbox' class='control-group'>\")";
        $query = "SELECT $loadId, `id`, `CUID`, `identity`, `phone`, `email`, IF(`active`=1,'Active', 'Disabled') Statut, `description`, IF(`admin_level`=1,'Admin', 'Simple') Role,`description`, `created_at`, `updated_at`
                    FROM `rlms_users` ORDER BY `created_at` DESC;";
        return self::getQueryForDataTable($query);
    }
    public function getLoginHistoryDT($data=null){
        global  $date, $fin, $debut;
        if($data) extract($data);
        if($debut&&$fin){
            $debut = date("Y-m-d",strtotime($debut));
            $fin = date("Y-m-d",strtotime($fin));
        }else{
            $debut = date("Y-m-d",strtotime($date)-7776000);
            $fin = date("Y-m-d");
        }
        $loadId = "<input name='selectedId[]' value='{h.`id`}' type='checkbox' class='control-group'>";
        $query = "SELECT \"$loadId\",h.`id`, h.`CUID`, `identity`, `action`, `statut`, h.`created_at` 
                    FROM `rlms_log_history` h LEFT JOIN `rlms_users` u ON h.`CUID`=u.`CUID` 
                    WHERE h.`created_at` BETWEEN '$debut' AND '$fin 23:59:59' ORDER BY h.`id` DESC;";
        return self::getQueryForDataTable($query);
    }
    public function loginClient($data){
        global $message , $alert, $date;
        $sortie=$id=$CUID=$REQSTATUS=$DATE=$FULLNAME=$NAME=$FIRSTNAME=$DESCRIPTION=$PHONENUMBER=$EMAIL=$MESSAGE=$admin_level=null;
        $cuid=$password=$sortie=null;
        $valid =$status = true;
        if($data){
            extract($data);
            if(!$cuid||!$password){
                $valid =$status =false;
                $message = "Veuillez remplir les champs vides SVP!";
            }
            if($valid){
                $sortie = self::getInfos($data);
                if(isset($sortie)&&$sortie) extract($sortie);
                if($REQSTATUS=="SUCCESS") {
                    $_SESSION = array("isConnected"=>false,
                        "CUID"=>null,
                        "FULLNAME"=>null,
                        "NAME"=>null,
                        "FIRSTNAME"=>null,
                        "EMAIL"=>null,
                        "PHONENUMBER"=>null,
                        "ADMIN_LEVEL"=>null,
                        "message" =>"Connexion reussie!");
                    $status = true;
                    $alert = "dan-success";
                    $message = "Connexion reussie!";
                }else{
                    $status =false;
                    $message ="Login ou mot de passe incorect!";
                    $alert = "dan-bad";
                }
            }else{
                $status =false;
                $alert = "dan-bad";
                $alert = "alert-warning";
            }
            if($status == true){
                $query = "SELECT COUNT(1) Nbre, `id`, `CUID`, `email`, `admin_level`, `active` FROM `rlms_users` WHERE `CUID`='{$CUID}';";
                $getUserInfo = self::getQuery($query);
                $id=isset($getUserInfo[0]["id"])?$getUserInfo[0]["id"]:0;
                $DESCRIPTION=addslashes($DESCRIPTION);
                if(isset($getUserInfo[0]["Nbre"])&&$getUserInfo[0]["Nbre"]){
                    if(isset($getUserInfo[0]["email"])&&!$getUserInfo[0]["email"]){
                        $query ="UPDATE `rlms_users` (`prenom`, `name`, `CUID`, `identity`, `email`, `phone`, `description`, `updated_at`) 
                        VALUES('{$FIRSTNAME}', '{$NAME}', '{$CUID}', '{$FULLNAME}', '{$EMAIL}', '{$PHONENUMBER}', '{$DESCRIPTION}', NOW()) ";
                        self::setQuery($query);
                    }
                    if(isset($getUserInfo[0]["active"])&&$getUserInfo[0]["active"]) {
                        extract($getUserInfo[0]);
                        $_SESSION["ID_USER"] = $id;
                        $_SESSION["CUID"] = $CUID;
                        $_SESSION["FULLNAME"] = $FULLNAME;
                        $_SESSION["FIRSTNAME"] = $FIRSTNAME;
                        $_SESSION["NAME"] = $NAME;
                        $_SESSION["PHONENUMBER"] = $PHONENUMBER;
                        $_SESSION["EMAIL"] = $EMAIL;
                        $_SESSION["ADMIN_LEVEL"] = $admin_level;
                        $_SESSION["status"] = "connected";
                        if (!((isset($_SESSION["logUniqueID"]) && $_SESSION["logUniqueID"]))) {
                            $_SESSION["logUniqueID"] = uniqid("login_");
                        }
                    }else{
                        $_SESSION["status"] = "disconnected";
                        $status = false;
                        $alert = "dan-bad";
                        $message ="Votre compte est inactif, prière de contacter l'administrateur!";
                        session_destroy();
                    }

                }else{
                    $_SESSION["status"] = "disconnected";
                    $status = false;
                    $alert = "dan-bad";
                    $message ="Votre compte a été créé, prière de contacter l'administrateur!";
                    $query ="INSERT INTO `rlms_users` (`name`, `CUID`, `identity`, `email`, `created_at`, `updated_at`, `active`, `phone`, `prenom`, `description`)".
                        "VALUES('{$NAME}', '{$CUID}', '{$FULLNAME}', '{$EMAIL}', NOW(), NOW(), 0, '{$PHONENUMBER}', '{$FIRSTNAME}', '{$DESCRIPTION}');";
                    self::setQuery($query);
                    session_destroy();
                }
            }
            $status = ($status)?"success":addslashes($message);
            $alert_bkp = $alert;
            $message_bkp = $message;
            $id = (!$id)?0:$id;
            $query = "INSERT INTO `rlms_log_history` (`CUID`, `id_user`, `created_at`, `updated_at`, `action`, `statut`) 
                    VALUES('{$CUID}', '{$id}', NOW(), NOW(), 'login', '{$status}');";
            self::setQuery($query);
            $alert = $alert_bkp;
            $message = $message_bkp;
        }else{
            $message = "Aucune donnée trouvé";
            $alert = "alert-warning";
        }
        $userSessionID=$_COOKIE["PHPSESSID"];
        $remoteIP=$_SERVER["REMOTE_ADDR"];
        $serverIP=$_SERVER["SERVER_ADDR"];
        $serverPort=$_SERVER["SERVER_PORT"];
        $userAgent=$_SERVER["HTTP_USER_AGENT"];
        $logUniqueID=(isset($_SESSION["logUniqueID"])&&$_SESSION["logUniqueID"])?$_SESSION["logUniqueID"]:null;
        $retour = array("status"=>$status, "message"=>$message, "alert"=>$alert);
        if(is_array($FULLNAME)) $FULLNAME=null;
        $data = implode( "|" , array_filter($retour, function($v){ return !is_array($v);}));
        $data1 = implode( "|" , array_filter($_SESSION, function($v){ return !is_array($v);}));
        $log = "loginClient[{$CUID}|{$FULLNAME}][Retour:{$data}][Session:{$data1}]";
        $this->customLogToFile($log);
        return $retour;
    }
    public function logoutClient(){
        $id=(isset($_SESSION["ID_USER"])&&$_SESSION["ID_USER"])?$_SESSION["ID_USER"]:"0";
        $CUID=(isset($_SESSION["CUID"])&&$_SESSION["CUID"])?$_SESSION["CUID"]:"None";
        $FULLNAME=(isset($_SESSION["FULLNAME"])&&$_SESSION["FULLNAME"])?$_SESSION["FULLNAME"]:"None";
        $status = "success";
        $message ="Bye-bye, deconnexion reussie!";
        $alert = "dan-success";
        $data1 = implode( "|" , array_filter($_SESSION, function($v){ return !is_array($v);}));
        $query = "INSERT INTO `rlms_log_history` (`CUID`, `id_user`, `created_at`, `updated_at`, `action`, `statut`) 
                    VALUES('{$CUID}', '{$id}', NOW(), NOW(), 'login', '{$status}');";
        self::setQuery($query);
        session_destroy();
        $retour = array("status"=>$status, "message"=>$message, "alert"=>$alert);
        $data = implode( "|" , array_filter($retour, function($v){ return !is_array($v);}));
        $log = "logoutClient[{$CUID}|{$FULLNAME}][Retour:{$data}][Session:{$data1}]";
        $this->customLogToFile($log);
    }
    public function getInfos($data=null){
        global $message , $alert, $date;
        $cuid=$password=$CUID=$REQSTATUS=$DATE=$FULLNAME=$NAME=$FIRSTNAME=$DESCRIPTION=$PHONENUMBER=$EMAIL=$MESSAGE=null;
        $url_ldap=$post_login=null;
        $conf = self::getConfigs();
        extract($conf);
        extract($data);
        $url = $url_ldap;
        $appication = "MyLIST";
        $post_login = str_replace("{{appication}}",$appication,$post_login);
        $post_login = str_replace("{{cuid}}",$cuid,$post_login);
        $post_login = str_replace("{{password}}",$password,$post_login);
        $post_login = str_replace("{{date}}",$date,$post_login);
        $retour=self::sendXmlRequest($url,$post_login,"POST");
        if(isset($retour)&&$retour) extract($retour);
        extract($retour);
//        var_dump($retour);
        $PHONENUMBER = is_array($PHONENUMBER)?null:$PHONENUMBER;
        $EMAIL = is_array($EMAIL)?null:$EMAIL;
        $FULLNAME = is_array($FULLNAME)?null:$FULLNAME;
        $DESCRIPTION = is_array($DESCRIPTION)?null:$DESCRIPTION;
        $log = "GetInfos[{$TYPE}|{$REQSTATUS}|{$MESSAGE}|{$CUID}|{$PHONENUMBER}|{$EMAIL}|{$FULLNAME}|{$DESCRIPTION}]";
        $this->customLogToFile($log);
        return $retour;
    }
    public function chargement($data=null){
        global $message , $alert, $date;
        $selectedId=null;
        $url_ldap=$resultat=$idLoadHist=$type_data=$post_login=$id_service=$code_service=$service_name=$ID_USER=$CUID=$FULLNAME=$FIRSTNAME=$NAME=$PHONENUMBER=$EMAIL=null;
        if($data) extract($data);
        $query = "SELECT  `id` id_service, `code_service`, `name` service_name FROM `ml_services` WHERE `id`='{$selectedId}';";
        $offre = self::getQuery($query);
        if(isset($offre[0])) extract($offre[0]);
        extract($_SESSION);
        $fichier = self::uploadfile();
        extract($fichier);
        if($uploadStatus==1){
            $status = "Uploading";
            $query = "INSERT INTO `ml_loadinghistory`(`loaded_by`, `type_data`, `CUID`, `id_user`, `id_service`, `code_service`, `service_name`, `created_at`, `updated_at`, `status`, `count_wl`)
                VALUES('{$FULLNAME}', '{$type_data}', '{$CUID}', '{$ID_USER}', '{$id_service}', '{$code_service}', '{$service_name}', NOW(),  NOW(), '{$status}', 0)";
            self::setQuery($query);
            $query ="SELECT MAX(`id`) idLoadHist FROM `ml_loadinghistory` WHERE `CUID`='{$CUID}' AND `id_service`='{$id_service}' ORDER BY `id` DESC LIMIT 1;";
            $getID = self::getQuery($query);
            if(isset($getID[0])) extract($getID[0]);
            $query ="INSERT INTO `ml_loadingfile` (`type_data`, `id_service`, `idLoadHist`, `fileName`, `loaded_by`) VALUES('{$type_data}', '{$id_service}', '{$idLoadHist}', '{$uploadedFile}', '{$FULLNAME}');";
            self::setQuery($query);
            ## chargement
            $alert = "dan-success";
            $target_file = "uploads/$uploadedFile";
            $myfile = fopen("$target_file", "r");
            $result=null;$n=$y=$z=0;
            while(!feof($myfile)) {
                $valeur=trim(fgets($myfile));
                switch ($type_data){
                    case "cellid":
                        $table = "`ml_whitelist_cellid`";
                        break;
                    default:
                        $valeur = substr($valeur, -9);
                        $table = "`ml_whitelist_numeros`";
                }
                if(strtolower($valeur)!="numeros"){
                    $n++;
                    $query="INSERT INTO {$table} (`valeur`, `id_service`, `id_load`)
                            VALUES ('{$valeur}','{$id_service}', '{$idLoadHist}');";
                    self::setQuery($query);
                }
            }
            $query="UPDATE `ml_loadinghistory` SET `count_wl`='{$n}', `updated_at`=NOW(), `status`='Active' WHERE `id`='{$idLoadHist}';";
            self::setQuery($query);
            fclose($myfile);
        }else{
            $alert = "dan-fail";
        }
        $message=$resultat;
        $log = "Chargement[{$type_data}|{$CUID}|{$FULLNAME}][{$code_service}|{$service_name}][{$uploadStatus}|{$uploadedFile}|{$resultat}]";
        $this->customLogToFile($log);
        return array("alert"=>$alert, "message"=>$message);
    }
    public function chargementDeletion($data=null){
        global $message , $alert, $date;
        $selectedId=null;
        $url_ldap=$resultat=$idLoadHist=$type_data=$post_login=$id_service=$code_service=$service_name=$ID_USER=$CUID=$FULLNAME=$FIRSTNAME=$NAME=$PHONENUMBER=$EMAIL=null;
        if($data) extract($data);
        extract($_SESSION);
        $selection = (($selectedId)?implode(",",$selectedId):null);
        $query = "UPDATE `ml_loadinghistory` SET `status`='Deleting', `deleted_by`='{$FULLNAME}', `updated_at`=NOW() WHERE `id` IN ({$selection});";
        self::setQuery($query);
        foreach ($selectedId as $id){
            $type_data=null;
            $query ="SELECT `type_data` FROM `ml_loadinghistory` WHERE `id`='{$id}' LIMIT 1;";
            $getID = self::getQuery($query);
            if(isset($getID[0])) extract($getID[0]);
            switch ($type_data){
                case "cellid":
                    $table = "`ml_whitelist_cellid`";
                    break;
                default:
                    $table = "`ml_whitelist_numeros`";
            }
//            var_dump($query);
//            var_dump($getID);
//            var_dump($table);
            $query="DELETE FROM {$table} WHERE `id_load`='{$id}';";
//            var_dump($query);
//            die();
            self::setQuery($query);
            $query = "UPDATE `ml_loadinghistory` SET `status`='Deleted', `updated_at`=NOW() WHERE `id` ='{$id}';";
            self::setQuery($query);
        }
        $alert = "dan-success";
        $message="Opération effectuée!";
        $log = "DeleteChargement[{$selection}][{$CUID}|{$FULLNAME}]";
        $this->customLogToFile($log);
        return array("alert"=>$alert, "message"=>$message);
    }
    public function userUpdate($data=null){
        global $message , $alert, $date;
        $selectedId=null;
        $action=$set_action=$resultat=$idLoadHist=$type_data=$post_login=$id_service=$code_service=$service_name=$ID_USER=$CUID=$FULLNAME=$FIRSTNAME=$NAME=$PHONENUMBER=$EMAIL=null;
        if($data) extract($data);
        extract($_SESSION);
        $selection = (($selectedId)?implode(",",$selectedId):null);

        if(isset($action)&&$action){
            switch ($action){
                case "active" : $set_action = "`active`=1,";
                    break;
                case "disabled" : $set_action = "`active`=0,";
                    break;
                case "admin" : $set_action = "`admin_level`=1,";
                    break;
                case "simple" : $set_action = "`admin_level`=0,";
                    break;
            }
        }
        if($selection){
            $query = "UPDATE `rlms_users` SET {$set_action} `updated_at`=NOW(), `update_by`='{$FULLNAME}'  WHERE `id` IN ({$selection});";
            self::setQuery($query);
            $alert = "dan-success";
            $message="Opération effectuée!";
        }
        $log = "UserUpdate[{$action}|{$selection}][{$CUID}|{$FULLNAME}]";
        $this->customLogToFile($log);
        return array("alert"=>$alert, "message"=>$message);
    }
    public function serviceUpdate($data=null){
        global $message , $alert, $date;
        $selectedId=null;
        $action=$set_action=$resultat=$idLoadHist=$type_data=$post_login=$id_service=$code_service=$service_name=$ID_USER=$CUID=$FULLNAME=$FIRSTNAME=$NAME=$PHONENUMBER=$EMAIL=null;
        if($data) extract($data);
        extract($_SESSION);
        $selection = (($selectedId)?implode(",",$selectedId):null);

        if(isset($action)&&$action){
            switch ($action){
                case "active" : $set_action = 1;
                    break;
                case "disabled" : $set_action = 0;
                    break;
            }
        }
        if($selection){
            $query = "UPDATE `ml_services` SET `active`={$set_action}, `updated_at`=NOW(), `edited_by`='{$FULLNAME}' WHERE `id` IN ({$selection});";
            self::setQuery($query);
            $alert = "dan-success";
            $message="Opération effectuée!";
        }
        $log = "ServiceUpdate[{$action}|{$selection}][{$CUID}|{$FULLNAME}]";
        $this->customLogToFile($log);
        return array("alert"=>$alert, "message"=>$message);
    }
    public function uploadfile(){
        $uploadDir = 'uploads/';
        $uploadStatus = 0;
        $uploadedFile = null;
        if(!empty($_FILES["file"]["name"])){
            // File path config
            $prefix = date("YmdHis_");
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $uploadDir.$prefix.$fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            // Allow certain file formats
            $allowTypes = array('csv', 'txt');
            if(in_array(strtolower($fileType), $allowTypes)){
                // Upload file to the server
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    $uploadedFile = $prefix.$fileName;
                    $uploadStatus = 1;
                    $resultat = "Loading Successful!";
                }else{
                    $uploadStatus = 0;
                    $resultat = "Sorry, there was an error uploading your file.";
                }
            }else{
                $uploadStatus = 0;
                $resultat = "Sorry, only CSV, TXT files are allowed to upload. The type is {$fileType}";
            }
            return array("uploadStatus"=>$uploadStatus, "uploadedFile"=>$uploadedFile, "resultat"=>$resultat );
        }
    }
    public function applyLogin(){
        global $message , $alert, $path, $url;
        require_once("views/viewLogin.php");
    }
    public function checkSession(){
//        var_dump($_SESSION);
        if(isset($_SESSION["status"])&& $_SESSION["status"]=="connected"){
            $retour = array("isConnected"=>true,
                "CUID"=>$_SESSION["CUID"],
                "FULLNAME"=>$_SESSION["FULLNAME"],
                "NAME"=>$_SESSION["NAME"],
                "EMAIL"=>$_SESSION["EMAIL"],
                "FIRSTNAME"=>$_SESSION["FIRSTNAME"],
                "PHONENUMBER"=>$_SESSION["PHONENUMBER"],
                "message" =>"Vous êtes connectés!");
        }else{
            $retour = array("isConnected"=>false,
                "CUID"=>null,
                "FULLNAME"=>null,
                "NAME"=>null,
                "FIRSTNAME"=>null,
                "EMAIL"=>null,
                "PHONENUMBER"=>null,
                "message" =>"Vous n'êtes pas connecté!");
        }
        return $retour;
    }
    public function customLogToFile($log=null, $logType="Debug"){
        global $message, $alert;

        $REMOTE_ADDR=$SERVER_ADDR=$SERVER_PORT=$SERVER_PROTOCOL=$REQUEST_METHOD=$REDIRECT_URL=$REQUEST_URI=$REDIRECT_STATUS=$HTTP_REFERER=$HTTP_USER_AGENT=null;
        $logFile = "logs/customlog_".date("Ymd").".log";
        $transDate = date("Y-m-d H:i:s");
        $logUniqueID = isset($_SESSION["logUniqueID"])?$_SESSION["logUniqueID"]:"No LoginID";
        $contactnumber = isset($_SESSION["PHONENUMBER"])?$_SESSION["PHONENUMBER"]:"No ContactNumer";
        $userFullName = isset($_SESSION["FULLNAME"])?$_SESSION["FULLNAME"]:"No userFullName";
        $level = (isset($_SESSION["ADMIN_LEVEL"])&&$_SESSION["ADMIN_LEVEL"])?"ADMIN":"SIMPLE";
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
        $format = "[{$transDate}] {$logType} <{$logUniqueID}> {$level}-{$contactnumber}-{$userFullName}-$log-From:$REMOTE_ADDR To:$SERVER_ADDR:$SERVER_PORT \"$SERVER_PROTOCOL $REQUEST_URI $REQUEST_METHOD\" $REDIRECT_STATUS \n";
        error_log($format, 3, $logFile);
    }

}