<?php

namespace app\application\config;

use app\application\utils\Database;

class Connection {

    public $connect;

    public Database $connection;

    public function __construct() {
        $this->connection = new Database;
    }

    public function confConnection() {
        $this->connection->setName("pubfuture");
        $this->connection->setUser("root");
        $this->connection->setPass("");
        $this->connection->setHost("localhost");
    }

    public function connect() {
        $this->confConnection();
        $this->connect =  mysqli_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass(), $this->connection->getName());
        if($this->connect->connect_error) {
            die("Error: " . $this->connect->connect_error);
        }
        else {
            return $this->connect;
        }
    }

    /*public function query($query) {
        $this->query = $query;
        if(!$this->query) {
            $this->error = mysqli_error($this->connect());
        }
    }*/
}