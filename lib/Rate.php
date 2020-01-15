<?php

class Rate{
    public $isoCode;
    public $bid;
    public $ask;
    public $source;

    public function __construct(String $isoCode){
        $this->isoCode = $isoCode;
    }

    public function getRate(PDO $conn){
        $sql = 'SELECT iso_code, bid, ask, name FROM v_newest WHERE iso_code = :code;';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':code', $this->isoCode, PDO::PARAM_STR);
        $result = $stmt->execute();
        if($result){
            $this->bid = $result['bid'];
            $this->ask = $result['ask'];
            $this->source = $result['name'];
            return true;
        }else{
            return false;
        }
    }

}


?>