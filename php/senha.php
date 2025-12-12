<?php

// Define que a resposta será enviada no formato JSON
header("Content-Type: application/json");

// Faz a conexão com o banco de dados MySQL
$conn = new mysqli("localhost", "root", "", "contrachamas");

// Verifica se houve erro na conexão com o banco
if ($conn->connect_error) {
    echo json_encode(["status" => "erro", "msg" => "Erro ao conectar"]);
    exit;
}

// Verifica se email e senha foram enviados pelo formulário
if (isset($_POST['email']) && isset($_POST['senha'])) {

    // Recebe os dados enviados
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Seleciona o usuário pelo email utilizando prepared statement (seguro)
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Se não encontrou nenhum usuário com esse email
    if ($resultado->num_rows === 0) {
        echo json_encode(["status" => "erro", "msg" => "usuario"]);
        exit;
    }

    $usuario = $resultado->fetch_assoc(); // Pega os dados do usuário encontrado

    // Verifica se a senha enviada bate com a senha hashada do banco
    if (password_verify($senha, $usuario['senha'])) {

        // Inicia a sessão do usuário
        session_start();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];

        echo json_encode(["status" => "ok"]);  // Retorna sucesso para o JavaScript
        exit;

    } else {
        
        echo json_encode(["status" => "erro", "msg" => "senha"]);// Senha incorreta
        exit;
    }
}

// Caso email ou senha não tenham sido enviados
echo json_encode(["status" => "erro", "msg" => "dados invalidos"]);
