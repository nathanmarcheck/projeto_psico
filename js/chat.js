function enviarMensagem() {
    const input = document.getElementById('mensagem');
    const texto = input.value.trim();
    if (texto === '') return;

    // Adiciona mensagem do cliente na tela
    adicionarMensagem('cliente', texto);

    // Salva no banco
    salvarMensagem(texto, 'cliente');

    input.value = '';

    // Resposta automática simulada
    setTimeout(() => {
        const respostas = [
            "Olá, estou aqui para te ouvir 😊",
            "Entendi. Pode me contar mais sobre isso?",
            "Isso parece importante. Como você se sente em relação a isso?",
            "Obrigado por compartilhar isso comigo. Estou aqui para ajudar.",
            "Isso é algo que você gostaria de explorar mais profundamente?",
        ];
        const respostaAleatoria = respostas[Math.floor(Math.random() * respostas.length)];

        adicionarMensagem('ia', respostaAleatoria);

        // Salva resposta no banco
        salvarMensagem(respostaAleatoria, 'ia');

    }, 1000);
}

function adicionarMensagem(remetente, texto) {
    const chatBox = document.getElementById('chat_box');
    const mensagemDiv = document.createElement('div');
    mensagemDiv.classList.add('mensagem', remetente);
    mensagemDiv.innerText = texto;
    chatBox.appendChild(mensagemDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function salvarMensagem(mensagem, remetente) {
    fetch("php/salvar_men.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "mensagem=" + encodeURIComponent(mensagem) + "&remetente=" + remetente
    })
        .then(res => res.text())
        .then(data => console.log("Servidor respondeu:", data))
        .catch(err => console.error("Erro:", err));
}
