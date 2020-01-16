<?php

    spl_autoload_register(function ($class_name) {
        include '../lib/'.$class_name.'.php';
    });

    $db = new Database();
    $conn = $db->getConnection();

    $miner = new Miner($conn, 'nbp');
    $miner->mining();
    http_response_code(200);
?>