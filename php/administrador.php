<?php

//Ligacao com a pagina ignorada no git de informacoes pessoais
require __DIR__ . '/config.php';

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
        } else {
            echo "<p style='color:red;'>Senha incorreta</p>";
        }

    } else {
        echo "<p style='color:red;'>Email não encontrado</p>";
    }

    $stmt->close();
}

