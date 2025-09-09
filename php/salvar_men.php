<?php
session_start();
include("conexao.php");
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo ("Usuário não autenticado");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id'];
    $mensagem = $_POST['mensagem'];
    $remetente  = $_POST['remetente'] ?? 'cliente';

    if (empty($mensagem)) {
        http_response_code(400);
        echo "Mensagem vazia";
        exit();
    }

    $sql = "INSERT INTO conversas (usuario_id, mensagem, remetente) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iss", $usuario_id, $mensagem, $remetente);
    if ($stmt->execute()) {
        echo "Mensagem salva com sucesso";
    } else {
        echo "Erro ao salvar mensagem: " . $stmt->error;
    }
    $stmt->close();
    $con->close();
}
