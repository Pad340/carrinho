<?php

use Cart\Carrinho;
use Cart\Produto;

require 'Carrinho.class.php';
require 'Produto.class.php';
require 'banco/Connect.php';
require 'banco/CRUD.php';

session_start();

$products = (new CRUD())->read('produto');

if (isset($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $productInfo = (new CRUD())->read('produto', "*", 'produto_id', $id);

    $product = new Produto();
    $product->setProdutoID($productInfo['produto_id']);
    $product->setNome($productInfo['nome']);
    $product->setValor($productInfo['valor']);
    $product->setQuantidade($productInfo['quantidade']);

    $cart = new Carrinho();
    $cart->add($product);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Produtos</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<header>
    <h1>Produtos</h1>
    <a href="meuCarrinho.php">Ver carrinho</a>
</header>
<main>
    <ul>
        <?php foreach ($products as $product) {
            echo "<li>
            {$product['nome']}
            <br>
            <br>
            R$ {$product['valor']}
            <br>
            <a href='?id={$product['produto_id']}'>Adicionar ao carrinho</a>
            </li>
            <br>";
        } ?>
    </ul>
</main>
</body>

</html>