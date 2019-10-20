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

    public function equals(Tax $anTax): bool
    {
        return self::tax() === $anTax->tax;
    }

    public function add(Tax $anTax): self
    {
        $newTaxPercent = $this->tax() + $anTax->tax();

        return new Tax($newTaxPercent);
    }
}
