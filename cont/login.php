<?php
/**
 * Script validar credenciais de login do usuário no banco de dados.
 */
require_once('../conf/config.php');

$email = $_POST["email"];
$password = $_POST["password"];

$resultado = $conexao->query("SELECT * FROM usuarios WHERE email='$email' AND senha='$password'");

if ($resultado->num_rows > 0) {
    session_start();
    $_SESSION['logado'] = true;
    header('Location: ../view/tela_operador.html');
    exit();
} else {
    //header('Location: login.php?erro=1');
    echo "<script>
            alert('Email ou senha incorretos!');
            window.location.href = '../../login.html';
          </script>";
}

$conexao->close();
?>