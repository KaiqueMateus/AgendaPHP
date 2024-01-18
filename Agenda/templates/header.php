<?php
include_once("config/url.php");

// Limpa a mensagem
if (isset($_SESSION['msg'])) {
    $printMsg = $_SESSION['msg'];
    $_SESSION['msg'] = '';
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Agenda de contatos</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/style.css">
</head>

<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <?php if (isset($_SESSION['email']) && basename($_SERVER['PHP_SELF']) !== 'login.php'): ?>
                <a class="navbar-brand" href="<?= $BASE_URL ?>#">
                    <img src="<?= $BASE_URL ?>img/logo.svg" alt="Agenda" id="Logo">
                </a>
                <div class="navbar-nav">
                    <a class="nav-link active" href="<?= $BASE_URL ?>logout.php">Sair</a>
                </div>
            <?php else: ?>
                <a class="navbar-brand">
                    <img src="<?= $BASE_URL ?>img/logo.svg" alt="Agenda" id="Logo">
                </a>
                <div class="navbar-nav">
                    <a class="nav-link active" href="<?= $BASE_URL ?>login.php">Entrar</a>
                </div>
            <?php endif; ?>
        </nav>
    </header>
