<?php

use banco\CRUD;

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
    $product->setCategoria($productInfo['categoria']);
    $product->setValor($productInfo['valor']);
    $product->setQuantidade($productInfo['quantidade']);
    $product->setImagem($productInfo['imagem']);

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
    <div class='quebra'>
        <ul>
            <?php foreach ($products as $product) {
                echo "<li>
            <b>{$product['nome']}</b>
            <br>
            {$product['categoria']}
            <br>
            R$ " . number_format($product['valor'], "2", ",", ".") . "
            <br>
             <img src='imagens/{$product['imagem']}' height='150'>
            <br>
            <a href='?id={$product['produto_id']}'>Adicionar ao carrinho</a>
            </li>
            <br>";
            } ?>
        </ul>
    </div>
</main>
</body>

</html>