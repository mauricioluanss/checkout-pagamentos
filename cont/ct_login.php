<?php
  $email = $_POST["email"];
  $password = $_POST["password"];

  require_once('../conf/config.php');
  $resultado = $conexao->query("SELECT * FROM usuarios WHERE email='$email' AND senha='$password'");

  if ($resultado->num_rows > 0) {
    session_start();
    $_SESSION["usuario"] = $resultado;
    header('Location: ../view/vi_checkout.html');
  } else {
    echo "<script>
            alert('Email ou senha incorretos!');
            window.location.href = '../login.html';
          </script>";
  }

  $conexao->close();
?>