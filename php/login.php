<?php
include("conexao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            // Login válido → cria sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];

            if ($usuario['tipo'] === 'psicologo') {
                header("Location: ../painel.php");
            } else {
                header("Location: ../chat.php");
            }
            exit();
        } else {
            // Senha incorreta → redireciona com erro=2
            header("Location: ../log.php?erro=2");
            exit();
        }
    } else {
        // Usuário não encontrado → redireciona com erro=1
        header("Location: ../log.php?erro=1");
        exit();
    }

    $stmt->close();
    $con->close();
}
