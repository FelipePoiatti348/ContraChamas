<?php
// Inicia a sessão para acessar variáveis de sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

// Verifica se o usuário NÃO está logado
if (!isset($_SESSION['email_usuario'])) {

    // Redireciona para a página de login
    header("Location: ../entrar.html");
    exit; // Encerra o script
}

// Pega o email do usuário logado
$email_usuario = $_SESSION['email_usuario'];

// Recebe o valor enviado pelo formulário (status selecionado)
$status = $_POST['solicitacoes'];

// Query base: busca solicitações do usuário logado
$sql = "SELECT * FROM solicitacoes 
        WHERE email = ?";

// Se o usuário selecionou algum filtro
if (!empty($status)) {

    // Acrescenta condição na query(Serve para falar com o banco, pode ser SELECT, INSERT, UPDATE, DELETE)
    $sql .= " AND tem_avcb = ?";
}

// Ordena da mais recente para a mais antiga
$sql .= " ORDER BY data_envio DESC";

// Prepara a query
$stmt = $conn->prepare($sql);

// Se houver filtro selecionado
if (!empty($status)) {

    // "ss" → duas strings (email + filtro)
    $stmt->bind_param("ss", $email_usuario, $status);

} else {

    // Apenas o email do usuário
    $stmt->bind_param("s", $email_usuario);
}

// Executa a consulta
$stmt->execute();

// Obtém o resultado
$result = $stmt->get_result();
?>
