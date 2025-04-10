<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
}

require_once("../conf/config.php");

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