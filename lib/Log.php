<?php

class Log{
    private $conn;
    private $senderId;

    public function FunctionName(PDO $conn, $senderId)
    {
        $this->conn = $conn;
        $this->senderId = $senderId;
    }

    public function writeLog(String $module, String $status)
    {
        $sql = '';
    }
}

?>