<?php

namespace App\SalesTaxes\Domain\Model\Product;

use App\SalesTaxes\Domain\Model\Tax\Tax;
use App\SalesTaxes\Domain\Model\Tax\TaxFactory;

final class Product
{
    private $name;
    private $price;
    private $tax;
    private $imported;

    public function __construct(string $name, float $price, Tax $tax, bool $imported)
    {
        $this->name = $name;
        $this->price = $price;
        $this->tax = $tax;
        $this->imported = $imported;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function tax(): Tax
    {
        return $this->tax;
    }

    public function imported(): bool
    {
        return $this->imported;
    }

    public function totalTax(): float
    {
        $priceTax = 0.0;
        if (0.0 !== $this->tax->tax()) {
            $priceTax = ($this->tax->tax() * $this->price()) / 100;
        }

        $importedTax = 0.0;
        if ($this->imported()) {
            $importedTax = TaxFactory::createImportedTax()->tax() * $this->price() / 100;
        }

        $totalTax = floor(($priceTax + $importedTax) * 100) / 100;

        return $this->roundUpToNearestZeroPointZeroFive($totalTax);
    }

    private function roundUpToNearestZeroPointZeroFive(float $anFloat): float
    {
        return (ceil($anFloat / 0.05)) * 0.05;
    }

    public function total(): float
    {
        return $this->price + $this->totalTax();
    }
}
