<?php
session_start();
require_once __DIR__ . '/config_ex.php';

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM administrador WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $admin = $result->fetch_assoc();

        if (password_verify($senha, $admin['senha'])) {
            $_SESSION['admin'] = true;
            echo "<p style='color:green;'>Login realizado com sucesso!</p>";
        } else {
            echo "<p style='color:red;'>Senha incorreta</p>";
        }

    } else {
        echo "<p style='color:red;'>Email não encontrado</p>";
    }

    $stmt->close();
}
?>