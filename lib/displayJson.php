<?php

function displayJson($json){
    http_response_code(200);
    header("Content-Type: application/json");
    echo $json;
}

?>