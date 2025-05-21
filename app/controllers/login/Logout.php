<?php
session_start();
session_destroy();

// Define que é uma resposta de sucesso, mas não redireciona
http_response_code(200);