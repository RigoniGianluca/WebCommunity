<?php
    require_once ("DBConn.php");
    $conn = new DBConn();

    $conn->conn->query("USE WebCommunity");
    if(isset($_COOKIE['utente'])){
        $utente = $_COOKIE['utente'];
        $query = "DELETE FROM vinili WHERE user='$utente'";
        $query2 = "DELETE FROM users WHERE username='$utente'";

        $conn->conn->query($query);
        $conn->conn->query($query2);
        Header('Location: ./Logout.php');
        exit;
    }