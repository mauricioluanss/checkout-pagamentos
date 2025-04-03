<?php
/**
 * Script pra validar credenciais de login do usuário no banco de dados.
 */
$email = $_POST["email"];
$password = $_POST["password"];

require_once('../conf/config.php');
$resultado = $conexao->query("SELECT * FROM usuarios WHERE email='$email' AND senha='$password'");

// verifica se existe registro da consulta acima, no banco
if ($resultado->num_rows > 0) {

    // valida se existe sessão ativa. Se não, cria uma
    if (!isset($_SESSION)) {
        session_start();
        $_SESSION['logado'] = true;
        //$_SESSION['id'] = session_id;
        header('Location: ../view/vi_checkout.html');
        exit();
    }
} else {
    //header('Location: login.php?erro=1');
    echo "<script>
            alert('Email ou senha incorretos!');
            window.location.href = '../login.html';
          </script>";
}

$conexao->close();
?>