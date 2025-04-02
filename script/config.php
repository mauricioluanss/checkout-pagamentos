<?php
//script de configuração e conexão do banco

//configuração inicial do banco PHPMyAdmin
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "db_pagamento";

//conexão com o banco de dados
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

//validação pra conexão
if ($conexao->connect_error) {
    die("Falha: " . $conexao->connect_error);
}
?>