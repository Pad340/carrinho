<?php

namespace Cart;
class Produto
{
    private int $produtoID;
    private string $nome;
    private float $valor;
    private int $quantidade;

    public function getProdutoID(): int
    {
        return $this->produtoID;
    }

    public function setProdutoID(int $produtoID): void
    {
        $this->produtoID = $produtoID;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): void
    {
        $this->quantidade = $quantidade;
    }


}