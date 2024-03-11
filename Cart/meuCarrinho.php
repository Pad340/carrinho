<?php

use Cart\Carrinho;

require 'Carrinho.class.php';
require 'Produto.class.php';

session_start();

$cart = new Carrinho();
$productsInCart = $cart->getCart();

if (isset($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    if (isset($_GET['remove'])) {
        $cart->remove($id, true);
    } elseif (isset($_GET['add'])) {
        $cart->addOne($id);
    } else {
        $cart->remove($id);
    }
    header('Location: meuCarrinho.php');
} elseif (isset($_GET['removeAll'])) {
    foreach ($productsInCart as $productInCart) {
        $cart->remove($productInCart->getProdutoID());
    }
    header('Location: meuCarrinho.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Carrinho</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<header>
    <h1>Carrinho</h1>
    <a href='index.php'>Voltar às compras</a>
</header>
<main>
    <ul>
        <?php if (count($productsInCart) <= 0) : ?>
            <p>Nenhum produto no carrinho</p>
        <?php endif; ?>

        <?php foreach ($productsInCart as $product) : ?>
            <li>
                <?= $product->getNome(); ?>
                <br>
                R$ <?= number_format($product->getValor(), 2, ',', '.') ?>
                <br>
                Quantidade:
                <a href='?id=<?= $product->getProdutoID(); ?>&remove'>-</a>
                <?= $product->getQuantidade() ?>
                <a href='?id=<?= $product->getProdutoID(); ?>&add'>+</a>
                <br>
                Subtotal: R$ <?= number_format($product->getValor() * $product->getQuantidade(), 2, ',', '.') ?>
                <br>
                <div><a href='?id=<?= $product->getProdutoID(); ?>'>Remover</a></div>
            </li>
            <br>
        <?php endforeach; ?>

        <?php if ($productsInCart): ?>
            <a href='?removeAll'>Esvaziar carrinho</a>
            <br>
        <?php endif; ?>

        <br>
        <li>Total: R$ <?= number_format($cart->getTotal(), 2, ',', '.'); ?></li>
        <br>
        <a href="pedido.php">Gerar pedido</a>
    </ul>
</main>

</body>

</html>
