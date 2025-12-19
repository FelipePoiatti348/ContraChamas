<?php
// Cria a conexão com o banco de dados MySQL
$conn = new mysqli("localhost", "root", "", "contrachamas");

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    
    // Interrompe o script e mostra a mensagem de erro
    die("Erro de conexão");
}

// Recebe o status vindo pela URL (GET)
// Se não existir, recebe string vazia
$status = $_GET['status'] ?? '';

// Comando SQL para buscar solicitações pelo status
$sql = "SELECT * FROM solicitacoes WHERE status = ?";

// Prepara o comando SQL (protege contra SQL Injection)
$stmt = $conn->prepare($sql);

// Substitui o ? pelo valor de $status
// "s" indica que o valor é do tipo string
$stmt->bind_param("s", $status);

// Executa a consulta no banco
$stmt->execute();

// Obtém o resultado da consulta
$result = $stmt->get_result();

// Verifica se encontrou algum registro
if ($result->num_rows > 0) {

    // Enquanto houver registros, percorre um por um
    while ($row = $result->fetch_assoc()) {

        // Abre um card para cada solicitação
        echo "<div class='card'>";
        echo "<p><strong>Nome:</strong> {$row['nome']}</p>";
        echo "<p><strong>Email:</strong> {$row['email']}</p>";
        echo "<p><strong>Endereço:</strong> {$row['endereco']}</p>";
        echo "<p><strong>Telefone:</strong> {$row['telefone']}</p>";
        echo "<p><strong>Área:</strong> {$row['area']}</p>";
        echo "<p><strong>Arquivo:</strong> {$row['arquivo']}</p>";
        echo "<p><strong>Status:</strong> {$row['status']}</p>";
        echo "</div><hr>";
    }

} else {

    // Caso não encontre nenhuma solicitação com esse status
    echo "<p>Nenhuma solicitação encontrada.</p>";
}

// Fecha o statement
$stmt->close();

// Fecha a conexão com o banco
$conn->close();
