<?php
/**
 * Script para realizar o cadastro de usuários no banco. É ativado pelo
 * 'vi_cadastro_usuario.html'.
 */

// dados eviados do formulário.
$nome = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["senha"];

// validação no banco do email.
require_once('../conf/config.php');
$verificacao = $conexao->query("SELECT * FROM usuarios WHERE email='$email'");

// bloco pra validar se existe registro do email no banco.
// se houver, avisa que existe usuário e volta pra pagina de login.
// se nao houver, executa a query pra cadastrar o usuário.
if ($verificacao->num_rows > 0) {
  echo "<script>
          alert('Email já existe na base dados!');
          window.location.href='../view/vi_cadastro_usuario.html';
        </script>";
} else {
  $input = $conexao->query("INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$password')");
  // se a query retornar sucesso, exibe para o usuário e volta pra pagina de login.
  // senão, mostra o erro 
  if ($input) {
    echo "<script>
          alert('Cadastro realizado! Voltando para página de login.');
          window.location.href='../login.html';
          </script>";
  } else {
    echo "<script>
            alert('Erro ao cadastrar: " . $conexao->error . "');
            window.location.href='../view/vi_cadastro_usuario.html';
          </script>";
  }
}
?>