<?php
$erro = $_GET['erro'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/regist.css">
    <link rel="icon" type="image/png" href="assets/icons/logolonge.ico">
</head>

<body>
    <div class="login_container">
        <h2>Cadastro de usuários</h2>
        <form action="php/register.php" method="post">
            <?php if (!empty($erro)) { ?>
                <p style="color: red;">⚠️ Usuário já existe</p>
            <?php } ?>

            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>

            <select name="tipo" id="tipo" required onchange="mostrarCampoCRP()">
                <option value="cliente">Cliente</option>
                <option value="psicologo">Psicólogo</option>
            </select>

            <!-- Campo CRP (só aparece se for psicólogo) -->
            <div id="campoCRP" style="display:none; margin-top:10px;">
                <input type="text" name="crp" placeholder="CRP (somente psicólogos)">
            </div>

            <button type="submit">Cadastrar</button>
        </form>
        <p>Já tem conta? <a href="log.php">Fazer login</a></p>
    </div>

    <script>
        function mostrarCampoCRP() {
            let tipo = document.getElementById("tipo").value;
            let campoCRP = document.getElementById("campoCRP");

            if (tipo === "psicologo") {
                campoCRP.style.display = "block";
                campoCRP.querySelector("input").setAttribute("required", "required");
            } else {
                campoCRP.style.display = "none";
                campoCRP.querySelector("input").removeAttribute("required");
            }
        }
    </script>
</body>

</html>