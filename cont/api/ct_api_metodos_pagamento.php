<?php
/* session_start(); */

/* if (!isset($_SESSION['api'])) {
    $_SESSION['api'] = true;
} */

//$total = $_POST['total'];
//$metodo_pagamento = $_POST["metodo_pagamento"];


/**
 * funcao transacao
 * */
function chamaTransacao($total)
{
    // endpoint da payer
    $url = "http://localhost:6060/Client/request";

    // body da requisicao (payload)
    $payload = [
        'command' => 'payment',
        'value' => $total
    ];

    // configs da requisicao
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($payload)
        ]
    ]);

    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);
}


?>