<?php
/**
 * Script pra realizar o logoff do sistema.
 * É acionado pelo botão 'logoff' em 'vi_checkout_html.php'.  
 */
session_start();
session_unset();
session_destroy();

header("Location: ../login.html");
exit();
?>