<?php

function connectDatabase(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vutrudongho";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if($conn->connect_error){
        return null;
    }

    return $conn;
}

function closeDatabase($conn){
    if($conn){
        $conn->close();
    }
}

?>

