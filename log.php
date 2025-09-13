<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="login_conteiner">
        <h2>login</h2>
        <form action="php/login.php" method="post">
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