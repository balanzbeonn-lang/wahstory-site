<?php
// baseclass.php
require_once(__DIR__ . '/../config/config.inc.php');
require_once(__DIR__ . '/../config/functions.inc.php');

define('BASE_URL', rtrim('https://www.wahstory.com', '/'));

@session_start();
require_once(__DIR__ . '/conn.php');
require_once(__DIR__ . '/smtpmailfun.php');

class BaseClass
{
    public $datetime;
    protected $conn;
    protected $openConn;
    protected $Secndconn;
    protected $SecndopenConn;

    function __construct()
    {
        $this->initializeDatabaseConnections();
        $this->setTimezoneAndDatetime();
    }

    // Initialize primary and secondary DB connections
    protected function initializeDatabaseConnections()
    {
        $this->conn = new connection();
        $this->openConn = $this->conn->openConnection();

        // WAHCLUB DB Connections
        $this->Secndconn = new Secondaryconnection();
        $this->SecndopenConn = $this->Secndconn->SecondaryopenConnection();
    }

    // Set default timezone and initialize datetime
    protected function setTimezoneAndDatetime()
    {
        date_default_timezone_set("Asia/Calcutta");
        $this->datetime = date("Y-m-d H:i");
    }
}
?>
