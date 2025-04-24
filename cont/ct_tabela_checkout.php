<?php

session_start();
require_once("../conf/config.php");


  $produto = $conexao->query("SELECT id, produto, preco FROM produtos ORDER BY id");

  if (!isset($_SESSION['todos_produtos'])) {
    $_SESSION['todos_produtos'] = [];
  }

  while ($linha = $produto->fetch_assoc()) {
    $_SESSION['todos_produtos'][] = $linha;
  }
?>