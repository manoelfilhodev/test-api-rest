<?php
class Database
{
    private $host = "162.241.61.89";
    private $database_name = "systex91_DB_API";
    private $username = "systex91_root_api";
    private $password = "nvbb2612!@";

    public $conn;
    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();

        }
        return $this->conn;
    }
}
