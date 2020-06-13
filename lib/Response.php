<?php

class Response{
    public static function displayJson($json){
        http_response_code(200);
        header("Content-Type: application/json");
        echo $json;
    }

    public static function authError(){
        http_response_code(401);
    }

}


?>