<?php
/**
 * O script recupera dados das variáveis de sessão de e realiza o insert da transação na tabela 'transacoes',
 * e também vai fazer insert na tabela 'itens_transacao' de cada item, relacionando com a transação correspondete.
 */

/**
 * Se a sessão não estiver iniciada ou estiver vazia (carrinho vazio), redireciona para a página de checkout
 * onde será exibida uma mensagem de erro.
 */
session_start();
if (!isset($_SESSION['produtos']) || count($_SESSION['produtos']) == 0) {
    header("Location: ../view/vi_tab_produtos_checkout_html.php?carrinho_vazio=1");
    exit();
}
/**
 * Aqui eu chamo a funcao que faz as requisições pra chamar a payer
 */
require_once("api/ct_api_metodos_pagamento.php");
if (isset($_POST['metodo_pagamento']) && $_POST['metodo_pagamento'] === "debito") {
    chamaTransacao($_SESSION['totalzao']);
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
    $insercao = $conexao->prepare("INSERT INTO itens_transacao (id_transacao, id_produto, produto_nome, preco_unitario) VALUES (?, ?, ?, ?)");
    foreach ($produtos as $produto) {
        $insercao->bind_param("iisd", $idTransacao, $produto["id"], $produto["produto"], $produto["preco"]);
        $insercao->execute();
    }
    $insercao->close();
    unset($_SESSION["produtos"]);

    header("Location: ../view/vi_venda_concluida_html.php");
    exit();
} else {
    echo "Requisição inválida.";
}
?>