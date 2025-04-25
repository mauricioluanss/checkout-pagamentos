<?php

session_start();

// Validação se o verbo da requisição é post. Se sim, entra no bloco da lógica.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
}

require_once('../conf/conexao_db.php');
$produto = $conexao->query("SELECT * FROM produtos WHERE id='$id'");

if (!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}

while ($linha = $produto->fetch_assoc()) {
    $_SESSION['produtos'][] = $linha;
}

header("Location: ../view/vi_checkout_html.php");
exit();
?>