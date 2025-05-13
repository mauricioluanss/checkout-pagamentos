<?php

function chamaTransacao($value)
{
    $url = "http://localhost:6060/Client/request";

    $payload = [
        'command' => 'payment',
        'value' => $value,
        'idPayer' => '00010001',
        'paymentMethod' => 'CARD',
        'paymentType' => 'DEBIT',
        'paymentMethodSubType' => 'FULL_PAYMENT'
    ];

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n",
            'content' => json_encode($payload)
        ]
    ]);

    $response = @file_get_contents($url, false, $context);
    
    if ($response === FALSE) {
        return "Erro";
    }
    
    return $response;
}
?>