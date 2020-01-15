<?php

class Key{
    private $api_key;
    private $conn;
    public $sender_id = null;
    public $auth = false;


    public function __construct(String $api_key, PDO $conn){
        $this->api_key = $api_key;
        $this->conn = $conn;
        $this->verification();
    }

    private function verification(){
        $sql = "SELECT id FROM api_keys WHERE api_keys.key = :key AND block = 0;";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':key', $this->api_key, PDO::PARAM_STR);
        $result = $query->execute();
        if(!empty($result) AND isset($result)){
            $this->auth = true;
            $this->sender_id = $result;
        }
    }
}

?>