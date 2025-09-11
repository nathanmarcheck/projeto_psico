<?php
include("conexao.php");

$sql = "SELECT id, nome, email FROM usuarios WHERE tipo = 'cliente'";
$resultado = $con->query($sql);

while ($row = $resultado->fetch_assoc()) {
  echo "<div class='usuario'>
            <strong>" . htmlspecialchars($row['nome']) . "</strong><br>
            <em>" . htmlspecialchars($row['email']) . "</em><br>
            <a href='ver_conversas.php?id=" . $row['id'] . "'>📂 Ver conversa</a>
          </div>";
}
