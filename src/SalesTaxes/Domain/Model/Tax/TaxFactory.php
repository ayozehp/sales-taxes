<?php

namespace App\SalesTaxes\Domain\Model\Tax;

final class TaxFactory
{

    public static function create10Percent(): Tax
    {
        return new Tax(10.0);
    }

    public static function create0Percent(): Tax
    {
        return new Tax(0);
    }

    public static function createImportedTax(): Tax
    {
        return new Tax(5.0);
    }
}
