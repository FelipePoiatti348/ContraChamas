<?php
// dados de conexão
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "contrachamas";

// cria a conexão
$conn = new mysqli($host, $user, $pass, $dbname);

// verifica se conectou
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
