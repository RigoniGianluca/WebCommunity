<?php
    require_once("DBConn.php");
    require_once ("CVinile.php");

    $conn = new DBConn();
    $conn->conn->query("USE WebCommunity");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['eliminaVinile']));{
            $id = $_POST['id'];
            $query = "DELETE FROM vinili WHERE id='$id'";

            $conn->conn->query($query);
            Header('Location: Profile.php');
            exit;
        }
    }