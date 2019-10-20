<?php

namespace App\Tests\SalesTaxes\Domain\Model\Tax;

use App\SalesTaxes\Domain\Model\Tax\Tax;
use App\SalesTaxes\Domain\Model\Tax\TaxFactory;
use PHPUnit\Framework\TestCase;

final class TaxTest extends TestCase
{
    /** @test */
    public function itShouldReturnATaxWith10Percent()
    {
        $taxPercent = 10.0;

        $tax = new Tax($taxPercent);

        $this->assertEquals($taxPercent, $tax->tax());
    }

    /** @test */
    public function itShouldReturnATaxWith5Percent()
    {
        $taxPercent = 0;

        $tax = new Tax($taxPercent);

        $this->assertEquals($taxPercent, $tax->tax());
    }

    /** @test  */
    public function itShouldReturnTrueIfAreEquals()
    {
        $anTax = TaxFactory::create10Percent();
        $otherTax = TaxFactory::create10Percent();

        $this->assertTrue($anTax->equals($otherTax));
    }

    /** @test  */
    public function itShouldReturnFalseIfAreEquals()
    {
        $anTax = TaxFactory::create0Percent();
        $otherTax = TaxFactory::create10Percent();

        $this->assertFalse($anTax->equals($otherTax));
    }

    /** @test  */
    public function itShouldReturnAnNewAddedTax()
    {
        $anTax = new Tax(0.5);
        $otherTax = TaxFactory::create10Percent();

        $expectedTax = 10.5;
        $addedTax = $anTax->add($otherTax);

        $this->assertEquals($expectedTax, $addedTax->tax());
    }
}
