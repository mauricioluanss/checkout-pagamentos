<?php
require_once('config.php');

$email = $_POST['email'];

$verificacao = $conexao->query("SELECT * FROM usuarios WHERE email='$email'");

if ($verificacao->num_rows > 0) {
    $senha_temporaria = random_int(100000, 9999999);
    $insert_senha_temporaria = $conexao->query("UPDATE usuarios SET senha='$senha_temporaria' WHERE email='$email'");

    //if ($conexao->query($insert_senha_temporaria)) {
        echo "Nova senha gerada: " . $senha_temporaria;
    //} else {
    //    echo "Deu ruim ao gerar senha ou salvar ela no banco kkkkkkkkkk...";
    //}
}
?>