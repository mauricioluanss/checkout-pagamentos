<?php
/**
 * Esse script starta a partir de 'vi_pagamento_html.php'.
 * Ele recupera dados das variáveis de sessão de 'vi_checkout_html.php' e 'ct_checkout.php'.
 * Ele vai realiza o insert da transação na tabela 'transacoes' e também vai fazer insert na
 * tabela 'itens_transacao' de cada item, relacionando com a transação correspondete.
 */
session_start();

/**
 * Esse bloco cria uma variavel de sessão e redireciona para a página de checkout caso se tente
 * finalizar uma venda com o carrinho vazio. A variavel 'erro_carrinho' só serve como referência
 * para validação na outra página (vi_checkout_html.php).*/
if (!isset($_SESSION['produtos']) || count($_SESSION['produtos']) == 0) {
    $_SESSION['erro_carrinho'] = "";
    header("Location: ../view/vi_checkout_html.php");
    exit();
}

// Validação se o verbo da requisição é post. Se sim, entra no bloco da lógica.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $metodo = $_POST["metodo_pagamento"];
    $produtos = $_SESSION["produtos"];
    $total = 0;

    // percorre 'produtos' e para cada item dentro dele, captura o preço e salva em 'total'.
    foreach ($produtos as $produto) {
        $total += $produto["preco"];
    }

    // isso aqui vai inserir o valor total de uma transação e método de pagamento na tavela 'transacoes'.
    require_once('../conf/conexao_db.php');
    $conexao->query("INSERT INTO transacoes (total, metodo_pagamento) VALUES ('$total', '$metodo')");
    $idTransacao = $conexao->insert_id;

    // insere os produtos na tabela 'itens_transacao' e relaciona com o id da transacao corespondete, como chave estrangeira.
    $stmtItem = $conexao->prepare("INSERT INTO itens_transacao (id_transacao, id_produto, produto_nome, preco_unitario) VALUES (?, ?, ?, ?)");
    foreach ($produtos as $produto) {
        $stmtItem->bind_param("iisd", $idTransacao, $produto["id"], $produto["produto"], $produto["preco"]);
        $stmtItem->execute();
    }
    $stmtItem->close();

    // limpa a  sessão de produtos
    unset($_SESSION["produtos"]);

    // redireciona para tela de confirmação de venda.
    header("Location: ../view/vi_venda_concluida_html.php");
    exit();
} else {
    echo "Requisição inválida.";
}
?>