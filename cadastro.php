<?php 
  $erro = $_GET['erro'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/regist.css">
    <link rel="icon" type="image/png" href="assets/icons/logolonge.ico">
</head>

<body>
    <div class="login_container">
        <h2>Cadastro de usuarios</h2>
        <form action="php/register.php" method="post">
            <?php
            if (!empty($erro)) { ?>
            <p style="color: red;">⚠️ Usuário já existe</p>
            <?php   } ?>
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <select name="tipo" required>
                <option value="cliente">Cliente</option>
                <option value="psicologo">Psicólogo</option>
            </select>
            <button type="submit">Cadastrar</button>
        </form>
        <p>Já tem conta? <a href="log.php">fazer login</a></p>
    </div>

</body>

</html>