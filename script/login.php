<?php
//chama o arquivo de conexão com o banco de dados
require_once('config.php');

//recebe o email e a senha do formulario em login.html
$email = $_POST["email"];
$password = $_POST["password"];

//faz o select no banco, passando como parâmetro os campos email e senha recebidos do formulario
$resultado = $conexao->query("SELECT * FROM usuarios WHERE email='$email' AND senha='$password'");

// valida se o select realizado acima deu resultado, ou seja, se existe alguma linha no banco que
// corresponda as credencias enviadas no formulario. Se sim, inicia uma sessao php e direciona pra pagina do
// caixa.
if ($resultado->num_rows > 0) {
    session_start();
    $_SESSION['logado'] = true;
    header('Location: ../static/tela_operador.html');
    exit();
} else {
    header('Location: login.php?erro=1');

}

$conexao->close();
?>