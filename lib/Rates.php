<?php

class Rates{
    private $list = [];

    public function getRates($conn){
        $sql = 'SELECT iso_code, bid, ask, name FROM v_newest;';
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            foreach ($data as $key => $value) {
                $rate = new Rate($value['iso_code'], $value['bid'], $value['ask'], $value['name']);
                array_push($this->list, $rate);
            }
            return $this->list;
        }else{
            return false;
        }
    }
}


?>