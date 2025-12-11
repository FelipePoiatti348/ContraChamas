<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "contrachamas");

if ($conn->connect_error) {
    echo json_encode(["status" => "erro", "msg" => "Erro ao conectar"]);
    exit;
}

if (isset($_POST['email']) && isset($_POST['senha'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        echo json_encode(["status" => "erro", "msg" => "usuario"]);
        exit;
    }

    $usuario = $resultado->fetch_assoc();

    if (password_verify($senha, $usuario['senha'])) {

        session_start();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];

        echo json_encode(["status" => "ok"]);
        exit;

    } else {
        echo json_encode(["status" => "erro", "msg" => "senha"]);
        exit;
    }
}

echo json_encode(["status" => "erro", "msg" => "dados invalidos"]);
