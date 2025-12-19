<?php
// Define que a resposta deste arquivo será em formato JSON
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "contrachamas";

// Cria a conexão com o banco de dados MySQL
$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica se ocorreu erro na conexão
if ($conn->connect_error) {
    // Retorna um JSON informando erro
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro de conexão'
    ]);
    exit; 
}

// Garante que o código só rode se o formulário for enviado via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recebe os dados enviados pelo formulário
    // Se não existir, define como string vazia
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $tem_avcb = $_POST['tem_avcb'] ?? '';

    // Área construída (se não vier, recebe 0)
    $area = $_POST['area'] ?? 0;

    // Nome do arquivo começa vazio
    $arquivoNome = "";

    // Verifica se o usuário disse que tem AVCB
    // e se um arquivo foi enviado sem erro
    if ($tem_avcb === "Sim" && isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === 0) {

        // Pasta onde os arquivos serão salvos
        $pasta = "uploadsAVCB/";

        // Se a pasta não existir, cria
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        // Cria um nome único para o arquivo (timestamp + nome original)
        $arquivoNome = time() . "-" . basename($_FILES["arquivo"]["name"]);

        // Caminho final do arquivo
        $destino = $pasta . $arquivoNome;

        // Move o arquivo da pasta temporária para a pasta uploads
        move_uploaded_file($_FILES["arquivo"]["tmp_name"], $destino);
    }

    // Comando SQL para inserir os dados
    // O status sempre começa como 'Pendente'
    $sql = "INSERT INTO solicitacoes 
        (nome, endereco, email, telefone, tem_avcb, area, arquivo, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'Pendente')";

    // Prepara o SQL para evitar SQL Injection
    $stmt = $conn->prepare($sql);

    // Liga os valores às interrogações do SQL
    // s = string | i = inteiro, ontagem de cima para baixo
    $stmt->bind_param(
        "sssssis",
        $nome,        
        $endereco,   
        $email,      
        $telefone,   
        $tem_avcb,   
        $area,     
        $arquivoNome  
    );

    // Executa o comando no banco
    if ($stmt->execute()) {

        // Retorna sucesso em JSON
        echo json_encode([
            'status' => 'ok'
        ]);
    } else {

        // Retorna erro em JSON
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'Erro ao salvar no banco'
        ]);
    }

    // Fecha o statement
    $stmt->close();
}

// Fecha a conexão com o banco
$conn->close();

exit;
