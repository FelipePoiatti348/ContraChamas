<?php
session_start();
require 'config_ex.php';


if (!isset($_SESSION['admin'])) {
    exit("Acesso negado.");
}

$statusFiltro = $_GET['filtro'] ?? '';

if ($statusFiltro !== '') {
    $sql = "SELECT * FROM solicitacoes WHERE status = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $statusFiltro);
} else {
    $sql = "SELECT * FROM solicitacoes";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<div style='background:#fff; padding:15px; margin:15px; border-radius:8px;'>";

        echo "<p><strong>Nome:</strong> {$row['nome']}</p>";
        echo "<p><strong>Email:</strong> {$row['email']}</p>";
        echo "<p><strong>Status:</strong> {$row['status']}</p>";

        if ($row['status'] !== 'Concluida') {
            echo "<a href='painel-admin.php?id={$row['id']}&status=Concluida'>
                  Marcar como Concluída
                  </a>";
        }

        echo "</div>";
    }

} else {
    echo "<p>Nenhuma solicitação encontrada.</p>";
}

$stmt->close();
$conn->close();
?>
