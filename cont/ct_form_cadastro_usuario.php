<?php
/**
 * Script para realizar o cadastro de usuários.
 */

$nome = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["senha"];

/**
 * Bloco pra validar se existe registro do email no banco. Se houver, avisa que já
 * existe e volta pra pagina de recuepração. Se nao houver, executa a query pra cadastrar
 * o usuário.
 */
require_once('../conf/conexao_db.php');
$verificacao = $conexao->query("SELECT * FROM usuarios WHERE email='$email'");

if ($verificacao->num_rows > 0) {
    header("Location: ../view/vi_form_cadastro_usuario_html.php?email_repetido=1");
    exit();
} else {
    $input = $conexao->query("INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$password')");
    if ($input) {
        header("Location: ../index.php?cadastro=1");
        exit();
    } else {
        echo "
        <script>
            alert('Erro ao cadastrar: " . $conexao->error . "');
            window.location.href='../view/vi_form_cadastro_usuario_html.php';
        </script>";
    }
}
$conexao->close();
?>