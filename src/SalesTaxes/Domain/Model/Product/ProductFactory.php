<?php

namespace App\SalesTaxes\Domain\Model\Product;

use App\SalesTaxes\Domain\Model\Tax\TaxFactory;

final class ProductFactory
{
    public static function createProductWithTaxAndNotImported(string $name, float $price): Product
    {
        return new Product($name, $price, TaxFactory::create10Percent(), false);
    }

    public static function createProductWithoutTaxAndNotImported(string $name, float $price)
    {
        return new Product($name, $price, TaxFactory::create0Percent(), false);
    }
}
