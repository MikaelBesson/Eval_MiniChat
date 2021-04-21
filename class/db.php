<?php


class db {
    private string $server ='localhost';
    private string $user = 'root';
    private string $password = '';
    private string $db = 'minichat';
    private ?PDO $dbLink;

    //__const et tab
    public function __construct() {
        $this->dbLink = $this->connect();
    }

    function connect () : ?PDO {
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db;charset=utf8", $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        }
        catch(PDOException $exception) {
            echo $exception->getMessage();
            die();
        }
    }
    function getdbLink () : ?PDO {
        if(is_null($this->dbLink)) {
            $this->dbLink = $this->connect();
        }
        return $this->dbLink;
    }
}

