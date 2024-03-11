<?php

namespace Cart;

use Cart\Produto;

class Carrinho
{
    public function add(Produto $product): void
    {
        $inCart = false;
        $this->setTotal($product);
        if (count($this->getCart()) > 0) {
            foreach ($this->getCart() as $productInCart) {
                if ($productInCart->getProdutoID() === $product->getProdutoID()) {
                    $quantity = $productInCart->getQuantidade() + $product->getQuantidade();
                    $productInCart->setQuantidade($quantity);
                    $inCart = true;
                    break;
                }
            }
        }

        if (!$inCart) {
            $this->setProductsInCart($product);
        }
    }

    public function addOne(int $id): void
    {
        if (isset($_SESSION['cart']['products'])) {
            foreach ($this->getCart() as $index => $product) {
                if ($product->getProdutoID() === $id) {
                    $product->setQuantidade($product->getQuantidade() + 1);
                    $_SESSION['cart']['total'] += $product->getValor();
                }
            }
        }
    }

    private function setProductsInCart(Produto $product): void
    {
        $_SESSION['cart']['products'][] = $product;
    }

    private function setTotal(Produto $product): void
    {
        if (!isset($_SESSION['cart']['total'])) {
            $_SESSION['cart']['total'] = 0;
        }
        $_SESSION['cart']['total'] += $product->getValor() * $product->getQuantidade();
    }

    public function remove(int $id, bool $oneOrAll = false): void
    {
        if (isset($_SESSION['cart']['products'])) {
            foreach ($this->getCart() as $index => $product) {
                if ($oneOrAll && ($product->getQuantidade() > 1)) {
                    if ($product->getProdutoID() === $id) {
                        $product->setQuantidade($product->getQuantidade() - 1);
                        $_SESSION['cart']['total'] -= $product->getValor();
                    }
                } else {
                    if ($product->getProdutoID() === $id) {
                        unset($_SESSION['cart']['products'][$index]);
                        $_SESSION['cart']['total'] -= $product->getValor() * $product->getQuantidade();
                    }
                }
            }
        }
    }

    public
    function getCart()
    {
        return $_SESSION['cart']['products'] ?? [];
    }

    public
    function getTotal()
    {
        return $_SESSION['cart']['total'] ?? 0;
    }
}