<?php
header('Content-Type: application/json');
include("conexao.php");

$usuario_id = $_GET['id'] ?? 0;

// Conta mensagens do cliente
$sql_qtd = "SELECT COUNT(*) as total FROM conversas WHERE usuario_id = ? AND remetente = 'cliente'";
$stmt_qtd = $con->prepare($sql_qtd);
$stmt_qtd->bind_param("i", $usuario_id);
$stmt_qtd->execute();
$res_qtd = $stmt_qtd->get_result()->fetch_assoc();
$total_cliente = $res_qtd['total'] ?? 0;
$stmt_qtd->close();

// Calcula tempo de uso (em minutos) do cliente
$sql_tempo = "SELECT MIN(criado_em) as inicio, MAX(criado_em) as fim FROM conversas WHERE usuario_id = ? AND remetente = 'cliente'";
$stmt_tempo = $con->prepare($sql_tempo);
$stmt_tempo->bind_param("i", $usuario_id);
$stmt_tempo->execute();
$res_tempo = $stmt_tempo->get_result()->fetch_assoc();
$inicio = $res_tempo['inicio'];
$fim = $res_tempo['fim'];
$stmt_tempo->close();

$tempo_uso = 0;
if ($inicio && $fim) {
    $tempo_uso = round((strtotime($fim) - strtotime($inicio)) / 60); // em minutos
}

echo json_encode([
    "qtd_mensagens" => $total_cliente,
    "tempo_uso_min" => $tempo_uso
]);
$con->close();
