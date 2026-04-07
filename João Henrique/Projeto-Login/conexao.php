<?php
$host = "localhost";
$user = "root";
$pass = ""; //coloque sua senha 
$banco = "projeto";

$conn = new mysqli($host, $user, $pass, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>