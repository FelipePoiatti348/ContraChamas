<?php

// Conexão com MySQL
$conn = new mysqli("localhost", "root", "", "contrachamas");

// Verificar se houve erro ao conectar no banco
if ($conn->connect_error) {
  
    die("Erro de conexão: " . $conn->connect_error);  // Se houver erro, para tudo e mostra a mensagem
}

// Verifica se o botão "cadastrar_usuario" foi clicado no formulário
if (isset($_POST['cadastrar_usuario'])) {

    // Pega os valores enviados pelo formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Compara senha e confirmação — se forem diferentes, interrompe e mostra erro
    if ($senha !== $confirmar_senha) {
        die("<p style='color:red;'>❌ As senhas não coincidem!</p>
             <a href='../criarConta.html'>Voltar</a>");
    }

    // Criptografa a senha com password_hash 
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // SQL para inserir novo usuário no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha, telefone)
            VALUES ('$nome', '$email', '$senha_hash', '$telefone')";

    // Executa a query e verifica se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        
        header("Location: ../obrigadoCriarConta.html");// Redireciona para página de obrigado em caso de sucesso
        exit(); // Para garantir que nada mais execute
    } else {
       
        echo "<p>Erro ao cadastrar: " . $conn->error . "</p>"; // Caso dê erro, mostra qual foi
    }

    // Fecha a conexão com o banco
    $conn->close();
}
?>
