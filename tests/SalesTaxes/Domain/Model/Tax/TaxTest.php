<?php

namespace App\Tests\SalesTaxes\Domain\Model\Tax;

use App\SalesTaxes\Domain\Model\Tax\Tax;
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
}
