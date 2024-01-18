<?php
// api.php

// Processa solicitações POST para ações específicas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        $response = [
            'status' => 'success',
            'message' => 'Login realizado com sucesso.',
        ];

        // Retorna a resposta JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}

header('HTTP/1.1 400 Bad Request');
exit();
?>
