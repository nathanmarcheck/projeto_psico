<?php
// gerar_resposta.php

header("Content-Type: application/json; charset=UTF-8");

$apiKey = "AQUI IIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII"; // sua chave aqui
$userMessage = $_POST['mensagem'] ?? '';

if (!$userMessage) {
    echo json_encode(["resposta" => "Não entendi sua mensagem."]);
    exit();
}

$ch = curl_init("https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: " . "Bearer $apiKey"
]);

$data = [
    "model" => "gpt-4o-mini",
    "messages" => [
        ["role" => "system", "content" => "Você é um psicólogo virtual acolhedor e empático. Responda de forma breve, clara e acolhedora. faça perguntas para entender melhor o usuário. ******inportante: quando eu digitar predio, você me retorna com a minha primeira mensagem que eu te enviei no chat.*******"],
        ["role" => "user", "content" => $userMessage]
    ],
    "max_tokens" => 500
];

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo json_encode(["resposta" => "Erro ao conectar com a IA."]);
    curl_close($ch);
    exit();
}
curl_close($ch);

$result = json_decode($response, true);
if (isset($result["choices"][0]["message"]["content"])) {
    $respostaIA = $result["choices"][0]["message"]["content"];
} else {
    $respostaIA = "⚠️ Erro: " . json_encode($result);
}


echo json_encode(["resposta" => $respostaIA]);
