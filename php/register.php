<?php
include("conexao.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];

    // Use password_hash para segurança
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "⚠️ Este email já está cadastrado";
    } else {
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql); // Corrigido para $con
        $stmt->bind_param("ssss", $nome, $email, $senha_hash, $tipo);
        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "❌ Erro ao cadastrar usuário";
        }
    }
    $stmt->close();
    $con->close();
}
