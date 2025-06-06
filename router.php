<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include_once __DIR__ . '/app/controllers/ChatController.php';
  exit;
}