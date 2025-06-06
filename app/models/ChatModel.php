<?php
class ChatModel {
  public static function getResponse($question) {
    $answers = [
      "Qual a quantidade ideal de proteína?" => "Em média, 1.6g a 2.2g por kg de peso corporal.",
      "O que é déficit calórico?" => "É quando você consome menos calorias do que gasta.",
      "Me diga um lanche saudável." => "Iogurte natural com frutas e aveia é uma boa opção."
    ];

    return $answers[$question] ?? "Desculpe, ainda não tenho resposta para isso.";
  }
}