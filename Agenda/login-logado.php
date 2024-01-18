<?php

session_start();

include_once('./config/connection.php');

error_reporting(E_ALL);

ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];


        $sql = "SELECT * FROM login WHERE email = '$email'";
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedSenha = $row['senha'];

            if (password_verify($senha, $hashedSenha)) {
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $hashedSenha;
                header('Location: ./login-logado.php');
                exit();
            } else {
                header('Location: ./login.php');
                exit();
            }
        } else {
            header('Location: ./login.php');
            exit();
        }
    } else {
        header('Location: ./login.php');
        exit();
    }
} elseif (isset($_SESSION['email']) && isset($_SESSION['senha'])) {
    $emailLogado = $_SESSION['email'];
    include_once("templates/header.php");
    ?>

    <section class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 my-5 text-center">
                <h2>Olá, <?php echo $emailLogado; ?>!</h2>
                <p>Aqui você poderá cadastrar seus contatos!</p>
            </div>
        </div>
    </section>

    <?php 
    include_once("templates/footer.php");

    ob_end_flush();
} else {
    header('Location: ./login.php');
    exit();
}
?>
