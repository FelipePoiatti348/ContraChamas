<?php

// Conexão com MySQL
$conn = new mysqli("localhost", "root", "", "contrachamas");

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Somente processa se o botão for clicado
if (isset($_POST['cadastrar_usuario'])) {

    // Receber dados
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Verificar se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        die("<p style='color:red;'>❌ As senhas não coincidem!</p>
             <a href='../criarConta.html'>Voltar</a>");
    }

    // Criptografar senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir no banco
    $sql = "INSERT INTO usuarios (nome, email, senha, telefone)
            VALUES ('$nome', '$email', '$senha_hash', '$telefone')";

    if ($conn->query($sql) === TRUE) {
        // ✔ Redireciona para a página Obrigado ao criar conta
        header("Location: ../obrigadoCriarConta.html");
        exit();
    } else {
        echo "<p>Erro ao cadastrar: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>
