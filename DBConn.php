<?php

class DBConn
{
    private $host;
    private $username;
    private $password;

    public $conn;

    public function __construct()
    {
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";

        $this->conn = new mysqli($this->host, $this->username, $this->password);
    }
}   