<?php
require_once __DIR__ . '/../models/ChatModel.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['question'])) {
  $response = ChatModel::getResponse($data['question']);
  echo json_encode(["response" => $response]);
} else {
  echo json_encode(["response" => "Pergunta inválida."]);
}
