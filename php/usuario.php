<?php
session_start();
include "conexao.php";

// Verifica se está logado
if (!isset($_SESSION['email_usuario'])) {
    header("Location: ../entrar.html");
    exit;
}

$email_usuario = $_SESSION['email_usuario'];
$status = $_POST['solicitacoes'];

// Query base
$sql = "SELECT * FROM solicitacoes 
        WHERE email = ?";

// Se selecionou um status
if (!empty($status)) {
    $sql .= " AND tem_avcb = ?";
}

$sql .= " ORDER BY data_envio DESC";

$stmt = $conn->prepare($sql);

// Bind
if (!empty($status)) {
    $stmt->bind_param("ss", $email_usuario, $status);
} else {
    $stmt->bind_param("s", $email_usuario);
}

$stmt->execute();
$result = $stmt->get_result();
?>
