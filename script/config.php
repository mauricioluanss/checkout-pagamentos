<?php
//script de configuração e conexão do banco

//configuração inicial do banco PHPMyAdmin
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "sistema_login";

//conexão com o banco de dados
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

//validação pra conexão
if ($conexao->connect_error) {
    die("Falha: " . $conexao->connect_error);
} else {
    echo "Sucesso";
}
?>