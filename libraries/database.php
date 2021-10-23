<?php
    // Kết nối CSDL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qlnv";
    $connect = mysqli_connect($servername, $username, $password, $dbname) or die ('khong the ket noi' . mysqli_connect_error());
    if($connect -> connect_error)
    {
        die("Connection false:".$connect->connect_error);
    }
?> 