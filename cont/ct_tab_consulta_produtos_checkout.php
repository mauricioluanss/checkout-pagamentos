<?php
/**
 * Script para consultar todos os produtos no banco e salvar numa variável de sessão.
 * Essa variável será utilizada na página de checkout para exibir todos os produtos dentro
 * de uma tabela.
 */
session_start();
$_SESSION['todos_produtos'] = [];

require_once('../conf/conexao_db.php');
$resultado = $conexao->query("SELECT id, produto, preco FROM produtos ORDER BY id");

if ($resultado) {
  while ($produto = $resultado->fetch_assoc()) {
    $_SESSION['todos_produtos'][] = $produto;
  }
  $resultado->free();
}

$conexao->close();
header('Location: ../view/vi_tab_produtos_checkout_html.php');
exit();
?>