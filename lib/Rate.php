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
        $sql = 'SELECT iso_code, bid, ask, name FROM v_newest WHERE iso_code = :code LIMIT 1;';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':code', $this->isoCode, PDO::PARAM_STR);
        $result = $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            $data = $data[0];
            $this->bid = $data['bid'];
            $this->ask = $data['ask'];
            $this->source = $data['name'];
            return true;
        }else{
            return false;
        }
    }

}


?>