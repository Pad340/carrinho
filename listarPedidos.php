<?php

use banco\CRUD;

require "banco/Connect.php";
require "banco/CRUD.php";

$lerPedidos = new CRUD();
$pedidos = $lerPedidos->fullRead(
    "SELECT p.pedido_id, pr.nome AS nomeProduto, ip.quantidade, ip.valor_total AS total_produto, p.valor_total AS total_pedido, p.data
FROM pedido p
INNER JOIN itenspedido ip ON p.pedido_id = ip.pedido_id
INNER JOIN produto pr ON ip.produto_id = pr.produto_id
ORDER BY p.data DESC");

$totAllPedidos = 0;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Pedido</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<header>
    <h1>Últimos pedidos</h1>
    <a style="color: black; border: 1px solid black" href='index.php'>Voltar às compras</a>
</header>
<main>
    <table>
        <tr>
            <th id="pedido_id">ID Pedido</th>
            <th>Produtos</th>
            <th>Quantidade</th>
            <th>Valor Unitário</th>
            <th>Total do Produto</th>
            <th>Total do Pedido</th>
            <th>Data do Pedido</th>
        </tr>
        <?php foreach ($pedidos as $pedido) {
            $totAllPedidos += $pedido['total_pedido'];
            ?>
            <tr>
                <td><?= $pedido['pedido_id']; ?></td>
                <td><?= $pedido['nomeProduto'] ?></td>
                <td><?= $pedido['quantidade'] ?></td>
                <td>R$ <?= number_format($pedido['total_produto'], 2, ',', '.') ?></td>
                <td><?= number_format($pedido['total_produto'] * $pedido['quantidade'], 2, ',', '.') ?></td>
                <td><?= "R$ " . number_format($pedido['total_pedido'], 2, ',', '.'); ?></td>
                <td><?= $pedido['data'] ?></td>
            </tr>
        <?php } ?>

    </table>
    <ul>
        <li>Total: R$
            <?= number_format($totAllPedidos, 2, ',', '.'); ?></li>
    </ul>
</main>
</body>

</html>
