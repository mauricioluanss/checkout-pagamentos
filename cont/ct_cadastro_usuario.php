<?php
$nome = $_POST["name"];
$email = $_POST["email"];
$senha = $_POST["senha"];

require_once('../conf/config.php');
$verificacao = $conexao->query("SELECT * FROM usuarios WHERE email='$email'");

if ($verificacao->num_rows > 0) {
    echo "
        <script>
            alert('Email já existe na base dados!');
            window.location.href='../view/vi_cadastro_usuario.html';
        </script>";
} else {
    try {
        $input = $conexao->query("INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')");
        echo "
            <script>
                alert('Cadastro realizado! Voltando para página de login.');
                window.location.href='../login.html';
            </script>";
    } catch (Exception $e) {
        echo "" . $e->getMessage() . "";
    }
}
?>