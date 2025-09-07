<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "psicologia_ia";
$con = new mysqli($servidor, $usuario, $senha, $banco);
if ($con->connect_error) {
    die("Conexão falhou: " . $con->connect_error);
} else {
    echo "Conectado com sucesso";
}
