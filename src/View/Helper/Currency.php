<?php

namespace ModulusCore\View\Helper;

use Zend\I18n\View\Helper\CurrencyFormat;

/**
 * Format currency BRL
 *
 * @category ModulusCore
 * @package View\Helper
 * @author  William Hoffmann <williamhoffmann@outlook.com>
 */
class Currency extends CurrencyFormat
{
    /**
     * @param float $number
     * @param null $currencyCode
     * @param null $showDecimals
     * @param null $locale
     * @param null $pattern
     * @return $this|string
     */
    public function __invoke($number, $currencyCode = null, $showDecimals = null, $locale = null, $pattern = null)
    {
        if (is_null($number)) {
            return $this;
        }

        return $this->formatBr($number);
    }

    /**
     * Format number for the Brazilian format without a dollar sign (locale: en_BR, currency: BRL)
     *
     * @param $number
     * @return string
     */
    protected function formatBr($number)
    {
        return parent::__invoke($number, 'BRL', null, 'pt_BR', 'R$ ');
    }
}
