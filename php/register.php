<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome  = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $tipo  = $_POST['tipo'];
    $crp   = ($tipo === "psicologo" && isset($_POST['crp'])) ? trim($_POST['crp']) : null;

    // Hash seguro da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Verifica se já existe usuário com esse e-mail
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        header("Location: ../cadastro.php?erro=1");
        exit();
    }

    // Insere usuário com CRP (null para cliente)
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo, crp) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $senha_hash, $tipo, $crp);

    if ($stmt->execute()) {
        // Redireciona dependendo do tipo
        if ($tipo == "psicologo") {
            header("Location: ../painel.php");
        } else {
            header("Location: ../log.php");
        }
        exit();
    } else {
        echo "❌ Erro ao cadastrar usuário.";
    }

    $stmt->close();
    $con->close();
}
