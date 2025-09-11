<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'psicologo') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel do Psicólogo</title>
    <link rel="stylesheet" href="css/painel.css">
</head>

<body>
    <h1>Painel do Psicólogo</h1>
    <h2>Lista de clientes</h2>

    <div id="lista_clientes"></div>

    <script>
        fetch("php/listar_cliente.php")
            .then(res => res.text())
            .then(data => {
                document.getElementById("lista_clientes").innerHTML = data;
            });
    </script>
</body>

</html>