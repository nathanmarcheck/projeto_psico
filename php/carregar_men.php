<?php
session_start();
include("conexao.php");

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo "Usuário não autenticado";
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT remetente, mensagem, criado_em FROM conversas 
        WHERE usuario_id = ? ORDER BY criado_em ASC";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

$mensagens = [];
while ($row = $resultado->fetch_assoc()) {
    $mensagens[] = $row;
}

echo json_encode($mensagens);

$stmt->close();
$con->close();
