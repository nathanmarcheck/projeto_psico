<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Chat - Psicologia IA</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="chat_container">
        <h2>Chat com a IA</h2>
        <div id="chat_box" class="chat-box">
            <!-- Mensagens aparecem aqui -->
        </div>

        <div class="chat_input">
            <input type="text" id="mensagem" placeholder="Digite sua mensagem..."
                onkeydown="if (event.keyCode == 13)enviarMensagem()">
            <button onclick="enviarMensagem()">Enviar</button>
        </div>
    </div>

    <script src="js/chat.js"></script>
</body>

</html>