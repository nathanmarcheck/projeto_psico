function enviarMensagem() {
    const input = document.getElementById('mensagem');
    const texto = input.value.trim();
    if (texto === '') return;

    // Adiciona mensagem do cliente na tela
    adicionarMensagem('cliente', texto);

    // Salva no banco
    salvarMensagem(texto, 'cliente');

    input.value = '';

    // Chama o backend que fala com a IA
    fetch("php/gerar_mensagem.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "mensagem=" + encodeURIComponent(texto)
    })
        .then(res => res.json())
        .then(data => {
            const resposta = data.resposta;

            adicionarMensagem('ia', resposta);

            // Salva resposta da IA no banco
            salvarMensagem(resposta, 'ia');
        })
        .catch(err => console.error("Erro:", err));

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
document.addEventListener("DOMContentLoaded", () => {
    fetch("php/carregar_men.php")
        .then(res => res.json())
        .then(mensagens => {
            mensagens.forEach(m => {
                adicionarMensagem(m.remetente, m.mensagem);
            });
        })
        .catch(err => console.error("Erro ao carregar mensagens:", err));
});
