<?php

namespace ModulusCore\Form\Filter;

use Zend\Filter\AbstractFilter;

/**
 * Converting value filter to float
 *
 * @category ModulusCore
 * @package Form\Filter
 * @author William Hoffmann <williamhoffmann@outlook.com>
 */
class Float extends AbstractFilter
{
    /**
     * Defined by Zend\Filter\FilterInterface
     *
     * Returns (float) $value
     *
     * @param string $value
     * @return float
     */
    public function filter($value)
    {
        if ($value === (string) (float) $value || is_float($value)) {
            return (float) $value;
        }
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);

        return (float) ((string) $value);
    }
}