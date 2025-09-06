function enviarMensagem() {
    const input = document.getElementById('mensagem');
    const texto = input.value.trim();
    if (texto === '') return;
    adicionarMensagem('cliente', texto);
    input.value = '';
    // Aqui você pode adicionar a lógica para enviar a mensagem ao servidor
    setTimeout(() => {
        const resposta = ["Olá, estou aqui para te ouvir 😊",
            "Entendi. Pode me contar mais sobre isso?",
            "isso parece importante. como você se sente em relação a isso?",
            "Obrigado por compartilhar isso comigo. Estou aqui para ajudar.",
            "Isso é algo que você gostaria de explorar mais profundamente?",
        ];
        const respostaAleatoria = resposta[Math.floor(Math.random() * resposta.length)];
        adicionarMensagem('ia', respostaAleatoria);
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