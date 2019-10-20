<?php

namespace App\SalesTaxes\Domain\Model\Tax;

final class Tax
{
    private $tax;

    public function __construct(float $tax)
    {
        $this->tax = $tax;
    }

    public function tax(): float
    {
        return $this->tax;
    }
}
