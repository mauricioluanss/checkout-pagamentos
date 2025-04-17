<?php
session_start();
require_once("../conf/config.php");

if (!isset($_SESSION['produtos']) || count($_SESSION['produtos']) == 0) {
    die("Nenhum produto na sessão.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $metodo = $_POST["metodo_pagamento"];
    $produtos = $_SESSION["produtos"];
    $total = 0;

    foreach ($produtos as $produto) {
        $total += $produto["preco"];
    }

    // isso aqui vai inserir o registro da transação no banco e obter o ID diretamente
    $conexao->query("INSERT INTO transacoes (total, metodo_pagamento) VALUES ('$total', '$metodo')");
    $idTransacao = $conexao->insert_id;


    // inserir cada item da transação
    $stmtItem = $conexao->prepare("INSERT INTO itens_transacao (id_transacao, id_produto, produto_nome, preco_unitario) VALUES (?, ?, ?, ?)");
    foreach ($produtos as $produto) {
        $stmtItem->bind_param("iisd", $idTransacao, $produto["id"], $produto["produto"], $produto["preco"]);
        $stmtItem->execute();
    }
    $stmtItem->close();

    // Limpar sessão de produtos
    unset($_SESSION["produtos"]);

    // Redirecionar para uma tela de confirmação ou para o início
    header("Location: ../view/vi_venda_concluida_html.php");
    exit();
} else {
    echo "Requisição inválida.";
}
?>