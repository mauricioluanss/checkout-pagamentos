<?php
require_once('config.php');

$nome = $_POST["name"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$senha_confirma = $_POST["senha_confirma"];

$verificacao = $conexao->query("");


?>