<?php

class Miner{

    private $conn;
    private $source;
    private $source_id;
    private $source_url;
    private $curr_list = array();

    public function __construct($conn, $source)
    {
        $this->conn = $conn;
        $this->source = strtolower($source);
        $this->getSource();
    }

    private function getSource(){
        $sql = 'SELECT id, url FROM s_source WHERE name = :source LIMIT 1;';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':source', $this->source, PDO::PARAM_STR);
        $result = $stmt->execute();
        if($result){
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->source_id = $data[0]['id'];
            $this->source_url = $data[0]['url'];
            return true;
        }else{
            return false;
        }
    }

    private function getCurrList(){
        $sql = 'SELECT id, iso_code FROM s_currency';
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute();
        if($result){
            $data =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $key => $value) {
                $this->curr_list[$value['iso_code']] = intval($value['id']);
            }
        }
    }


    private function nbpMining(){
        $json = json_decode(file_get_contents($this->source_url), true);
        $data = $json[0]['rates'];
        $sql = 'INSERT INTO currences(id ,s_currency_id, bid, ask, s_source_id, cur_date) VALUES (null, :curr_id, :bid, :ask, :source_id, CURRENT_TIMESTAMP); ';
        $stmt = '';
        foreach ( $data as $key => $value) {
            if(isset($this->curr_list[$value['code']])){
               $stmt .= $sql;
               $stmt = str_replace(':curr_id', $this->curr_list[$value['code']], $stmt);
               $stmt = str_replace(':bid', floatval($value['bid']), $stmt);
               $stmt = str_replace(':ask', floatval($value['ask']), $stmt);
               $stmt = str_replace(':source_id', $this->source_id, $stmt);

            }
        }
        $this->conn->exec($stmt);

    }

    

    public function mining(){
        $this->getCurrList();

        switch($this->source){
            case 'nbp':
                $data = $this->nbpMining();
            break;
        }
        
    }
}


?>