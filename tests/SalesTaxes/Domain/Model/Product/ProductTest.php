<?php

namespace App\Tests\SalesTaxes\Domain\Model\Product;

use App\SalesTaxes\Domain\Model\Product\ProductFactory;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    /** @test */
    public function ifProductDontHaveTaxAndNotImported()
    {
        $price = 12.49;
        $product = ProductFactory::createProductWithoutTaxAndNotImported('book', $price);

        $expectedTotalTax = 0;

        $this->assertEquals($expectedTotalTax, $product->totalTax());
        $this->assertEquals($price, $product->total());
    }

    /** @test */
    public function IfProductHaveTaxAndNotImported()
    {
        $product = ProductFactory::createProductWithTaxAndNotImported('music CD', 14.99);

        $expectedTotalTax = 1.50;
        $expectedTotal = 16.49;

        $this->assertEquals($expectedTotalTax, $product->totalTax());
        $this->assertEquals($expectedTotal, $product->total());
    }

    /** @test */
    public function IfProductDontHaveTaxAndImported()
    {
        $product = ProductFactory::createProductWithoutTaxAndImported('imported box of chocolates', 10.00);

        $expectedTotalTax = 0.50;
        $expectedTotal = 10.50;

        $this->assertEquals($expectedTotalTax, $product->totalTax());
        $this->assertEquals($expectedTotal, $product->total());
    }

    /** @test */
    public function IfProductHaveTaxAndImported()
    {
        $product = ProductFactory::createProductWithTaxAndImported('imported bottle of perfume', 47.50);

        $expectedTotalTax = 7.15;
        $expectedTotal = 54.65;

        $this->assertEquals($expectedTotalTax, $product->totalTax());
        $this->assertEquals($expectedTotal, $product->total());
    }
}
