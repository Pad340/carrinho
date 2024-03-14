<?php

use banco\CRUD;
use modelos\Produto;

require 'Carrinho.class.php';
require 'modelos/Produto.class.php';
require 'banco/Connect.php';
require 'banco/CRUD.php';

session_start();

$products = (new CRUD())->read('produto', "*", "", true);

if (isset($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $productInfo = (new CRUD())->read("produto", "*", "WHERE produto_id = {$id}");

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
    <a style="color: black; border: 1px solid black" href="meuCarrinho.php">Ver carrinho</a>
    <a style="color: black; border: 1px solid black" href="listarPedidos.php">Resumo de pedidos</a>
    <?php if (isset($product)) echo "<h1>". $product->getQuantidade() . "x " . $product->getNome() . " adicionado ao carrinho!</h1>"; ?>
</header>
<main>
    <div class='quebra'>
        <ul>
            <?php foreach ($products as $product) {
                echo "<li><div style='text-align: center; font-size: 20pt'>
            <b>{$product['nome']}</b>
            <br>
            {$product['categoria']}
            <br>
            R$ " . number_format($product['valor'], '2', ',', '.') . "
            <br>
             <img src='imagens/{$product['imagem']}' height='150'>
            <br>
            <a href='?id={$product['produto_id']}'>Adicionar ao carrinho</a>
            </div></li>
            <br>";
            } ?>
        </ul>
    </div>
</main>
</body>

</html>