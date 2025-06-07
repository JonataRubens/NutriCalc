<?php

class ChatbotController
{
    public function resposta()
    {
        header('Content-Type: application/json');

        $mensagem = strtolower(trim($_POST['mensagem'] ?? ''));

        if (!$mensagem) {
            echo json_encode(['resposta' => 'Mensagem vazia!']);
            return;
        }

        $resposta = match (true) {
            str_contains($mensagem, 'caloria') => "Você pode calcular suas calorias na Calculadora de Calorias!",
            str_contains($mensagem, 'imc') => "Use a Calculadora de IMC!",
            str_contains($mensagem, 'água'), str_contains($mensagem, 'agua') => "Beba cerca de 35ml por kg!",
            str_contains($mensagem, 'dieta') => "Está buscando emagrecer ou ganhar massa?",
            default => "Desculpe, não entendi. Pergunte sobre calorias, IMC, água ou dieta."
        };

        echo json_encode(['resposta' => $resposta]);
    }
}
