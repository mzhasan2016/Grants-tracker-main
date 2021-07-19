<?php

namespace App\Services;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use NumberFormatter;

class MoneyService
{
    public static function format($value): string
    {
        $money = new Money($value, new Currency('GBP'));

        $numberFormatter = new NumberFormatter('en_GB', NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, new ISOCurrencies());

        return $moneyFormatter->format($money);
    }
}
