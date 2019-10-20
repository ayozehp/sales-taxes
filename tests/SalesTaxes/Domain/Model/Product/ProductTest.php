<?php

namespace App\Tests\SalesTaxes\Domain\Model\Product;

use App\SalesTaxes\Domain\Model\Product\ProductFactory;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    /** @test */
    public function itShouldReturnAZeroValueAsTotalTax()
    {
        $product = ProductFactory::createProductWithoutTaxAndNotImported('book', 12.49);

        $expectedTotalTax = 0;

        $this->assertEquals($expectedTotalTax, $product->totalTax());
    }

    /** @test */
    public function itShouldReturnAValueAsTotalTax()
    {
        $product = ProductFactory::createProductWithTaxAndNotImported('music CD', 14.99);

        $expectedTotalTax = 1.50;

        $this->assertEquals($expectedTotalTax, $product->totalTax());
    }
}
