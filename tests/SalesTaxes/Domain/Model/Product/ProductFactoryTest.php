<?php

namespace App\Tests\SalesTaxes\Domain\Model\Product;

use App\SalesTaxes\Domain\Model\Product\ProductFactory;
use App\SalesTaxes\Domain\Model\Tax\TaxFactory;
use PHPUnit\Framework\TestCase;

final class ProductFactoryTest extends TestCase
{
    /** @test */
    public function itShouldReturnAProductWithTaxAndNotImported()
    {
        $name = 'music CD';
        $price = 14.49;
        $tax = TaxFactory::create10Percent();
        $imported = false;

        $product = ProductFactory::createProductWithTaxAndNotImported($name, $price);

        $this->assertEquals($name, $product->name());
        $this->assertEquals($price, $product->price());
        $this->assertTrue($tax->equals($product->tax()));
        $this->assertEquals($imported, $product->imported());
    }

    /** @test */
    public function itShouldReturnAProductWithoutTaxAndNotImported()
    {
        $name = 'book';
        $price = 12.49;
        $tax = TaxFactory::create0Percent();
        $imported = false;

        $product = ProductFactory::createProductWithoutTaxAndNotImported($name, $price);

        $this->assertEquals($name, $product->name());
        $this->assertEquals($price, $product->price());
        $this->assertTrue($tax->equals($product->tax()));
        $this->assertEquals($imported, $product->imported());
    }

    /** @test */
    public function itShouldReturnAProductWithTaxAndImported()
    {
        $name = 'imported bottle of perfume';
        $price = 47.50;
        $tax = (TaxFactory::create10Percent())->add(TaxFactory::createImportedTax());
        $imported = true;

        $product = ProductFactory::createProductWithTaxAndImported($name, $price);

        $this->assertEquals($name, $product->name());
        $this->assertEquals($price, $product->price());
        $this->assertTrue($tax->equals($product->tax()));
        $this->assertEquals($imported, $product->imported());
    }

    /** @test */
    public function itShouldReturnAProductWithoutTaxAndImported()
    {
        $name = 'imported box of chocolates';
        $price = 10.0;
        $tax = (TaxFactory::create0Percent())->add(TaxFactory::createImportedTax());
        $imported = true;

        $product = ProductFactory::createProductWithoutTaxAndImported($name, $price);

        $this->assertEquals($name, $product->name());
        $this->assertEquals($price, $product->price());
        $this->assertTrue($tax->equals($product->tax()));
        $this->assertEquals($imported, $product->imported());
    }
}
