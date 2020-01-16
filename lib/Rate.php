<?php

class Rate{
    public $isoCode;
    public $bid;
    public $ask;
    public $source;

    public function __construct($isoCode, $bid = null, $ask = null, $source = null){
        $this->isoCode = $isoCode;
        $this->bid = $bid;
        $this->ask = $ask;
        $this->source = $source;
    }

    public function getRate($conn){
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