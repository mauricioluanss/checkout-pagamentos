<?php

// bloco de validação se existe sessão de login aberta.
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION["usuario"])) {
  header("location:index.php");
}

require_once('../conf/config.php');

// inicia o carrinho
session_start();
if (!isset($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}

$id = (int) $_POST['id'];

//consulta no banco pelo produto, por meio do id.
$verificacao = $conexao->query("SELECT * FROM produtos WHERE id='$id'");
$produto = $verificacao->fetch_assoc();

// se a consulta der bom, salva os dados do produto no array 'carrinho'.
if ($produto) {
  $_SESSION['carrinho'][] = $produto;
} else {
  $erro = 'Produto com ID $id não encontrado.';
}

$total = 0;
foreach ($_SESSION['carrinho'] as $item) {
  $total += $item['preco'];
}

?>