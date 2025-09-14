<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'psicologo') {
    header("Location: index.php");
    exit();
}
$usuario_id = $_GET['id'] ?? 0;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Conversa e Análise</title>
    <link rel="stylesheet" href="css/conversa.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/png" href="assets/icons/logolonge.ico">
</head>

<body>
    <h1>Histórico de Conversa</h1>
    <div id="chat"></div>

    <h2>📊 Análise da Conversa</h2>
    <canvas id="grafico"></canvas>

    <a href="painel.php" class="btn-voltar">⬅ Voltar ao painel</a>

    <script>
        // Carregar conversa
        fetch("php/buscar_conversa.php?id=<?= $usuario_id ?>")
            .then(res => res.text())
            .then(data => {
                document.getElementById("chat").innerHTML = data;
            })
            .catch(err => console.error("Erro ao carregar conversa:", err));

        // Carregar dados do gráfico
        fetch("php/buscar_dados.php?id=<?= $usuario_id ?>")
            .then(res => res.json())
            .then(data => {
                const ctx = document.getElementById("grafico").getContext("2d");
                new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: ["Mensagens do cliente", "Tempo de uso(min)"],
                        datasets: [{
                            label: "Dados do Cliente",
                            data: [data.qtd_mensagens, data.tempo_uso_min],
                            backgroundColor: ["#42a5f5", "#9ccc65"]
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            })
            .catch(err => console.error("Erro ao carregar gráfico:", err));
    </script>
</body>

</html>