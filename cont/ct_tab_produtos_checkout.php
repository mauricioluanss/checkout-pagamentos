<?php
/**
 * Script para adicionar produtos ao carrinho de compras por meio do ID.
 */

$id = $_POST['id'];

require_once('../conf/conexao_db.php');
$produto = $conexao->query("SELECT * FROM produtos WHERE id='$id'");

session_start();
if (!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}

while ($linha = $produto->fetch_assoc()) {
    $_SESSION['produtos'][] = $linha;
}
$conexao->close();
header("Location: ../view/vi_tab_produtos_checkout_html.php");
exit();
?>