<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db_suratperingatan";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if(!$conn){
        die("database tidak terkoneksi" . mysqli_connect_error());
    }
