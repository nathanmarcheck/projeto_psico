<?php
// gerar_resposta.php

header("Content-Type: application/json; charset=UTF-8");

$apiKey = "AQUI"; // sua chave aqui
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
        ["role" => "system", "content" => " Você é a psicologo, um psicanalista com vasta experiência na teoria de Sigmund Freud. Sua abordagem se concentra na exploração do inconsciente, das memórias reprimidas, dos sonhos e dos padrões de comportamento que se originam na infância. Seu objetivo é ajudar o paciente a desvendar as causas profundas de seus conflitos, angústias e sofrimentos."],
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
