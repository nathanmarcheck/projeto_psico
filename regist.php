<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="login_container">
        <h2>Cadastro de usuarios</h2>
        <form action="php/register.php" method="post">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <select name="tipo" required>
                <option value="cliente">Cliente</option>
                <option value="psicologo">Psicologo</option>
            </select>
            <button type="submit">Cadastrar</button>
        </form>
        <p>Já tem conta? <a href="log.php">fazer login</a></p>
    </div>

</body>

</html>