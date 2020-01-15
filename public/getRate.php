<?php
require_once '../lib/Database.php';
require_once '../lib/Log.php';
require_once '../lib/Key.php';
require_once '../lib/displayJson.php';

if(isset($_GET['key']) and !empty($_GET['key']) and isset($_GET['code']) and !empty($_GET['code'])){

    $db = new Database();
    $conn = $db->getConnection();

    $key = new Key($_GET['key'], $conn);

    if($key->auth){
        $log = new Log($conn, $key->sender_id);
        $rate = new Rate($_GET['code']);
        $status = $rate->getRate($conn);
        if($status){
            $json = json_encode($rate);
            displayJson($json);
            $log->writeLog('getRate: '.$_GET['code'], 'Succeed');
        }else{
            http_response_code(401);
            $log->writeLog('getRate: '.$_GET['code'], 'Failed');
        }
        
    }else{
        http_response_code(401);
    }
}else{
    http_response_code(400);
}
?>