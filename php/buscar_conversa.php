<?php
include("conexao.php");

$usuario_id = $_GET['id'] ?? 0;

$sql = "SELECT remetente, mensagem, criado_em 
        FROM conversas 
        WHERE usuario_id = ? 
        ORDER BY criado_em ASC";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$mensagens = $stmt->get_result();

while ($m = $mensagens->fetch_assoc()) {
        echo "<div class='mensagem " . $m['remetente'] . "'>
            <strong>" . ucfirst($m['remetente']) . ":</strong> 
            " . htmlspecialchars($m['mensagem']) . "
            <br><small>" . $m['criado_em'] . "</small>
          </div>";
}
$stmt->close();
$con->close();
