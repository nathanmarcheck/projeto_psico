<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'psicologo') {
    header("Location: index.php");
    exit();
}
$usuario_id = $_GET['id'] ?? 0;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Conversa</title>
    <link rel="stylesheet" href="css/conversa.css">
</head>

<body>
    <h1>Histórico de Conversa</h1>
    <div id="chat"></div>
    <p><a href="painel.php">⬅ Voltar ao painel</a></p>

    <script>
        fetch("php/buscar_conversa.php?id=<?= $usuario_id ?>")
            .then(res => res.text())
            .then(data => {
                document.getElementById("chat").innerHTML = data;
            });
    </script>
</body>

</html>