<?php
// ---- CONFIGURAÇÕES ----
$destinatario = "contato@seudominio.com"; // pode deixar fictício

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "contrachamas";

// ---- CONECTA AO BANCO ----
$conn = new mysqli($host, $usuario, $senha, $banco);
if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}

// ---- RECEBE DADOS ----
$nome = $_POST['nome'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$tem_avcb = $_POST['tem_avcb'] ?? '';
$area = $_POST['area'] ?? '';
$arquivo_nome = "";

// ---- TRATA UPLOAD ----
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
  $pasta = "uploads/";
  if (!is_dir($pasta)) mkdir($pasta, 0755);
  $arquivo_nome = time() . "_" . basename($_FILES['arquivo']['name']);
  $caminho = $pasta . $arquivo_nome;
  move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho);
}

// ---- GRAVA NO BANCO ----
$stmt = $conn->prepare("INSERT INTO solicitacoes (nome, endereco, email, telefone, tem_avcb, area, arquivo) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssis", $nome, $endereco, $email, $telefone, $tem_avcb, $area, $arquivo_nome);
$stmt->execute();

// ---- REDIRECIONA ----
header("Location: obrigado.html");
exit;
?>
