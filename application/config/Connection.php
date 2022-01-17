<?php

namespace app\application\config;

use app\application\utils\Database;

class Connection {

    public $connect;

    public Database $connection;

    //Define a inicialização de objeto da classe Database na instanciação
    public function __construct() {
        $this->connection = new Database;
    }

    //Configura os valores padrão para conexão ao banco de dados
    public function confConnection() {
        $this->connection->setName("pubfuture");
        $this->connection->setUser("root");
        $this->connection->setPass("");
        $this->connection->setHost("localhost");
    }

    //Efetua a conexão ao banco de dados
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
}