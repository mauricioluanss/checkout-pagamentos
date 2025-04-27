<?php
/**
 * Script para realizar a lógica de login / autenticação do usuário, no banco de dados.
 */
$email = $_POST["email"];
$password = $_POST["password"];

// consulta as crenciais do usuário.
require_once('../conf/conexao_db.php');
$resultado = $conexao->query("SELECT * FROM usuarios WHERE email='$email' AND senha='$password'");

// faz a validação da consulta.
// se encontrar registro no banco, abre uma sessão e encaminha para a página de checkout.
// se não encontrar, faz um get para a página de login com os parâmetros de credenciais incorretas.
if ($resultado->num_rows > 0) {
    session_start();
    $_SESSION["usuario"] = $resultado;
    header('Location: ../view/vi_tab_produtos_checkout_html.php');
} else {
    header('Location: ../index.php?credenciais_incorretas=1');
    exit();
}

$conexao->close();
?>