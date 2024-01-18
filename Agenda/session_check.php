<?php
/*
// session_check.php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Verifica se o usuário não está logado
    if (!isset($_SESSION['email']) && basename($_SERVER['PHP_SELF']) !== 'login.php') {
        echo "Usuário não logado. Redirecionando para login.php.";
        header('Location: ./login.php');
        exit();
    }
?>