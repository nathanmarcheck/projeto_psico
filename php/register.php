<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];

    // Hash seguro da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Verifica se já existe usuário com esse e-mail
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Já existe → volta para cadastro com erro
        header("Location: ../cadastro.php?erro=1");
        exit();
    }

    // Caso contrário, insere usuário
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $senha_hash, $tipo);

    if ($stmt->execute()) {
        header("Location: ../log.php"); // cadastro ok → vai pro login/index
        exit();
    } else {
        echo "❌ Erro ao cadastrar usuário.";
    }

    $stmt->close();
    $con->close();
}
