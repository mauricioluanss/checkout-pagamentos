<?php
/**
 * Script para realizar a lógica de login / autenticação do usuário, no banco de dados.
 * Este script é acionado pelo formulario em 'login.html'.
 */

// recebe os valores dos input 'email' e 'password', do formulario.
$email = $_POST["email"];
$password = $_POST["password"];

// realiza uma consulta no banco e valida se o email e a senha informadas batem com o registro no banco.
// salva a consulta em $resultado.
require_once('../conf/conexao_db.php');
$resultado = $conexao->query("SELECT * FROM usuarios WHERE email='$email' AND senha='$password'");

// faz a validação da consulta.
// se encontrar registro no banco, abre uma sessão e encaminha para a página de checkout.
// se não encontrar, mostra a msg de credenciais incorretas e redireciona para a tela de login.
if ($resultado->num_rows > 0) {
  session_start();
  $_SESSION["usuario"] = $resultado;
  header('Location: ../view/vi_tab_produtos_checkout_html.php');
} else {
  echo "<script>
              alert('Email ou senha incorretos!');
              window.location.href = '../index.html';
          </script>";
}

$conexao->close();
?>