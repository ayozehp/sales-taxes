<?php

namespace App\SalesTaxes\Domain\Model\Basket;

use App\SalesTaxes\Domain\Model\Product\Product;

final class Basket
{
    private $products;

    /**
     * @param Product[] $products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * @return Product[]
     */
    public function products(): array
    {
        return $this->products;
    }

    public function totalTax(): float
    {
        $products = $this->products;
        $totalTax = 0;

        foreach ($products as $product) {
            $totalTax = $totalTax + $product->totalTax();
        }

        return $totalTax;
    }

    public function total(): float
    {
        $products = $this->products;
        $total = 0;

        foreach ($products as $product) {
            $total = $total + $product->total();
        }

        return $total;
    }
}
