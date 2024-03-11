<?php

use Cart\Carrinho;

require 'banco/CRUD.php';
require 'banco/Connect.php';
require 'Carrinho.class.php';
require 'Produto.class.php';

session_start();

$cart = new Carrinho();
$productsInCart = $cart->getCart();

if ($cart->getTotal() > 0) {
    $pedido = new CRUD();
    $lastID = $pedido->insert("pedido", "1, {$cart->getTotal()}, 1", "valor_total, status");

    if (isset($lastID)) {
        foreach ($productsInCart as $productInCart) {
            $pedido->insert(
                "itenspedido",
                "{$productInCart->getProdutoID()},
            {$lastID},
            {$productInCart->getQuantidade()},
            {$productInCart->getValor()},
            " . $productInCart->getValor() * $productInCart->getQuantidade(),
                "produto_id, pedido_id, quantidade, valor_unitario, valor_total"
            );
        }
        $items = $pedido->read("itenspedido", "produto_id, quantidade, valor_unitario, valor_total", "pedido_id", "{$lastID}", true);
    }
} else {
    $msg = "<h4 style='text-align: center'>Você deve ter produtos no carrinho para gerar um pedido.</h4>";
}

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
    <h1>Gerar pedido</h1>
    <a href='index.php'>Voltar às compras</a>
</header>
<main>
    <?php if (isset($lastID)): ?>
        <h1 style="text-align: center">Pedido Gerado com Sucesso!</h1>
        <h2 style="text-align: center">Resumo do Pedido #<?= $lastID; ?></h2>
        <table>
            <tr>
                <th> Nome</th>
                <th> Valor unitário</th>
                <th> Quantidade</th>
                <th> Valor total</th>
            </tr>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td><?= $pedido->read("produto", "nome", "produto_id", "{$item['produto_id']}")['nome'] ?></td>
                    <td>R$ <?= number_format($item['valor_unitario'], 2, ',', '.') ?></td>
                    <td><?= $item['quantidade'] ?></td>
                    <td>R$ <?= number_format($item['valor_total'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>

        </table>
        <ul>
            <li>Total:
                R$ <?= number_format($pedido->read("pedido", "valor_total", "pedido_id", "{$lastID}")['valor_total'], 2, ',', '.'); ?></li>
        </ul>

        <?php session_destroy(); else: ?>
        <?= $msg ?>
    <?php endif; ?>

</main>
</body>

</html>
