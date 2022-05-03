<?php
$dan = new ModelTraitement();
$url=explode("/", filter_var($_GET["url"], FILTER_SANITIZE_URL));
//var_dump($url);

if(isset($url[1])&&$url[1]){
    $methode = $url[1];
}elseif(isset($_POST["methode"])&&$_POST["methode"]){
    $methode = $_POST["methode"];
}else{
    $methode = null;
}
$methode = $_REQUEST["methode"];
if($methode){
    if(method_exists($dan, "$methode"))
        $sortie = $dan->$methode($_REQUEST);
}else{
    $sortie["draw"]=1;
    $sortie["recordsTotal"]=0;
    $sortie["recordsFiltered"]=0;
    $sortie["data"]=[];
}

print_r(json_encode($sortie));
?>