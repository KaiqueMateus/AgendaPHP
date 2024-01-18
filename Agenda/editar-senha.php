<?php
session_start();  

include_once("templates/header_editarSenha.php");
include_once('./config/connection.php');

/*
Não tava funcionando não kkkkkkk
// Se o usuário não estiver logado, redireciona para a página de login.php
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
*/

// Processamento do formulário de alteração de senha
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nova_senha']) && isset($_POST['confirmar_senha']) && isset($_POST['email'])) {
        $email = $_POST['email'];
        $novaSenha = $_POST['nova_senha'];
        $confirmarSenha = $_POST['confirmar_senha'];

        // Consulta o banco de dados para encontrar o usuário pelo e-mail
        $query = "SELECT * FROM login WHERE email = '$email'";
        $result = mysqli_query($conexao, $query);

        if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hashedNovaSenha = password_hash($novaSenha, PASSWORD_DEFAULT);
    // Atualiza a senha no banco de dados
    $updateQuery = "UPDATE login SET senha = '$hashedNovaSenha' WHERE email = '$email'";
    $updateResult = mysqli_query($conexao, $updateQuery);

    if ($updateResult) {
        echo 'Senha alterada com sucesso!';
        header('Location: login.php');
        exit();
    } else {
        echo 'Erro ao alterar a senha!';
        header('Location: editar-senha.php');
        exit();
    }
} else {
    echo 'E-mail não encontrado.';
    header('Location: editar-senha.php');
    exit();
}
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Senha</title>
</head>
<body>



<div class="container">
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    
    <h1 class="text-center">Editar Senha</h1>

    <form action="editar-senha.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="nova_senha">Nova Senha:</label>
            <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
        </div>
        <div class="form-group">
            <label for="confirmar_senha">Confirmar Nova Senha:</label>
            <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Senha</button>
    </form>
</div>

<?php include_once("templates/footer.php"); ?>

</body>
</html>
