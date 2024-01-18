<?php
session_start();
include_once('./config/connection.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Verifique se o e-mail já está em uso
        $emailExistsQuery = "SELECT * FROM login WHERE email = '$email'";
        $emailExistsResult = mysqli_query($conexao, $emailExistsQuery);

        if (mysqli_num_rows($emailExistsResult) > 0) {
            header('Location: ./login.php');
            exit();
        }

        $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

        $result = mysqli_query($conexao, "INSERT INTO login(email, senha) VALUES ('$email', '$hashedSenha')");

        if ($result) {
            header('Location: ./login.php');
            exit();
        } else {
            header('Location: ./login.php');
            exit();
        }
    } else {
        // Campos do formulário não preenchidos
        header('Location: ./login.php');
        exit();
    }
}
?>
