<?php

// Dados de conexão com o banco
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "contrachamas";

// Cria a conexão usando MySQLi
$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado via método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recebe os campos do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $tem_avcb = $_POST['tem_avcb'];
    $area = $_POST['area'];
    $arquivoNome = ""; // Variável padrão caso nenhum arquivo seja enviado

    // Verifica se o usuário tem AVCB e se o arquivo foi enviado corretamente
    if ($tem_avcb === "Sim" && isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === 0) {

        $pasta = "uploads/";  // Pasta onde os arquivos serão salvos

        // Se a pasta não existir, cria com permissão total (0777)
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        // Gera um nome único usando timestamp + nome original do arquivo
        $arquivoNome = time() . "-" . basename($_FILES["arquivo"]["name"]);

        // Caminho completo de destino do arquivo
        $destino = $pasta . $arquivoNome;

        // Move o arquivo temporário para a pasta definitiva
        move_uploaded_file($_FILES["arquivo"]["tmp_name"], $destino);
    }

    // SQL usando prepared statement para evitar SQL Injection
    $sql = "INSERT INTO solicitacoes (nome, endereco, email, telefone, tem_avcb, area, arquivo)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql); // Prepara a query
    $stmt->bind_param("sssssis", $nome, $endereco, $email, $telefone, $tem_avcb, $area, $arquivoNome); // Liga os valores aos placeholders do SQL

    // Executa a query
    if ($stmt->execute()) {

       // Redireciona para página de agradecimento em caso de sucesso
       header("Location: ../obrigado.html");
       exit();
    } else {
        
        // Mostra erro se a execução falhar
        echo "Erro ao enviar: " . $stmt->error;
    }

    // Fecha o statement
    $stmt->close();
}

// Fecha a conexão com o banco
$conn->close();
?>
