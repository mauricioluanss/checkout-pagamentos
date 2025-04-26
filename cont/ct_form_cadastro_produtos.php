<?php
/**
 * Script para cadastro dos produtos no banco de dados. Além de cadastrar, ele também
 * atualiza a quantidade do produto, se ele ja existir na base.
 */

// bloco de validação se existe sessão de login aberta.
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION["usuario"])) {
  header("location:index.php");
}

// import dos valores enviados pelo formulário lá do html.
$produto = $_POST['produto'];
$quantidade = (int) $_POST['qtd'];
$preco = $_POST['preco'];

// verifica no banco se existe registro do produto.
require_once('../conf/conexao_db.php');
$verificacao = $conexao->query("SELECT * FROM produtos WHERE produto='$produto'");

// bloco de validações -> se a quantidade for menor que um, não cadastra nada.
// Se houver registro do produto no banco, a quantidade dele será atualizada.
// se não houver, ele cadastra o produto na base.
if ($quantidade > 0) {
  if ($verificacao->num_rows > 0) {
    $conexao->query("UPDATE produtos SET quantidade=quantidade + $quantidade WHERE produto='$produto'");
    echo "<script>
            alert('Produto: $produto já existente na base.\\nAtualizado apenas a quantidade deste produto na base.');
            window.location.href = '../view/vi_form_cadastro_produtos_html.php';
          </script>";
  } else {
    $input = $conexao->query("INSERT INTO produtos (produto, quantidade, preco) VALUES ('$produto', '$quantidade', '$preco')");
    echo "<script>
            alert('Produto $produto cadastrado na base de dados.\\nVoltando para a tela de cadastro...');
            window.location.href = '../view/vi_form_cadastro_produtos_html.php';
          </script>";
  }
} else {
  echo "<script>
          alert('Quantidade não pode ser menor que 1.');
          window.location.href='../view/vi_form_cadastro_produtos_html.php';
        </script>";
}
?>