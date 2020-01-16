<?php

class Log{
    private $conn;
    private $senderId;

    public function FunctionName($conn, $senderId)
    {
        $this->conn = $conn;
        $this->senderId = $senderId;
    }

    public function writeLog($module, $status)
    {
        $sql = 'INSERT INTO log(sender_id, status, module) VALUES( :sender_id , :status , :module );';
        $stmt =  $this->conn->prepare($sql);
        $stmt->bindParam(':sender_id', $this->senderId, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':module', $module, PDO::PARAM_STR);
        $stmt->execute();
    }
}

?>