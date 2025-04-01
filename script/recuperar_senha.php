<?php
// Script para recuperar a senha do usuário. 

 // isso aqui importa o arquivo de configuração do banco de dados, onde é estabelecida a conexão.
require_once('config.php');

// recebe o email do usuário através do formulario html.
// depois faz a consulta no banco e valida se o email existe.
$email = $_POST['email'];
$verificacao = $conexao->query("SELECT * FROM usuarios WHERE email='$email'");

// se existir registro com o email, gera uma senha temporária e atualiza no banco de dados.
if ($verificacao->num_rows > 0) {
    $senha_temporaria = random_int(100000, 9999999);
    $insert_senha_temporaria = $conexao->query("UPDATE usuarios SET senha='$senha_temporaria' WHERE email='$email'");
    echo "Nova senha gerada: " . $senha_temporaria;
    /*
    aqui vou adicionar depois o código para enviar a senha temporária para o email do usuário.
    */
}
?>