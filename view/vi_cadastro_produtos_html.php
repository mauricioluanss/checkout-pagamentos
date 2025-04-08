<!DOCTYPE html>
<?php
  if (!isset($_SESSION)) {
    session_start();
  }
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
?>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CADASTRAR PRODUTOS</title>
    <style>
      /* Estilo geral para a página */
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }

      /* Container que centraliza o formulário */
      .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
      }

      /* Título */
      h2 {
        text-align: center;
        color: #333;
      }

      /* Estilo dos rótulos */
      label {
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
        display: block;
      }

      /* Estilo dos inputs */
      input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
      }

      /* Estilo do botão de cadastro */
      button {
        width: 100%;
        padding: 12px;
        background-color: #28a745;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
      }

      button:hover {
        background-color: #218838;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <form id="cadastro" action="../cont/ct_cadastro_produtos.php" method="post">
        <h2>CADASTRO DE PRODUTOS</h2>
        <label for="produto">Produto:</label>
        <input type="text" name="produto" id="produto" required />
        <label for="qtd">Qtd:</label>
        <input type="number" name="qtd" id="qtd" required />
        <label for="preco">Preço:</label>
        <input type="text" name="preco" id="preco" required />
        <button type="submit" id="botao">CADASTRAR</button>
      </form>
    </div>
  </body>
</html>
