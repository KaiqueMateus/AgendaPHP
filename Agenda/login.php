<?php 
    // Inclua "templates/header.php" apenas uma vez
    include_once("templates/header.php");
?>

<?php
include_once('./config/connection.php');

if (isset($_SESSION['email'])) {
  header('Location: ./login-logado.php');
  exit();
}

// Configurações de exibição de erros
error_reporting(E_ALL); 
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['email']) && isset($_POST['senha'])) {
      $email = $_POST['email'];
      $senha = $_POST['senha'];

      $query = "SELECT * FROM login WHERE email = '$email'";
      $result = mysqli_query($conexao, $query);

      if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $hashedSenha = $row['senha'];

          if (password_verify($senha, $hashedSenha)) {
              $_SESSION['email'] = $email;
              header('Location: ./login-logado.php');
              exit();
          } else {
              echo 'Usuário ou senha inválidos.';
          }
      } else {
          echo 'Usuário não encontrado.';
      }
  } else {
      echo 'Por favor, preencha todos os campos do formulário.';
  }
}

// Adicione o bloco de mensagens no local apropriado
if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>


<section class="container">
    <div class="row">
      <div class="col-lg-2"></div>
  
      <div class="col-lg-8 my-5">
        <h1 class="text-center">Criar conta ou Entrar</h1>
        <p class="text-center lead">Faça o login ou crie sua conta abaixo</p>
        
        <?php 
        if(isset($_SESSION['msg'])): ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_SESSION['msg']; ?>
            </div>
            <?php 
            // Limpe a variável de sessão após exibição
            unset($_SESSION['msg']);
        endif; ?>
        
        <div class="row">
          <div class="col-lg  my-4">
            <h4>Faça seu cadastro</h4>
            <p>Se você ainda não tem conta, preencha o formulário abaixo</p>
            
            <form action="/agenda/17_AGENDA/criar-conta.php" id="form-login" method="POST">
              <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <label>Senha:</label>
                <input type="password" class="form-control" name="senha">
              </div>
              <button type="submit" class="btn btn-primary my-3" value="Criar!">Criar minha conta</button>
            </form>
          </div>
  
          <div class="col-lg  my-4">
            <h4>Entrar no sistema</h4>
            <p>Se você já tem uma conta, faça login abaixo:</p>
            
            <form action="/agenda/17_AGENDA/login-logado.php" id="login-form" method="POST">
              <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <label>Senha:</label>
                <input type="password" class="form-control" name="senha">
              </div>
              <button type="submit" class="btn btn-primary my-3" value="Entrar!">Entrar</button>
              <a class="text-center" href="../17_AGENDA/editar-senha.php">Editar Senha</a>
            </form>
          </div>
        </div>
      </div>
  
      <div class="col-lg-2"></div>
    </div>
  </section>

<?php 
    include_once("templates/footer.php");
?>
