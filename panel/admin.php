<?php
require_once("../db/conn.php");

class admin
{
    private $conn;
    private $openConn;

    function __construct()
    {
        $this->conn = new connection();
        $this->openConn = $this->conn->openConnection();
    }

    function login(){
        $user = $_POST["user"];
        $pass = md5($_POST["pass"]);
        $sql = "select * from admin where user = '$user' and pass = '$pass'";
        $stm = $this->openConn->prepare($sql);
        $stm->execute();
        if ($stm->rowCount()) {
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        else{
            return false;
        }
    }
}
