<?php


class Database
{
    private $servername = "localhost";
    private $username   ="root" ;
    private $password   ="" ;
    private $dbname     ="login_system";
    public $pdo;

    public function __construct()
    {
        if (!isset($this->pdo)){
            try {
                $link = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname,$this->username,$this->password);
                $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $link->exec("SET CHARACTER SET utf8");
                $this->pdo = $link;
            }catch (PDOException $e){
                die("Failed to connect Database" .$e->getMessage());
            }
        }
    }
}