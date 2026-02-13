<?php

session_start();
require 'config_ex.php';


if (!isset($_SESSION['admin'])) {
    header("Location: ../entrar.html");
    exit();
}

if (isset($_GET['id']) && isset($_GET['status'])) {

    $id = intval($_GET['id']);
    $status = $_GET['status'];

    $sql = "UPDATE solicitacoes SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: ../painel-admin.html");
exit();
?>
