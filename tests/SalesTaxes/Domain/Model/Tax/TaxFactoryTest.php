<?php

namespace App\Tests\SalesTaxes\Domain\Model\Tax;

use App\SalesTaxes\Domain\Model\Tax\Tax;
use App\SalesTaxes\Domain\Model\Tax\TaxFactory;
use PHPUnit\Framework\TestCase;

final class TaxFactoryTest extends TestCase
{
    /** @test */
    public function itShouldReturnATaxWithTenPercent()
    {
        $tax = new Tax(10.0);

        $expectedTax = TaxFactory::create10Percent();

        $this->assertInstanceOf(Tax::class, $expectedTax);
        $this->assertEquals($expectedTax->tax(), $tax->tax());
    }

    /** @test */
    public function itShouldReturnATaxWithZeroPercent()
    {
        $tax = new Tax(0);

        $expectedTax = TaxFactory::create0Percent();

        $this->assertInstanceOf(Tax::class, $expectedTax);
        $this->assertEquals($expectedTax->tax(), $tax->tax());
    }

    /** @test */
    public function itShouldReturnATaxWithImportedTax()
    {
        $tax = new Tax(5);

        $expectedTax = TaxFactory::createImportedTax();

        $this->assertInstanceOf(Tax::class, $expectedTax);
        $this->assertEquals($expectedTax->tax(), $tax->tax());
    }
}
