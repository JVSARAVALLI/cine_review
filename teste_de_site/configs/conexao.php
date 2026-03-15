<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "site_filmes"; 

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>