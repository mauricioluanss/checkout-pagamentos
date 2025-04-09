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
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CHECKOUT</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f4f4;
    }

    .container {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      width: 800px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f0f0f0;
    }

    input {
      padding: 8px;
      margin: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #d9dfe6;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #65e62a;
    }

    #total {
      font-size: 20px;
      font-weight: bold;
      margin-top: 10px;
    }

    #pagar {
      background-color: #65e62a;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>PDV MAURICIO 1.0</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Produto</th>
          <th>Preço</th>
          <th>Selecionar</th>
        </tr>
      </thead>
      <tbody id="listaProdutos">
        <!-- script com laço pra jogar os produtos dentro da tabela-->
        <?php
        require_once('../conf/config.php');
        $consulta = $conexao->query("SELECT * FROM produtos");

        while ($linha = $consulta->fetch_assoc()) {
          echo "<tr>
                    <td>{$linha['id']}</td>
                    <td>{$linha['produto']}</td>
                    <td>R$ " . number_format($linha['preco'], 2, ',', '.') . "</td>
                    <td><input type='checkbox' name='selecionados[]' value='{$linha['id']}'></td>
                  </tr>";
        }
        ?>
      </tbody>
    </table>

    <form id="form" method="post">
      <label for="id">ID:</label>
      <input type="number" id="id" name="id" required />
      <button type="submit" id="adicionar">Adicionar</button>
    </form>

    <div id="total">TOTAL: R$</div>

    <button id="pagar" type="submit">Finalizar</button>
  </div>
</body>

</html>