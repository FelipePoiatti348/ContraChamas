<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "contrachamas";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $tem_avcb = $_POST['tem_avcb'];
    $area = $_POST['area'];

    $arquivoNome = "";

    if ($tem_avcb === "Sim" && isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === 0) {

        $pasta = "uploads/";

        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $arquivoNome = time() . "-" . basename($_FILES["arquivo"]["name"]);
        $destino = $pasta . $arquivoNome;

        move_uploaded_file($_FILES["arquivo"]["tmp_name"], $destino);
    }

    $sql = "INSERT INTO solicitacoes (nome, endereco, email, telefone, tem_avcb, area, arquivo)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssis", $nome, $endereco, $email, $telefone, $tem_avcb, $area, $arquivoNome);

    if ($stmt->execute()) {
       header("Location: ../obrigado.html");
      exit();
    } else {
        echo "Erro ao enviar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
