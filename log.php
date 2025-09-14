<?php
$erro = $_GET['erro'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/log.css">
    <link rel="icon" type="image/png" href="assets/icons/logolonge.ico">
</head>

<body>
    <div class="login_conteiner">
        <h2>login</h2>
        <form action="php/login.php" method="post">
            <?php
            if ($erro == 1) { ?>
                <p style="color: red;">⚠️ Usuário não encontrado</p>
            <?php   } ?>
            <?php
            if ($erro == 2) { ?>
                <p style="color: red;">⚠️ Senha incorreta</p>
            <?php   } ?>
            <div class="form_group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form_group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit">Entrar</button>

        </form>
    </div>

</body>

</html>