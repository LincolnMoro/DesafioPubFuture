<?php

namespace app\application\config;

class Connection {

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
        confConnection();
        return mysqli_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass(), $this->connection->getName());
    }
}