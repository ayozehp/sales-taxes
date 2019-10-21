<?php

namespace App\Tests\SalesTaxes\Domain\Model\Basket;

use App\SalesTaxes\Domain\Model\Basket\Basket;
use App\SalesTaxes\Domain\Model\Product\ProductFactory;
use PHPUnit\Framework\TestCase;

final class BasketTest extends TestCase
{
    /** @test */
    public function testCaseOne()
    {
        $products = [];
        $products[] = ProductFactory::createProductWithoutTaxAndNotImported('book', 12.49);
        $products[] = ProductFactory::createProductWithTaxAndNotImported('music CD', 14.99);
        $products[] = ProductFactory::createProductWithoutTaxAndNotImported('chocolate bar', 0.85);

        $basket = new Basket($products);

        $expectedTotalTax = 1.50;
        $expectedTotal = 29.83;
        $products = $basket->products();

        $this->assertEquals(12.49, $products[0]->total());
        $this->assertEquals(16.49, $products[1]->total());
        $this->assertEquals(0.85, $products[2]->total());
        $this->assertEquals($expectedTotalTax, $basket->totalTax());
        $this->assertEquals($expectedTotal, $basket->total());
    }

    /** @test */
    public function testCaseTwo()
    {
        $products = [];
        $products[] = ProductFactory::createProductWithoutTaxAndImported(
            'imported box of chocolate',
            10.0
        );
        $products[] = ProductFactory::createProductWithTaxAndImported(
            'imported bottle of perfume',
            47.50
        );

        $basket = new Basket($products);

        $expectedTotalTax = 7.65;
        $expectedTotal = 65.15;
        $products = $basket->products();

        $this->assertEquals(10.50, $products[0]->total());
        $this->assertEquals(54.65, $products[1]->total());
        $this->assertEquals($expectedTotalTax, $basket->totalTax());
        $this->assertEquals($expectedTotal, $basket->total());
    }

    /** @test */
    public function testCaseThree()
    {
        $products = [];
        $products[] = ProductFactory::createProductWithTaxAndImported(
            'imported bottle of perfume',
            27.99
        );
        $products[] = ProductFactory::createProductWithTaxAndNotImported('bottle of perfume', 18.99);
        $products[] = ProductFactory::createProductWithoutTaxAndNotImported(
            'packe of headcache pills',
            9.75
        );
        $products[] = ProductFactory::createProductWithoutTaxAndImported(
            'box of imported chocolates',
            11.25
        );

        $basket = new Basket($products);

        $expectedTotalTax = 6.70;
        $expectedTotal = 74.68;
        $products = $basket->products();

        $this->assertEquals(32.19, $products[0]->total());
        $this->assertEquals(20.89, $products[1]->total());
        $this->assertEquals(9.75, $products[2]->total());
        $this->assertEquals(11.85, $products[3]->total());
        $this->assertEquals($expectedTotalTax, $basket->totalTax());
        $this->assertEquals($expectedTotal, $basket->total());
    }
}
