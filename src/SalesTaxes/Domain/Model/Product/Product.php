<?php

namespace App\SalesTaxes\Domain\Model\Product;

use App\SalesTaxes\Domain\Model\Tax\Tax;

class Product
{
    private $name;
    private $price;
    private $tax;
    private $imported;

    public function __construct(string $name, float $price, Tax $tax, bool $imported)
    {
        $this->name = $name;
        $this->price = $price;
        $this->tax = $tax;
        $this->imported = $imported;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function tax(): Tax
    {
        return $this->tax;
    }

    public function imported(): bool
    {
        return $this->imported;
    }
}
