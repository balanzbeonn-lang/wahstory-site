<?php
class connection
{
    private $servername = "localhost";
    private $dbname = "wahstory_wahstory";
    private $username = "root";
    private $password = "s9mQYZwVNjv0xJaK!";
    protected $conn;



    public function openConnection()

    {

        try {

            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;

        } catch (Exception $e) {

            echo "Connection failed: " . $e->getMessage();

        }

    }

};


class Secondaryconnection
{
    private $servername = "localhost";
    private $dbname = "wahstory_wahclub";
    private $username = "root";
    private $password = "s9mQYZwVNjv0xJaK!";
    protected $conn;



    public function SecondaryopenConnection()

    {

        try {

            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;

        } catch (Exception $e) {

            echo "Connection failed: " . $e->getMessage();

        }

    }

};
